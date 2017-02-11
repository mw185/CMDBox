<?php
// Session starten
session_start();

$dir = "Profilbild/";
$newname = $_SESSION ['dir'];
if (isset($_FILES['file'])) {
    $zielname = basename ($_FILES["file"]["name"]);
    if (move_uploaded_file($newname, $dir.$zielname)){
    rename($dir.$zielname, $dir.$newname);
    header ('location: showuploads.php');
    }
    else{
        echo "Fehler";
    }

}

?>