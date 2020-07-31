<?php
require_once "session.php";
updateSessionFromAction();

require_once "../../db/user_dao.php";
$userDAO = new UserDAO();

$isLoggedIn = $_SESSION['userid']>-1;
$ownid = $_SESSION['userid'];
$frienduser = $userDAO->getUserByID($_GET['user']);
$friendid = $frienduser->userid;

if($isLoggedIn && isset($_POST['user_message']) && isset($_POST['receiver_id'])){
    if ($_POST['csrf'] == $_SESSION['csrf_token']) {

        $message = $_POST['user_message'];
        $friendid = $_POST['receiver_id'];
        if($message!="")
            $insert = $userDAO->saveMessage($ownid, $friendid, $message);
    
    }   
}
?>