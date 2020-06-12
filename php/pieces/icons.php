<?php
$iconname = ['avatarTeemo', 'avatarBard', 'avatarZac', 'avatarFuryhorn', 'avatarPingu', 'avatarSquid','avatarSpook', 'avatarRammus'];
?>

<div class=choice-wrapper>  
    <div class="icon-radio">
        <?php foreach($iconname as $icon): ?>
            <label class="radiobutton-container">
                <input type="radio" name="icon" value='<?php echo $icon?>' <?php echo (isset($profileicon))? ($profileicon == $icon)? 'checked' : '' : '' ?> required>
                <span class="checkmark"></span>
                <div class="icon" id='<?php echo $icon?>'></div>
            </label>
        <?php endforeach; ?>
    </div>
</div>    
