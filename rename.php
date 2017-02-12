<?php

session_start();
include'connection.php';

$fileID = isset($_GET['fileID']) ? $_GET ['fileID'] : die("ERROR: ID konnte nicht gefunden werden");

$oldname = $file['filename'];

if (isset($_POST['newname'])) {

    $newname = $_POST['newname'];

    $statement = $db->prepare("UPDATE file SET filename = :newname WHERE fileID = :fileID");
    $result = $statement->execute(array('filename' => $newname, 'fileID' => $fileID));

    rename("Uploads/" . $newname);

    header("location: upload.php");
}
else {
    echo "Datei konnte nicht umbenannt werden";
}
?>

<form name="rename" action="<?php echo("?id={$fileID}")?>method="post">Neuer Name:<br>
<input type="text" size="40" maxlength="250" name="newname" value="<?php echo $newname ?>"><br>

<input type="submit" value="Umbenennen">
</form>