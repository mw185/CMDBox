<?php

session_start();
include'connection.php';


$fileID = isset($_GET['fileID'])? $_GET ['fileID']: die("ERROR: ID konnte nicht gefunden werden");

$oldname = $file['filename'];
$newname = $_POST['newname'];

if (isset($_POST['newname'])) {

    $statement = $db->prepare("UPDATE file SET filename = :newname WHERE fileID = :fileID");
    $result = $statement->execute(array('filename' => $newname, 'fileID' => $fileID));

    rename ($oldname, $newname);

    header("location: upload.php");
}
?>

<form name="rename" action="<?php echo("?fileID={$fileID}")?>" method="post">Neuer Name:<br>

    <input type="text" size="40" maxlength="250" name="newname" value= "Neuer Name" placeholder = "Neuer Name"><br>

    <input type="submit" value="Umbenennen">
</form>