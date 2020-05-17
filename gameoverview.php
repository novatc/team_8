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
            <div class="fadein">
                <img src="Resourcen/500px-League_of_Legends_2019_vector.svg.png">
            </div>

        </div>

        <div class="valorant">
            <div class="fadein">
                <img src="Resourcen/2000px-Valorant_logo.svg.png">
            </div>
        </div>

        <div class="csgo">
            <div class="fadein">
                <img src="Resourcen/counter_strike.png">
            </div>
        </div>

        <div class="rocketleague">
            <div class="fadein"
                 <img src="Resourcen/call_of_duty.png">
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