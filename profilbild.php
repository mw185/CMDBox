<?php

if (!isset($_SESSION ['username'])) {
    header("location: login.php");
}
// Session starten
    session_start();
    if (isset($_GET ['profilbild'])) {
        $dir = "Profilbild/";
        $newname = $_SESSION ['username'];
        if (isset($_FILES['file'])) {
            $zielname = basename($_FILES["file"]["name"]);
            if (move_uploaded_file($_FILES ['file']['tmp_name'], $dir . $zielname)) {
                rename($dir . $zielname, $dir . $newname . '.jpg');
                header('location: profil.php');
            } else {
                echo "Fehler";
            }

        }
    }

?>

<form method="POST" enctype="multipart/form-data" action="profilbild.php?profilbild=1">
    <p><input type="file" name="file" size="20">
        <input type="submit" value="Bild hochladen" name="bild_hochladen"></p>
</form>



