<?php
include "php/actions/session.php";
startSession();

include "db/PlayerListDAO.php";
$listDAO = new PlayerListDAO("sqlite:db/Database.db");

include "db/GameDAO.php";
$gameDAO = new GameDAO("sqlite:db/Database.db");

include "db/UserDAO.php";
$userDAO = new UserDAO("sqlite:db/Database.db");

$userID = $_SESSION['userid'];
$user = $userDAO->getUserByID($userID);
$description = $user->description;
$age = $user->age;
$language = $user->language;

$games = $listDAO->getGamesFromPlayer($userID);

if(isset($_SESSION['gamechoice'])){
    $gamechoice = $_SESSION['gamechoice'];
}else{
    $gamechoice = '';
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team8 - Profil bearbeiten</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/formular.css">
    <link rel="stylesheet" type="text/css" href="css/icons.css">
</head>
<body>
    
    <header>
        <div class="mainnav">
            <?php include "php/header.php";?>
        </div>
    </header>
    <main>
        <form class="box" action="php/actions/changeProfileAction.php" method="post">
            <h1>Profil anpassen</h1>
            <div class="input-wrapper">
                <textarea name="description" class="textarea-input" cols="30" rows="10"><?= $description?></textarea>
                <label class="top-label">Beschreibung</label>
            </div> 
            <div class="input-wrapper">
                <input class="data-input" type="number" name="age" value= "<?= $age?>">
                <label class="left-label">Alter</label>
            </div>
            <div class="input-wrapper">
                <input class="data-input" type="text" name="language" value= "<?= $language?>">
                <label class="left-label">Sprachen</label>
            </div>
        
            <input class="submit-btn"  type="submit" name="changesubmit" value="Speichern">
        </form>
        <div class="box"> 
            <form  action="php/actions/choosegameaction.php" method="post">
                <h1>Spiele verwalten</h1>  
                <div class="input-wrapper">
                    <select class="selectbox" name="game" onchange="this.form.submit()" required>
                        <optgroup label="Meine Spiele">
                        <?php foreach($games as $game):?>
                            <?php if($game=='csgo'):?>
                                <option value='CS:GO'>CS:GO</option>
                            <?php endif;?>
                            <?php if($game=='lol'):?>
                                <option value='League of Legends'>League of Legends</option>
                            <?php endif;?>
                            <?php if($game=='rl'):?>
                                <option value='Rocket League'>Rocket League</option>
                            <?php endif;?>
                            <?php if($game=='val'):?>
                                <option value='Valorant'>Valorant</option>
                            <?php endif;?>
                        <?php endforeach;?>
                        </optgroup>
                        <optgroup label="Weitere Spiele hinzufügen">
                            <?php if(!in_array('csgo', $games)):?>
                                <option value='csgo'>CS:GO</option>
                            <?php endif;?>
                            <?php if(!in_array('lol', $games)):?>
                                <option value='League of Legends'>League of Legends</option>
                            <?php endif;?>
                            <?php if(!in_array('rl', $games)):?>
                                <option value='Rocket League'>Rocket League</option>
                            <?php endif;?>
                            <?php if(!in_array('val', $games)):?>
                                <option value='Valorant'>Valorant</option>
                            <?php endif;?>
                        </optgroup>
                    </select>
                    <label class="left-label">Spiel</label>
                    <div id="select-icon"></div>
                </div>
                <input class="submit-btn" id="choose-btn" type="submit" name="gamechoicesubmit" value="Wählen">
            </form>
            <?php if($gamechoice != ''): ?>
            <form action="php/actions/editGamesAction.php" method="post">
                <?php if($gamechoice == 'CS:GO'): ?>
                    <div class="gamebox">
                        <?php include "php/pieces/csgostatistics.php";?>
                    </div>
                    <div class="submit-wrapper">
                        <input class="submit-btn"  type="submit" name="deletegame" value="Entfernen">
                        <input class="submit-btn"  type="submit" name="savegame" value="Speichern">
                    </div>
                <?php endif; ?>
                <?php if($gamechoice == 'League of Legends'): ?>
                    <div class="gamebox">
                        <?php include "php/pieces/lolstatistics.php";?>
                    </div>
                    <div class="submit-wrapper">
                        <input class="submit-btn"  type="submit" name="deletegame" value="Entfernen">
                        <input class="submit-btn"  type="submit" name="savegame" value="Speichern">
                    </div>
                <?php endif; ?>
                <?php if($gamechoice == 'Rocket League'): ?>
                    <div class="gamebox">
                        <?php include "php/pieces/rocketleaguestatistics.php";?>
                    </div>
                    <div class="submit-wrapper">
                        <input class="submit-btn"  type="submit" name="deletegame" value="Entfernen">
                        <input class="submit-btn"  type="submit" name="savegame" value="Speichern">
                    </div>
                <?php endif; ?>
                <?php if($gamechoice == 'Valorant'): ?>
                    <div class="gamebox">
                        <?php include "php/pieces/valorantstatistics.php";?>
                        </div>
                    <div class="submit-wrapper">
                        <input class="submit-btn"  type="submit" name="deletegame" value="Entfernen">
                        <input class="submit-btn"  type="submit" name="savegame" value="Speichern">
                    </div>
                <?php endif; ?>
            </form>
            <?php endif; ?>
        </div>

        <form class="box" action="php/actions/changeProfileAction.php" method="post">
            <h1>Icon ändern</h1>
            <?php include "php/pieces/icons.php";?>
            <input class="submit-btn"  type="submit" name="changesubmit" value="Speichern">
        </form>

    </main>
    <script>
        var btn = document.getElementById("choose-btn");
        btn.style.display = "none";   
        var option = document.getElementById("option-choosed");
        option.style.display = "none";             
    </script>
    <footer>
            <div class="footer">
                <?php include "php/footer.php";?>
            </div>
    </footer>
</body>
</html>