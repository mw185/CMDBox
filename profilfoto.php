<?php
// Session starten
session_start();

$dir = "Profilbild/";
$newname = $_SESSION ['username'];
if (isset($_FILES['file'])) {
    $zielname = basename ($_FILES["file"]["name"]);
    if (move_uploaded_file($newname, $dir.$zielname)){
    rename($dir.$zielname, $dir.$newname.'.jpeg');
    header ('location: profil.php');
    }
    else {
        echo "Fehler";
    }

}
?>

<form method="POST" enctype="multipart/form-data" action="profilfoto.php">
    <p><input type="file" name="file" size="20">
        <input type="submit" value="hochladen" name="Bild hochladen"></p>
</form>



