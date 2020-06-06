<?php
session_start();
$isLoggedIn = $_SESSION['isLoggedIn']
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
        <?php if ($isLoggedIn) { ?>
            <div class="rightloggedin" onclick="location.href='gameoverview.php'">
                <h1>Spiele</h1>
                <p><b>Finde neue Freunde und Spielpartner zu deinen Spielen!</p>
            </div>
        <?php } else { ?>
            <div class="right" onclick="location.href='login.php'">
                <h1>Login</h1>
                <p><b>Log dich ein um mit deinen Freunden in Kontakt zu bleiben und neue Freundschaften zu knüpfen</p>
            </div>
        <?php } ?>

        <?php if ($isLoggedIn) { ?>
            <div class="leftloggedin" onclick="location.href='playerprofile.php'">
                <h1>Mein Profil</h1>
                <p><b>Geh auf dein Profil und sieh dir neue Nachrichten an und Bearbeite dein Profil!</p>
            </div>
        <?php } else { ?>

            <div class="left" onclick="location.href='registration.php'">
                <h1><b>Registrieren</h1>
                <p><b>Melde dich jetzt bei Team8 an  um neue Freunde für deine Spiele zu finden!</p>
            </div>
        <?php } ?>


    </section>
</main>
<footer>
    <div class="footer">
        <?php include "php/footer.php"; ?>
    </div>
</footer>

</body>
</html>
