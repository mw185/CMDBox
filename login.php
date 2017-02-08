<?php
session_start();
$dsn="mysql:host=localhost;dbname=u-db104"; #Datenbankverbindung aufbauen
$dbuser="db104";    #db username
$dbpass="anohk4Aepu";   #db passwort
try {
    $db=new PDO($dsn,$dbuser,$dbpass); #kreiren der variable $db mit Daten für Datenbankverbindung
}
catch(PDOException $e){
    echo $e->getMessage();
    die();
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

        die('Login erfolgreich. Falls sie nicht automatisch weitergeleitet werden klicken sie bitte hier: <a href="showuploads.php">internen Bereich</a>'); #erfolgreich, weiterleiten auf internen Bereich

        ?>
        <meta http-equiv="refresh" content="5; URL=showuploads.php">
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
<?php
if(isset($errorMessage)) {
    echo $errorMessage;
}
?>

</body>
</html>