<?php
require_once "php/actions/session.php";
startSession();

if(isset($_SESSION['loginerror'])){
    $errorcode = $_SESSION['loginerror'];
}else{
    $errorcode = 0;
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


    <form class="box" method="post" action="php/actions/login_action.php">
        <h2 id='error-message'></h2>
        <h1>Login</h1>
        <input class="login-input" type="text" name="username" placeholder="Benutzername" required>
        <input class="login-input" type="password" name="password" placeholder="Passwort" required>
        <input class="submit-btn" id="submit-form" type="submit" name="loginsubmit" value="Login">
        <h3 onclick="location.href='registration.php'">Noch kein Account?</h3>
    </form>

    <script>
        var label = document.getElementById("error-message");
    </script>

    <?php 
    switch ($errorcode){
        case 0: ?>
            <script>
                var label = document.getElementById("error-message");
                label.innerHTML = "";   
            </script>
            <?php break;
            
        case 1: ?>
            <script>
                var label = document.getElementById("error-message");
                label.innerHTML = "Bitte alle Felder ausfüllen!";   
            </script>
            <?php break;
        case 2: ?>
            <script>
                var label = document.getElementById("error-message");
                label.innerHTML = "Nutzer existiert nicht!";   
            </script>
            <?php break;
        case 3: ?>
            <script>
                var label = document.getElementById("error-message");
                label.innerHTML = "Das Passwort ist falsch!";   
            </script>
            <?php break;
        case 4: ?>
            <script>
                var label = document.getElementById("error-message");
                label.innerHTML = "Huch etwas ist schief gelaufen. Bitte versuchen Sie es erneut!";   
            </script>
            <?php break;
        }
?>
</main>

<footer>
    <div class="footer">
        <?php include "php/footer.php"; ?>
    </div>
</footer>
</body>
</html>
