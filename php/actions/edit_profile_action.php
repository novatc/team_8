<?php
require_once "session.php";
updateSessionFromAction();

require_once "../../db/user_dao.php";
$userDAO = new UserDAO();

$isLoggedIn = $_SESSION['userid']>-1;

if($isLoggedIn){
    $posted = false;
    $userID = $_SESSION['userid'];

    $icon = $_POST['icon'];

    $age = $_POST['age'];

    $language = $_POST['language'];

    $description = $_POST['description'];

    $errorcode = $userDAO->updateUser($userID, $age, $language, $description, $icon);

}




header('Location: ../../playerprofile.php');
exit();

?>