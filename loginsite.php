<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <link href="loginsite.css" rel="stylesheet">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" async></script>
    <title>Login</title>
</head>

<body>

<?php

include(login.php);
if(isset($errorMessage)) {
    echo $errorMessage;
}
?>

<div class="loginsite">
    <div class="loginbox">
        <div class="firstcard"></div>
        <div class="card">
            <h1 class="title">Login</h1>
            <form action="login.php" method="post">
                <div class="input-container">
                    <input id="username" name="username" type="text" placeholder="Email" maxlength="40" required>
                    <label for="username"></label>
                    <div class="bar"></div>
                </div>
                <div class="input-container">
                    <input type="password" id="password" name="password" placeholder="Passwort" maxlength="40" required>
                    <label for="password"></label>
                    <div class="bar"></div>
                </div>
                <div class="button-container">
                    <button type="submit" name="logmein"><span>Go</span></button>
                </div>
                <div class="cardfooter"><!--<a href="#">Passwort vergessen?</a>---></div>
            </form>
        </div>
    </div>
</div>
</body>
</html>



</body>
</html>