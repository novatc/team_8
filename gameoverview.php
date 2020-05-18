<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Team8 - Spieleseite</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/grid.css">
    <link rel="stylesheet" type="text/css" href="css/gameoverview.css">
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
            <h2>Filter</h2>
            <form>
                <input type="radio" id="strategie" name="typ" value="strategie">
                <label for="strategie">Strategie</label>
                <input type="radio" id="fps" name="typ" value="fps">
                <label for="FPS">FPS</label>
            </form>
        </div>
        <div class="content">
            <ul class="cards" >
                <li class="card">
                    <div class="lol" onclick="location.href='lol.php'"></div>
                </li>
                <li class="card">
                    <div class="valorant" onclick="location.href='valorant.php'"></div>
                </li>
                <li class="card">
                    <div class="csgo" onclick="location.href='csgo.php'"></div>
                </li>
                <li class="card">
                    <div class="rocketleague" onclick="location.href='rocketleague.php'"></div>
                </li>
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