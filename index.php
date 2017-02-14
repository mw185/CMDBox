<p><img src="CMDBox.png" width="250px" alt="Logo"/></p>

<?php
session_start(); #beginnt die Session und übernimmt alles was unter $_SESSION gespeichert wurde

include 'connection.php'; #Datenbankverbindung wird hergestellt, indem connection.php aufgerufen/includiert wird
?>

<?php
$showFormular = true; #Variable showFormular wird auf true gesetzt ->Registrierungsformular wird angezeigt

if(isset($_GET['register'])) {  #Daten aus Formular werden übergeben
    $error = false;             #Variable Error wird auf false gesetzt
    $username = $_POST['username'];
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];

    if(strlen($username) == 0) {        #Es wird geprüft, ob ein Username angegeben wurde, wenn nicht wird der $error auf true gesetzt und die Registrierung
        echo 'Bitte einen Usernamen eingeben<br>';  #wird nicht durchgeführt, es wird eine Fehlermeldung ausgegeben
        $error = true;
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {    #Es wird geprüft, ob eine korrekte e-mail-Adresse eingegeben wurde, wenn nicht wie oben
        echo 'Bitte eine gültige email Adresse eingeben<br>';
        $error = true;
    }
    if(strlen($passwort) == 0) {                        #Es wird geprüft, ob ein Passwort eingegeben wurde, wenn nicht wie oben
        echo 'Bitte ein Passwort angeben<br>';
        $error = true;
    }
    if($passwort != $passwort2) {                       #Es wird geprüft, ob die Passwörter übereinstimmen, wenn nicht wie oben
        echo 'Die Passwörter müssen übereinstimmen<br>';
        $error = true;
    }

    #Es wird geprüft, ob die eingegebene E-Mail Adresse schon auf der Datenbank vorhanden ist
    if(!$error) {
        $statement = $db->prepare("SELECT * FROM person WHERE email = :email");
        $result = $statement->execute(array('email' => $email));
        $emailadress = $statement->fetch();

        if($emailadress !== false) {        #Wenn E-Mail schon registriert ist, wird die Fehlermeldung ausgegeben und $error auf True gesetzt
            echo 'Diese E-Mail-Adresse ist bereits registriert<br>';
            $error = true;
        }
    }
    #Es wird geprüft, ob der eingegebene Username schon auf der Datenbank vorhanden ist, wenn nicht wie oben
    if(!$error) {
        $statement = $db->prepare("SELECT * FROM person WHERE username = :username");
        $result = $statement->execute(array('username' => $username));
        $user = $statement->fetch();

        if($user !== false) {
            echo 'Dieser Username ist bereits vergeben<br>';
            $error = true;
        }

    }

    # Es gibt keinen Error, der Nutzer kann jetzt registriert werden
    if(!$error) {
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT); #die Variable passwort_hash wird definiert, die von PHP vorgegeben Version verschlüsselt die
                                                                    # Passwörter auf der Datenbank

        $statement = $db->prepare("INSERT INTO person (username, email, password) VALUES (:username, :email, :password)"); #Das SQL Statement überträgt die eingegebenen
        $result = $statement->execute(array('username' => $username,'email' => $email, 'password' => $passwort_hash));      # Werte in die Datenbank

        if($result) {               #wenn das Statement ausgeführt wurde und der Nutzer in der Datenbank registriert wurde,
            $showFormular = false;  #wird das Formular nicht mehr angezeigt und

            # es wird eine Bestätigungsmail gesendet
            $empfaenger = "".$_POST['email']."";
            $absendername = "CMD Box";
            $absendermail = "automatic@CMD-Box.de";
            $betreff = "Herzlich Willkommen bei CMD Box!";
            $text = "Hallo ".$_POST['username']."


Du kannst jetzt deine Box verwalten und Dateien teilen.
Wir wünschen dir viel Spaß.

Hier geht's zum Login: https://mars.iuk.hdm-stuttgart.de/~mw185/login.php


Liebe Grüße, 

dein CMDBox-Team

Dies ist eine automatisch generierte E-Mail, bitte nicht darauf antworten.";
            mail($empfaenger, $betreff, $text, "From: $absendername <$absendermail>"); #oben gesetzte Variablen werden ausgeselesen und die Mail wird gesendet

            echo 'Du wurdest erfolgreich registriert. Wir haben eine Bestätigungsmail an deine E-Mail Adresse gesendet.' #Ausgabe im Browser nach Registrierung
            ?>
            <a href =login.php>Zum Login</a>
            <?php
        }
        else {  #Wenn es einen Fehler beim Abspreichern in der DAtenbank gab, wird die Fehlermeldung ausgegeben
            echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';

        }
    }
}

if($showFormular) { #solange #showFormular = true ist, wird das Formular angezeigt
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="index.css">
    <title>Registrierung</title>
</head>
<body>

    <div class = 'loginsite'>
        <div class="loginbox">
            <div class="card">
                <h1 class ="title">Registrieren</h1>
                <form action="?register=1" method="post">
                    <div class="input-container">
                        <input id ="username" type="text" size="40" maxlength="250" name="username" placeholder = "Username">
                        <label for = "username"></label>
                        <div class = "bar"></div>
                    </div>
                    <div class = "input-container">
                        <input id = "email" type="email" name="email" maxlength="250" placeholder = "E-Mail"><br/>
                        <label for = "E-Mail"></label>
                        <div class = "bar"></div>
                    </div>
                    <div class = "input-container">
                        <input id = "password" type="password" name="passwort" maxlength="250" placeholder = "Passwort"><br/>
                        <label for = "Passwort"></label>
                        <div class = "bar"></div>
                    </div>
                    <div class = "input-container">
                        <input id = "password" type="password" name="passwort2" maxlength="250" placeholder = "Passwort wiederholen"><br/>
                        <label for = "Passwort wiederholen"></label>
                        <div class = "bar"></div>
                    </div>


                    <div class = "button-container">
                        <button type = "submit" name = "Registrieren">Registrieren</button>
                    </div>
                    <br/>

                    <div class = "button-container">
                        <a href="login.php" class="btn btn-default">Zum Login</a>
                    </div>



                </form>
            </div>
        </div>
    </div>

    <?php
}       #ShowFormular endet hier
?>
        <div class="extrainfo">
            <small class="impressum">Impressum</small>
            <small class="impressum">|</small>
            <small class="impressum">Team CMD &copy; 2017</small>

        </div>

</body>
</html>


