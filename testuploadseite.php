<?php
session_start();
// DIESE SEITE FUNKTIONIERT!!
// Datenbankverbindung aufbauen
include ("connection.php");
if ($_SESSION['loggedin'] != 1) {
    // Wenn der User die Session nicht auf 1 hat, wird er auf die Loginseite zur�ckgeleitet
    header("Location: loginsite.html");
    exit;
}
if( isset( $_SESSION['loggedin'] ) )
{
    echo ($_SESSION['email']);
}
$email = $_SESSION['email'];
$sql = "SELECT pfad FROM User WHERE email LIKE '$email' ";
$query = $db->prepare($sql);
$query->execute();
while ($result = $query->fetch(PDO::FETCH_ASSOC)){
    $emailvergleich = $result["pfad"];
}
echo "<br/>Das ist der Pfad $emailvergleich <br/>";
//md5 decypt
$emailcheck= md5($email);
echo $emailcheck. "<br/>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Happy Times</title>
</head>
<body>
You did it, great!
<form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="fileToUpload" /> <br/>
    <input type="submit" name="hochladen">
</form>
</body>
</html>