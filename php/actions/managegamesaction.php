<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['games'])){
    $games = $_SESSION['games'];
}else{
    $games = [];
}
$game = $_SESSION['gamechoice'];

if(isset($_POST['deletegame'])){
    if(in_array($game, array_keys($_SESSION['games'])))
        unset($_SESSION['games'][$game]);

}elseif(isset($_POST['savegame'])){
    
    $rank = $_POST['rank'];
    $roles =[];
    if(isset($_POST['role']))
        $roles = $_POST['role'];
   
    $games[$game] = array("rank" => $rank, "roles" => $roles);

    $_SESSION['games'] = $games;
}



header('Location: ../../changeprofile.php');
exit();


?>