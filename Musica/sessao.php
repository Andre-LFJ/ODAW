<?php
// inicia a sessão
session_start();
// login e senha da página anterior
$login = $_POST['login'];
$senha = $_POST['senha'];

$conexao = mysqli_connect('localhost', 'root', '', 'plataformamusicas') or die
    ("Sem conexão com o servidor");


//pesquisa na tabela de usuarios
$consulta = "SELECT * FROM `USUARIO` WHERE `login` = '$login' AND `senha`= '$senha'";
$resultado = mysqli_query($conexao, $consulta);

$linha = mysqli_fetch_row($resultado);
//echo $linha[2];

if(mysqli_num_rows ($resultado) > 0 ){ /* se encontrar login e senha no bd e vai para o site.php, resultado = 1 */
$_SESSION['login'] = $login;
$_SESSION['senha'] = $senha;
$_SESSION['admin'] = $linha[2];

header('location:site.php');
} else {                    /* se nao encontrar login e senha retorna ao login */
  unset ($_SESSION['login']);
  unset ($_SESSION['senha']);
  unset ($_SESSION['admin']);
  header('location:index.php');
  }
?>