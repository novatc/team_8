<?php
include "session.php";
startSession();

include "../../db/PlayerListDAO.php";
$listDAO = new PlayerListDAO();

include "../../db/GameDAO.php";
$gameDAO = new GameDAO();

$gameid = $gameDAO->getGameByName($_SESSION['gamechoice'])->gameid;
$userid = $_SESSION['userid'];

if($_SESSION['isLoggedIn'])
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
    switch($listDAO->alreadyIncluded($game->gameid, $userid)){
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
header('Location: ../../changeprofile.php');
exit();

?>