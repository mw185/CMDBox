<?php
// Session starten
session_start();

if (!isset($_SESSION ['userid'])) {
    //header("location: login.php");
    //exit;
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
    <title>Profil</title>
</head>

<body>

<ul><li><img src="<?php echo 'Profilbild/'.$_SESSION ['userid'].'.jpg'; ?>" width="285px" alt="Profilbild"/>
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



</body>
</html>



