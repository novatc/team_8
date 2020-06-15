<?php
$game = 'Valorant';
$valorantranks = ['Mercenary', 'Soldier', 'Veteran', 'Hero', 'Legend', 'Mythic', 'Immortal', 'Valorant'];
$valorantroles = ['Breach', 'Brimstone', 'Cypher', 'Jett', 'Omen', 'Phoenix', 'Raze', 'Reyna', 'Sage', 'Sova', 'Viper'];

$userID = $_SESSION['userid'];
$gameID = $gameDAO->getGameByName($game)->gameid;
$userrank = $listDAO->getRank($gameID, $userID);
$userroles = $listDAO->getRoles($gameID, $userID);
$gamestatus = $listDAO->getStatus($gameID, $userID);
?>
<h1>Valorant</h1>
<h2>Rang</h2>
<div class=choice-wrapper>  
    <?php foreach($valorantranks as $rank): ?>
        <label class="radiobutton-container"><?php echo $rank?>
            <input type="radio" name="rank" value='<?php echo $rank?>' <?php echo ($userrank == $rank)? 'checked' : ''?> required>
            <span class="checkmark"></span>
        </label>
    <?php endforeach; ?>
</div>
<?php if(count($valorantroles)>0): ?>
    <h2>Position</h2>
    <div class=choice-wrapper> 
        <?php foreach($valorantroles as $role): ?>
            <label class="checkbox-container"><?php echo $role?>
                <input type="checkbox" name="role[]" value='<?php echo $role?>' <?php echo (in_array($role, $userroles))? 'checked' : ''?>>
                <span class="checkmark"></span>
            </label>
        <?php endforeach; ?> 
    </div>
<?php endif; ?>
<label class="checkbox-container">Ich möchte, dass andere Spieler mich über dieses Spiel finden.
        <input type="checkbox" name="visible" <?php echo ($gamestatus == 'active')? 'checked' : ''?>>
        <span class="checkmark"></span>
</label>