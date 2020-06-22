<?php
require_once "php/actions/session.php";
startSession();

include "db/player_list_dao.php";
$playerlistDAO = new PlayerListDAO("sqlite:db/Database.db");

include "db/game_dao.php";
$gameDAO = new GameDAO("sqlite:db/Database.db");



// Filter
$rankfilter = [];
if(isset($_POST['rankfilter']))
    $rankfilter = $_POST['rankfilter'];

$rolefilter =[];
if(isset($_POST['rolefilter']))
    $rolefilter = $_POST['rolefilter'];

$_SESSION['ranks']= $rankfilter;
$_SESSION['roles']= $rolefilter;



if (isset($_GET['gameid']))
    $gameID = $_GET['gameid'];

$game = $gameDAO->getGameByID($gameID);
$gameranks = $gameDAO->getRanksFromGame($gameID);
$gameroles = $gameDAO->getRolesFromGame($gameID);

if($game != null){
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
    <title>Team8 - <?php echo $gamename?></title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/cardgrid.css">
    <link rel="stylesheet" type="text/css" href="css/playeroverview.css">
    <link rel="stylesheet" type="text/css" href="css/games.css">
    <link rel="stylesheet" type="text/css" href="css/colors.css">
</head>
<body>
<header>
    <div class="mainnav">
        <?php include "php/header.php"; ?>
    </div>
</header>
<main>
    <h1 class="title"> <?php echo $gamename?></h1>
    <div class="card-grid">
        <div class="filter">
            <h2>Filter</h2>
            <form method="post">
            <h3>Rang:</h3>
                <?php foreach($gameranks as $rank): ?>
                    <label class="checkbox-container"><?php echo $rank?>
                        <input type="checkbox" name="rankfilter[]" value='<?php echo $rank?>' <?php echo (in_array($rank,$_SESSION['ranks']))? 'checked' : ''?>  onchange="this.form.submit()">
                        <span class="checkmark"></span>
                    </label>
                    
                <?php endforeach; ?>
                <?php if(count($gameroles)>0): ?>
                    <h3>Charakter:</h3>
                    <?php foreach($gameroles as $role): ?>
                        <label class="checkbox-container"><?php echo $role?>
                            <input type="checkbox" name="rolefilter[]" value='<?php echo $role?>' <?php echo (in_array($role, $_SESSION['roles']))? 'checked' : ''?> onchange="this.form.submit()">
                            <span class="checkmark"></span>
                        </label>
                    <?php endforeach; ?> 
                <?php endif; ?>
            </form>
        </div>
        <div class="overview">
            <?php if (isset($list) && count($list) > 0): ?>
                <ul class="cardview" class="players">
                    <?php foreach ($list as $playeritem):
                        $playerID = $playeritem->userid;
                        $playername = $playerlistDAO->getPlayerByID($playerID);
                        $profileurl = 'playerprofile.php?id=' . $playerID ;
                        ?>

                        <li class="card">
                            <a href='<?php echo $profileurl?>' class="container" style="<?php echo $style?>">
                                
                                    <h2><?php echo htmlspecialchars($playeritem->username) ?></h2>
                                    <ul>
                                        <li>Sprache:  <?php echo htmlspecialchars($playeritem->language) ?></li>
                                        <li>Role:  <?php echo implode(", ",$playerlistDAO->getRoles($gameID, $playeritem->userid)) ?></li>
                                        <li>ELO: <?php echo htmlspecialchars($playerlistDAO->getRank($gameID, $playeritem->userid)) ?>  </li>
                                    </ul>
                                
                            </a>
                        </li>
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