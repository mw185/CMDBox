<?php
session_start();
include ("connection.php");
include ("FormularUpload.html");


// Email Wert wird verhasht um "anonyme" Ordner zu erhalten
$directorywert = md5($_SESSION['username']);


// Dateien werden in den jeweiligen Ordner basierend auf dem Email Hash abgelegt
$target_dir = "/Uploads/$directorywert/";


// Mithilfe von preg_replace werden ungültige Zeichen, die zu Problemen führen künnen, ersetzt.
$filename = $_FILES["file"]["name"]; //übernahme des Filenames aus Furmularupload.php

$tmp_name = $_FILES["file"]["tmp_name"];

if (isset($filename)) {
    if (!empty($filename))
    {
    $location ="Uploads/";

    if (move_uploaded_file($tmp_name, $location.$filename)); {
        echo "Uploaded!" ?>
    Weiter zu <a href= uploadseite.html"> Uploadverzeichnis</a>;
<?php
    }
    } else {
        echo "please upload file";
    }
}

//$middleuserfile = preg_replace ("([^\w\s\d\-_~,;:\[\]\(\).])", '', $filename);
//$newuserfile = preg_replace('/\s+/', '_', $middleuserfile);
//$target_file = $target_dir . basename($newuserfile);
//$uploadOk = 1;
//$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Kontrolle, ob Bild Fake ist

// Kontrolle, ob Datei bereits existiert
//if (file_exists($target_file)) {
  //  echo "Die Datei ist bereits vorhanden.<br/>";
    //$uploadOk = 0;
//}
// Kontrolliert die Dateigröße
//if ($_FILES["file"]["size"] > 13107200) {
  //  echo "Die Datei ist zu groß.";
    //$uploadOk = 0;
//}


//------------------------------- Verschiedene Dateiformate-------------------------------------------
/**
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
$uploadOk = 0;
}
//------------------------------- END allow file formats-------------------------------------------*/
//------------------------------- Lädt hoch, wenn $uploadOk gleich 0------------------------
//if ($uploadOk == 0) {
   //  echo "Weiter zu deinen <a href='showuploads.php'>Dateien.</a>";
// Wenn alles passt, Datei hochladen
//} else {
   // if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    //    chmod($target_file, 0600);
    //    echo "Die Datei ". basename($filename). " wurde erfolgreich hochgeladen.<br/>";
    //    echo "Weiter zu deinen <a href='showuploads.php'>Dateien.</a>";
   // } else {
    //    echo "Es gab ein Problem beim Hochladen deiner Datei.<br/>";
     //   echo "Weiter zu deinen <a href='showuploads.php'>Dateien.</a>";
   // }
//}
?>