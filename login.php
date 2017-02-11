<?php
session_start();

include 'connection.php';
if(isset($errorMessage)) {
    echo $errorMessage;
}





if(isset($_GET['login'])) {     #loginformular senden
    $username = $_POST['username']; #eingegebenen Username $username zuordenen
    $password = $_POST['password']; #eingegebenes Passwort $password zuordnen

    $statement = $db->prepare("SELECT * FROM person WHERE username = :username"); #mit der Variable $statement alle usernames in der Datenbank 'person' vorbereiten
    $result = $statement->execute(array('username' => $username)); #eingegebenen username mit username aus Datenbank abgleichen
    $user = $statement->fetch(); #variable username erstellen mit dem entsprechenden uername aus $statement




    //Überprüfung des Passworts
    if ($user !== false && password_verify($password, $user['password'])) { #wenn $user nicht falsch ist und das Passwort aus einem hash gelesen werden kann

        $_SESSION['userid'] = $user['username']; #session id erzeugen mit der bezeichung 'userid'
        $_SESSION['loggedin'] = 1;
        header("Location: upload.php");

        /*if ($user) {
            $showFormular = false;  #Formular wird nicht mehr angezeigt


            die('Login erfolgreich. Weiter zu <a href="">internen Bereich</a>');
        }*/
    }
    else {
        $errorMessage = "Username oder Passwort ist ungültig<br>";
    }
}


if(isset($errorMessage)) {
    echo $errorMessage;
}


?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UFT-8">
    <link href="login.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <title>Login</title>
</head>
<body>
    <div class = 'loginsite'>
        <div class="loginbox">
            <div class="firstcard"></div>
            <div class="card">
                <h1 class ="title">Login</h1>
                <form name="login" action="?login=1" method="post">

                <div class="input-container">
                    <input id = "username" type="text" name="username" maxlength="30">
                    <label for = "username"></label>
                    <div class = "bar"></div>
                </div>

                <div class = "input-container">
                    <input id = "password" type="password" name="password" maxlength="40"><br/>
                    <label for = "password"></label>
                    <div class = "bar"></div>
                </div>

                <div class = "button-container">
                    <button type = "reset" name = "Eingabe zurücksetzen">Eingabe zurücksetzen</button>
                </div>

                 <div class = "button-container">
                    <button type = "submit" name = "Einloggen">Einloggen</button>
                 </div>
                 <div class="cardfooter">

                </form>
            </div>
        </div>
    </div>
</body
</html

