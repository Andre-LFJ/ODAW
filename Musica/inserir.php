<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<?php
$conexao = mysqli_connect('localhost', 'root', '', 'avaliacaoodaw') or die
    ("Sem conexão com o servidor");

/* verifica se o usuario fez login e se a sessao existe */
session_start();
if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
{
  unset($_SESSION['login']);
  unset($_SESSION['senha']);
  header('location:index.php');  /* se a sessao nao existir, volta para o login */
  }

$logado = $_SESSION['login']; 

$Err = '';
$nomeMusica = '';
$nomeAutor = '';
$ano = '';
$duracao = '';
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
    if($preenchido == false){
        $Err = "Todos os campos são necessários.";
    } else {
        $consulta = "INSERT INTO musica (nomeMusica, nomeAutor, duracao, ano) VALUES ('$_POST[nomeMusica]','$_POST[nomeAutor]','$_POST[duracao]','$_POST[ano]')";
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
<table width="1200" height="800" border="1">
    <tr>
        <td height="90" colspan="2" style="text-align:center" bgcolor="#48C9B0 ">
            <h1>Plataforma de músicas</h1>
            <br>
        <?php
           echo " Bem vindo $logado";
        ?>
        <div style="text-align:right">    
            <a href="logout.php">Logout</a>
        </div>
        </td>
    </tr>
    <tr>
        <td width="103" height="410" bgcolor="#76D7C4 ">
            <p><a href="site.php">Início</a></p>
            <p><a href="mostrar.php">Mostrar</a></p>
            <p><a href="inserir.php">Inserir</a></p>

        </td>
    <td width="546" bgcolor="#A3E4D7 ">
    <h2>Inserir músicas</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
    Nome da música: <input type="text" name="nomeMusica"  size="22"  value="<?php echo $nomeMusica;?>"> <br>
    Nome do autor: <input type="text" name="nomeAutor"  size="22" value="<?php echo $nomeAutor;?>"> <br>
    Duração da música: <input type="text" name="duracao"  size="22" value="<?php echo $duracao;?>">  -> e   screva 3 minutos e 21 segundos no formato <u>321</u>  <br>
    Ano de publicação: <input type="text" name="ano" size="22" value="<?php echo $ano;?>"> -> escreva o ano no formato yyyy, por exemplo <u>2021</u><br>
    <span class="error"><?php echo $Err;?></span>


  <br><br>
  <input type="submit" name="submit">  
</form>

</td>

  </tr>
  <tr>
    <td colspan="2" bgcolor="#0E6655 "> </td>
  </tr>
</table>
</body>
</html>