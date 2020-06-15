<?php
$game = 'CS:GO';
$csgoranks = ['Unranked', 'Silber', 'Gold', 'Master Guardian', 'Legendary Eagle', 'Supreme', 'Global'];
$csgoroles = ['Sniper', 'Stratege', 'Support', 'Awper', 'Entry Fragger'];

include "db/PlayerListDAO.php";
$listDAO = new PlayerListDAO();

include "db/GameDAO.php";
$gameDAO = new GameDAO();

$gameID = $gameDAO->getGameByName($game)->gameid;
$userID = $_SESSION['userid'];
$userrank = $listDAO->getRank($gameID, $userID)

?>

<h1>CS:GO</h1>
<h2>Rang</h2>
<div class=choice-wrapper>  
    <?php foreach($csgoranks as $rank): ?>
        <label class="radiobutton-container"><?php echo $rank?>
            <input type="radio" name="rank" value='<?php echo $rank?>' <?php echo ($userrank == $rank)? 'checked' : ''?> required>
            <span class="checkmark"></span>
        </label>
    <?php endforeach; ?>
</div>
<?php if(count($csgoroles)>0): ?>
    <h2>Rolle</h2>
    <div class=choice-wrapper> 
        <?php foreach($csgoroles as $role): ?>
            <label class="checkbox-container"><?php echo $role?>
                <input type="checkbox" name="role[]" value='<?php echo $role?>' <?php echo (isset($games[$game]))? (in_array($role, $games[$game]['roles']))? 'checked' : '' : ''?>>
                <span class="checkmark"></span>
            </label>
        <?php endforeach; ?> 
    </div>
<?php endif; ?>    
<label class="checkbox-container">Ich möchte, dass andere Spieler mich über dieses Spiel finden.
        <input type="checkbox" name="visible" <?php echo (isset($games[$game]))? ($games[$game]['status'] == 'active')? 'checked' : '' : 'checked'?>>
        <span class="checkmark"></span>
</label>
