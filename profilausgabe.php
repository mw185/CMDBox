<?php
// Session starten
session_start ();
// Datenbankverbindung aufbauen
include ("connection.php");
//Daten aus DB herauslesen
$sql = $db->prepare('SELECT username, email  FROM person WHERE username = :username');
$array = array(
    ':username' => $_SESSION[':username']
);
$sql->execute($array);

//Gibt Datensätze untereinander aus
while ($row = $sql->fetch()) {
    //  echo 'Userid: ' . $row['userid'] . '<br />';
    echo '<i class="fa fa-user"></i>&nbsp;&nbsp;' . $row['username'] ."&nbsp;" . $row['email'] .'<br />';
    echo '<i class="fa fa-envelope"></i>&nbsp;&nbsp;'. $row['email'] . '<br />';
};
?>