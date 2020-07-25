<form action="php/actions/edit_games_action.php" method="post">
    <?php
    $gameID = $gameDAO->getGameByName($gamechoice)->gameid;
    $gameranks= $gameDAO->getRanksFromGame($gameID);
    $gameroles= $gameDAO->getRolesFromGame($gameID);

    $userrank = $listDAO->getRank($gameID, $userID);
    $userroles = $listDAO->getRoles($gameID, $userID);
    $gamestatus = $listDAO->getStatus($gameID, $userID);
    ?>
    <div class="gamebox">
        <h1><?= $gamechoice?></h1>
        <h2>Rang</h2>
        <div class="choice-wrapper">  
            <?php foreach($gameranks as $rank): ?>
                <label class="radiobutton-container"><?php echo $rank?>
                    <input type="radio" name="rank" value='<?php echo $rank?>' <?php echo ($userrank == $rank)? 'checked' : ''?> required>
                    <span class="checkmark"></span>
                </label>
            <?php endforeach; ?>
        </div>
        <?php if(count($gameroles)>0): ?>
            <h2>Rolle</h2>
            <div class="choice-wrapper"> 
                <?php foreach($gameroles as $role): ?>
                    <label class="checkbox-container"><?php echo $role?>
                        <input type="checkbox" name="role[]" value='<?php echo $role?>' <?php echo (in_array($role, $userroles))? 'checked' : ''?>>
                        <span class="checkmark"></span>
                    </label>
                <?php endforeach; ?> 
            </div>
        <?php endif; ?>    
        <div class="visibility-wrapper">
            <label class="checkbox-container">Ich möchte, dass andere Spieler mich über dieses Spiel finden.
                    <input type="checkbox" name="visible" <?php echo ($gamestatus == 'active')? 'checked' : ''?>>
                    <span class="checkmark"></span>
            </label>
        </div>
    </div>
    <div class="submit-wrapper">
        <input class="submit-btn"  type="submit" name="deletegame" value="Entfernen">
        <input class="submit-btn"  type="submit" name="savegame" value="Speichern">
        <input type="hidden" name="token" value="<?=$_SESSION['token']?>"/>
    </div>
    
</form>