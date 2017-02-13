<?php
session_start();
include'connection.php';

///Daten aus DB herauslesen
$sql = $db->prepare('SELECT username FROM person WHERE username = :username');
$array = array(
    ':username' => $_SESSION['userid']
);

$fileID = isset($_GET['fileID'])? $_GET ['fileID']: die("ERROR: ID konnte nicht gefunden werden");
$username = isset($_GET['username']);

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
https://mars.iuk.hdm-stuttgart.de/~mw185/Uploads/fileID=$fileID";
mail($empfaenger, $betreff, $text, "From: $absendername <$absendermail>");
?>

<form name ="share" action="<?php echo("?fileID={$fileID}")?>" method="POST">
    <input type="email" name="email">email<br/>
    <input type="submit" value="Senden">Senden<br/>
</form>

<?php
include("userdata.inc.php");
$datei=$_GET['share']; #variable datei wird definiert
$fulldir=$uploaddir.'/'.$datei; #fulldir wird definiert, uploaddir: $server.$userfolder,
$sharedir=$home.'/share'; #bestimmt Ordner wo share datei reingelegt wird: share
$date = new DateTime();
$folder =  $date->getTimestamp(); #individueller Zeistempel wird erstellt, um datei eindeutigen link zuweisen zu können
mkdir($home.'share/'.$folder, 0777, true); #mkdir erstellt Verzeichnis (ordner für jede datei, die man teilen will)

copy($fulldir, $home.'share/'.$folder.'/'.$datei);
$link = $fullurlslash.'share/'.$folder.'/'.$datei; #link Variable wird definiert, die in share.php angezeigt wird
$_SESSION['link'] = $link;
header('Location: '.$fullurl.'/share.php'); #weiterleitung zu share.php wo link angezeigt wird
?>

<?php
include("inc/header.inc.php");
$link=$_SESSION['link'];
?>
<section id="inhalt">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2><br>Teilen</h2>
                <br> <br>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="form-group col-xs-12">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <input type="text" name="link" size="100" value="<?php echo $link; ?>" class="form-control" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>









