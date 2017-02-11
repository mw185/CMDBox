<?php

if (isset($GET['file']) && basename($_GET['file']) == $_GET['file']) {
    $filename = $_GET['file'];
}

$path = "Uploads/" . $filename;
$mime = mime_content_type($path);
$fsize = filesize ($path);

if (file_exists($path) && is_readable ($path)) {
    header ('Content-Type: '.$mime);
    header ('Content-Length: '.$fsize);
    header ('Content-Disposition: attachment; filename='.$filename);
    header ('Content-Transfer-Encoding: binary');

    $file = @ fopen ($path, 'rb');

    if ($file) {
        fpassthru($file);
        exit;
    } else {
        echo 'error';
    }
}