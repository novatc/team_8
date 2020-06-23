<?php
require_once "php/actions/session.php";
startSession();

$isLoggedIn = $_SESSION['userid']> -1;

include "db/player_list_dao.php";
$listDAO = new PlayerListDAO("sqlite:db/Database.db");

include "db/game_dao.php";
$gameDAO = new GameDAO("sqlite:db/Database.db");

include "db/user_dao.php";
$userDAO = new UserDAO("sqlite:db/Database.db");


if (isset($_GET['id']))
    $profileID = $_GET['id'];
else
    $profileID = $_SESSION['userid'];

$user = $userDAO->getUserByID($profileID);
$usergames = $listDAO->getGamesFromPlayer($profileID);
$allgames = $gameDAO->getGames([]);

$noData = ($user==null);
if(!$noData){
    $username = $user->username;
    $description = $user->description;
    $age = $user->age;
    if($age!=null){
        // Berechne Alter
        $date = new DateTime($age);
        $now = new DateTime();
        $age_in_years = $now->diff($date)->y;
    }else{
        $age_in_years ='';
    }
    

    $language = $user->language;
    $usericon = $user->icon;
    
    if($profileID == $_SESSION['userid'])
        $ownprofile = true;
    else
        $ownprofile = false;
    
}

$_SESSION['addfriend'] = $user;

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team8 - Profil</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <link rel="stylesheet" type="text/css" href="css/games.css">
    <link rel="stylesheet" type="text/css" href="css/icons.css">
</head>
<body>
    <script>
        function showStats(btnID, statID){   
            var stats = document.getElementsByClassName("statswrapper");
            for (var i = 0; i < stats.length; i++) {
                if(stats[i].id === statID){
                    stats[i].style.display = "block";
                }else{
                    stats[i].style.display = "none";
                }      
            }       
            var btn = document.getElementsByClassName("container");
            for (var i = 0; i < btn.length; i++) {
                if(btn[i].id === btnID){
                    btn[i].style.transform = "scale(1.1)";
                }else{
                    btn[i].style.transform = "scale(0.9)";
                }        
            }          
        }
        
        function deactivate(id){ 
            var btn = document.getElementsByClassName("container");
            for (var i = 0; i < btn.length; i++) {
                if(btn[i].id === id){
                    btn[i].style.opacity = "0.5";
                }       
            }                 
        } 
    </script>

    <header>
        <div class="mainnav">
            <?php include "php/header.php";?>
        </div>
    </header>
    <main>
        <?php if ($noData): ?>
            <div class=error-wrapper>
                <p id='error-label'>Hier gibt es nichts zusehen</p>
            </div>
            
        <?php else: ?>
        <div class="profile-grid">
            <div class="profil-header">
                <div class="picture-wrapper">
                    <div class="icon" id= <?=$usericon?>></div>
                </div>
                <div class="name-wrapper">
                    <?php if ($ownprofile): ?>
                    <p> Angemeldet als: <?= $username?></p>
                    <?php endif; ?>
                    <h1><?= $username?></h1>
                    <label><?= $description?></label>
                    
                </div>
                <div class="options-wrapper">
                    <?php if ($ownprofile): ?>    
                    <a id="settings-link" href="change_profile.php"></a>
                    <a id="logout-link" href="php/actions/logout_action.php"></a>
                    <?php else:?>
                    <form action="php/actions/start_chat_action.php" method="post">
                        <input type="submit" id="message-link" name="friend" value=<?= htmlspecialchars($username) ?>>
                    </form>
                    <a id="friend-link" href="php/actions/add_friend_action.php"></a>
                    <?php endif; ?>
                </div>
            </div>
         
            <div class="profil-body">
            <h2>Beschreibung:</h2>
            <div class="description">
                <div>
                    <label class="attribute">Alter: </label><label class="value"><?= $age_in_years?></label>
                </div>
                <div>
                    <label class="attribute">Sprachen: </label><label class="value"><?= $language?></label>
                </div>
            </div>
            <h2>Meine Spiele:</h2>
            <div class="game-wrapper"> 
                <ul class="cardview" >
                    <?php foreach($usergames as $usergame):?>
                            <?php foreach($allgames as $game):?>
                                <?php if($usergame==$game->gameid):?>
                                    <?php $style = "background-color: #" . $game->gamecolor ?>
                                    <div class="wrapper">
                                        <li class="card">
                                            <div class="game-container" id="<?php echo "game". $game->gameid ?>" style="<?php echo $style?>" onclick="showStats('<?php echo "game" . $game->gameid ?>', '<?php echo "stats". $game->gameid?>')">
                                                <label class="gamelabel"><?php echo $game->gamename ?></label>
                                            </div>
                                        </li>
                                    </div>
                                    <?php if($listDAO->getStatus($game->gameid,$profileID)!='active'):?><script>deactivate('<?php echo "game" . $game->gameid ?>')</script><?php endif;?>
                                <?php endif;?>
                            <?php endforeach;?>
                        <?php endforeach;?>
                </ul>              
                <div class="game-stats">
                    <?php foreach($usergames as $usergame):?>
                        <?php foreach($allgames as $game):?>
                            <?php if($usergame==$game->gameid):?>
                                <div class=statswrapper id="<?php echo "stats" . $game->gameid ?>"> 
                                <h2 class="statslabel"><?php echo $game->gamename ?></h2>
                                    <div>
                                        <label class="attribute">ELO: </label><label class="value"><?php echo $listDAO->getRank($game->gameid, $profileID)?></label>
                                    </div>
                                    <?php if(count($listDAO->getRoles($game->gameid, $profileID))>0):?>
                                        <div>
                                            <label class="attribute">Positionen: </label><label class="value"><?php echo implode(", ", $listDAO->getRoles($game->gameid, $profileID))?></label>
                                        </div>
                                    <?php endif; ?>
                                </div> 
                            <?php endif; ?>
                        <?php endforeach;?>
                    <?php endforeach;?>
                </div> 
                <?php if(count($usergames)>0): ?>
                    <script>showStats('<?php echo "game" . $usergames[0]?>', '<?php echo "stats" . $usergames[0] ?>')</script>  
                <?php endif;?>
            </div>            
        </div>
        <?php endif; ?>
    </main>
  
    <footer>
            <div class="footer">
                <?php include "php/footer.php";?>
            </div>
    </footer>
</body>
</html>