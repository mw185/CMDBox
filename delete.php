<?php
session_start();
include ("connection.php");

if(!isset($_SESSION['userid'])) { #es wird geprüft ob eingelogt, ansonsten wird auf login.php weitergeleitet
    header("location: login.php");
}

#alles unten: die Dateien werden über fileID rausgesucht und auf der Datenbank sowie auf dem Server gelöscht

$fileID = $_GET['fileID'];

$sql = "SELECT * FROM file WHERE fileID = :fileID";
$statement = $db->prepare($sql);
$statement->execute(array('fileID'=> $fileID));

$file = $statement->fetch();
unlink("Uploads/". $file["filename"]);

$sql = "DELETE FROM file WHERE fileID = :fileID";
$statement = $db->prepare($sql);
$statement->execute(array('fileID'=> $fileID));

header("location: upload.php");

?>