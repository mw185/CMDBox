<?php

session_start();
include'connection.php';

session_start();
include ("connection.php");

if(!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])) {
    header('Login.php');
    exit;
}

$fileID = $_GET['fileID'];

$statement = $db->prepare("UPDATE file SET filename = :filename WHERE fileID = :fileID");
$statement->execute(array('fileID'=> $fileID));

$file = $statement->fetch();
rename("Uploads/". $file["filename"]);

header("location: upload.php");


$old = $uploaddir.'/'.$_POST[alt]; #old in rename definiert
$new = $uploaddir.'/'.$_POST[neu];
rename($old,$new); #alten namen durch neuen ersetzen
header('Location: '.$fullurl.'/home.php'); #weiterleitung zur home seite


$old=$_GET['ren']; #variable old wird definiert
?>
<section id="inhalt">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2><br><?php echo $old ?></h2> <!-- alter name wird ausgegeben-->
                <br><br>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">


                <form action="<?php echo $fullurl ?>renamedo.php" method="post"> <!--formular wird an /inc/renamedo.inc.php weitergegeben -->
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <input type="hidden" name="alt" value="<?php echo $old; ?>"/>
                            <label>Neuer Name</label>
                            <input type="text" name="neu" class="form-control" value="<?php echo $old; ?>"/> <!--in input wird alter name angezeigt zum überarbeiten -->
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12">
                            <input type="submit" name="submit" value="Umbenennen" class="btn btn-success btn-lg"> <!--button-->
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
</section>
