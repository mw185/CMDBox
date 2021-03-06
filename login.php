<p><img src="CMDBox.png" width="250px" alt="Logo"/></p>

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
    $user = $statement->fetch(); #variable user erstellen mit dem entsprechenden uername aus $statement und aus der DB holen

    if ($user !== false && password_verify($password, $user['password'])) { #wenn $user nicht falsch ist und das Passwort aus einem hash gelesen werden kann weiter machen

        $_SESSION['userid'] = $user['username']; #session id erzeugen mit der bezeichung 'userid'
        header("Location: upload.php"); #weiterleitung zur upload.php

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

    <!--folgend das Loginformular-->

    <meta charset="UFT-8">
    <link href="index.css" rel="stylesheet">
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
                    <input id = "username" type="text" name="username" maxlength="30" placeholder = "Username">
                    <label for = "username"></label>
                    <div class = "bar"></div>
                </div>

                <div class = "input-container">
                    <input id = "password" type="password" name="password" maxlength="40" placeholder = "Passwort"><br/>
                    <label for = "password"></label>
                    <div class = "bar"></div>
                </div>

                <div class = "button-container">
                    <button type = "submit" name = "Einloggen">Einloggen</button>
                </div>

                 <div class = "button-container">
                     <button type = "reset" name = "Eingabe zurücksetzen">Eingabe zurücksetzen</button>
                 </div>
                    <br/><br/>

                    <div class = "button-container">
                        <a href="index.php" class="btn btn-default">Zur Registrierung</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="extrainfo">
        <small class="impressum">Impressum</small>
        <small class="impressum">|</small>
        <small class="impressum">Team CMD &copy; 2017</small>
    </div>
</body
</html>

