<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" initial-scale=1.0 />
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="profil.css" rel="stylesheet">

    <title>Upload</title>
    <?php

    session_start();
    include("connection.php");

    if(!isset($_SESSION['userid'])) {
        header("login.php");
    }
    ?>

</head>

<body>
<div class="extrainfo">
    <img src="CMDBox.png" width="250px" alt="Logo"/>
</div>
<ul><li><img src="<?php echo 'Profilbild/'.$_SESSION ['userid'].'.jpg'; ?>" width="285px" alt="Profilbild"/>
        <h1><?php echo ($_SESSION['userid']) ?></h1></li></ul>


<div>
    <div class="nav">
        <div class="container">
            <ul class="pull-right">
                <li><a href="upload.php">CMD Upload</a></li>
                <li><a href="pwaendern.php">Passwort ändern</a></li>
                <li><a href="profilbild.php">Profilbild ändern</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</div>

<br/><br/><br/><br/><br/>


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
        //$datasize = $_POST ["datasize"];uhg
        //$username = $_POST ["username"];


        /*   $statement = $db->prepare("SELECT * FROM person WHERE username = :username"); #mit der Variable $statement alle usernames in der Datenbank 'person' vorbereiten
           $result = $statement->execute(array('username' => $username)); #eingegebenen username mit username aus Datenbank abgleichen
           $user = $statement->fetch(); #variable username erstellen mit dem entsprechenden uername aus $statement
*/
        $sql = "INSERT INTO file (filename, datasize, username) VALUES ('" . $filename . "'.'" . $datasize . "'.'" . $username . "')";
        $statement = $db->prepare($sql);
        $result = $statement->execute();

        echo('<h2>Upload erfolgreich!</h2></a>');
    } else {
        echo "please upload file!";
    }
}

    //$handle = opendir('Uploads/');

     //if ($handle) {
        $sql = "SELECT * FROM file WHERE username = :username";
        $statement = $db->prepare($sql);
        $statement->execute(array('username'=> $username));
        $row = $statement->fetch();

echo "<h2>Bisher hochgeladene Dateien:</h2>";

        //while (($entry = readdir($handle)) !== false) {
          // if ($entry != '.' && $entry != '..') {
echo "<table rules='rows'>";
                while ($row = $statement->fetch()) {
                    extract($row);

                    echo "<tr>";

                    echo"<td>" . $row['filename']; echo "</td>";
                    //echo"<td>" . $row['datasize']; echo "</td>";
                    echo"<td>" . "<a style ='color:aliceblue;' href= 'download.php?file=" . $row['fileID'] . "'>Download</a></td>";
                    echo"<td>" . "<a style ='color:aliceblue;' href= 'delete.php?fileID=" . $row['fileID'] . "'>Löschen</a></td>";
                    echo"<td>" . "<a style ='color:aliceblue;' href= 'rename.php?fileID=" . $row['fileID'] . "'>Umbenennen</a></td>";
                    echo"<td>" . "<a style ='color:aliceblue;' href ='share.php?fileID=" . $row['fileID'] . "'>Share</a></td>";
                    echo"</tr>";

                    echo"<br/>";
                }
echo "</table>";

?>

</body>
</html>