<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['games'])){
    $games = $_SESSION['games'];
}else{
    $games = [];
}
$game = $_POST['game'];

if(isset($_POST['deletegame'])){
    if(in_array($game, array_keys($_SESSION['games'])))
        unset($_SESSION['games'][$game]);
}elseif(isset($_POST['savegame'])){
    
    $rank = $_POST['rank'];

    $positions = '';
    $positionform = $_POST['position'];
    $count = 0;
    foreach($positionform as $pos){
        if($count==0){
            $positions = $pos;
        } else{
            $positions = $positions . ', ' . $pos;
        }
        $count ++;
    }
        


    $games[$game] = array("rank" => $rank, "positions" => $positions);

    $_SESSION['games'] = $games;
}



header('Location: ../changeprofile.php');
exit();


?>