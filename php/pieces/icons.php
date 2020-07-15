<?php
$icons = $userDAO->getAllIcons();
?>

<div class=icon-wrapper>  
    <div class="icon-radio">
        <?php foreach($icons as $icon): ?>
            <label class="radiobutton-container">
                <input type="radio" name="icon" value='<?= $icon->iconid?>' <?= ($usericon == $icon->iconid)? 'checked' : '' ?> required>
                <span class="checkmark"></span>
                <div class="icon" style="background-image: url('<?= 'Resourcen/Icons/' . $icon->filename?>');"></div>
            </label>
        <?php endforeach; ?>
    </div>
</div>    
