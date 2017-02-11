<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" initial-scale=1.0 />
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <script src="./js/dropzone.js"></script>
    <link href="./css/basic.css" rel="stylesheet">
    <link href="./css/dropzone.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/script.js/0.1/script.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="js/bootstrap.min.js">
    <link href="profil.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="js/main.js"></script>
</head>

<body>

<img src="<?php echo 'Profilbild/'.'.jpg'; ?>" width="285px" alt="Profilbild"/>

<?php echo ($_SESSION['userid']) ?>

<script>
    /*--------------------------------Passwort falsch ----------------------------*/
    $(document).ready(function () {
        $(".password_alt").click(function () {
            var password_alt =  $("password_alt").attr("password_alt");
            alert (password_alt);
            $.ajax({
                type: "POST",
                url: "edit.php",
                data: passwort_alt,
                success: function () {
                }
            });
        }
        return false;
    });
    });
</script>



<div>
    <div class="nav">
        <div class="container">
            <ul class="pull-left">
                <li><a href="index.html">CMDBox</a></li>
            </ul>
            <ul class="pull-right">
                <li><a href="FormularUpload.html">Upload</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</div>



<!-- Profil -->

<div class="profil">
    <div class="profilkopf"></div>
    <div class="profilbody">
        <div class="profilpic">
            <?php
            include('connection.php');
            $einfuegen = $db->prepare('SELECT * FROM person WHERE email = :email');
            $array = array(
                ':email' => $_SESSION['email']
            );
            $einfuegen->execute($array);
            while ($row = $einfuegen->fetch()) {
                echo "<img src='" . $row['profilbildpfad'] . "'>";
            };
            ?>
        </div>

        <!--  Fenster für Profilbildänderung  ----->
        <div id="BildModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Lade hier bitte dein neues Profilbild hoch.</h4>
                    </div>
                    <div class="modal-body">
                        <form action="profilbild.php" method="post" enctype="multipart/form-data">
                            <input class="btn btn-primary active" type="file" name="bild" value="Datei auswählen">
                            <input class="btn btn-primary active" type="submit" name="upload" value="Hochladen">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- In der DB gespeichertes Profil wird ausgegeben -->
        <div class="info">
            <div class="title">
                <h3>Mein Profil</h3>
            </div>
            <div class="desc">
                <?php
                include("profilausgabe.php");
                ?>
            </div>
        </div>

        <!-- Buttons für Profilbild- und Passwortänderung -->
        <div class="btn-group">
            <button type="button" href="#passwortModal" class="btn btn-primary" data-toggle="modal">Passwort ändern
            </button>
            <button type="button" href="#BildModal" class="btn btn-primary" data-toggle="modal">Profilbild ändern
            </button>
        </div>

        <!-- Modal HTML -->
        <div id="passwortModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Passwort ändern</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form" action="edit.php" method="post">
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <input class="passwort_alt form-control" id="passwort_alt" name="passwort_alt" type="password"
                                           placeholder="Gib hier dein altes Passwort ein."
                                           required>
                                </div>
                            </div>
                            <p></p>
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <input class="form-control" name="passwort" type="password"
                                           placeholder="Gib hier dein neues Wunschpasswort ein." required>
                                </div>
                            </div>
                            <p></p>
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <input class="form-control" name="passwort2" type="password"
                                           placeholder="Bitte wiederhole dein Wunschpasswort."
                                           required>
                                </div>
                            </div>
                            <div class="button-container col-md-offset">
                                <button data-trigger='click' class="btn btn-primary active" type="submit" name="submitdata">Passwort ändern</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>


</body>
</html>