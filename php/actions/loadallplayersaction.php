<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "../../db/PlayerListDAO.php";

$playerlist = new PlayerListDAO();

$list = $playerlist->getAllPlayers();
echo "<ul>";
foreach ($list as $result){
    echo "<li>" . htmlspecialchars($result->username) . ": " .htmlspecialchars($result-> mail);
}






?>


