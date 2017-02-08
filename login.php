<?php
session_start();

include "connection.php";
if(isset($errorMessage)) {
    echo $errorMessage;
}
?>

<?php
if(isset($_GET['login'])) {     #loginformular senden
    $username = $_POST['username']; #eingegebenen Username $username zuordenen
    $password = $_POST['password']; #eingegebenes Passwort $password zuordnen
    $statement = $db->prepare("SELECT * FROM person WHERE username = :username"); #mit der Variable $statement alle usernames in der Datenbank 'person' vorbereiten
    $result = $statement->execute(array('username' => $username)); #eingegebenen username mit username aus Datenbank abgleichen
    $user = $statement->fetch(); #variable username erstellen mit dem entsprechenden uername aus $statement

    //Überprüfung des Passworts
    if ($user !== false && password_verify($password, $user['password'])) { #wenn $user nicht falsch ist und das Passwort aus einem hash gelesen werden kann
        $_SESSION['userid'] = $user['id']; #session id erzeugen mit der bezeichung 'userid'

        die
?>


        Login erfolgreich. Falls sie nicht automatisch weitergeleitet werden klicken sie bitte hier:

<a href="http://www.bild.de">internen Bereich</a>'); #erfolgreich, weiterleiten auf internen Bereich

        <meta http-equiv="refresh" content="5; URL = showuploads.php">




        <?php

    } else {
        $errorMessage = "Username oder Passwort wurde falsch eingegeben";  #login klappt nicht
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
<h1>Login</h1>

<form>
    <div class="loginsite">
        <div class="loginbox">
            <div class="firstcard"></div>
            <div class="card">
                <h1 class="title">Login</h1>
                <form action="login.php" method="post">
                    <div class="input-container">
                        <input id="email" name="email" type="email" placeholder="Email" maxlength="40" required>
                        <label for="email"></label>
                        <div class="bar"></div>
                    </div>
                    <div class="input-container">
                        <input type="password" id="Password" name="passwort" placeholder="Passwort" maxlength="40" required>
                        <label for="Password"></label>
                        <div class="bar"></div>
                    </div>
                    <div class="button-container">
                        <button type="submit" name="logmein"><span>Go</span></button>
                    </div>
                    <div class="cardfooter"><!--<a href="#">Passwort vergessen?</a></div>--->
                </form>
            </div>
        </div>
    </div>
</form>

</body>
</html>