<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Team8 - LOL</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/grid.css">
</head>
<body>
<header>
    <div class="mainnav">
        <?php include "php/header.php"; ?>
    </div>
</header>
<main>
    <h1>League of Legends</h1>
    <div id="content">
        <div class="filter">
            <h2>Filter</h2>
            <form>
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

                <h2>Position: </h2>

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
        <div class="main">
            <ul class="game-cards">
                <li class="playercard">
                    <label>Spieler 1 </label>

                    <div class="profilcard">
                        <ul>
                            <li>Name:</li>
                            <li>Alter:</li>
                            <li>ELO:</li>
                        </ul>
                    </div>
                </li>
                <li class="playercard">
                    <label>Spieler 2 </label>

                    <div class="profilcard">
                        <ul>
                            <li>Name:</li>
                            <li>Alter:</li>
                            <li>ELO:</li>
                        </ul>
                    </div>
                </li>
                <li class="playercard">
                    <label>Spieler 3</label>

                    <div class="profilcard">
                        <ul>
                            <li>Name:</li>
                            <li>Alter:</li>
                            <li>ELO:</li>
                        </ul>
                    </div>
                </li>
                <li class="playercard">
                    <label>Spieler 4 </label>

                    <div class="profilcard">
                        <ul>
                            <li>Name:</li>
                            <li>Alter:</li>
                            <li>ELO:</li>
                        </ul>
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