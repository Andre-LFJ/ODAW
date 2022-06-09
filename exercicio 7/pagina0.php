
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
    if(!isset($_COOKIE[$cookie_name])) {
        echo "Cookie named '" . $cookie_name . "' is not set!";
    } else {
         echo "Cookie '" . $cookie_name . "' is set!<br>";
        echo "Value is: " . $_COOKIE[$cookie_name];
    }
    echo "<br>";

    echo "Hoje é " . date("d/m/Y") .  " e agora são " . date("H:i") . "h" . "<br>";
    
    olaMundo();

    $str = "boa tarde";
    $str2 = "bom dia";

    echo "str: " . ($str). "<br>";
    echo "str2: " . ($str2). "<br>";
    echo "str com primeiro caracter uppercase: " . ucfirst($str). "<br>";
    
    $str3 = $str;
    $str3 .= $str2;
    echo "str+str3: " . ($str3) . "<br>";
    
    echo "<br>" . "<br>" . "<br>";
    function olaMundo() {
        echo "Olá mundo!<br>";
      }

    $handle = fopen("counter.txt", "r");
    if(!$handle){
        echo "could not open the file" ;
    } 
    else { 
        $counter = (int ) fread($handle,20); 
        fclose ($handle); $counter++; 
        echo" <strong> Você é o visitante nº ". $counter . " </strong> " ; 
        $handle = fopen("counter.txt", "w" ); 
        fwrite($handle,$counter); 
        fclose ($handle); 
    }
?> 
</body>

</html>