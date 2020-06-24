<?php
require_once "session.php";
updateSessionFromAction();

require_once "../../db/user_dao.php";
$userDAO = new UserDAO();

$isLoggedIn = $_SESSION['userid']>-1;

if($isLoggedIn){

    $frienduser = $userDAO->getUserByName($_GET['user']);
    $_SESSION['frienduser'] = $frienduser;
    $friendname = $frienduser->username;

    if(!isset($_SESSION['activechats'])) {
        $setactivechats = array();
        array_push($setactivechats, $frienduser);
        $_SESSION['activechats'] = $setactivechats;

        //need help array to check for duplicates because full user object can't be counted and checked for unique
        $preventduplicates = array();
        array_push($preventduplicates, $friendname);
        $_SESSION['preventchatduplicates'] = $preventduplicates;
    } else {
        array_push($_SESSION['preventchatduplicates'], $friendname);
        if(count(array_unique($_SESSION['preventchatduplicates'])) < count($_SESSION['preventchatduplicates'])) {
            array_pop($_SESSION['preventchatduplicates']);
        } else {
            array_push($_SESSION['activechats'], $frienduser);
        }
    }
}
header('Location: ../../chat.php');
exit();
?>