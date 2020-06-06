<?php
session_start();
$validLogin = isset($_SESSION['user']);

if ($validLogin){
    $username = $_SESSION['user'];
    if(isset($_SESSION['age'])){
        $age = $_SESSION['age'];
    }else{
        $age = '';
    }
    if(isset($_SESSION['language'])){
        $language = $_SESSION['language'];
    }else{
        $language = '';
    }
    if(isset($_SESSION['description'])){
        $description = $_SESSION['description'];
    }else{
        $description = '';
    }
    if(isset($_SESSION['icon'])){
        $icon = $_SESSION['icon'];
    }
    else {
        $icon="avatarTeemo";
    }
    if(isset($_SESSION['games'])){
        $games = $_SESSION['games'];
    }else{
        $games = [];
    }     
    
} else{
    $username = '';
    $description = '';
    $language = '';
    $age = '';
    $games = [];
    $icon="";
}
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
                    <div class="icon" id= <?=htmlspecialchars($icon)?>></div>
                </div>
                <div class="name-wrapper">
                    <?php if ($validLogin): ?>
                        <p> Angemeldet als: <?= htmlspecialchars($username)?></p>
                        <h1><?= htmlspecialchars($username)?></h1>
                        <label><?= htmlspecialchars($description)?></label>
                    <?php endif; ?>
                </div>
                <div class="settings-wrapper">
                    <?php if ($validLogin): ?>    
                    <a id="settings-link" href="changeprofile.php"></a>
                    <a id="logout-link" href="php/logout.php"></a>
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
                    <label class="attribute">Alter: </label><label class="value"><?= htmlspecialchars($age)?></label>
                </div>
                <div>
                    <label class="attribute">Sprachen: </label><label class="value"><?= htmlspecialchars($language)?></label>
                </div>
            </div>
            <h2>Meine Spiele:</h2>
            <div class="game-wrapper"> 
                <ul class="cardview" >
                    <?php foreach(array_keys($games) as $game):?>
                        <?php if($game=='League of Legends'):?>
                            <div class="wrapper">
                                <li class="card">
                                    <div class="container" id="lol" onclick="showStats('lol', 'lol-stats')">
                                        <label class="gamelabel">League of Legends</label>
                                    </div>
                                </li>
                            </div>
                        <?php endif;?>
                        <?php if($game=='CSGO'):?>
                            <div class="wrapper">
                                <li class="card">
                                    <div class="container" id="csgo" onclick="showStats('csgo', 'csgo-stats')">
                                        <label class="gamelabel">CS:GO</label>
                                    </div>
                                </li>
                            </div>
                        <?php endif;?>
                        <?php if($game=='Rocket League'):?>
                            <div class="wrapper">
                                <li class="card">
                                    <div class="container" id="rocketleague" onclick="showStats('rocket', 'rocket-stats')">
                                        <label class="gamelabel">Rocket League</label>
                                    </div>
                                </li>
                            </div>
                        <?php endif;?>
                        <?php if($game=='Valorant'):?>
                            <div class="wrapper">
                                <li class="card">
                                    <div class="container" id="valorant" onclick="showStats('valorant', 'valorant-stats')">
                                        <label class="gamelabel">Valorant</label>
                                    </div>    
                                </li>
                            </div>
                        <?php endif;?>
                    <?php endforeach;?>
                </ul>
                        
                <div class="game-stats">
                <?php foreach(array_keys($games) as $game):?>
                    <?php if($game=='League of Legends'):?>
                        <div class=statswrapper id="lol-stats"> 
                            <h2 class="statslabel">League of Legends</h2>
                            <div>
                                <label class="attribute">ELO: </label><label class="value"><?php if(isset($games['League of Legends'])) echo htmlspecialchars($games['League of Legends']['rank'])?></label>
                            </div>
                            <div>
                                <label class="attribute">Position: </label><label class="value"><?php if(isset($games['League of Legends'])) echo htmlspecialchars($games['League of Legends']['positions'])?></label>
                            </div>
                        </div> 
                    <?php endif;?>
                    <?php if($game=='CSGO'):?>
                        <div class=statswrapper id="csgo-stats"> 
                            <h2 class="statslabel">CS:GO</h2>
                            <div>
                                <label class="attribute">ELO: </label><label class="value"><?php if(isset($games['CSGO'])) echo htmlspecialchars($games['CSGO']['rank'])?></label>
                            </div>
                            <div>
                                <label class="attribute">Position: </label><label class="value"><?php if(isset($games['CSGO'])) echo htmlspecialchars($games['CSGO']['positions'])?></label>
                            </div>
                        </div>
                    <?php endif;?>
                    <?php if($game=='Rocket League'):?>
                        <div class=statswrapper id="rocket-stats"> 
                            <h2 class="statslabel">Rocket League</h2>
                            <div>
                                <label class="attribute">ELO: </label><label class="value"><?php if(isset($games['Rocket League'])) echo htmlspecialchars($games['Rocket League']['rank'])?></label>
                            </div>
                            <div>
                                <label class="attribute">Position: </label><label class="value"><?php if(isset($games['Rocket League'])) echo htmlspecialchars($games['Rocket League']['positions'])?></label>
                            </div>
                        </div>
                    <?php endif;?>
                    <?php if($game=='Valorant'):?>
                        <div class=statswrapper id="valorant-stats"> 
                            <h2 class="statslabel">Valorant</h2>
                            <div>
                                <label class="attribute">ELO: </label><label class="value"><?php if(isset($games['Valorant'])) echo htmlspecialchars($games['Valorant']['rank'])?></label>
                            </div>
                            <div>
                                <label class="attribute">Position: </label><label class="value"><?php if(isset($games['Valorant'])) echo htmlspecialchars($games['Valorant']['positions'])?></label>
                            </div>
                        </div>
                    <?php endif;?>
                <?php endforeach;?>  
                </div>  
                <?php $game = array_keys($games);?>
                <?php if($game[0]=='League of Legends'):?>
                <script>showStats('lol', 'lol-stats')</script>
                <?php endif;?>
                <?php if($game[0]=='CSGO'):?>
                <script>showStats('csgo', 'csgo-stats')</script>
                <?php endif;?>
                <?php if($game[0]=='Rocket League'):?>
                <script>showStats('rocket', 'rocket-stats')</script>
                <?php endif;?>
                <?php if($game[0]=='Valorant'):?>
                <script>showStats('valorant', 'valorant-stats')</script>
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