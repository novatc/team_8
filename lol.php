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
    <h1 class="gamename">League of Legends</h1>
    <div id="grid">
        <div class="filter">
            <h1>Filter</h1>
            <form>
                <h2>Elo:</h2>
                <label class="filtercontainer">Master
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label class="filtercontainer">Diamant
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label class="filtercontainer">Platin
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label class="filtercontainer">Gold
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label class="filtercontainer">Silber
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label class="filtercontainer">Bronze
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <h2>Position:</h2>
                <label class="filtercontainer">Top Lane
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label class="filtercontainer">Jungle
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label class="filtercontainer">Mid
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label class="filtercontainer">Bottom
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <label class="filtercontainer">Support
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
            </form>
        </div>
        <div class="overview">
            <ul class="cardview" id="lol-players">
                <li class="card">
                    <div class="container" id="payer1" onclick="location.href='playerprofile.php'">
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
                    <div class="container" id="payer2"  onclick="location.href='playerprofile.php'">
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
                    <div class="container" id="payer3" onclick="location.href='playerprofile.php'">
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
                    <div class="container" id="payer4" onclick="location.href='playerprofile.php'">
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