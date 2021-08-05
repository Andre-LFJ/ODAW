<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<head>
<?php


/* verifica se o usuario fez login e se a sessao existe */
session_start();
if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true)) 
{
  unset($_SESSION['login']);
  unset($_SESSION['senha']);
  header('location:index.php'); /* se a sessao nao existir, volta para o login */
  }

$logado = $_SESSION['login'];
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SISTEMA WEB</title>
</head>

<body>
<table width="1200" height="800" border="1">
  <tr>
    <td height="90" colspan="2" style="text-align:center" bgcolor="#48C9B0">
    <h1>Plataforma de músicas</h1>
    <br>
    <?php
        echo" Bem vindo $logado";
    ?>
    <div style="text-align:right">    
        <a href="logout.php">Logout</a>
    </div>
    </td>
  </tr>
  <tr>
    <td width="103" height="410" bgcolor="#76D7C4   ">
        <p><a href="site.php">Início</a></p>
        <p><a href="mostrar.php">Mostrar</a></p>
        <p><a href="inserir.php">Inserir</a></p>

    </td>
    <td width="546" bgcolor="#A3E4D7 ">
        <h2>Selecione no menu à esquerda alguma opção</h2>
    </td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#0E6655"> </td>
  </tr>
</table>
</body>
</html>