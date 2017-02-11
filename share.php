<?php
session_start();
include("connection.php");
///Daten aus DB herauslesen
$sql = $db->prepare('SELECT email FROM person WHERE email = :email');
$array = array(
    ':username' => $_SESSION['userid']
);
$sql->execute($array);
$emailto = $_POST["empfaenger"];
$subject = $_POST["betreff"];
$body = $_POST["nachricht"];
$sender = "email";
$headers = "From:.$sender";
mail($emailto, $subject, $body, $headers);
?>
