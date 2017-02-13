<?php
session_start();

include 'connection.php';

if(isset($errorMessage)) {
    echo $errorMessage;
}
?>

<?php
$showFormular = true; #Registrierungsformular wird angezeigt

if(isset($_GET['register'])) {
    $error = false;
    $username = $_POST['username'];
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];

    if(strlen($username) == 0) {
        echo 'Bitte einen Usernamen eingeben<br>';
        $error = true;
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Bitte eine gültige email Adresse eingeben<br>';
        $error = true;
    }
    if(strlen($passwort) == 0) {
        echo 'Bitte ein Passwort angeben<br>';
        $error = true;
    }
    if($passwort != $passwort2) {
        echo 'Die Passwörter müssen übereinstimmen<br>';
        $error = true;
    }

    #Überprüfe, dass email noch nicht registriert wurde
    if(!$error) {
        $statement = $db->prepare("SELECT * FROM person WHERE email = :email");
        $result = $statement->execute(array('email' => $email));
        $emailadress = $statement->fetch();

        if($emailadress !== false) {
            echo 'Diese E-Mail-Adresse ist bereits registriert<br>';
            $error = true;
        }
    }
    #Überprüfe, dass Username noch nicht registriert wurde
    if(!$error) {
        $statement = $db->prepare("SELECT * FROM person WHERE username = :username");
        $result = $statement->execute(array('username' => $username));
        $user = $statement->fetch();

        if($user !== false) {
            echo 'Dieser Username ist bereits vergeben<br>';
            $error = true;
        }

    }

    # Nutzer registrieren
    if(!$error) {
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);

        $statement = $db->prepare("INSERT INTO person (username, email, password) VALUES (:username, :email, :password)");
        $result = $statement->execute(array('username' => $username,'email' => $email, 'password' => $passwort_hash));

        if($result) {
            $showFormular = false;  #Formular wird nicht mehr angezeigt
            # Bestätigungsmail senden
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
    <link rel="stylesheet" href="index.css">
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
            <small class="credits">Team CMD &copy; 2017  |</small>
            <small class="impressum">Impressum</small>
        </div>
    </div>

</body>
</html>


