<?php
session_start();

include 'connection.php';
if(isset($errorMessage)) {
    echo $errorMessage;
}
?>

<?php

session_start();

$dsn="mysql:host=localhost;dbname=u-db104"; #Datenbankverbindung aufbauen
$dbuser="db104";
$dbpass="anohk4Aepu";

try {
    $db=new PDO($dsn,$dbuser,$dbpass);
}
catch(PDOException $e){
    echo $e->getMessage();
    die();
}
?>

<?php
$username =$_SESSION['username'];

if (isset($_GET['pwaendern'])) {
    $error = false;
    $passwort_alt = $_POST['passwort_alt'];
    $passwort_neu = $_POST['passwort_neu'];
    $passwort_neu2 = $_POST['passwort_neu2'];
}
if($passwort_neu != $passwort_neu2) {
    echo 'Die neuen Passwörter stimmen nicht überein<br>';
    $error = true;
}

if($passwort_alt == $passwort_neu) {
    echo 'Das neue Passwort ist unverändert<br>';
}

# Passwort kann jetzt geändert werden

if (!$error) {
    $statement = $db->prepare("UPDATE person SET password = '$passwort_neu' WHERE username = username");
    $result = $statement->execute(array(':password' => $passwort_neu));
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Passwort ändern</title>
    <h1>Passwort ändern</h1>
</head>
<body>

<form action="?password=1" method="post">
    Altes Passwort:<br>
    <input type="password" size="40" maxlength="250" name="passwort_alt"><br>
    Neues Passwort:<br>
    <input type="password" size="40" maxlength="250" name="passwort_neu"><br>
    Neues Passwort wiederholen:<br>
    <input type="password" size="40"  maxlength="250" name="passwort_neu2"><br><br>


    <input type="submit" value="Passwort ändern">
</form>