<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<?php
$conexao = mysqli_connect('localhost', 'root', '', 'plataformamusicas') or die
    ("Sem conexão com o servidor");

/* verifica se o usuario fez login e se a sessao existe */
session_start();
if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
{
  unset($_SESSION['login']);
  unset($_SESSION['senha']);
  unset($_SESSION['admin']);
  header('location:index.php');  /* se a sessao nao existir, volta para o login */
  }

if($_SESSION['admin']==0){
  header('location:site.php');
}
$logado = $_SESSION['login']; 

$Err = '';
$nomeMusica = '';
$nomeAutor = '';
$ano = '';
$duracao = '';
$nomeArquivo = '';
$preenchido = true;


if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (empty($_POST["nomeMusica"])) {
        $Err = "Todos os campos são necessários.";
        $preenchido = false;
    } else {
        $nomeMusica = test_input($_POST["nomeMusica"]);
        // check if only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/",$nomeMusica)) {
            $Err = "Só é permitido letras e espaços.";
            $preenchido = false;    // pra não cadastrar no banco de dados se o formulario nao tiver completo
        }
    }

    if (empty($_POST["nomeAutor"])) {
        $Err = "Todos os campos são necessários.";
        $preenchido = false;
    } else {
        $nomeAutor = test_input($_POST["nomeAutor"]);
        // check if only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/",$nomeAutor)) {
            $Err = "Só é permitido letras e espaços.";
            $preenchido = false;    // pra não cadastrar no banco de dados se o formulario nao tiver completo
        }
    }

    if (empty($_POST["duracao"])) {
        $Err = "Todos os campos são necessários.";
        $preenchido = false;    
    } else {
        $duracao = test_input($_POST["duracao"]);
        // check if only contains letters and whitespace
        if (!preg_match("/^[0-9]*$/",$duracao)) {
            $Err = "Só é permitido letras e espaços.";
            $preenchido = false;    // pra não cadastrar no banco de dados se o formulario nao tiver completo
        } 
    }

    if (empty($_POST["ano"])) {
        $Err = "Todos os campos são necessários.";
        $preenchido = false;   
    } else {
        $ano = test_input($_POST["ano"]);
        // check if only contains letters and whitespace
        if (!preg_match("/^[0-9]*$/",$ano)) {
            $Err = "Só é permitido letras e espaços.";
            $preenchido = false;    // pra não cadastrar no banco de dados se o formulario nao tiver completo
        }
    }
    if (empty($_POST["nomeArquivo"])) {
        $preenchido = false;
    }else {
        $tmp = $_POST["nomeArquivo"];
        $nomeArq = 'uploads\\\\'.$tmp.'.mp3';
    }


    if($preenchido == false){
        $Err = "Todos os campos são necessários.";
    } else {
        $consulta = "INSERT INTO musica (nomeMusica, nomeAutor, duracao, ano, nomearquivo) VALUES ('$_POST[nomeMusica]','$_POST[nomeAutor]','$_POST[duracao]','$_POST[ano]', '$nomeArq')";
        $resultado = mysqli_query ($conexao, $consulta);
        mysqli_error($conexao);
        if ($resultado)
            $Err = "Música inserida com sucesso.";
        else
            $Err = "Ocorreu um erro ao inserir a música.";
    }

}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Inserir</title>
</head>

<body>
<table  width="100%" height="969" border="1">
  <tr>
        <td height="15%" colspan="2" style="text-align:center" bgcolor="#2586B0">
        <h1>Plataforma de músicas</h1>
        <br>
        <?php
           echo " Bem vindo $logado";
        ?>
        <div style="text-align:right">    
        <a href="logout.php" 
        style="
        background-color: #AAD5E9;
        color: black;
        padding: 14px 25px;
        text-align: center;
        text-decoration: none;
        display: inline-block;">Logout</a>
    </div>
        </td>
    </tr>
    <tr>
        <td width="10%" height="70%" bgcolor="#AAD5E9 ">
        <p><a href="site.php">Início</a></p>
        <p><a href="playlist.php">Playlist</a></p>
        <p><a href="pesquisar.php">Pesquisar</a></p>
        <p><a href="inserir.php">Inserir (admin)</a></p>

        </td>
    <td  bgcolor="#C1DCE8">
    <h2>Inserir músicas</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
    Nome da música: <input type="text" name="nomeMusica"  size="22"  value="<?php echo $nomeMusica;?>"> <br>
    Nome do autor: <input type="text" name="nomeAutor"  size="22" value="<?php echo $nomeAutor;?>"> <br>
    Duração da música: <input type="text" name="duracao"  size="22" value="<?php echo $duracao;?>">  -> escreva 3 minutos e 21 segundos no formato <u>321</u>  <br>
    Ano de publicação: <input type="text" name="ano" size="22" value="<?php echo $ano;?>"> -> escreva o ano no formato yyyy, por exemplo <u>2021</u><br>
    
    Nome do arquivo da música: <input type="text" name="nomeArquivo" size="22" value="<?php echo $nomeArquivo;?>"> -> o arquivo deve estar na pasta uploads<br>

    <span class="error"><?php echo $Err;?></span>


  <br><br>
  <input type="submit" name="submit">  
</form>

</td>

  </tr>
  <tr>
    <td colspan="2" bgcolor="#2586B0"> </td>
  </tr>
</table>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>