<?php
require_once "php/actions/session.php";
updateSession();

$isLoggedIn = $_SESSION['userid'] > -1;
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team8</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/start.css">
    <link rel="stylesheet" type="text/css" href="css/games.css">
</head>
<body>
<header>
    <div class="mainnav">
        <?php include "php/header.php"; ?>
    </div>
</header>

<main>
    <section id="grid">
        <?php if ($isLoggedIn): ?>
            <a href='playerprofile.php'  class="right">
                <img class="start-img" src="Resourcen/Logo/team8_logo01-orange_profil-text.svg">
            </a>
            <a href='gameoverview.php' class="left">
                <img class="start-img" src="Resourcen/Logo/team8_logo01-orange_spiele-text.svg">
            </a>
        <?php else: ?>
            <a href='login.php' class="right">
                <img class="start-img" src="Resourcen/Logo/team8_logo01-orange_login-text.svg">
            </a>
            <a href='registration.php' class="left">
                <img class="start-img" src="Resourcen/Logo/team8_logo01-orange_registrieren-text.svg">
            </a>
        <?php endif; ?>


    </section>
</main>
<footer>
    <div class="footer">
        <?php include "php/footer.php"; ?>
    </div>
</footer>

</body>
</html>
