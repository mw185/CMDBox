<?php
session_start(); //Session wird gestartet

$dsn="mysql:host=localhost;dbname=u-db104"; //Datenbankverbindung aufbauen
$dbuser="db104";                //Datenbankeigentümer und Passwort
$dbpass="anohk4Aepu";

try {
    $db=new PDO($dsn,$dbuser,$dbpass); // Datenbank definieren
}
catch(PDOException $e){     //Fehler bei Datenbankverbindung abfangen
    echo $e->getMessage();
    die();
}

?>

