<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "db/PlayerListDAO.php";

$playerlist = new PlayerListDAO("sqlite:db/Database.db");

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team8 - LOL</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/cardgrid.css">
    <link rel="stylesheet" type="text/css" href="css/playeroverview.css">
    <link rel="stylesheet" type="text/css" href="css/games.css">
</head>
<body>
<header>
    <div class="mainnav">
        <?php include "php/header.php"; ?>
    </div>
</header>
<main>
    <h1 class="title">League of Legends</h1>
    <div class="card-grid">
        <div class="filter">
            <h2>Filter</h2>
            <form>
                <h3>Elo:</h3>
                <label class="checkbox-container">Master
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Diamant
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Platin
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Gold
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Silber
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Bronze
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <h3>Position:</h3>
                <label class="checkbox-container">Top Lane
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Jungle
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Mid
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Bottom
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Support
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
            </form>
        </div>
        <div class="overview">
            <?php $list = $playerlist->getPlayersForGame("lol");?>
            <?php if (isset($list) && count($list) > 0) { ?>
                <ul class="cardview" id="lol-players">
                    <?php foreach ($list as $playeritem) { ?>
                        <li class="card">
                            <div class="container" id="payer1" onclick="location.href='playerprofile.php'">
                                <div class="content">
                                    <h2>Spieler 1</h2>
                                    <ul>
                                        <li>Name: <?php echo htmlspecialchars($playeritem->username) ?></li>
                                        <li>Alter:</li>
                                        <li>ELO:</li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            <?php } else { ?>
                <p>keine Spieler gefunden</p>
            <?php } ?>


        </div>
    </div>


</main>

<footer>
    <div class="footer">
        <?php include "php/footer.php"; ?>
    </div>
</footer>

</body>
</html>