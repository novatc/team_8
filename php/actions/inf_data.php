<?php
require_once "../../db/player_list_dao.php";
$playerlist = new PlayerListDAO();


if (isset($_POST['getData'])) {
    $list = $playerlist->getPlayersLimit($_POST['start'], $_POST['limit']);
    $response = "";

    if (count($list) > 0) {
        foreach ($list as $elem) {

            $response .= '
            <div>
                <h2>' . $elem->username . '</h2>
                <p>'.$elem->language.'</p>
            </div>
        ';
        }
        exit($response);
    } else exit('reachedMax');


}


?>