<?php
// Session starten
session_start();


// Datenbankverbindung aufbauen
include 'connection.php';


//Profilbild abspeichern

if ($_POST['upload']) {
    $bildname = $_FILES['bild']['name'];  //greift auf den Namen der Datei zu
    $bildtmp = $_FILES['bild']['tmp_name'];  //greift auf den temporären Pfad der Datei zu
    $dir_zusatz = md5($_SESSION['email']);

    $olduserfile = $_FILES["bild"]["name"];
    $middleuserfile = preg_replace ("([^\w\s\d\-_~,;:\[\]\(\).])", '', $olduserfile);
    $newuserfile = preg_replace('/\s+/', '_', $middleuserfile);

    $target_dir = "profilbild/";
    $target_file = $target_dir . basename($newuserfile);
    $filetype = pathinfo($target_file, PATHINFO_EXTENSION);
    $filesize = $_FILES['bild']['size'];


    // echo $bildname . "<br>";
    // echo $bildtmp . "<br>";
    //echo $filetype . "<br>";
    //echo $filesize . "<br>";
    //echo $dir_zusatz;


    if ($bildname != '' AND $bildtmp != '') {    //prüft ob Bildname und Speicherort befüllt sind


        // Allow certain file formats
        if ($filetype != "jpg" && $filetype != "png" && $filetype != "jpeg"
            && $filetype != "gif" && $filetype !="JPG" && $filetype !="JPEG"
            && $filetype !="GIF" && $filetype !="PNG"
        ) {
            header("Location: fehlerdateityp.html");
            $error = true;
        }
    }



        $profilbildpfad = "profilbild/$dir_zusatz.$newuserfile";


    if ( move_uploaded_file($bildtmp, $profilbildpfad)) {


        //Einfügen in DB
        $sql = "INSERT INTO folder( ppID, username) VALUES ('" . $ppID . "','" . $username . "')";
        $statement = $db->prepare($sql);
        $result = $statement->execute();


        /*
        $uploadprofilbild = $db->prepare('UPDATE person SET profilbildpfad = :profilbildpfad WHERE email = :email');
        $query = array(
            ':profilbildpfad' => $profilbildpfad,
            ':email' => $_SESSION['email'],
        );
        $uploadprofilbild->execute($query);

        echo "Ihr Profilbild wurde erfolgreich geändert. <br />";
        echo "$profilbildpfad. <br />";
        echo "Zurück zum <a href='profil.php'>Profil</a><br/>";
        $uploadOK=true;

}
        */


//einfuegen in Profilbildkästchen
        if ($uploadOK == true) {
            $einfuegen = $db->prepare('SELECT * FROM person WHERE username = :username');
            $array = array(
                ':username' => $_SESSION['username']
            );
            $einfuegen->execute($array);


            while ($row = $einfuegen->fetch()) {
                echo "<img src='" . $row['profilbildpfad'] . "'>";
            }
            header("Location: profil.php");
        }
        else {
            echo "Upload fehlgeschlagen.";
            echo "Zur&uuml;ck zum <a href='profil.php'>Profil</a><br/>";
            $error = true;
        }
        $db = null;

// die();

?>