<?php
require_once "php/actions/session.php";
startSession();

include "db/PlayerListDAO.php";

$playerlist = new PlayerListDAO("sqlite:db/Database.db");
$search = $_GET['search'];
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team8 - Results</title>
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
    <h1 class="title">Ergebnisse</h1>
    <div class="card-grid">
        
        <div class="overview">
            <?php $searchresult = $playerlist->getPlayerByName($search);?>
            <?php if (isset($searchresult) && $searchresult!=null):
                $playerID = $searchresult->userid;
                $profileurl = 'playerprofile.php?id= ' . $playerID ;?>

                <ul class="cardview" id="lol-players">
                    <li class="card">
                        <a href='<?php echo $profileurl?>' class="container">
                            <div class="content">
                                <h2><?php echo htmlspecialchars($searchresult->username) ?></h2>
                                <ul>
                                    <li>Sprache:  <?php echo htmlspecialchars($searchresult->language) ?></li>
                                    <li>Alter:  <?php echo htmlspecialchars($searchresult->age)?></li>

                                </ul>
                            </div>
                        </a>
                    </li>


                    <?php foreach ($searchresult as $user):

                        ?>


                    <?php endforeach; ?>
                </ul>
            <?php  else: ?>
                <p>keine Spieler gefunden</p>
            <?php endif; ?>
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