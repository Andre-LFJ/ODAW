
<!DOCTYPE html>
<meta charset="UTF-8">
<?php
    $cookie_name = "user";
    $cookie_value = "Andre Francisco";
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
?>

<html>
<head>
    <title>Melhor página que existe</title>
</head>

<body>
<?php
// define variables and set to empty values
$email = ""; $emailErr = "";
$senha = ""; $senhaErr = "";
$msgLogin = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //----------------------------------------
    $userN = $_POST["email"];
    $passW = $_POST["senha"];
    $userlist = file ("autenticacao.txt");

    $email = "";
    $senha = "";
    
    $success = false;
 
    foreach ($userlist as $user) {
        $user_details = explode("|", $user);

        if ($user_details[0] == $userN && password_verify($passW , $user_details[1])) {
            $success = true;
            
            //$email = $user_details[0];
            //$senha = $user_details[1];
            break;
        }
    }
    
    if ($success) {
        //echo "<br> Hi $userN you have been logged in. <br>";
        $msgLogin = "Credenciais corretas";
    } else {
        //echo "<br> You have entered the wrong username or password. Please try again. <br>";
        $msgLogin = "Falha no login";
    }
    
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

<h2>Login em PHP</h2>
<p><span class="error"></span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
    Email: <input type="text" name="email" value="<?php echo $email;?>">
        
    <br><br>

    Senha: <input type="password" name="senha">
        
    <br><br>
    <input type="submit" name="submit">  
    <br><br>
    <span> <?php echo $msgLogin;?></span>
</form>


</body>

</html>