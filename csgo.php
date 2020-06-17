<?php
require_once "php/actions/session.php";
startSession();

include "db/PlayerListDAO.php";

$playerlist = new PlayerListDAO("sqlite:db/Database.db");

$csgoranks = ['Unranked', 'Silber', 'Gold', 'Master Guardian', 'Legendary Eagle', 'Supreme', 'Global'];
$csgoroles = ['Sniper', 'Stratege', 'Support', 'Awper', 'Entry Fragger'];

$rank =[];
if(isset($_POST['rank']))
    $rank = $_POST['rank'];

$role =[];
if(isset($_POST['role']))
    $role = $_POST['role'];

$_SESSION['ranks']= $rank;
$_SESSION['roles']= $role;

$list = $playerlist->getPlayersForGame("csgo", $rank, $role);

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team8 - CS:GO</title>
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
    <h1 class="title">CS:GO</h1>
    <div class="card-grid">
        <div class="filter">
            <h2>Filter</h2>
            <form action="csgo.php" method="post">
                <h3>Rang:</h3>
                <?php foreach($csgoranks as $rank): ?>
                    <label class="checkbox-container"><?php echo $rank?>
                        <input type="checkbox" name="rank[]" value='<?php echo $rank?>' <?php echo (in_array($rank,$_SESSION['ranks']))? 'checked' : ''?>  onchange="this.form.submit()">
                        <span class="checkmark"></span>
                    </label>
                    
                <?php endforeach; ?>
                <h3>Rolle:</h3>
                <?php foreach($csgoroles as $role): ?>
                    <label class="checkbox-container"><?php echo $role?>
                        <input type="checkbox" name="role[]" value='<?php echo $role?>' <?php echo (in_array($role, $_SESSION['roles']))? 'checked' : ''?> onchange="this.form.submit()">
                        <span class="checkmark"></span>
                    </label>
                <?php endforeach; ?> 
            </form>
        </div>
        <div class="overview">
            <?php if (isset($list) && count($list) > 0): ?>
                <ul class="cardview" id="csgo-players">
                    <?php foreach ($list as $playeritem):
                        $playerID = $playeritem->userid;
                        $playername = $playerlist->getPlayerByID($playerID);
                        $profileurl = 'playerprofile.php?id= ' . $playerID ;
                        ?>

                        <li class="card">
                            <a href='<?php echo $profileurl?>' class="container">
                                <div class="content">
                                    <h2><?php echo htmlspecialchars($playeritem->username) ?></h2>
                                    <ul>
                                        <li>Sprache:  <?php echo htmlspecialchars($playeritem->language) ?></li>
                                        <li>Role:  <?php echo implode(", ",$playerlist->getRoles("csgo",$playeritem->userid)) ?></li>
                                        <li>ELO: <?php echo htmlspecialchars($playerlist->getRank("csgo",$playeritem->userid)) ?>  </li>
                                    </ul>
                                </div>
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