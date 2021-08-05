<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<?php
$conexao = mysqli_connect('localhost', 'root', '', 'avaliacaoodaw') or die
    ("Sem conexão com o servidor");
/* esse bloco de código em php verifica se existe a sessão, pois o usuário pode
 simplesmente não fazer o login e digitar na barra de endereço do seu navegador
o caminho para a página principal do site (sistema), burlando assim a obrigação de
fazer um login, com isso se ele não estiver feito o login não será criado a session,
então ao verificar que a session não existe a página redireciona o mesmo
 para a index.php.*/
session_start();
if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
{
  unset($_SESSION['login']);
  unset($_SESSION['senha']);
  header('location:index.php');
  }

$logado = $_SESSION['login'];




?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mostrar</title>
</head>

<body>
<table width="1200" height="800" border="1">
    <tr>
        <td height="90" colspan="2" style="text-align:center" bgcolor="#48C9B0">
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
        <td width="103" height="410" bgcolor="#76D7C4">
            <p><a href="site.php">Início</a></p>
            <p><a href="mostrar.php">Mostrar</a></p>
            <p><a href="inserir.php">Inserir</a></p>

        </td>
    <td width="546" bgcolor="#A3E4D7 ">
    <h2>Mostrar todas as músicas</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $consulta = "SELECT codigo, nomemusica, nomeautor, duracao, ano FROM musica";
        $resultado = mysqli_query ($conexao,$consulta);
        echo "codigo - nome da musica - nome do autor - duracao- ano <br>";
        while ($linha = mysqli_fetch_row($resultado))
        {
         echo $linha[0]." - ".$linha[1]." - ".$linha[2]." - ".$linha[3]." - ".$linha[4]."<br>";
        }
        echo "<br><br>";
    
    }
    ?>

  <br><br>
  <input type="submit" name="submit" value="Mostrar">  
</form>

</td>

  </tr>
  <tr>
    <td colspan="2" bgcolor="#0E6655"> </td>
  </tr>
</table>
</body>
</html>