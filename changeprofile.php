<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

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
</head>
<body>
    <header>
        <div class="mainnav">
            <?php include "php/header.php";?>
        </div>
    </header>
    <main>
        <form class="box" action="php/changeprofileaction.php" method="post">
            <h1>Profil anpassen</h1>
            <div class="input-wrapper">
                <textarea name="description" class="textarea-input" cols="30" rows="10"><?= htmlspecialchars($description)?></textarea>
                <label class="top-label">Beschreibung</label>
            </div> 
            <div class="input-wrapper">
                <input class="data-input" type="number" name="age" value= "<?= htmlspecialchars($age)?>">
                <label class="left-label">Alter</label>
            </div>
            <div class="input-wrapper">
                <input class="data-input" type="text" name="language" value= "<?= htmlspecialchars($language)?>">
                <label class="left-label">Sprachen</label>
            </div>
        
            <input class="submit-btn" id="submit-form" type="submit" name="changesubmit" value="Speichern">
        </form>

        <form class="box" action="php/managegamesaction.php" method="post">
            <h1>Spiele verwalten</h1>  
            <div class="input-wrapper" >
                <select class="selectbox" name="game" required>
                    <optgroup label="Meine Spiele">
                    <?php foreach(array_keys($games) as $game):?>
                        <?php if($game=='CSGO'):?>
                            <option>CSGO</option>
                        <?php endif;?>
                        <?php if($game=='League of Legends'):?>
                            <option>League of Legends</option>
                        <?php endif;?>
                        <?php if($game=='Rocket League'):?>
                            <option>Rocket League</option>
                        <?php endif;?>
                        <?php if($game=='Valorant'):?>
                            <option>Valorant</option>
                        <?php endif;?>
                    <?php endforeach;?>
                    </optgroup>
                    <optgroup label="Weitere Spiele hinzufügen">
                    <?php if(!in_array('CSGO', array_keys($games))):?>
                            <option>CSGO</option>
                        <?php endif;?>
                        <?php if(!in_array('League of Legends', array_keys($games))):?>
                            <option>League of Legends</option>
                        <?php endif;?>
                        <?php if(!in_array('Rocket League', array_keys($games))):?>
                            <option>Rocket League</option>
                        <?php endif;?>
                        <?php if(!in_array('Valorant', array_keys($games))):?>
                            <option>Valorant</option>
                        <?php endif;?>
                    </optgroup>
                </select>
                <label class="left-label">Spiel</label>
                <div id="select-icon"></div>
            </div>
            <div class="gamebox">
                <h2>Rang</h2>
                <div class=choice-wrapper>  
                    <label class="radiobutton-container">Master
                        <input type="radio" name="rank" value="Master" required>
                        <span class="checkmark"></span>
                    </label>
                    <label class="radiobutton-container">Diamant
                        <input type="radio" name="rank" value="Diamant" required>
                        <span class="checkmark"></span>
                    </label>
                    <label class="radiobutton-container">Platin
                        <input type="radio" name="rank" value="Platin" required>
                        <span class="checkmark"></span>
                    </label>
                    <label class="radiobutton-container">Gold
                        <input type="radio" name="rank" value="Gold" required>
                        <span class="checkmark"></span>
                    </label>
                    <label class="radiobutton-container">Silber
                        <input type="radio" name="rank" value="Silber" required>
                        <span class="checkmark"></span>
                    </label>
                    <label class="radiobutton-container">Bronze
                        <input type="radio" name="rank" value="Bronze" required>
                        <span class="checkmark"></span>
                    </label>
                </div>
                <h2>Position</h2>
                <div class=choice-wrapper>  
                    <label class="checkbox-container">Top Lane
                        <input type="checkbox" name="position[]" value="Top Lane">
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkbox-container">Jungle
                        <input type="checkbox" name="position[]" value="Jungle">
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkbox-container">Mid
                        <input type="checkbox" name="position[]" value="Mid">
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkbox-container">Bottom
                        <input type="checkbox" name="position[]" value="Bottom">
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkbox-container">Support
                        <input type="checkbox" name="position[]" value="Support">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <label class="checkbox-container">Ich möchte, dass andere Spieler mich über dieses Spiel finden.
                        <input type="checkbox" name="visible" checked>
                        <span class="checkmark"></span>
                </label>
            </div>
            <div class="submit-wrapper">
                <input class="submit-btn" id="submit-form" type="submit" name="deletegame" value="Entfernen">
                <input class="submit-btn" id="submit-form" type="submit" name="savegame" value="Speichern">
            </div>
           
        </form>

    </main>
    <footer>
            <div class="footer">
                <?php include "php/footer.php";?>
            </div>
    </footer>
</body>
</html>