<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team8 - Rocket League</title>
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
    <h1 class="gamename">Rocket League</h1>
    <div id="grid">
        <div class="filter">
            <form>
                <h2>Filter</h2>
                <h3>Elo: </h3>
                <input type="radio" id="master" name="elo" value="master">
                <label for="master">Master</label><br>
                <input type="radio" id="dia" name="elo" value="dia">
                <label for="dia">Dia</label><br>
                <input type="radio" id="plat" name="elo" value="plat">
                <label for="plat">Plat</label><br>
                <input type="radio" id="gold" name="elo" value="gold">
                <label for="gold">Gold</label><br>
                <input type="radio" id="silber" name="elo" value="silber">
                <label for="silber">Silber</label><br>
                <input type="radio" id="bronze" name="elo" value="bronze">
                <label for="bronze">Bronze</label><br>

                <h3>Position: </h3>
                <input type="radio" id="top" name="position" value="top">
                <label for="master">Top</label><br>
                <input type="radio" id="jng" name="position" value="jng">
                <label for="master">jng</label><br>
                <input type="radio" id="mid" name="position" value="mid">
                <label for="master">mid</label><br>
                <input type="radio" id="bot" name="position" value="bot">
                <label for="master">bot</label><br>
                <input type="radio" id=sup name="position" value="sup">
                <label for="master">sup</label><br>
                <br>

                <input type="submit" value="Filtern">
            </form>
        </div>
        <div class="overview">
            <ul class="cardview" id="rocket-players">
                <li class="card">
                    <div class="container" id="payer1" onclick="location.href='playerprofil.php'">
                        <div class="content">
                            <h2>Spieler 1</h2>
                            <ul>
                                <li>Name:</li>
                                <li>Alter:</li>
                                <li>ELO:</li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="card">
                    <div class="container" id="payer2"  onclick="location.href='playerprofil.php'">
                        <div class="content">
                            <h2>Spieler 2</h2>
                            <ul>
                                <li>Name:</li>
                                <li>Alter:</li>
                                <li>ELO:</li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="card">
                    <div class="container" id="payer3" onclick="location.href='playerprofil.php'">
                        <div class="content">
                            <h2>Spieler 3</h2>
                            <ul>
                                <li>Name:</li>
                                <li>Alter:</li>
                                <li>ELO:</li>
                            </ul>
                        </div>  
                    </div>
                </li>
                <li class="card">
                    <div class="container" id="payer4" onclick="location.href='playerprofil.php'">
                        <div class="content">
                            <h2>Spieler 4</h2>
                            <ul>
                                <li>Name:</li>
                                <li>Alter:</li>
                                <li>ELO:</li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
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