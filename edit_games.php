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

if($userID == -1){
    $message="Bitte loggen Sie sich erst ein!";
    setcookie("loginmessage", $message, 0, "/");
    header('Location: login.php?dest=edit_games');
    exit();
}

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
        <div class="box"> 
            <form action="php/actions/choose_game_action.php" method="post">
                <h1>Spiele verwalten</h1>  
                <div class="input-wrapper">
                    <select class="selectbox" name="game" onchange="this.form.submit()" required>
                        <optgroup id="option-choosed" label="Gewählt">
                            <option value='<?php echo $gamechoice?>' selected='selected'><?php echo $gamechoice?></option>

                        <optgroup label="Meine Spiele">
                        <?php foreach($usergames as $usergame):?>
                            <?php foreach($allgames as $game):?>
                                <?php if($usergame==$game->gameid):?>
                                    <option value='<?php echo $game->gamename?>'><?php echo $game->gamename?></option>
                                <?php endif;?>
                            <?php endforeach;?>
                        <?php endforeach;?>
                        </optgroup>
                        <optgroup label="Weitere Spiele hinzufügen">
                        <?php foreach($allgames as $game):?>
                            <?php if(!in_array($game->gameid, $usergames)):?>
                                <option value='<?php echo $game->gamename?>'><?php echo $game->gamename?></option>
                            <?php endif;?>
                        <?php endforeach;?>
                        </optgroup>
                    </select>
                    <label class="left-label">Spiel</label>
                    <div id="select-icon"></div>
                </div>
                <input class="submit-btn" id="choose-btn" type="submit" name="gamechoicesubmit" value="Wählen">
            </form>
            <?php if($gamechoice != ''): 
                include "php/pieces/gamestats.php";
           endif; ?>
        </div>

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