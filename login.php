<!DOCTYPE html>

<head>
    <meta charset="UFT-8">
    <title>Login</title>
    <?php
    session_start();
    include("connection.php")
    ?>
</head>

<body>

<?php




//$showFormular = true; #Registrierungsformular wird angezeigt

if(isset($_GET['login'])) {     #loginformular senden
    $username = $_POST['username']; #eingegebenen Username $username zuordenen
    $password = $_POST['password']; #eingegebenes Passwort $password zuordnen

    $statement = $db->prepare("SELECT * FROM person WHERE username = :username"); #mit der Variable $statement alle usernames in der Datenbank 'person' vorbereiten
    $result = $statement->execute(array('username' => $username)); #eingegebenen username mit username aus Datenbank abgleichen
    $user = $statement->fetch(); #variable username erstellen mit dem entsprechenden uername aus $statement


    $_SESSION['userid'] = $user['username']; #session id erzeugen mit der bezeichung 'userid'
    
    //Überprüfung des Passworts
    if ($user !== false && password_verify($password, $user['password'])) { #wenn $user nicht falsch ist und das Passwort aus einem hash gelesen werden kann


        $_SESSION['loggedin'] = 1;
        header("Location: upload.php");

        /*if ($user) {
            $showFormular = false;  #Formular wird nicht mehr angezeigt


            die('Login erfolgreich. Weiter zu <a href="">internen Bereich</a>');
        }*/
    }
    else {
            $errorMessage = "E-Mail oder Passwort war ungültig<br>";
    }
} else{
    $errorMessage = "keine daten vom Formular erhalten" ;
}


if(isset($errorMessage)) {
    echo $errorMessage;
}

include "loginpage.html";

?>
</body>
</html>