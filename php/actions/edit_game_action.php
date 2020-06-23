<?php
include "session.php";
updateSession();

include "../../db/player_list_dao.php";
$listDAO = new PlayerListDAO();

include "../../db/game_dao.php";
$gameDAO = new GameDAO();

$gameid = $gameDAO->getGameByName($_SESSION['gamechoice'])->gameid;
$userid = $_SESSION['userid'];


if(isset($_POST['deletegame'])){
    $errorcode = $listDAO->deletePlayer($gameid, $userid);

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

    /* Check if player is already in playerlist for specific game*/
    switch($listDAO->alreadyIncluded($gameid, $userid)){
        case false:
            $listDAO->addPlayer($gameid, $userid, $rank, $roles, $status);
            break;
        case true:
            $listDAO->updatePlayer($gameid, $userid, $rank, $roles, $status);
            break;
        default:
            // TODO Errormessage
            break;
    }
}
header('Location: ../../change_profile.php');
exit();

?>