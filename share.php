<?php
session_start();
include'connection.php';

///Daten aus DB herauslesen
$sql = $db->prepare('SELECT username FROM person WHERE username = :username');
$array = array(
    ':username' => $_SESSION['userid']
);

$fileID = isset($_GET['fileID'])? $_GET ['fileID']: die("ERROR: ID konnte nicht gefunden werden");
$username = $_SESSION['userid'];

$sql->execute($array);


$sql = ("SELECT * FROM file WHERE fileID = :fileID");
$statement = $db->prepare($sql);
$statement->execute(array('fileID'=> $fileID));


$empfaenger = "".$_POST['email']."";
$absendername = "CMD Box";
$absendermail = "automatic@CMD-Box.de";
$betreff = "$username hat Dir eine Datei gesendet!";
$text = "Der Nutzer $username hat dir eine Datei gesendet.
Du kannst die Datei unter folgendem Link herunterladen:
https://mars.iuk.hdm-stuttgart.de/~mw185/download.php?fileID=".$fileID;
mail($empfaenger, $betreff, $text, "From: $absendername <$absendermail>");
?>

<form name ="share" action="<?php echo("?fileID={$fileID}")?>" method="POST">
    <input type="email" name="email">email<br/>
    <input type="submit" value="Senden">Senden<br/>
</form>

