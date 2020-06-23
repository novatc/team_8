<?php
require_once "php/actions/session.php";
updateSession();

require_once "db/player_list_dao.php";
$listDAO = new PlayerListDAO("sqlite:db/Database.db");

require_once "db/game_dao.php";
$gameDAO = new GameDAO("sqlite:db/Database.db");

require_once "db/user_dao.php";
$userDAO = new UserDAO("sqlite:db/Database.db");

$userID = $_SESSION['userid'];
$user = $userDAO->getUserByID($userID);
$description = $user->description;
$age = $user->age;
$language = $user->language;
$usericon = $user->icon;

$usergames = $listDAO->getGamesFromPlayer($userID);
$allgames = $gameDAO->getGames([]);

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
        <form class="box" action="php/actions/change_profile_action.php" method="post">
            <h1>Profil anpassen</h1>
            <div class="input-wrapper">
                <textarea name="description" class="textarea-input" cols="30" rows="10"><?= htmlspecialchars($description)?></textarea>
                <label class="top-label">Beschreibung</label>
            </div> 
            <div class="input-wrapper">
                <input class="data-input" type="date" name="age" value= "<?= htmlspecialchars($age)?>">
                <label class="left-label">Alter</label>
            </div>
            <div class="input-wrapper">
                <input class="data-input" type="text" name="language" value= "<?= htmlspecialchars($language)?>">
                <label class="left-label">Sprachen</label>
            </div>
        
            <input class="submit-btn"  type="submit" name="changesubmit" value="Speichern">
        </form>
        <div class="box"> 
            <form action="php/actions/choose_game_action.php" method="post">
                <h1>Spiele verwalten</h1>  
                <div class="input-wrapper">
                    <select class="selectbox" name="game" onchange="this.form.submit()" required>
                        <optgroup id="option-choosed" label="Gewählt">
                            <option value='<?php echo $gamechoice?>' selected='selected'><?php echo htmlspecialchars($gamechoice)?></option>

                        <optgroup label="Meine Spiele">
                        <?php foreach($usergames as $usergame):?>
                            <?php foreach($allgames as $game):?>
                                <?php if($usergame==$game->gameid):?>
                                    <option value='<?php echo $game->gamename?>'><?php echo htmlspecialchars($game->gamename)?></option>
                                <?php endif;?>
                            <?php endforeach;?>
                        <?php endforeach;?>
                        </optgroup>
                        <optgroup label="Weitere Spiele hinzufügen">
                        <?php foreach($allgames as $game):?>
                            <?php if(!in_array($game->gameid, $usergames)):?>
                                <option value='<?php echo $game->gamename?>'><?php echo htmlspecialchars($game->gamename)?></option>
                            <?php endif;?>
                        <?php endforeach;?>
                        </optgroup>
                    </select>
                    <label class="left-label">Spiel</label>
                    <div id="select-icon"></div>
                </div>
                <input class="submit-btn" id="choose-btn" type="submit" name="gamechoicesubmit" value="Wählen">
            </form>
            <?php if($gamechoice != ''): ?>
            <form action="php/actions/edit_game_action.php" method="post">
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

        <form class="box" action="php/actions/change_profile_action.php" method="post">
            <h1>Icon ändern</h1>
            <?php include "php/pieces/icons.php";?>
            <input class="submit-btn"  type="submit" name="iconsubmit" value="Speichern">
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