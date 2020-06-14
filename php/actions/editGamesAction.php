<?php
include "session.php";
startSession();


include "../../db/PlayerListDAO.php";
$listDAO = new PlayerListDAO();

include "../../db/GameDAO.php";
$gameDAO = new GameDAO();


if(isset($_SESSION['games'])){
    $games = $_SESSION['games'];
}else{
    $games = [];
}
$game = $_SESSION['gamechoice'];


if($_SESSION['isLoggedIn'])
if(isset($_POST['deletegame'])){
    if(in_array($game, array_keys($_SESSION['games'])))
        unset($_SESSION['games'][$game]);
        $errorcode = $listDAO->deletePlayer($game->gameid, $userid);

}elseif(isset($_POST['savegame'])){   


    $rank = $_POST['rank'];
    $roles =[];
    if(isset($_POST['role']))
        $roles = $_POST['role'];

    if(isset($_POST['visible'])) {
        $status = 'active';
    } else{
        $status = 'inactive';
    }
        
    $games[$game] = array("rank" => $rank, "roles" => $roles, "status" => $status);

    $_SESSION['games'] = $games;

    $game = $gameDAO->getGameByName($game);
    $userid = $_SESSION['userid'];
    if($game!=NULL)
        $errorcode = $listDAO->addPlayer($game->gameid, $userid, $rank, $roles, $status);
}


header('Location: ../../changeprofile.php');
exit();

?>