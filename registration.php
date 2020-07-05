<?php
require_once "php/actions/session.php";
updateSession();

if(isset($_SESSION['registrationerror'])){
    $errorcode = $_SESSION['registrationerror'];
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
    <form class="box" action='php/actions/registration_action.php' method="post">
        <h2 id='error-message'></h2>
        <h1>Registrieren</h1>
        <input class="login-input" type="text" name="username" placeholder="Benutzername" required>
        <input class="login-input" type="email" name="usermail" placeholder="Mail" required>
        <input class="login-input" type="password" name="password" placeholder="Passwort" required>
        <input class="login-input" type="password" name="passwordrepeat" placeholder="Passwort wiederholen" required>

        <label class="checkbox-container">Ich habe die <a href="terms_of_use.php">Nutzungsbedingungen</a> gelesen und akzeptiere diese.
            <input type="checkbox" name="acceptterms" value='terms'>
            <span class="checkmark"></span>
        </label>  
         
        <input class="submit-btn" id="submit-form" type="submit" name="registersubmit" value="Registrieren">
        
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
                label.innerHTML = "Nutzername bereits vergeben!";   
            </script>
            <?php break;
        case 3: ?>
            <script>
                var label = document.getElementById("error-message");
                label.innerHTML = "Passwörter stimmen nicht überein!";   
            </script>
            <?php break;
        case 4: ?>
            <script>
                var label = document.getElementById("error-message");
                label.innerHTML = "E-Mail Adresse ungültig!";   
            </script>
            <?php break;
        case 5: ?>
            <script>
                var label = document.getElementById("error-message");
                label.innerHTML = "Huch etwas ist schief gelaufen. Bitte versuchen Sie es erneut!";   
            </script>
            <?php break;
        case 6: ?>
            <script>
                var label = document.getElementById("error-message");
                label.innerHTML = "Bitte akzeptieren Sie die Nutzungsbedingungen!";   
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

