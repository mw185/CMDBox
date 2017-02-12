<?php
// Session starten
session_start();

if (!isset($_SESSION ['userid'])) {
    //header("location: login.php");
    //exit;
}
?>

<?php

    if (isset($_GET ['profilbild'])) {
        $dir = "Profilbild/";
        $newname = $_SESSION ['userid'];
        if (isset($_FILES['file'])) {
            $zielname = basename($_FILES["file"]["name"]);
            if (move_uploaded_file($_FILES ['file']['tmp_name'], $dir . $zielname)) {
                rename($dir . $zielname, $dir . $newname);
                header('location: profil.php');
            } else {
                echo "Fehler";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" initial-scale=1.0 />
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link href="./css/basic.css" rel="stylesheet">
    <link href="./css/dropzone.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <link href="js/bootstrap.min.js">
    <link href="profil.css" rel="stylesheet">
    <link href="profilbild.css" rel="stylesheet">
    <title>Profilbild ändern</title>
</head>


<body>

<ul><li><img src="<?php echo 'Profilbild/'.$_SESSION ['userid'].'.jpg';?> " width="285px" alt="Profilbild"/>
        <h1><?php echo ($_SESSION['userid']) ?></h1></li></ul>


<div>
    <div class="nav">

        <div class="container">


            <ul class="pull-left">
                <li><a href="upload.php">CMD Upload</a></li>
            </ul>
            <ul class="pull-right">
                <li><a href="pwaendern.php">Passwort ändern</a></li>
                <li><a href="profilbild.php">Profilbild ändern</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</div>
<br/><br/><br/><br/><br/><br/><br/>


<form name ="Profilbild" method="post" enctype="multipart/form-data" action="profilbild.php?profilbild=1">

    <input type="file" name="file" size="60" maxlength="255" placeholder="Bild auswählen" value="Bild auswählen"><br>

    <input type="Submit" name="submit" placeholder="Bild hochladen" value ="Bild hochladen">

</form>
</body>
</html>


