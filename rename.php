<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" initial-scale=1.0 />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="profil.css" rel="stylesheet">
    <link href="FormularUpload.css" rel="stylesheet">
    <title>Passwort ändern</title>
</head>

<?php
session_start();    #Die aktuelle Session wird übergeben -> man bleibt angemeldet
include 'connection.php';   ##Datenbankverbindung wird hergestellt, indem connection.php aufgerufen wird

if(!isset($_SESSION['userid'])) { #es wird geprüft ob eingelogt, ansonsten wird auf login.php weitergeleitet
    header("login.php");
}
?>

<body>
<div class="extrainfo">
    <img src="CMDBox.png" width="250px" alt="Logo"/>
</div>
<ul><li><img src="<?php echo 'Profilbild/'.$_SESSION ['userid'].'.jpg'; ?>" width="285px" alt="Profilbild"/></li></ul>



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


$fileID = isset($_GET['fileID'])? $_GET ['fileID']: die("ERROR: ID konnte nicht gefunden werden"); #Die FileID wird übergeben, wenn nicht erscheint eine Fehlermeldung

$sql = "SELECT * FROM file WHERE fileID = :fileID"; #Die Datei wird in der Datenbank aufgerufen durch ein SQL STatement
$statement = $db->prepare($sql);
$statement->execute(array('fileID'=> $fileID));

$file = $statement->fetch();    #Der Variable $file wird die aus der Datenbank ausgelesene fileID zugewiesen

$oldname = $file['filename'];   #Der alte Name der Datei wird aus der DB ausgelesen und der Variable $oldname zugewiesen
$newname = $_POST['newname'];   #Der neue Name wird aus dem Formular ausgelesen

if (isset($_POST['newname'])) { #Wenn ein neuer Name über das Formular übergeben wurde,

    $statement = $db->prepare("UPDATE file SET filename = :filename WHERE fileID = :fileID"); #wird über ein SQL Statement der alte Name durch den neuen Namen
    $result = $statement->execute(array('filename' => $newname, 'fileID' => $fileID));         #in der DB ersetzt

    rename ("Uploads/".$oldname, "Uploads/".$newname);  #Auf dem Server wird der alte Name ebenfalls durch den neuen Namen ersetzt

    header("location: upload.php"); #Man wird automatisch auf upload.php zurückgeleitet
}
?>


<br/><br/><br/><br/>
<form name = "rename" enctype="multipart/form-data" action="<?php echo("?fileID={$fileID}")?>" method="post">

    <input type = "text" name="newname" size="60" maxlength="255" id="newname" placeholder="Neuen Namen eingeben"><br/>

    <input type="Submit" name="submit"  id="submit" value = "Umbenennen">

</form>

</body>
</html>


