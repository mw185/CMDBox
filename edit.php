<?php
// Session starten
session_start ();
// Datenbankverbindung aufbauen
include ("connection.php");
//Passwortvergleich (eingegebenes PW mit dem der DB)
$username = $_SESSION["username"];
$passwort_alt = $_POST["passwort_alt"];
try{
    $sql = "SELECT username, passwort FROM person WHERE username LIKE '$username'";
    $query = $db->prepare($sql);
    $query->execute();
    while ($result = $query->fetch(PDO::FETCH_ASSOC)){
        $usernamevergleich = $result["username"];
        $pwvergleich = $result["passwort"];
    }
}
catch(PDOException $e){
    echo "2:".$sql."</br>".$e->getMessage();
    die();
}
$secret_salt = "topsecretsalt";
$salted_password = $secret_salt . $passwort_alt;
$password_hash = hash('sha256', $salted_password);
if($pwvergleich == $password_hash)
{
    $_SESSION["username"] = $username;
    $_SESSION["loggedin"] = 1;
    echo "Passw&ouml;rter stimmen &uuml;berein.";
    $error = false;
}
else
{
    echo "Das eingegebene alte Passwort stimmt nicht. <br />";
    echo "Zur&uuml;ck zum <a href='profil.php'>Profil</a>";
    $error = true;
}
// neues Passwort einspeichern
$pw = $_POST["passwort"];
$pw2 = $_POST["passwort2"];
$user_dir = md5($_POST["username"]); /* Es wird auf Basis der einmaligen E-Mail ein Hashwert erzeugt*/
if ($error == false) {
    if ($pw == $pw2) {
        $secret_salt = "topsecretsalt";
        $salted_password = $secret_salt . $pw;
        $password_hash = hash('sha256', $salted_password);
        //Einfügen in DB
        $edit = $db->prepare('UPDATE person SET passwort = :passwort WHERE username = :username');
        $array = array(
            ':passwort' => $password_hash,
            ':username' => $_SESSION['username']
        );
        $edit->execute($array);
        echo "Ihr Passwort wurde erfolgreich ge&auml;ndert. <br /> ";
        echo "<a href='loginpage.html'>Einloggen</a><br/>";
        echo $password_hash;
    } else {
        echo "Die Passw&ouml;rter waren nicht identisch. <a href='index.html'>Zur&uuml;ck</a>";
    }
}
else {}
$db     = null;
/*header("Location: index.html");*/
die();
?>