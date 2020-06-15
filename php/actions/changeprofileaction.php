<?php
include "session.php";
startSession();

include "../../db/UserDAO.php";
$userDAO = new UserDAO();

$posted = false;
$userID = $_SESSION['userid'];

if(isset($_POST['iconsubmit'])){

    $icon = ((!empty($_POST['age'])) ? $_POST['icon'] : '' );

    $errorcode = $userDAO->updateUser($userID, null, null, null, $icon);
}

if(isset($_POST['changesubmit'])){
    $age = ((!empty($_POST['age'])) ? $_POST['age'] : null);

    $language = ((!empty($_POST['age'])) ? $_POST['language'] : null );

    $description = ((!empty($_POST['age'])) ? $_POST['description'] : null );

    $errorcode = $userDAO->updateUser($userID, $age, $language, $description, null);
}



header('Location: ../../changeprofile.php');
exit();

?>