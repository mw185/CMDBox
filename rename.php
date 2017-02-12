<?php

session_start();
include'connection.php';

$fileID = $_GET['fileID'];

    $newname = $_POST['newname'];

    $statement = $db->prepare("UPDATE file SET filename = :filename WHERE fileID = :fileID");
    $statement->execute(array('fileID' => $fileID, 'filename' => $filename));

    $file = $statement->fetch();
    rename("Uploads/" . $file["filename"]);

    header("location: upload.php");

?>

<form action="rename.php?rename=1" method="post">Neuer Name:<br>
    <input type="text" size="40" maxlength="250" name="newname"><br>

    <input type="submit" value="Umbenennen">
</form>
