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
                rename($dir . $zielname, $dir . $newname . '.jpg');
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
    <title>Profilbild ändern</title>
</head>


<body>

<img src="<?php echo 'Profilbild/'.$_SESSION ['userid'].'.jpg'; ?>" width="285px" alt="Profilbild"/>
<?php echo ($_SESSION['userid']) ?>


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
<br/><br/><br/><br/><br/>



<form method="POST" enctype="multipart/form-data" action="profilbild.php?profilbild=1">
    <p><input type="file" name="file" size="20">
        <input type="submit" value="Bild hochladen" name="bild_hochladen"></p>
</form>
</body>
</html>


