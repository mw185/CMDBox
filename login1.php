<?php
// Session starten
session_start ();
// Datenbankverbindung aufbauen
include "connection.php";

$username = $_POST["username"];
$passwort = $_POST["password"];

try{
    //   include_once("userdata.php");
    //   $db = new PDO($dsn, $db_user, $db_pass);
    $sql = "SELECT username, password FROM person WHERE username LIKE '$username'";
    $query = $db->prepare($sql);
    $query->execute();
    while ($result = $query->fetch(PDO::FETCH_ASSOC)){
        $emailvergleich = $result["email"];
        $pwvergleich = $result["password"];
    }
}
catch(PDOException $e){
    echo "2:".$sql."</br>".$e->getMessage();
    die();
}
$secret_salt = "topsecretsalt";
$salted_password = $secret_salt . $passwort;
$password_hash = hash('sha256', $salted_password);
if($pwvergleich == $password_hash)
{
    $_SESSION["username"] = $username;
    $_SESSION["loggedin"] = 1;
    echo "Login erfolgreich.. <br> <a href='uploadseite.html' >Zum Upload</a>";
    header('Location: showuploads.php');
}
else
{
    echo "Benutzername und/oder Passwort falsch.</br>";
    echo "Zur&uuml;ck zur <a href='loginsite.html'>Anmeldeseite</a><br/>";
    header('Location: falscheslogin');
}
?>