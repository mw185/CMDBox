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
    <link href="js/bootstrap.min.js">
    <link href="profil.css" rel="stylesheet">
    <link href="FormularUpload.css" rel="stylesheet">
    <title>Passwort ändern</title>
</head>

<?php
session_start();

include 'connection.php';

if(isset($errorMessage)) {
    echo $errorMessage;
}
?>

<body>

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


<?php


$fileID = isset($_GET['fileID'])? $_GET ['fileID']: die("ERROR: ID konnte nicht gefunden werden");

$sql = "SELECT * FROM file WHERE fileID = :fileID";
$statement = $db->prepare($sql);
$statement->execute(array('fileID'=> $fileID));

$file = $statement->fetch();

$oldname = $file['filename'];
$newname = $_POST['newname'];

if (isset($_POST['newname'])) {

    $statement = $db->prepare("UPDATE file SET filename = :filename WHERE fileID = :fileID");
    $result = $statement->execute(array('filename' => $newname, 'fileID' => $fileID));

    rename ("Uploads/".$oldname, "Uploads/".$newname);

    header("location: upload.php");
}
?>


<br/><br/><br/><br/>
<form name = "rename" enctype="multipart/form-data" action="<?php echo("?fileID={$fileID}")?>" method="post">

    <input type = "text" name="newname" size="60" maxlength="255" id="newname" placeholder="Neuen Namen eingeben"><br/>

    <input type="Submit" name="submit"  id="submit" value = "Umbenennen">

</form>

</body>

