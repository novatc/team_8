<?php
require_once "session.php";
updateSessionFromAction();

require_once "../../db/user_dao.php";
$userDAO = new UserDAO();

$isLoggedIn = $_SESSION['userid']>-1;

$userID = $_SESSION['userid'];

if($isLoggedIn){
    if ($_SESSION['token']!==$_POST['token']) {
        die ('Ungültiger Token');
    }

    $icon = $_POST['icon'];

    $age = $_POST['age'];

    $language = $_POST['language'];

    $description = $_POST['description'];

    $errorcode = $userDAO->updateUser($userID, $age, $language, $description, $icon);

    if($errorcode==0){
        header('Location: ../../playerprofile.php');
        exit();
    }
}

header('Location: ../../edit_profile.php');
exit();

?>