<?php
require_once "../../db/player_list_dao.php";

$playerlist = new PlayerListDAO();

$list = $playerlist->getAllPlayers();
echo "<ul>";
foreach ($list as $result){
    echo "<li>" . htmlspecialchars($result->username) . ": " .htmlspecialchars($result-> mail);
}
?>


