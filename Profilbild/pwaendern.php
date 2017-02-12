<?php
session_start();

include 'connection.php';

if(isset($errorMessage)) {
    echo $errorMessage;
}
?>

<?php
$showFormular = true;

if (isset($_SESSION['userid'])){
$username = $_SESSION['userid'];
}

if (isset($_GET['pwaendern'])) {
    $error = false;
    $passwort_alt = $_POST['passwort_alt'];
    $passwort_neu = $_POST['passwort_neu'];
    $passwort_neu2 = $_POST['passwort_neu2'];
}
if($passwort_neu != $passwort_neu2) {
    echo 'Die neuen Passwörter stimmen nicht überein<br>';
    $error = true;
}

if($passwort_alt == $passwort_neu) {
    echo 'Das neue Passwort ist unverändert<br>';
}

# Passwort kann jetzt geändert werden

if (!$error) {
    $passwort_hash = password_hash($passwort_neu, PASSWORD_DEFAULT);

    $statement = $db->prepare("UPDATE person SET password = $passwort_neu WHERE username = :username");
    $result = $statement->execute(array('password' => $passwort_neu));
}

    if ($result){
        $ShowFormular = false;
        echo 'Dein Passwort wurde erfolgreich geändert.';
    }

echo $username;
?>
        <a href = showuploads.php>Zum Login</a>
<?php
if($showFormular) {
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Passwort ändern</title>
        <h1>Passwort ändern</h1>
    </head>
    <body>

    <form action="?password=1" method="post">
        Altes Passwort:<br>
        <input type="password" size="40" maxlength="250" name="passwort_alt"><br>
        Neues Passwort:<br>
        <input type="password" size="40" maxlength="250" name="passwort_neu"><br>
        Neues Passwort wiederholen:<br>
        <input type="password" size="40" maxlength="250" name="passwort_neu2"><br><br>


        <input type="submit" value="Passwort ändern">
    </form>

    <?php
}               #showFormular endet hier
?>