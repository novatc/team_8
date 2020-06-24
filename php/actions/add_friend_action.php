<?php
require_once "session.php";
updateSessionFromAction();

require_once "../../db/user_dao.php";
$userDAO = new UserDAO();

$isLoggedIn = $_SESSION['userid']>-1;


if($isLoggedIn){
    $you = $_SESSION['userid'];
    $newfriend = $_SESSION['addfriend'];
    $friendID = $newfriend->userid;
    $error = $userDAO->addFriend($you, $friendID);
}

header('Location: ../../playerprofile.php?id=' . $friendID);

?>