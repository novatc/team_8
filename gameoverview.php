<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Team8 - Spieleseite</title>
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
    <div id="content">
        <div class="filter">
            <h2>Filter</h2>
            <form>
                <input type="radio" id="strategie" name="typ" value="strategie">
                <label for="strategie">Strategie</label>
                <input type="radio" id="fps" name="typ" value="fps">
                <label for="FPS">FPS</label>
            </form>
        </div>

        <div class="lol">
            LOL
        </div>

        <div class="valorant">
            Valorant
        </div>

        <div class="csgo">
            CSGO
        </div>

        <div class="rocketleague">
            <label class="fadein">RocketLeague</label>
        </div>
</main>


<footer>
    <div class="footer">
        <?php include "php/footer.php"; ?>
    </div>
</footer>


</body>
</html>