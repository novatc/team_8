<?php
require_once "session.php";
updateSessionFromAction();

if($_POST['csrf'] == $_SESSION['csrf_token']) {
    
    if (isset($_POST['game'])){
        $_SESSION['gamechoice'] = $_POST['game'];
    }
}
header('Location: ../../edit_games.php');
    exit();
?>