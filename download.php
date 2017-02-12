<?php

session_start();
include ("connection.php");

$fileID = $_GET['filename'];

$sql = "SELECT filename FROM file WHERE fileID = :fileID";
$statement = $db->prepare($sql);
$statement->execute(array('fileID'=> $fileID));
$file = $statement->fetch();

if (isset($file['filename']) && basename($file['fileID']) == $file['fileID']) {
    $filename = $file['fileID'];
}
    else {
     $filename = NULL;
    }
if(!$filename) {
    //file nicht verändern
}
else {

$path = "Uploads/" . $fileID;
$mime = mime_content_type($path);
$fsize = filesize ($path);


    file_exists($path) && is_readable($path);
        header('Content-Type: '.$mime);
        header('Content-Length: ' . $fsize);
        header('Content-Disposition: attachment; fileID=' . $fileID);
        header('Content-Transfer-Encoding: binary');
        readfile($path);
        
        $file = @ fopen($path, 'rb');

        if ($file) {
            fpassthru($file);
            exit;
        } else {
            echo 'error';
        }
}
?>