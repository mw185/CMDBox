
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
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/script.js/0.1/script.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="js/bootstrap.min.js">
    <link href="profil.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="js/main.js"></script>
    <title>Passwort ändern</title>
<?php
session_start();

include 'connection.php';

if(isset($errorMessage)) {
    echo $errorMessage;
}
?>
        <?php
        $showFormular = true;
        ?>

<body>
<img src="<?php echo 'Profilbild/'.$_SESSION ['userid'].'.jpg'; ?>" width="285px" alt="Profilbild"/>
<?php echo ($_SESSION['userid']) ?>


<div>
    <div class="nav">
        <div class="container">
            <ul class="pull-left">
                <li><a href="upload.php">CMD Upload</a></li>
            </ul>
            <ul class="pull-right">
                <li><a href="pwaendern.php">Passwort ändern</a></li>
                <li><a href="profilbild.php">Profilbild ändern</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</div>
<br/><br/><br/><br/><br/>

<?php
$showFormular = true;
if($showFormular) {
    ?>

    <form action="pwaendern.php?password=1" method="post">
        Altes Passwort:<br>
        <input type="password" size="40" maxlength="250" name="passwort_alt"><br>
        Neues Passwort:<br>
        <input type="password" size="40" maxlength="250" name="passwort_neu"><br>
        Neues Passwort wiederholen:<br>
        <input type="password" size="40" maxlength="250" name="passwort_neu2"><br><br>


        <input type="submit" value="Passwort ändern">
    </form>

    <?php
}

if (isset($_SESSION['userid'])){
$username = $_SESSION['userid'];
}

if (isset($_GET['password'])) {
    $error = false;
    $passwort_alt = $_POST['passwort_alt'];
    $passwort_neu = $_POST['passwort_neu'];
    $passwort_neu2 = $_POST['passwort_neu2'];

    if ($passwort_neu != $passwort_neu2) {
        echo 'Die neuen Passwörter stimmen nicht überein';
        $error = true;
    }

    if ($passwort_neu == $passwort_alt) {
        echo 'Das neue Passwort ist unverändert';
        $error = true;
    }

# Passwort kann jetzt geändert werden

    if (!$error) {
        $passwort_hash = password_hash($passwort_neu, PASSWORD_DEFAULT);

        $statement = $db->prepare("UPDATE person SET password = :password WHERE username = :username");
        $result = $statement->execute(array('password' => $passwort_hash, 'username' => $username));
        if ($result) {
            $ShowFormular = false;
            echo 'Dein Passwort wurde erfolgreich geändert.';
        }
    }
}
?>
        <a href = upload.php>Zurück</a>


