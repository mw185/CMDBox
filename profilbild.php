<?php
// Session starten
session_start();

if (!isset($_SESSION ['userid'])) {
   //wenn Session nicht existiert wird UserID übergeben
}

//wenn
    if (isset($_GET ['profilbild'])) {
        $dir = "Profilbild/";
        $newname = $_SESSION ['userid'];
        if (isset($_FILES['file'])) {
            $zielname = basename($_FILES["file"]["name"]);
            if (move_uploaded_file($_FILES ['file']['tmp_name'], $dir . $zielname)) {
                rename($dir . $zielname, $dir . $newname . '.jpg');
                header('location: profil.php');
                echo "Dein Profilbild wurde erfolgreich Hochgeladen";
            } else {
                echo "Fehler";
            }
        }
    }
?>
<!--html Teil fängt an und entsprechende Styles, Bootstrap und Viewport wird eingebunden-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" initial-scale=1.0 />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="profil.css" rel="stylesheet">

    <title>Profilbild ändern</title>
</head>


<body>
<!-- Logo wird über div container mit dem Namen "extrainfo" eingebunden -->
<div class="extrainfo">
    <img src="CMDBox.png" width="250px" alt="Logo"/>
</div>

<!-- Profilbild wird aus der Datenbank über UserID gezogen -->
<ul><li><img src="<?php echo 'Profilbild/'.$_SESSION ['userid'].'.jpg';?>" width="285px" alt="Profilbild"/></li></ul>

<!-- Menüleiste wird eingefügt, die zu anderen Seiten weiterleiten -->
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

<!--Formular wird included-->
<?php include ("profilbild.html");?>


</body>
</html>


