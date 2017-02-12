<?php
session_start();
include("connection.php");

///Daten aus DB herauslesen
$sql = $db->prepare('SELECT email FROM person WHERE username = :username');
$array = array(
    ':username' => $_SESSION['userid']
);



$sql->execute($array);



$sql = "SELECT * FROM file WHERE fileID = :fileID";
$statement = $db->prepare($sql);
$statement->execute(array('fileID'=> $fileID));



$emailto = $_POST["empfaenger"];
$subject = $_POST["betreff"];
$body = $_POST["nachricht"];
$sender = "email";
$headers = "From:.$sender";
mail($emailto, $subject, $body, $headers);
?>

<form action="share.php" method="POST">
    <input type="email" name="email">email<br/>
    <input type="file" name="file">Datei<br/>
    <input type="submit" value="Senden">Senden<br/>
</form>
