<?php
require_once "php/actions/session.php";
updateSession();

require_once "db/player_list_dao.php";
$playerlistDAO = new PlayerListDAO("sqlite:db/Database.db");

require_once "db/user_dao.php";
$userListDAO = new UserDAO("sqlite:db/Database.db");


require_once "db/game_dao.php";
$gameDAO = new GameDAO("sqlite:db/Database.db");


// Filter
$rankfilter = [];
if (isset($_POST['rankfilter']))
    $rankfilter = $_POST['rankfilter'];

$rolefilter = [];
if (isset($_POST['rolefilter']))
    $rolefilter = $_POST['rolefilter'];

$_SESSION['ranks'] = $rankfilter;
$_SESSION['roles'] = $rolefilter;


if (isset($_GET['gameid']))
    $gameID = $_GET['gameid'];

$game = $gameDAO->getGameByID($gameID);
$gameranks = $gameDAO->getRanksFromGame($gameID);
$gameroles = $gameDAO->getRolesFromGame($gameID);

if ($game != null) {
    $gamename = $game->gamename;
    $color = $game->gamecolor;
}


$style = "border: solid #" . $color . " 2.5px";
$list = $playerlistDAO->getPlayersForGame($gameID, $rankfilter, $rolefilter);

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team8 - <?php echo $gamename ?></title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/cardgrid.css">
    <link rel="stylesheet" type="text/css" href="css/colors.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

</head>
<body>
<header>
    <div class="mainnav">
        <?php include "php/header.php"; ?>
    </div>
</header>
<main>
    <h1 class="title"> <?php echo $gamename ?></h1>
    <input type="hidden" id="gameid" value="<?=$gameID?>">
    <div class="card-grid">
        <div class="filter">
            <h2>Filter</h2>
            <form method="post">
                <h3>Rang:</h3>
                <?php foreach ($gameranks as $rank): ?>
                    <label class="checkbox-container"><?php echo $rank ?>
                        <input type="checkbox" name="rankfilter[]"
                               value='<?php echo $rank ?>' <?php echo (in_array($rank, $_SESSION['ranks'])) ? 'checked' : '' ?>
                               onchange="this.form.submit()">
                        <span class="checkmark"></span>
                    </label>

                <?php endforeach; ?>
                <?php if (count($gameroles) > 0): ?>
                    <h3>Charakter:</h3>
                    <?php foreach ($gameroles as $role): ?>
                        <label class="checkbox-container"><?php echo $role ?>
                            <input type="checkbox" name="rolefilter[]"
                                   value='<?php echo $role ?>' <?php echo (in_array($role, $_SESSION['roles'])) ? 'checked' : '' ?>
                                   onchange="this.form.submit()">
                            <span class="checkmark"></span>
                        </label>
                    <?php endforeach; ?>
                <?php endif; ?>
            </form>
        </div>
        <div class="overview">
            <?php if (isset($list) && count($list) > 0): ?>
                <ul class="cardview">

                </ul>
            <?php else: ?>
                <p>keine Spieler gefunden</p>
            <?php endif; ?>
        </div>
    </div>


</main>
<script>
    var start = 0;
    var limit = 15;
    var reachedMax = false;

    $(window).scroll(function () {
        if ((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight) {
            getData()
        }

    })

    $(document).ready(function () {
        getData()
    });

    function getData() {
        if (reachedMax) return

        var gameid = document.getElementById("gameid").value;

        $.ajax({
            url: 'php/actions/load_players.php',
            method: 'POST',
            data: {
                getData: 1,
                start: start,
                limit: limit,
                game: gameid,
            },
            success: function (response) {
                if (response === 'reachedMax') {
                    reachedMax = true
                } else {
                    start += limit
                    $(".cardview").append(response)
                }
            }
        })
    }
</script>
<div class="footer">
    <?php include "php/footer.php"; ?>
</div>

</body>
</html>