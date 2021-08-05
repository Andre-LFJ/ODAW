<!--“action=sessao.php” para que o formulário repasseas informações para a página sessao.php */ -->
<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<head>
    <title>Login</title>
</head> 
<body>
<table width="1200" height="800", border="1">
    <tr>
        <td colspan="2" bgcolor="#48C9B0">
           <div style="text-align:center; vertical-align: 50%; horizontal-align: 50%">
           
                <form method="post" action="sessao.php" id="formlogin" name="formlogin" >
                <h1>Plataforma de músicas</h1>
                <h3>Fazer login</h3>
                <br>
                <label>Login: </label>
                <input type="text" name="login" id="login"><br><br>
                <label>Senha:</label>
                <input type="password" name="senha" id="senha"><br><br>
                <input type="submit" value="Login  ">
            </div>
    </td>
    </tr>
</form>
</table>
</body>
</html>