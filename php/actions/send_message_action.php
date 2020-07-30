<?php
require_once "session.php";
updateSessionFromAction();

require_once "../../db/user_dao.php";
$userDAO = new UserDAO();

$isLoggedIn = $_SESSION['userid']>-1;
$ownid = $_SESSION['userid'];
$frienduser = $userDAO->getUserByID($_GET['user']);
$friendid = $frienduser->userid;

if($isLoggedIn & isset($_GET['user'])){
    if ($_POST['csrf'] == $_SESSION['csrf_token']) {

        $message = $_POST['message'];

        if($message!="")
            $userDAO->saveMessage($ownid, $friendid, $message);
    }

}
header('Location: ../../chat.php?user='. $friendid);
exit();



?>