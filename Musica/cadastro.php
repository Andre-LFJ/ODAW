<!--“action=sessao.php” para que o formulário repasseas informações para a página sessao.php */ -->
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
  //header('location:index.php');  /* se a sessao nao existir, volta para o login */
  }

//$logado = $_SESSION['login']; 
$name = ""; 
$senha = "";
$preenchido = true;

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    if (empty($_POST["name"])) {
        $nameErr = "Esse campo é necessário.";
        $preenchido = false;                // pra não cadastrar no banco de dados se o formulario nao tiver completo
        echo "aqui1";
        
    } else {
        $name = test_input($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
        $nameErr = "Só é permitido letras e espaços.";
        $preenchido = false;                // pra não cadastrar no banco de dados se o formulario nao tiver completo
        echo "aqui2";
        }
    }
    $uppercase = preg_match('@[A-Z]@', $_POST["senha"]);
    $lowercase = preg_match('@[a-z]@', $_POST["senha"]);
    $number    = preg_match('@[0-9]@', $_POST["senha"]);
    $specialChars = preg_match('@[^\w]@', $_POST["senha"]);

    if (empty($_POST["senha"])) {
        $senhaErr = "Esse campo é necessário.";
        $preenchido = false;  
    } else {
        $senha = test_input($_POST["senha"]);

        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($_POST["senha"]) < 8) {
            $senhaErr = "A senha precisa ter 8 caracteres, um maiusculo, um minusculo, um numero e um caracter especial.";
            $preenchido = false;  
        }
        //if($_POST["name"]=='admin' && $_POST["senha"]=='admin'){
        //    $preenchido=true;
        //}
    }
    if($preenchido == false){
        echo "Faltou preencher todo o formulario";
    } else {
        //$senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $consulta = "INSERT INTO usuario (login, senha) values ('$_POST[name]','$_POST[senha]')";
        $resultado = mysqli_query ($conexao, $consulta);
        mysqli_error($conexao);
        //if ($resultado)
            //echo "Sucesso";
        //else
            //echo "Erro";
    }

}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>
<head>
    <title>Cadastrar usuário</title>
</head> 
<body>
<table  width="100%" height="969" border="1">
    <tr>
        <td colspan="2" bgcolor="#AAD5E9">
           <div style="text-align:center; vertical-align: 50%; horizontal-align: 50%">
           <h1>Plataforma de músicas</h1>
                <h3>Criar conta</h3>
                <br>
           
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
                Login: <input type="text" name="name" value="<?php echo $name;?>">
                
                <br><br>

                Senha: <input type="password" name="senha" value="<?php echo $senha;?>">
                
                <br><br>
                <input type="submit" name="submit">  
                <br><br>
                <p><a href="http://localhost/musica/index.php">Fazer login</a></p>
            </div>
    </td>
    </tr>
</form>
</table>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>