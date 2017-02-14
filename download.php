<?php

session_start();
include ("connection.php");

if(!isset($_SESSION['userid'])) { #es wird geprüft ob eingelogt, ansonsten wird auf login.php weitergeleitet
    header("login.php");
}

$fileID = $_GET['file']; #$fileID holt sich alles sachen aus der tabelle file

$sql = "SELECT * FROM file WHERE fileID = :fileID";
$statement = $db->prepare($sql);
$statement->execute(array('fileID'=> $fileID));

$fileA = $statement->fetch();


if (isset($fileA['filename'])) {
    $filename = $fileA['filename'];
}

else {
    $filename = NULL;
}

if (!$filename) {
    echo "File nicht vorhanden.";
}

else {
    $path = "Uploads/" . $filename; #definiert den pfad über Uploads/ und dem filename
    $mime = mime_content_type($path); #weißt $mime die möglichen datentypen zu
    $fsize = filesize($path); #fsize bekommt die Datengrößen zugewiesen
    
#alles unten - die Befehle, die den download einleiten
  if (file_exists($path) && is_readable($path)) {
        header('Content-Type: ' . $mime);
        header('Content-Length: ' . $fsize);
        header('Content-Disposition: attachment; filename=' . $filename );
        header('Content-Transfer-Encoding: binary');
        readfile($path);
        echo $fsize;

        $file = @ fopen($path, 'rb'); #befehl zum Download

        if ($file) { #download ausführen
            fpassthru($file);
            exit;
        } else {
            echo 'error';
        }
    }
}
?>

