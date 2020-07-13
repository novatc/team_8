<?php
require_once "php/actions/session.php";
updateSession();

if(isset($_COOKIE['deletionmessage'])){
    $errormessage = $_COOKIE['deletionmessage'];
}else{
    $errormessage = "";
}


?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team8 - Login</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/formular.css">

</head>
<body>
<header>
    <div class="mainnav">
        <?php include "php/header.php"; ?>
    </div>
</header>

<main>
    <form class="box" method="post" action="php/actions/delete_account_action.php">
        <h2 id='error-message'><?= $errormessage?></h2>
        <h1>Account löschen</h1>
        <p>Wenn Sie sich sicher sind, dass Sie Ihren Account löschen wollen geben Sie bitte Ihren Nutzernamen und Ihr Passwort ein.</p>
        <input class="login-input" type="text" name="username" placeholder="Benutzername" required>
        <input class="login-input" type="password" name="password" placeholder="Passwort" required>
        <input class="submit-btn" id="submit-form" type="submit" name="delete" value="Löschen">
        <div class="center">
            <a class="no-link" href='playerprofile.php'>Abbrechen</a>
        </div>
    </form>

    <script>
        var label = document.getElementById("error-message");
    </script>

</main>

<footer>
    <div class="footer">
        <?php include "php/footer.php"; ?>
    </div>
</footer>
</body>
</html>
