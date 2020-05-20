<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Team8 - LOL</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/cardgrid.css">
    <link rel="stylesheet" type="text/css" href="css/playeroverview.css">
</head>
<body>
<header>
    <div class="mainnav">
        <?php include "php/header.php"; ?>
    </div>
</header>
<main>
    <h1>League of Legends</h1>
    <div id="grid">
        <div class="filter">          
            <form>
                <h2>Filter</h2>
                <h3>Elo: </h3>
                <ul>
                    <li><input type="radio" id="master" name="elo" value="master">
                <label for="master">Master</label></li>
                    <li><input type="radio" id="dia" name="elo" value="dia">
                <label for="dia">Dia</label></li>
                    <li> <input type="radio" id="plat" name="elo" value="plat">
                <label for="plat">Plat</label></li>
                    <li><input type="radio" id="gold" name="elo" value="gold">
                <label for="gold">Gold</label></li>
                    <li><input type="radio" id="silber" name="elo" value="silber">
                <label for="silber">Silber</label></li>
                    <li><input type="radio" id="bronze" name="elo" value="bronze">
                <label for="bronze">Bronze</label></li>
                </ul>
                <h3>Position: </h3>
                <ul>
                    <li><input type="radio" id="top" name="position" value="top">
                <label for="master">Top</label></li>
                    <li><input type="radio" id="jng" name="position" value="jng">
                <label for="master">jng</label></li>
                    <li><input type="radio" id="mid" name="position" value="mid">
                <label for="master">mid</label></li>
                    <li><input type="radio" id="bot" name="position" value="bot">
                <label for="master">bot</label></li>
                    <li><input type="radio" id=sup name="position" value="sup">
                <label for="master">sup</label></li>
                </ul>
                <input type="submit" value="Filtern">
            </form>
        </div>
        <div class="overview">
            <ul class="cardview">
                <li class="card">
                    <div class="container" id="payer1" onclick="location.href='playerprofil.php'">
                        <div class="content">
                            <label>Spieler 3</label>
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
                            <label>Spieler 2</label>
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
                            <label>Spieler 3</label>
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
                            <label>Spieler 4</label>
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