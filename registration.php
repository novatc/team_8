<?php
require_once "php/actions/session.php";
updateSession();

if(isset($_COOKIE['registrationmessage'])){
    $message = $_COOKIE['registrationmessage'];
}else{
    $message = "";
}

if(isset($_SESSION['user'])){
    $username = $_SESSION['user'];
}else{
    $username = "";
}

if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];
}else{
    $email = "";
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
        <h2 id='error-message'><?=$message?></h2>
        <h1>Registrieren</h1>
        <input class="login-input" type="text" name="username" placeholder="Benutzername" value= "<?=$username?>" required>
        <input class="login-input" type="email" name="usermail" placeholder="Mail" value= "<?=$email?>" required>
        <input class="login-input" type="password" name="password" placeholder="Passwort" required>
        <input class="login-input" type="password" name="passwordrepeat" placeholder="Passwort wiederholen" required>

        <label class="checkbox-container">Ich habe die <a href="terms_of_use.php">Nutzungsbedingungen</a> und <a href="data_protection.php">Datenschutzbestimmungen</a> gelesen und akzeptiere diese.
            <input type="checkbox" name="acceptterms" value='terms'>
            <span class="checkmark"></span>
        </label>  
         
        <input class="submit-btn" id="submit-form" type="submit" name="registersubmit" value="Registrieren">
        
    </form>
</main>
<footer>
    <div class="footer">
        <?php include "php/footer.php"; ?>
    </div>
</footer>
</body>
</html>

