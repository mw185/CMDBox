<?php

session_start();
include'connection.php';

$fileID = (isset($_GET['fileID'])) ? $_GET ['fileID'] : "ERROR: ID konnte nicht gefunden werden";

$statement = $db->prepare("SELECT * FROM file WHERE fileID = :fileID");
$statement->execute(array('fileID' => $fileID));

$file = $statement->fetch();

$oldname = $file['filename'];

echo $oldname;

    if (isset($_GET['rename'])) {
        $newname = $_POST['newname'];

        $statement = $db->prepare("UPDATE file SET filename = :filename WHERE fileID = :fileID");
        $statement->execute(array('fileID' => $fileID, 'filename' => $newname));

        $file = $statement->fetch();
        rename("Uploads/" . $newname);

        header("location: upload.php");
    }
    else {
        echo "Datei konnte nicht umbenannt werden";
    }
?>

<form action="rename.php?rename=1" method="post">Neuer Name:<br>
    <input type="text" size="40" maxlength="250" name="newname" value="<?php echo $oldname ?>"><br>

    <input type="submit" value="Umbenennen">
</form>
