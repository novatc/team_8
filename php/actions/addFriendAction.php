<?php
include "session.php";
startSession();

include "../../db/UserDAO.php";
$userDAO = new UserDAO();

$you = $_SESSION['userid'];
$newfriend = $_SESSION['addfriend'];
$friendID = $newfriend->userid;

$error = $userDAO->addFriend($you, $friendID);

header('Location: ../../chatoverview.php');

?>