<?php
require_once "session.php";
updateSessionFromAction();

require_once "../../db/player_list_dao.php";
$playerlist = new PlayerListDAO();

require_once "../../db/user_dao.php";
$userlist = new UserDAO();


if (isset($_POST['getData'])) {

    $gameID = $_POST['game'];
    $rankfilter = $_SESSION['ranks'];
    $rolefilter = $_SESSION['roles'];

    $list = $playerlist->getPlayersForGameWithLimit($gameID, $rankfilter, $rolefilter, $_POST['start'], $_POST['limit']);
    $response = "";

    if (count($list) > 0) {
        foreach ($list as $playeritem){
            $playerID = $playeritem->userid;
            $playername = $playerlist->getPlayerByID($playerID);
            $profileurl = 'playerprofile.php?id=' . $playerID;
            $user = $userlist->getUserByID($playerID);
            $usericonID = $user->iconid;
            $icon = $userlist->getIcon($usericonID)->filename;
            $roles = implode(', ', $playerlist->getRoles($gameID, $playeritem->userid));

            $response .= "
            <li class='card' style=''>
                <a href='{$profileurl}' class='container'
                    style='background-image: url(&quot;Resourcen/Icons/{$icon}&quot;);'>
                    <div class='name-wrapper'
                            style='background-image: url(&quot;Resourcen/Icons/{$icon}&quot;);'>
                        <h1>{$playeritem->username}</h1>
                    </div>
                    <ul>
                        <li>Sprache: {$playeritem->language}</li>
                        <li>
                            Role: {$roles}
                        </li>

                        <li>
                            ELO: {$playerlist->getRank($gameID, $playeritem->userid)}
                        </li>
                    </ul>
                </a>
            </li>
        ";
        }

        exit($response);
    } else exit('reachedMax');
}
?>
