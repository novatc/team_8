<?php
include "session.php";
startSession();

include "../../db/UserDAO.php";
$userDAO = new UserDAO();

$frienduser = $userDAO->getUserByName($_POST['friend']);

$_SESSION['frienduser'] = $frienduser;

header('Location: ../../chat.php');
//print_r($friendicon);
