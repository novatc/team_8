<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team8 - Spieleseite</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/cardgrid.css">
    <link rel="stylesheet" type="text/css" href="css/games.css">


</head>
<body>

<header>
    <div class="mainnav">
        <?php include "php/header.php"; ?>
    </div>
</header>
<main>
    <h1 class="title">Spieleübersicht</h1> 
    <div class="card-grid">
        <div class="filter">
            <h2>Filter</h2>
            <form>
                <label class="checkbox-container">Shooter
                    <input type="checkbox" checked="checked">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Teamplay
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Strategie
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Arenakampf
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>

            </form>
        </div>
        <div class="overview">
            <ul class="cardview" >
                <div class="wrapper">
                    <li class="card">
                        <div class="container" id="lol" onclick="location.href='lol.php'">
                            <label class="gamelabel">League of Legends</label>
                        </div>
                    </li>
                </div>
                <div class="wrapper">
                    <li class="card">
                        <div class="container" id="val" onclick="location.href='valorant.php'">
                            <label class="gamelabel">Valorant</label>
                        </div>
                    </li>
                </div>
                <div class="wrapper">
                    <li class="card">
                        <div class="container" id="rl" onclick="location.href='rocketleague.php'">
                            <label class="gamelabel">Rocket League</label>
                        </div>
                    </li>
                </div>
                <div class="wrapper">
                    <li class="card">
                        <div class="container" id="csgo" onclick="location.href='csgo.php'">
                            <label class="gamelabel">CS:GO</label>
                        </div>
                    </li>
                </div>
            </ul>
        </div>
</main>


<footer>
    <div class="footer">
        <?php include "php/footer.php"; ?>
    </div>
</footer>


</body>
</html>