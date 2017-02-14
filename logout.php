<!-- Session wird beendet und kompletter Inhalt der Session wird gelöscht -->

<?php
session_start();
session_destroy();
header("Location: index.php");  //Zurückleitung auf index.php
?>