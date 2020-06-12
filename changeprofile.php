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
    if(isset($_SESSION['gamechoice'])){
        $gamechoice = $_SESSION['gamechoice'];
    }else{
        $gamechoice = '';
    }        
    
} else{
    $username = '';
    $description = '';
    $language = '';
    $age = '';
    $games = [];
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
        <form class="box" action="php/actions/changeprofileaction.php" method="post">
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
        
            <input class="submit-btn"  type="submit" name="changesubmit" value="Speichern">
        </form>
        <div class="box"> 
            <form  action="php/actions/choosegameaction.php" method="post">
                <h1>Spiele verwalten</h1>  
                <div class="input-wrapper">
                    <select class="selectbox" name="game" onchange="this.form.submit()" required>
                        <optgroup label="Gewählt">
                            <option value='<?php echo $gamechoice?>' selected='selected'><?php echo $gamechoice?></option>
                        <optgroup label="Meine Spiele">
                        <?php foreach(array_keys($games) as $game):?>
                            <?php if($game=='CSGO'):?>
                                <option value='CSGO'>CSGO</option>
                            <?php endif;?>
                            <?php if($game=='League of Legends'):?>
                                <option value='League of Legends'>League of Legends</option>
                            <?php endif;?>
                            <?php if($game=='Rocket League'):?>
                                <option value='Rocket League'>Rocket League</option>
                            <?php endif;?>
                            <?php if($game=='Valorant'):?>
                                <option value='Valorant'>Valorant</option>
                            <?php endif;?>
                        <?php endforeach;?>
                        </optgroup>
                        <optgroup label="Weitere Spiele hinzufügen">
                        <?php if(!in_array('CSGO', array_keys($games))):?>
                                <option value='CSGO'>CSGO</option>
                            <?php endif;?>
                            <?php if(!in_array('League of Legends', array_keys($games))):?>
                                <option value='League of Legends'>League of Legends</option>
                            <?php endif;?>
                            <?php if(!in_array('Rocket League', array_keys($games))):?>
                                <option value='Rocket League'>Rocket League</option>
                            <?php endif;?>
                            <?php if(!in_array('Valorant', array_keys($games))):?>
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
            <form action="php/actions/managegamesaction.php" method="post">
                <?php if($gamechoice == 'CSGO'): ?>
                    <div class="gamebox">
                        <?php include "php/statistics/csgostatistics.php";?>
                    </div>
                    <div class="submit-wrapper">
                        <input class="submit-btn"  type="submit" name="deletegame" value="Entfernen">
                        <input class="submit-btn"  type="submit" name="savegame" value="Speichern">
                    </div>
                <?php endif; ?>
                <?php if($gamechoice == 'League of Legends'): ?>
                    <div class="gamebox">
                        <?php include "php/statistics/lolstatistics.php";?>
                    </div>
                    <div class="submit-wrapper">
                        <input class="submit-btn"  type="submit" name="deletegame" value="Entfernen">
                        <input class="submit-btn"  type="submit" name="savegame" value="Speichern">
                    </div>
                <?php endif; ?>
                <?php if($gamechoice == 'Rocket League'): ?>
                    <div class="gamebox">
                        <?php include "php/statistics/rocketleaguestatistics.php";?>
                    </div>
                    <div class="submit-wrapper">
                        <input class="submit-btn"  type="submit" name="deletegame" value="Entfernen">
                        <input class="submit-btn"  type="submit" name="savegame" value="Speichern">
                    </div>
                <?php endif; ?>
                <?php if($gamechoice == 'Valorant'): ?>
                    <div class="gamebox">
                        <?php include "php/statistics/valorantstatistics.php";?>
                    </div>
                    <div class="submit-wrapper">
                        <input class="submit-btn"  type="submit" name="deletegame" value="Entfernen">
                        <input class="submit-btn"  type="submit" name="savegame" value="Speichern">
                    </div>
                <?php endif; ?>
            </form>
            <?php endif; ?>
        </div>

        <form class="box" action="php/actions/changeprofileaction.php" method="post">
            <h1>Icon ändern</h1>
            <div class="gridIcons">
                <div class="icon" id="avatarTeemo"></div>
                <div class="icon" id="avatarBard" onclick=""></div>
                <div class="icon" id="avatarZac" onclick=""></div>
                <div class="icon" id="avatarFuryhorn" onclick=""></div>
                <label class="radiobutton-container">
                    <input type="radio" name="icon" value="avatarTeemo" required>
                    <span class="checkmark"></span>
                </label>
                <label class="radiobutton-container">
                    <input type="radio" name="icon" value="avatarBard" required>
                    <span class="checkmark"></span>
                </label>
                <label class="radiobutton-container">
                    <input type="radio" name="icon" value="avatarZac" required>
                    <span class="checkmark"></span>
                </label>
                <label class="radiobutton-container">
                    <input type="radio" name="icon" value="avatarFuryhorn" required>
                    <span class="checkmark"></span>
                </label>
                <div class="icon" id="avatarPingu" onclick=""></div>
                <div class="icon" id="avatarSquid" onclick=""></div>
                <div class="icon" id="avatarSpook" onclick=""></div>
                <div class="icon" id="avatarRammus" onclick=""></div>
                <label class="radiobutton-container">
                    <input type="radio" name="icon" value="avatarPingu" required>
                    <span class="checkmark"></span>
                </label>
                <label class="radiobutton-container">
                    <input type="radio" name="icon" value="avatarSquid" required>
                    <span class="checkmark"></span>
                </label>
                <label class="radiobutton-container">
                    <input type="radio" name="icon" value="avatarSpook" required>
                    <span class="checkmark"></span>
                </label>
                <label class="radiobutton-container">
                    <input type="radio" name="icon" value="avatarRammus" required>
                    <span class="checkmark"></span>
                </label>
            </div>
            <input class="submit-btn"  type="submit" name="changesubmit" value="Speichern">
        </form>

    </main>
    <script>
        var btn = document.getElementById("choose-btn");
        btn.style.display = "none";              
    </script>
    <footer>
            <div class="footer">
                <?php include "php/footer.php";?>
            </div>
    </footer>
</body>
</html>