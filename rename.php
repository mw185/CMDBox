<?php

session_start();
include'connection.php';



$fileID = $_GET['file'];

$sql = "SELECT * FROM file WHERE fileID = :fileID";
$statement = $db->prepare($sql);
$statement->execute(array('fileID'=> $fileID));

$file = $statement->fetch();

if (isset($file['filename']) && basename($file['filename']) == $file['filename']) {
    $filename = $file['filename'];


//$fileID = isset($_GET['fileID']) ? $_GET ['fileID'] : die("ERROR: ID konnte nicht gefunden werden");

    $oldname = $file['filename'];
    $newname = $_POST['newname'];

    if (isset($_POST['newname'])) {

        $statement = $db->prepare("UPDATE file SET filename = :newname WHERE fileID = :fileID");
        $result = $statement->execute(array('filename' => $newname, 'fileID' => $fileID));

        rename("Uploads/" . $newname);

        header("location: upload.php");
    }
}
?>

<form name="rename" action="<?php echo("?id={$fileID}")?>" method="post"> Neuer Name:<br>
<input type="text" size="40" maxlength="250" name="newname" value= "newname" placeholder=filename><br>

<input type="submit" value="Umbenennen">
</form>