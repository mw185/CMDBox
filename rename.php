<?php
session_start();




// Email Wert wird verhasht um "anonyme" Ordner zu erhalten
$directorywert = md5($_SESSION['email']);



// Dateien werden in den jeweiligen Ordner basierend auf dem Email Hash abgelegt
$target_dir = "uploads/$directorywert/";
// Mithilfe von preg_replace werden ungültige Zeichen, die zu Problemen führen können, ersetzt.


/* Erhalten der Variablen durch Ajax von showuploads.php*/
$altername = $_POST['pk'];
$namenswunsch = $_POST['value'];


/* Zerlegen der Variable in Name und Endung*/
$path_parts = pathinfo($altername);
$nameohneendung = $path_parts['filename'];
echo 'Das ist der Altename :'.$nameohneendung."<br/>";
$namenextension = $path_parts['extension'];
echo 'Das ist die Extension :'.$namenextension."<br/>";


/*Zerlegen des Namenswunsches in Variable und Endung um Endung nicht zu berücksichtigen */
$path_parts = pathinfo($namenswunsch);
$wunschname = $path_parts['filename'];
echo 'Das ist der Wunschname :'.$wunschname."<br/>";
$wunschendung = $path_parts['extension'];
echo 'Das ist die Wunschendung :'.$wunschendung."<br/>";


/* Hier werden Zeichen zum Schutz vor Komplikationen geändert*/
$namensänderung = $wunschname;
$ersteÄnderung = preg_replace ("([^\w\s\d\-_~,;:\[\]\(\).])", '', $namensänderung);
$zweiteÄnderung = preg_replace('/\s+/', '_', $ersteÄnderung);


/* FILENAME und Extension werden zusammengeführt */
$sicherername = $zweiteÄnderung.".".$namenextension;
echo $sicherername;
rename($altername, $target_dir.$sicherername);

?>