<?php

session_start();
include ("connection.php");

$fileID = $_GET['file'];

$sql = "SELECT filename FROM file WHERE fileID = :fileID";
$statement = $db->prepare($sql);
$statement->execute(array('filename'=> $filename));

$file = $statement->fetch();

if (isset($file['filename']) && basename($file['filename']) == $file['filename']) {
    $filename = $file['filename'];
}

    else {
     $filename = NULL;
    }

if(!$filename) {
    //file nicht verändern
}



$path="Uploads/".$filename;
$mime=mime_content_type($path);
$datasize=filesize ($path);



    if (file_exists($path) && is_readable($path)) {
        echo $mime;
        echo $datasize;
        header('Content-Type: '.$mime);
        header('Content-Length: '.$datasize);
        header('Content-Disposition: attachment; filename='.$filename);
        header('Content-Transfer-Encoding: binary');
        readfile($path);

        
        $file=@fopen($path,'rb');

        if ($file) {
            fpassthru($file);
            exit;
        } else {
            echo'error';
        }
    }

?>