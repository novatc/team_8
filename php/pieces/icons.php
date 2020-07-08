<?php
$icons = ['iconBC', 'iconLee', 'iconFizz', 'iconGaren', 'iconGragas', 'iconGraves', 'iconKennen', 'iconSinged', 'iconZiggs'];
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
