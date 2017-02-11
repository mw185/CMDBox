<?php
session_start();
include ("connection.php");
$directorywert = md5($_SESSION['username']);
$dir = "file/$directorywert/";

$fileID = $_GET['fileID'];

$sql = "SELECT filename FROM file WHERE fileID = :fileID";
$statement = $db->prepare($sql);
$statement->execute(array('fileID'=> $fileID));

$file = $statement->fetch();
unlink("Uploads/". $file["filename"]);

$sql = "DELETE * FROM file WHERE fieleID = :fileID";
$statement = $db->prepare($sql);
$statement->execute(array('fileID'=> $fileID));









/*
// Check die Verbindung
if ($_SESSION['loggedin'] != 1) {
    // Wenn der User die Session nicht auf 1 hat, wird er auf die Loginseite zurückgeleitet
    header("Location: loginsite.html");
    exit;
}

// Verbindung gecheckt - Email wird ausgegeben
if( isset( $_SESSION['loggedin'] ) )
{
    echo "Session-Email:". ($_SESSION['email']. "<br/>");
}
// Email ausgegeben
$test = $_POST['.php'];
echo $test;
$newtest = $_POST['id']."test";
$filepath = $_POST['id'];
$filename = $dir.'install.log';

// Delete File @ Symbol damit keine PHP Warnung angezeigt wird
if (@unlink($filepath)) {
    echo 'File <strong>' .$filepath .'has been deleted.';
}   else {
    echo 'File cannot be deleted.';
}
$testpath = 'uploads/6c4b425b0b3b3436039e50a1434cc890/2013-12-19%2017.49.12.jpg';
if (@unlink($testpath)) {
    echo 'File <strong>' .$filepath .'has been deleted.';
}   else {
    echo 'File cannot be deleted.';
}

*/
?>