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



header('Location: ../changeprofile.php');
exit();


?>