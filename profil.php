
<?php
// Session starten
session_start();

//wenn
if (!isset($_SESSION ['userid'])) { //es wird geprüft ob eingelogt, ansonsten wird auf login.php weitergeleitet
    header("location: login.php");
}
?>

<!-- html beginnt-->
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Viewport, Bootstrap und Style wird inkludiert-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" initial-scale=1.0 />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="profil.css" rel="stylesheet">
    <title>Profil</title>
</head>

<body>
<!-- Logo wird mit div container eingebunden -->
<div class="extrainfo">
    <img src="CMDBox.png" width="250px" alt="Logo"/>
</div>

<!-- Profilbild des Users wir aus Datenbank über UserID geholt und dargestellt  -->
<ul><li><img src="<?php echo 'Profilbild/'.$_SESSION ['userid'].'.jpg'; ?>" width="300px" alt="Profilbild"/></li></ul>

<!-- Menüleiste wird mit div containern als Liste erzeugt; Verlinkt mit entsprechenden Seiten -->
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
</body>
</html>



