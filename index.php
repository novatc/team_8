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
        <?php if ($isLoggedIn) { ?>
            <a href='gameoverview.php' class="rightloggedin">

            </a>
        <?php } else { ?>
            <a href='login.php' class="right">

            </a>
        <?php } ?>

        <?php if ($isLoggedIn) { ?>
            <a href='playerprofile.php'class="leftloggedin">

            </a>
        <?php } else { ?>

            <a href='registration.php' class="left">

            </a>
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
