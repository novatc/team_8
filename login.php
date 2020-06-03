<?php
session_start();

$isInputFalse = false;
$required = array('username', 'password');
$error = false;
$_SESSION['isLoggedIn'] = false;

foreach ($required as $field){
    if (empty($_POST[$field])){
        $error = true;
        $isInputFalse = true;
    }
}
if ($error==false) {
    $_SESSION['user'] = $_POST['username'];
    header('Location: playerprofile.php');
    $_SESSION['isLoggedIn'] = true;
    exit();
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


    <form class="box" method="post">
        <h1>Anmelden</h1>
        <input class="login-input" type="text" name="username" placeholder="Benutzername" required>
        <input class="login-input" type="password" name="password" placeholder="Passwort" required>
        <input class="submit-btn" id="submit-form" type="submit" name="loginsubmit" value="Anmelden">
        <h3 onclick="location.href='registration.php'">Noch kein Account?</h3>
    </form>
</main>

<footer>
    <div class="footer">
        <?php include "php/footer.php"; ?>
    </div>
</footer>
</body>
</html>
