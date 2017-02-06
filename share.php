<?php
session_start();
include("connection.php");
///Daten aus DB herauslesen
$sql = $db->prepare('SELECT email FROM User WHERE email = :email');
$array = array(
    ':email' => $_SESSION['email']
);
$sql->execute($array);
$emailto = $_POST["empfaenger"];
$subject = $_POST["betreff"];
$body = $_POST["nachricht"];
$sender = "email";
$headers = "From:.$sender";
mail($emailto, $subject, $body, $headers);
?>
