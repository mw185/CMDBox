<?php

session_start();
include'connection.php';

session_start();
include ("connection.php");

$fileID = $_GET['fileID'];

if(!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])) {
    header('Login.php');
    exit;
}
$statement = $db->prepare("UPDATE file SET filename = :filename WHERE fileID = :fileID");
$statement->execute(array('fileID'=> $fileID));

$file = $statement->fetch();
rename("Uploads/". $file["filename"]);


if(!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])) {
    header('Login.php');
    exit;
}

$old = $uploaddir.'/'.$_POST[alt];
$new = $uploaddir.'/'.$_POST[neu];
rename($old,$new); #alten namen durch neuen ersetzen

$old=$_GET['ren']; #variable old wird definiert
?>

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
