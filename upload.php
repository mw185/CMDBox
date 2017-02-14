<!DOCTYPE html>
<html lang="en">
<head> <!--hier wird gebootstrapped-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" initial-scale=1.0 />
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="profil.css" rel="stylesheet">

    <title>Upload</title>
    <?php

    session_start(); #beginnt die Session und übernimmt alles was unter $_SESSION gespeichert wurde
    
    include("connection.php"); #connection.php wird eingebunden um Datenbankverbindung aufzubauen
    include ("FormularUpload.html"); #FormularUpload.html wird eingebunden

    if(!isset($_SESSION['userid'])) { #es wird geprüft ob eingelogt, ansonsten wird auf login.php weitergeleitet
        header("location: login.php");
    }
    ?>

</head>

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

<br/><br/><br/><br/><br/>


<?php

if(isset($_SESSION['userid'])){
    $username = $_SESSION['userid']; #wenn Session existiert wird der Variable username die userid zugewiesen
}

$target_dir = "/Uploads/$directorywert/"; #Speicherziel definieren


$filename = $_FILES["file"]["name"]; #übernahme des Filenames aus Furmularupload.php
$datasize = $_FILES["file"]["size"]; #übernahme des filegröße aus Furmularupload.php

$tmp_name = $_FILES["file"]["tmp_name"]; #vergabe eines temporären namens zur zwischenspeicherung

if ($_FILES ["file"]["name"] <> '') { #überprüfung ob es nicht leer ist

    $location = "Uploads/"; #zuweißung der Variable location zum pfad "Uploads


    if (move_uploaded_file($tmp_name, $location . $filename)) { #Befehl zum speichern der Datei mit Temporärem namen in variable location mit dem filename

        $sql = "INSERT INTO file (filename, datasize, username) VALUES ('" . $filename . "','" . $datasize . "','" . $username . "')"; #SQL statement welches übergebene Variablen in die Datenbank einfügt
        $statement = $db->prepare($sql); #der Variable Statment wird der Befehl übergeben, $db mit dem inhalt der variable $sql vorzubereiten
        $result = $statement->execute(); #$result wird das ausführen der variable $statement zugewiesen

        echo('<h2>Upload erfolgreich!</h2></a>');
    } else {
        echo "please upload file!";
    }
}
        $sql = "SELECT * FROM file WHERE username = :username"; #im sql statment wird der Variable $sql die auswahl aus der tabelle file bei der username gleich username ist zugewiesen
        $statement = $db->prepare($sql);
        $statement->execute(array('username'=> $username));
        $row = $statement->fetch(); #der variable row werden über variable statement die infos aus der datenbank gefetched

echo "<h2>Bisher hochgeladene Dateien:</h2>";

#alles unten = Tabelle die alle angezeigten Daten auflistet und mit ihrer fileID eindeutig zuordnen und so Download, Löschen, Umbennen und share eindeutig zuweißt
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