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
    header('Location: login.php?dest=edit_profile');
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
        <form class="box" action="php/actions/edit_profile_action.php" method="post">
            <h1>Profil anpassen</h1>
            <div class="input-wrapper">
                <textarea name="description" class="textarea-input" cols="30" rows="10"><?= $description?></textarea>
                <label class="top-label">Beschreibung</label>
            </div> 
            <div class="input-wrapper">
                <input class="data-input" type="date" name="age" value= "<?= ($age)?>">
                <label class="left-label">Alter</label>
            </div>
            <div class="input-wrapper">
                <input class="data-input" type="text" name="language" value= "<?= ($language)?>">
                <label class="left-label">Sprachen</label>
            </div>       
            <h1>Icon ändern</h1>
            <?php include "php/pieces/icons.php";?>
            <input class="submit-btn"  type="submit" name="submit" value="Speichern">
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