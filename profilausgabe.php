<?php
// Session starten
session_start ();
// Datenbankverbindung aufbauen
include ("connection.php");
//Daten aus DB herauslesen
$sql = $db->prepare('SELECT userid, vorname, nachname, email  FROM User WHERE email = :email');
$array = array(
    ':email' => $_SESSION['email']
);
$sql->execute($array);
//Gibt Datensätze untereinander aus
while ($row = $sql->fetch()) {
    //  echo 'Userid: ' . $row['userid'] . '<br />';
    echo '<i class="fa fa-user"></i>&nbsp;&nbsp;' . $row['vorname'] ."&nbsp;" . $row['nachname'] .'<br />';
    echo '<i class="fa fa-envelope"></i>&nbsp;&nbsp;'. $row['email'] . '<br />';
};
?>