<?php
require_once "session.php";
updateSessionFromAction();

require_once "../../db/user_dao.php";
$userDAO = new UserDAO();

$isLoggedIn = $_SESSION['userid']>-1;

if($isLoggedIn & isset($_GET['user'])){
    if ($_SESSION['token']!==$_POST['token']) {
        die ('Ungültiger Token');
    }

    //testing
    $ownid = $_SESSION['userid'];
    $frienduser = $userDAO->getUserByID($_GET['user']);
    $friendid = $frienduser->userid;
    $message = $_POST['message'];


    $userDAO->saveMessage($ownid, $friendid, $message);
}
header('Location: ../../chat.php?user='. $friendid);
exit();



?>