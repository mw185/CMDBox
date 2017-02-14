
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" initial-scale=1.0 />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="profil.css" rel="stylesheet">
    <link href="pwaendern.css" rel="stylesheet">
    <title>Passwort ändern</title>
</head>

<?php
session_start();

include 'connection.php';   #Datenbankverbindung wird hergestellt, indem connection.php aufgerufen wird
?>

<body>


<div class="extrainfo">
    <img src="CMDBox.png" width="250px" alt="Logo"/>
</div>
<ul><li><img src="<?php echo 'Profilbild/'.$_SESSION ['userid'].'.jpg';?>" width="285px" alt="Profilbild"/></li></ul>


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
$showFormular = true;       #Die Variable ShowFormular wird auf true gesetzt-> Formular wird angezeigt

if (isset($_SESSION['userid'])){    #Wenn der Nutzr in der Session angemeldet ist, wird eine userid übergeben
    $username = $_SESSION['userid']; #der userid wird die Variable $username zugewiesen
    }

if (isset($_GET['password'])) { #eingegebene Daten werden aus Formular ausgelesen
    $error = false; #Die Variable $error wird auf false gesetzt
    $passwort_alt = $_POST['passwort_alt'];
    $passwort_neu = $_POST['passwort_neu'];
    $passwort_neu2 = $_POST['passwort_neu2'];

    if ($passwort_neu != $passwort_neu2) {  #Es wird geprüft, ob die neuen Passwörter überein stimmen, ansonsten wird eine Fehlermeldung ausgegeben
        echo '<p>Die neuen Passwörter stimmen nicht überein!</p>';  #und die Variable $error auf true gesetzt -> Änderung wird nicht ausgeführt
        $error = true;
    }

    if ($passwort_neu == $passwort_alt) {   #prüft, ob das neue und das alte Passwort überein stimmen, wenn ja -> wie oben
        echo '<p>Das neue Passwort ist unverändert!</p>';
        $error = true;
    }

# Kein Error, Passwort kann jetzt geändert werden

    if (!$error) {
        $passwort_hash = password_hash($passwort_neu, PASSWORD_DEFAULT); #Das neue Passwort wird gehasht

        $statement = $db->prepare("UPDATE person SET password = :password WHERE username = :username"); #SQL Statement Updated das Passwort in der DB
        $result = $statement->execute(array('password' => $passwort_hash, 'username' => $username));
        if ($result) {      # Wenn das Statement ausgeführt wurde und das Passwort geändert wurde,
            $showFormular = false;  #wird das Formular ausgeblendet
            echo '<h3>Dein Passwort wurde erfolgreich geändert!</h3>'; #und eine Bestätigungsnachricht ausgegeben
            ?>
            <a href=upload.php><h4>Zurück</h4></a>

            <?php
        }
    }
}
if($showFormular) { #Das wird angezeigt, wenn $showFormular = true ist
?>
    <br/><br/><br/><br/><br/>
    <br/><br/>

    <form action="pwaendern.php?password=1" method="post">

        <input type="password" size="40" maxlength="250" name="passwort_alt" placeholder="Altes Passwort"><br>
        <input type="password" size="40" maxlength="250" name="passwort_neu" placeholder = "Neues Passwort"><br>
        <input type="password" size="40" maxlength="250" name="passwort_neu2" placeholder = "Passwort wiederholen"><br><br>

        <button type="submit">Passwort ändern</button>
        <button type="reset">Eingaben zurücksetzen</button>

    </form>

<?php
}
?>
</body>
</html>
