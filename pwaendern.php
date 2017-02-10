<?php
include("inc/header.inc.php");
require 'inc/password.lib.php';
require 'inc/connect.php';
if(isset($_POST['password'])) { #passwort wird aus datenbank genommen

    $username=$_SESSION['username'];
    $pass = !empty($_POST['password']) ? trim($_POST['password']) : null;  #verkürztes if statement mit ? : ; trim entfernt leerzeichen

    $passwordHash = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12)); #variable passwordhash wird definiert

    $sql = "UPDATE users SET password = :password WHERE username=:username";
    $stmt = $pdo->prepare($sql);

    #Values werden an PDO-Statement gebunden
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':password', $passwordHash);

    $result = $stmt->execute(); #ausführen von stmt

    header('Location: changedpwd.php'); #weiterleitung zu changedpw

}

?>
<section id="inhalt">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2><br>Passwort ändern</h2>
                <br> <br>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">

                <form action="changepwd.php" method="post"> <!--formular zum umbenennen  -->
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <input type="hidden" name="username" value="<?php echo $password; ?>"/>
                            <label>Neues Passwort</label><input type="password" class="form-control" name="password" value="NEWPASSWORD"/>
                        </div>
                    </div><br>
                    <div class="form-group col-xs-12">
                        <input type="submit" name="submit" value="Neues Passwort speichern" class="btn btn-success">
                    </div>
            </div>


            </form>
        </div>
    </div>
    </div>
</section>

<?php
include("inc/footer.inc.php");
?>


