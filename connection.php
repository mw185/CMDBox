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