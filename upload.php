<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UFT-8">
    <title>Login</title>
    <?php

    session_start();
    include("connection.php");

    if(!isset($_SESSION['username'])) {
        header("login.php");
    }
    ?>
</head>

<body
<?php

if (isset ($errorMessage)) {
    echo $errorMessage;
}
include ("FormularUpload.html");

if(isset($_SESSION['username'])){
    $username = $_SESSION['username']; //auslagern
}

echo $_SESSION['username'];
print_r($username);
var_dump($username);

// Email Wert wird verhasht um "anonyme" Ordner zu erhalten
$directorywert = md5($_SESSION['username']);


// Dateien werden in den jeweiligen Ordner basierend auf dem Email Hash abgelegt
$target_dir = "/Uploads/$directorywert/";


// Mithilfe von preg_replace werden ungültige Zeichen, die zu Problemen führen künnen, ersetzt.
$filename = $_FILES["file"]["name"]; //übernahme des Filenames aus Furmularupload.php
$datasize = $_FILES["file"]["size"];

$tmp_name = $_FILES["file"]["tmp_name"];

if ($_FILES ["file"]["name"] <> '') {

if (isset($filename)) {
    if (!empty($filename)) {
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

                echo('Upload erfolgreich. Weiter zu <a href="showuploads.php">Uploadverzeichnis</a>');
            } else {
                echo "please upload file";
            }
        }
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



if ( $_FILES['uploaddatei']['name'] <>"")
    (
        move_uploaded_file(
            $_FILES['uploaddatei']['tmp_name'],'Uploads/'. ($filename));

    $statement = $db->prepare("INSERT INTO file (fileID, filename, datasize, username) VALUES (:fileID, :filename, :datasize, :username)");
    $result = $statement->execute(array("fileID" => $fileID, "filename" => $filename, "datasize" => $datasize, "username" => $username));

    echo ('Upload erfolgreich. Weiter zu <a href="showuploads.php">Uploadverzeichnis</a>');
    );
    else {
    echo ("please upload file");
}

?>
</body>
</html>