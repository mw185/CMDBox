<?php
session_start();
include("connection.php");

///Daten aus DB herauslesen
$sql = $db->prepare('SELECT email FROM person WHERE username = :username');
$array = array(
    ':username' => $_SESSION['userid']
);






$sql->execute($array);



$sql = "SELECT * FROM file WHERE fileID = :fileID";
$statement = $db->prepare($sql);
$statement->execute(array('fileID'=> $fileID));



$emailto = $_POST["empfaenger"];
$subject = $_POST["betreff"];
$body = $_POST["nachricht"];
$sender = "email";
$headers = "From:.$sender";
mail($emailto, $subject, $body, $headers);
?>

<form action="share.php" method="POST">
    <input type="email" name="email">email<br/>
    <input type="file" name="file">Datei<br/>
    <input type="submit" value="Senden">Senden<br/>
</form>

<?php
session_start();

include 'connection.php';

if(isset($errorMessage)) {
    echo $errorMessage;
}
?>

<?php


if(isset($_GET['fileID'])) {
    $error = false;
    $username = $_POST['username'];
    $email = $_POST['email'];
    }

    if(!$error) {
        $statement = $db->prepare("SELECT * FROM file WHERE fileID = :fileID");
        $result = $statement->execute(array('filename' => $filename));
        $fick = $statement->fetch();
    }

            $empfaenger = "".$_POST['email']."";
            $absendername = "CMD Box";
            $absendermail = "automatic@CMD-Box.de";
            $betreff = "Herzlich Willkommen bei CMD Box!";
            $text = "Hallo ".$_POST['username']."

Du kannst jetzt deine Box verwalten und Dateien teilen.
Wir wünschen dir viel Spaß.

Dies ist eine automatisch generierte e-mail, bitte nicht darauf antworten.";
            mail($empfaenger, $betreff, $text, "From: $absendername <$absendermail>");
            echo 'Du wurdest erfolgreich registriert. Wir haben eine Bestätigungsmail an deine e-mail Adresse gesendet.'
            ?>
            <a href = login.php>Zum Login</a>
            <?php
        }
        else {
            echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';

        }
    }
}

if($showFormular) {
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="login.css">
    <title>Registrierung</title>
</head>
<body>

<div class = 'loginsite'>
    <div class="loginbox">
        <div class="firstcard"></div>
        <div class="card">
            <h1 class ="title">Registrieren</h1>
            <form action="?register=1" method="post">
                <div class="input-container">
                    <input id ="username" type="text" size="40" maxlength="250" name="username">
                    <label for = "username">Username</label>
                    <div class = "bar"></div>
                </div>
                <div class = "input-container">
                    <input id = "email" type="email" name="email" maxlength="250"><br/>
                    <label for = "E-Mail">E-Mail</label>
                    <div class = "bar"></div>
                </div>
                <div class = "input-container">
                    <input id = "password" type="password" name="passwort" maxlength="250"><br/>
                    <label for = "Passwort">Passwort</label>
                    <div class = "bar"></div>
                </div>
                <div class = "input-container">
                    <input id = "password" type="password" name="passwort2" maxlength="250"><br/>
                    <label for = "Passwort wiederholen">Passwort wiederholen</label>
                    <div class = "bar"></div>
                </div>


                <div class = "button-container">
                    <button type = "submit" name = "Registrieren">Registrieren</button>
                </div>
                <br/>

                <div class = "button-container">
                    <a href="login.php" class="btn btn-default">Zum Login</a>
                </div>

                <div class="cardfooter">

            </form>
        </div>
    </div>
</div>

<?php
}       #ShowFormular endet hier
?>


<hr id="line"/>
<div class="extrainfo">
    <small class="credits">Team CMD &copy; 2017  |  </small>
    <small class="impressum"><a href="#">Impressum</a></small>
</div>
</div>

</body>
</html>


