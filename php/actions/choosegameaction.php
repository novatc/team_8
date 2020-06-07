<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_POST['game'])){
    $_SESSION['gamechoice'] = $_POST['game']; 
}
    

header('Location: ../../changeprofile.php');
exit();

?>