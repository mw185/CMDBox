<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" initial-scale=1.0 />
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <script src="./js/dropzone.js"></script>
    <link href="./css/basic.css" rel="stylesheet">
    <link href="./css/dropzone.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/script.js/0.1/script.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="js/bootstrap.min.js">
    <link href="profil.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="js/main.js"></script>
    <title>Login</title>
    <?php

    session_start();
    include("connection.php");

    if(!isset($_SESSION['userid'])) {
        header("login.php");
    }
    ?>

</head>

<body>
<img src="<?php echo 'Profilbild/'.'.jpg'; ?>" width="285px" alt="Profilbild"/>

<div>
    <div class="nav">
        <div class="container">
            <ul class="pull-left">
                <li><a href="index.html">CMDBox</a></li>
            </ul>
            <ul class="pull-right">
                <li><a href="FormularUpload.html">Upload</a></li>
                <li><a href="showuploads.php">&Uuml;bersicht</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</div>

<?php

if (isset ($errorMessage)) {
    echo $errorMessage;
}
include ("FormularUpload.html");

if(isset($_SESSION['userid'])){
    $username = $_SESSION['userid']; //auslagern
}

// Email Wert wird verhasht um "anonyme" Ordner zu erhalten
$directorywert = md5($_SESSION['username']);


// Dateien werden in den jeweiligen Ordner basierend auf dem Email Hash abgelegt
$target_dir = "/Uploads/$directorywert/";


// Mithilfe von preg_replace werden ungültige Zeichen, die zu Problemen führen künnen, ersetzt.
$filename = $_FILES["file"]["name"]; //übernahme des Filenames aus Furmularupload.php
$datasize = $_FILES["file"]["size"];

$tmp_name = $_FILES["file"]["tmp_name"];

if ($_FILES ["file"]["name"] <> '') {

//if (isset($filename)) {
    //  if (!empty($filename)) {
    $location = "Uploads/";


    if (move_uploaded_file($tmp_name, $location . $filename)) {

        //$fileID = uniqid(``, true) . `.` . $filename;
        //if (isset($_POST["uploadformular"])) {
        //  $fileID = $_POST["fileID"];
        //$filename = $_POST["filename"];
        //$datasize = $_POST ["datasize"];
        //$username = $_POST ["username"];


        /*   $statement = $db->prepare("SELECT * FROM person WHERE username = :username"); #mit der Variable $statement alle usernames in der Datenbank 'person' vorbereiten
           $result = $statement->execute(array('username' => $username)); #eingegebenen username mit username aus Datenbank abgleichen
           $user = $statement->fetch(); #variable username erstellen mit dem entsprechenden uername aus $statement
*/

        $abra = "Abra";
        $sql = "INSERT INTO file (filename, datasize, username) VALUES ('" . $filename . "','" . $datasize . "','" . $username . "')";
        $statement = $db->prepare($sql);
        $result = $statement->execute();

        echo('Upload erfolgreich. Weiter zu <a href="upload.php">Uploadverzeichnis</a>');
    } else {
        echo "please upload file!";
    }


    $handle = opendir('Uploads/');

    if ($handle) {
        $sql = "SELECT FROM file WHERE fileID = fileID";
        $statement = $db->prepare($sql);
        //$result = $statement->execute();

        while (($entry = readdir($handle)) !== false) {
            if ($entry != '.' && $entry != '..') {
                while ($row = $statement->fetch()) {
                    echo $row->urlname;
                    echo "<br /><br />";
                }

            }
        }
    }

    closedir($handle);


     //   }
   // }

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
</body>
</html>