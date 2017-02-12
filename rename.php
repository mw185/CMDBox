<?php

session_start();
include'connection.php';

$fileID = isset($_GET['fileID']);


$newname = $_POST['newname'];
$oldname = $_GET['fileID'];

echo $fileID;

    if (isset($_POST['newname'])) {

        $statement = $db->prepare("UPDATE file SET filename = :filename WHERE fileID = :fileID");
        $result = $statement->execute(array('filename' => $newname, 'fileID' => $fileID));

        rename($oldname, $newname);

        header("Location: upload.php");
    }

 //   else {
  //          echo "Datei konnte nicht umbenannt werden";
    //    }

?>

<form name="rename" action=pwaendern.php<?php echo $oldname?>method="post">Neuer Dateiname:<br>
    <input type="text" size="40" maxlength="250" name="newname"><br>

    <input type="submit" value="Umbenennen">
</form>
