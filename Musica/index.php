<!--“action=sessao.php” para que o formulário repasseas informações para a página sessao.php */ -->
<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Login</title>
</head> 
<body>
<table  width="100%" height="969" border="1">
    <tr>
        <td colspan="2" bgcolor="#AAD5E9">
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
                <br><br>
                <p><a href="http://localhost/musica/cadastro.php">Criar conta</a></p>
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