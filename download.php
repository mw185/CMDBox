<?php

session_start();
include ("connection.php");

$fileID = $_GET['file'];

$sql = "SELECT * FROM file WHERE fileID = :fileID";
$statement = $db->prepare($sql);
$statement->execute(array('fileID'=> $fileID));

$file = $statement->fetch();

//if (isset($file['filename']) && basename($file['filename']) == $file['filename']) {
    $filename = $file['filename'];
//}

else {
    $filename = NULL;
}

if (!$filename) {
    //File nicht vorhanden.
}

else {
    $path = "Uploads/" . $filename;
    $mime = mime_content_type($path);
    $fsize = filesize($path);



    if (file_exists($path) && is_readable($path)) {
        header('Content-Type: ' . $mime);
        header('Content-Length: ' . $fsize);
        header("Content-Disposition: attachment; filename=' . $filename" );
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


