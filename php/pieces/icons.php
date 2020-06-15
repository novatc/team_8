<?php
$icons = ['avatarTeemo', 'avatarBard', 'avatarZac', 'avatarFuryhorn', 'avatarPingu', 'avatarSquid','avatarSpook', 'avatarRammus'];
?>

<div class=icon-wrapper>  
    <div class="icon-radio">
        <?php foreach($icons as $icon): ?>
            <label class="radiobutton-container">
                <input type="radio" name="icon" value='<?php echo $icon?>' <?php echo ($usericon == $icon)? 'checked' : '' ?> required>
                <span class="checkmark"></span>
                <div class="icon" id='<?php echo $icon?>'></div>
            </label>
        <?php endforeach; ?>
    </div>
</div>    
