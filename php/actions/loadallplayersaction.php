<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "../../db/PlayerListDAO.php";

$playerlist = new PlayerListDAO();

$playerlist->getAllPlayers();






?>


