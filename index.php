<?php
include "php/actions/session.php";
startSession();

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

            </div>
        <?php } else { ?>
            <div class="right" onclick="location.href='login.php'">

            </div>
        <?php } ?>

        <?php if ($isLoggedIn) { ?>
            <div class="leftloggedin" onclick="location.href='playerprofile.php'">

            </div>
        <?php } else { ?>

            <div class="left" onclick="location.href='registration.php'">

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
