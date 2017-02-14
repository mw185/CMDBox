<?php

session_start();
include ("connection.php");

if(!isset($_SESSION['userid'])) { #es wird geprüft ob eingelogt, ansonsten wird auf login.php weitergeleitet
    header("login.php");
}

$fileID = $_GET['file'];

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
    $path = "Uploads/" . $filename;
    $mime = mime_content_type($path);
    $fsize = filesize($path);


    #mimetype in variable & pfad nicht absolut - sichergehn, dass der stimmt
    #meine variablen 

  if (file_exists($path) && is_readable($path)) {
        header('Content-Type: ' . $mime);
        header('Content-Length: ' . $fsize);
        header('Content-Disposition: attachment; filename=' . $filename );
        header('Content-Transfer-Encoding: binary');
        readfile($path);
        echo $fsize;

        $file = @ fopen($path, 'rb');

        if ($file) {
            fpassthru($file);
            exit;
        } else {
            echo 'error';
        }
    }
}
?>

