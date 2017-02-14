
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

include 'connection.php';

if(isset($errorMessage)) {
    echo $errorMessage;
}
?>

<body>


<div class="extrainfo">
    <img src="CMDBox.png" width="250px" alt="Logo"/>
</div>
<ul><li><img src="<?php echo 'Profilbild/'.$_SESSION ['userid'].'.jpg';?>" width="285px" alt="Profilbild"/>
        <h1><?php echo ($_SESSION['userid'])?></h1></li></ul>


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
$showFormular = true;

if (isset($_SESSION['userid'])){
    $username = $_SESSION['userid'];
    }

if (isset($_GET['password'])) {
    $error = false;
    $passwort_alt = $_POST['passwort_alt'];
    $passwort_neu = $_POST['passwort_neu'];
    $passwort_neu2 = $_POST['passwort_neu2'];

    if ($passwort_neu != $passwort_neu2) {
        echo '<p>Die neuen Passwörter stimmen nicht überein!</p>';
        $error = true;
    }

    if ($passwort_neu == $passwort_alt) {
        echo '<p>Das neue Passwort ist unverändert!</p>';
        $error = true;
    }

# Passwort kann jetzt geändert werden

    if (!$error) {
        $passwort_hash = password_hash($passwort_neu, PASSWORD_DEFAULT);

        $statement = $db->prepare("UPDATE person SET password = :password WHERE username = :username");
        $result = $statement->execute(array('password' => $passwort_hash, 'username' => $username));
        if ($result) {
            $showFormular = false;
            echo '<h3>Dein Passwort wurde erfolgreich geändert!</h3>';
            ?>
            <a href=upload.php><h4>Zurück</h4></a>

            <?php
        }
    }
}
if($showFormular) {
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
