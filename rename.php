<?php

session_start();
include'connection.php';

$fileID = isset($_GET['fileID']);


$newname = $_POST['newname'];
$oldname = $_GET['fileID'];

echo $fileID;

rename($oldname, $newname);
header("Location: upload.php");

 //   else {
  //          echo "Datei konnte nicht umbenannt werden";
    //    }

?>

<form action="rename.php?rename=1" method="post">Neuer Dateiname:<br>
    <input type="text" size="40" maxlength="250" name="newname"><br>

    <input type="submit" value="Umbenennen">
</form>
