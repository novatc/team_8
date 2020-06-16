<?php
require_once "php/actions/session.php";
startSession();

$isLoggedIn = $_SESSION['userid']> -1;

include "db/PlayerListDAO.php";
$listDAO = new PlayerListDAO("sqlite:db/Database.db");

include "db/GameDAO.php";
$gameDAO = new GameDAO("sqlite:db/Database.db");

include "db/UserDAO.php";
$userDAO = new UserDAO("sqlite:db/Database.db");

$userID = $_SESSION['userid'];
$user = $userDAO->getUserByID($userID);
$username = $user->username;
$description = $user->description;
$age = $user->age;
$language = $user->language;
$usericon = $user->icon;

$games = $listDAO->getGamesFromPlayer($userID);


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
        <div class="profile-grid">
            <div class="profil-header">
                <div class="picture-wrapper">
                    <div class="icon" id= <?=$usericon?>></div>
                </div>
                <div class="name-wrapper">
                    <?php if ($isLoggedIn): ?>
                        <p> Angemeldet als: <?= $username?></p>
                        <h1><?= $username?></h1>
                        <label><?= $description?></label>
                    <?php endif; ?>
                </div>
                <div class="settings-wrapper">
                    <?php if ($isLoggedIn): ?>    
                    <a id="settings-link" href="changeprofile.php"></a>
                    <a id="logout-link" href="php/actions/logoutaction.php"></a>
                    <?php endif; ?>
                </div>
                <div class="message-wrapper">
                    <button class="message">Nachricht schreiben</button>
                </div>
            </div>
         
            <div class="profil-body">
            <h2>Beschreibung:</h2>
            <div class="description">
                <div>
                    <label class="attribute">Alter: </label><label class="value"><?= $age?></label>
                </div>
                <div>
                    <label class="attribute">Sprachen: </label><label class="value"><?= $language?></label>
                </div>
            </div>
            <h2>Meine Spiele:</h2>
            <div class="game-wrapper"> 
                <ul class="cardview" >
                    <?php foreach($games as $game):?>
                        <?php if($game=='lol'):?>
                            <div class="wrapper">
                                <li class="card">
                                    <div class="container" id="lol" onclick="showStats('lol', 'lol-stats')">
                                        <label class="gamelabel">League of Legends</label>
                                    </div>
                                </li>
                            </div>
                            <?php if($listDAO->getStatus($game,$userID)!='active'):?><script>deactivate('lol')</script><?php endif;?>
                        <?php endif;?>
                        <?php if($game=='csgo'):?>
                            <div class="wrapper">
                                <li class="card">
                                    <div class="container" id="csgo" onclick="showStats('csgo', 'csgo-stats')">
                                        <label class="gamelabel">CS:GO</label>
                                    </div>
                                </li>
                            </div>
                            <?php if($listDAO->getStatus($game,$userID)!='active'):?><script>deactivate('csgo')</script><?php endif;?>
                        <?php endif;?>
                        <?php if($game=='rl'):?>
                            <div class="wrapper">
                                <li class="card">
                                    <div class="container" id="rl" onclick="showStats('rl', 'rl-stats')">
                                        <label class="gamelabel">Rocket League</label>
                                    </div>
                                </li>
                            </div>
                            <?php if($listDAO->getStatus($game,$userID)!='active'):?><script>deactivate('rl')</script><?php endif;?>
                        <?php endif;?>
                        <?php if($game=='val'):?>
                            <div class="wrapper">
                                <li class="card">
                                    <div class="container" id="val" onclick="showStats('val', 'val-stats')">
                                        <label class="gamelabel">Valorant</label>
                                    </div>    
                                </li>
                            </div>
                            <?php if($listDAO->getStatus($game,$userID)!='active'):?><script>deactivate('val')</script><?php endif;?>
                        <?php endif;?>
                    <?php endforeach;?>
                </ul>
                        
                <div class="game-stats">
                
                <?php foreach($games as $game):?>
                    <?php if($game=='lol'):?>
                        <div class=statswrapper id="lol-stats"> 
                            <h2 class="statslabel">League of Legends</h2>
                            <div>
                                <label class="attribute">ELO: </label><label class="value"><?php echo $listDAO->getRank($game, $userID)?></label>
                            </div>
                            <?php if(count($listDAO->getRoles($game, $userID))>0):?>
                                <div>
                                    <label class="attribute">Positionen: </label><label class="value"><?php echo implode(", ", $listDAO->getRoles($game, $userID))?></label>
                                </div>
                            <?php endif; ?>
                        </div> 
                    <?php endif;?>
                    <?php if($game=='csgo'):?>
                        <div class=statswrapper id="csgo-stats"> 
                            <h2 class="statslabel">CS:GO</h2>
                            <div>
                                <label class="attribute">ELO: </label><label class="value"><?php echo $listDAO->getRank($game, $userID)?></label>
                            </div>
                            <?php if(count($listDAO->getRoles($game, $userID))>0):?>
                                <div>
                                    <label class="attribute">Rollen: </label><label class="value"><?php echo implode(", ", $listDAO->getRoles($game, $userID))?></label>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif;?>
                    <?php if($game=='rl'):?>
                        <div class=statswrapper id="rl-stats"> 
                            <h2 class="statslabel">Rocket League</h2>
                            <div>
                                <label class="attribute">ELO: </label><label class="value"><?php echo $listDAO->getRank($game, $userID)?></label>
                            </div>
                            <?php if(count($listDAO->getRoles($game, $userID))>0):?>
                                <div>
                                    <label class="attribute">Position: </label><label class="value"><?php echo implode(", ", $listDAO->getRoles($game, $userID))?></label>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif;?>
                    <?php if($game=='val'):?>
                        <div class=statswrapper id="val-stats"> 
                            <h2 class="statslabel">Valorant</h2>
                            <div>
                                <label class="attribute">ELO: </label><label class="value"><?php echo $listDAO->getRank($game, $userID)?></label>
                            </div>
                            <?php if(count($listDAO->getRoles($game, $userID))>0):?>
                                <div>
                                    <label class="attribute">Position: </label><label class="value"><?php echo implode(", ", $listDAO->getRoles($game, $userID))?></label>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach;?>  
                </div> 
                <?php if(count($games)>0): ?>
                    <?php if($games[0]=='lol'):?>
                    <script>showStats('lol', 'lol-stats')</script>
                    <?php endif;?>
                    <?php if($games[0]=='csgo'):?>
                    <script>showStats('csgo', 'csgo-stats')</script>
                    <?php endif;?>
                    <?php if($games[0]=='rl'):?>
                    <script>showStats('rl', 'rl-stats')</script>
                    <?php endif;?>
                    <?php if($games[0]=='val'):?>
                    <script>showStats('val', 'val-stats')</script>
                    <?php endif;?> 
                <?php endif;?>
    
            </div>            
        </div>
    </main>
  
    <footer>
            <div class="footer">
                <?php include "php/footer.php";?>
            </div>
    </footer>
</body>
</html>