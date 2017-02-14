<?php
session_start();
include'connection.php';

$showFormular = true;

///Daten aus DB herauslesen
$sql = $db->prepare('SELECT username FROM person WHERE username = :username');
$array = array(
    ':username' => $_SESSION['userid']
);

$fileID = isset($_GET['fileID'])? $_GET ['fileID']: die("ERROR: ID konnte nicht gefunden werden");
$username = $_SESSION['userid'];

$sql->execute($array);


$sql = ("SELECT * FROM file WHERE fileID = :fileID");
$statement = $db->prepare($sql);
$statement->execute(array('fileID'=> $fileID));


$empfaenger = "".$_POST['email']."";
$absendername = "CMD Box";
$absendermail = "automatic@CMD-Box.de";
$betreff = "$username hat Dir eine Datei gesendet!";
$text = "Der Nutzer $username hat dir eine Datei gesendet.
Du kannst die Datei unter folgendem Link herunterladen:
https://mars.iuk.hdm-stuttgart.de/~mw185/download.php?file=".$fileID;
$result = mail($empfaenger, $betreff, $text, "From: $absendername <$absendermail>");

if ($result) {
    echo "Die E-Mail mit dem Downloadlink wurde an den Empfänger gesendet.";
    $showFormular = false;

}

if($showFormular) {
?>

<form name ="share" action="<?php echo("?fileID={$fileID}")?>" method="POST">
    <input type="email" name="email" placeholder="Empfänger E-Mail"><br/>
    <button type="submit">Datei teilen</button><br/>
</form>


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