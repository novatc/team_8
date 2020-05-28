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
    <div id="grid">
        <div class="filter"> 
            <form>
                <h2>Filter</h2>
                <ul>
                    <li>
                        <input type="radio" id="strategie" name="typ" value="strategie">
                        <label for="strategie">Strategie</label>
                    </li>
                    <li>
                        <input type="radio" id="fps" name="typ" value="fps">
                        <label for="FPS">FPS</label>
                    </li>
                </ul>
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
                        <div class="container" id="valorant" onclick="location.href='valorant.php'">
                            <label class="gamelabel">Valorant</label>
                        </div>
                    </li>
                </div>
                <div class="wrapper">
                    <li class="card">
                        <div class="container" id="rocketleague" onclick="location.href='rocketleague.php'">
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