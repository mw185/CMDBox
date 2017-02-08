<?php

session_start();

$dsn="mysql:host=localhost;dbname=u-db104"; #Datenbankverbindung aufbauen
$dbuser="db104";
$dbpass="anohk4Aepu";

try {
    $db=new PDO($dsn,$dbuser,$dbpass);
}
catch(PDOException $e){
    echo $e->getMessage();
    die();
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrierung</title>
    <h1>Registrierung</h1>
</head>
<body>

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
            echo 'Du wurdest erfolgreich registriert.';
            $showFormular = false;
        }
        else {
            echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
        }
    }
}

if($showFormular) {
    ?>

    <form action="?register=1" method="post">
        Username:<br>
        <input type="username" size="40" maxlength="250" name="username"><br>
        E-Mail:<br>
        <input type="email" size="40" maxlength="250" name="email"><br>
        Dein Passwort:<br>
        <input type="password" size="40"  maxlength="250" name="passwort"><br>
        Passwort wiederholen:<br>
        <input type="password" size="40" maxlength="250" name="passwort2"><br><br>

        <input type="submit" value="Senden">
    </form>

    <?php
}
?>

</body>
</html>