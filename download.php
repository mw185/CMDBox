<?php

if (isset($_GET['file']) && basename($_GET['file']) == $_GET['file']) {
    $filename = $_GET['file'];
}

    else {
     $filename = NULL;
    }

if(!$filename) {
    //file nicht verändern
}

$path = "Uploads/" . $filename;
$mime = mime_content_type($path);
$fsize = filesize ($path);





    if (file_exists($path) && is_readable($path)) {
        header('Content-Type: ' . "image.jpeg");
        header('Content-Length: ' . $fsize);
        header('Content-Disposition: attachment; filename=' . $filename);
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