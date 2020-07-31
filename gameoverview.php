<?php
require_once "php/actions/session.php";
updateSession();

require_once "db/game_dao.php";

$gameDAO = new GameDAO("sqlite:db/Database.db");

$filtertags = $gameDAO->getAllTags();


$tags = [];
if (isset($_POST['tags']))
    $tags = $_POST['tags'];

$_SESSION['tags'] = $tags;

$games = $gameDAO->getGames($tags);

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team8 - Spieleseite</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/cardgrid.css">
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
            <form action="gameoverview.php" method="post">
                <?php foreach ($filtertags as $tag): ?>
                    <label class="checkbox-container"><?php echo $tag ?>
                        <input type="checkbox" name="tags[]" value='<?php echo $tag ?>' <?php echo
                        (in_array($tag, $_SESSION['tags'])) ? 'checked' : '' ?>  onchange="this.form.submit()">
                        <span class="checkmark"></span>
                </label>
                <?php endforeach; ?>
            </form>
        </div>
        <div class="overview">
            <?php if (count($games) > 0): ?>
                <ul class="cardview">
                    <?php foreach ($games

                    as $game):
                    $gameID = $game->gameid;
                    $gamename = $game->gamename;
                    $gameurl = 'playeroverview.php?gameid=' . $gameID;
                    $style = "background-color: #" . $game->gamecolor;
                    ?>

                    <li class="wrapper">
                    <li class="card">
                        <a href='<?php echo $gameurl ?>' class="game-container" id="<?php echo "game" . $gameID ?>"
                           style="<?php echo $style ?>">
                            <span class="gamelabel"><?php echo $gamename ?></span>
                        </a>
                        <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Keine Spiele, die den Angaben entsprechen, gefunden.</p>
            <?php endif; ?>
        </div>
    </div>
</main>


<div class="footer">
    <?php include "php/footer.php"; ?>
</div>


</body>
</html>