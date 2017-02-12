<?php
session_start();
include ("connection.php");

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