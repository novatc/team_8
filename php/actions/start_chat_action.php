<?php
require_once "../../db/user_dao.php";
$userDAO = new UserDAO();

$frienduser = $userDAO->getUserByName($_POST['friend']);
$_SESSION['frienduser'] = $frienduser;

if(!isset($_SESSION['activechats'])) {
    $setactivechats = array();
    array_push($setactivechats, $frienduser);
    $_SESSION['activechats'] = $setactivechats;
} else {
    array_push($_SESSION['activechats'], $frienduser);
    //didn't find good method to stop duplicates yet.
    /*if(count(array_unique($_SESSION['activechats'])) < count($_SESSION['activechats'])) {
        $error = array_pop($_SESSION['activechats']);
    }*/
}

header('Location: ../../chat.php');
