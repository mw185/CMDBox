<?php
session_start();    #Die aktuelle Session wird übergeben -> man bleibt angemeldet
include'connection.php'; ##Datenbankverbindung wird hergestellt, indem connection.php aufgerufen wird
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" initial-scale=1.0 />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="profil.css" rel="stylesheet">
    <link href="share.css" rel="stylesheet">
    <title>Profil</title>
</head>

<body>

<div class="extrainfo">
    <img src="CMDBox.png" width="250px" alt="Logo"/>
</div>
<ul><li><img src="<?php echo 'Profilbild/'.$_SESSION ['userid'].'.jpg'; ?>" width="300px" alt="Profilbild"/>
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
$showFormular = true;   #Variable $showFormular wird auf true gesetzt-> Forular wird angezeigt

$sql = $db->prepare('SELECT username FROM person WHERE username = :username');  #Durch ein SQL Statement wird der aktuelle username aus der Datenbank ausgelesen
$array = array(':username' => $_SESSION['userid']);

$fileID = isset($_GET['fileID'])? $_GET ['fileID']: die("ERROR: ID konnte nicht gefunden werden"); #die FileID wird per Get übergeben. Ansonsten Error
$username = $_SESSION['userid']; #Dem Usernamen wird in der aktuellen Session eine ID zugewiesen
$sql->execute($array);


$sql = ("SELECT * FROM file WHERE fileID = :fileID"); #Durch ein SQL Statement wird die aktuelle FileID aus der Datenbank ausgelesen
$statement = $db->prepare($sql);
$statement->execute(array('fileID'=> $fileID));


$empfaenger = "".$_POST['email']."";
$absendername = "CMD Box";
$absendermail = "automatic@CMD-Box.de";
$betreff = "$username hat Dir eine Datei gesendet!";
$text = "Der Nutzer $username hat dir eine Datei gesendet.

Du kannst die Datei unter folgendem Link herunterladen:
https://mars.iuk.hdm-stuttgart.de/~mw185/download.php?file=".$fileID;
$result = mail($empfaenger, $betreff, $text, "From: $absendername <$absendermail>"); #Eine E-Mail mit den oben festgelegten Variablen wird versendet,
                                                                                    #Die Empfänger E-Mail Adresse wird aus dem Formular übergeben
if ($result) { #wenn die E-Mail erfolgreich versendet wurde, wird eine Bestätigungsnachricht ausgegeben
    echo "<h3>Die E-Mail mit dem Downloadlink wurde an den Empfänger gesendet.</h3>";
    $showFormular = false;?> #Das Formular wird ausgeblendet
    <a href=upload.php><h4>Zurück</h4></a>
<?php
}

if($showFormular) { #wenn $showFormular = true ist, wird folgendes Formular angezeigt:
?>

<br/><br/><br/><br/><br/>
<form name ="share" action="<?php echo("?fileID={$fileID}")?>" method="POST">
    <input type="email" name="email" placeholder="Empfänger E-Mail"><br/><br/>
    <button type="submit">Datei teilen</button><br/>
</form>





    <?php
}
?>