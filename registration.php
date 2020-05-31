<?php
$isInputFasle = false;
$required = array('username', 'usermail', 'password', 'repeatpassword');
$error = false;

foreach ($required as $field) {
    if (empty($_POST[$field])) {
        $error = true;
    } else {
        $_SESSION['user'] = $_POST['username'];
        header('Location: playerprofile.php');
        exit();

    }
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
        <h1>Registrieren</h1>
        <input class="data-input" type="text" name="username" placeholder="Benutzername">
        <input class="data-input" type="email" name="usermail" placeholder="Mail">
        <input class="data-input" type="password" name="password" placeholder="Passwort">
        <input class="data-input" type="password" name="repeatpassword" placeholder="Passwort wiederholen">
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
