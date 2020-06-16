<?php
include "session.php";
startSession();

include "../../db/UserDAO.php";
$userDAO = new UserDAO();

//testing
$ownid = $_SESSION['userid'];
$frienduser = $_SESSION['frienduser'];
$friendid = $frienduser->userid;
$message = $_POST['message'];


$userDAO->saveMessage($ownid, $friendid, $message);

header('Location: ../../chat.php');