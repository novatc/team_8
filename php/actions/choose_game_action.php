<?php
include "session.php";
startSession();

if (isset($_POST['game'])){
    $_SESSION['gamechoice'] = $_POST['game']; 
}
    

header('Location: ../../change_profile.php');
exit();

?>