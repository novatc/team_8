<?php
include "session.php";
startSession();

include "../../db/UserDAO.php";
$userDAO = new UserDAO();

$posted = false;
$userID = $_SESSION['userid'];

if(isset($_POST['iconsubmit'])){

    $icon =$_POST['icon'];

    $errorcode = $userDAO->updateUser($userID, -1, -1, -1, $icon);
}

if(isset($_POST['changesubmit'])){
    $age = $_POST['age'];

    $language = $_POST['language'];

    $description = $_POST['description'];

    $errorcode = $userDAO->updateUser($userID, $age, $language, $description, -1);
}



header('Location: ../../changeprofile.php');
exit();

?>