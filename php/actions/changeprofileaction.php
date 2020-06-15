<?php
include "session.php";
startSession();

include "../../db/UserDAO.php";
$userDAO = new UserDAO();

$posted = false;
$userID = $_SESSION['userid'];
$fields = array('age','language', 'description', 'icon');

$age = (!empty($_POST['age'])) ? $_POST['age'] : null ;

$language = (!empty($_POST['age'])) ? $_POST['language'] : null ;

$description = (!empty($_POST['age'])) ? $_POST['description'] : null ;

$icon = (!empty($_POST['age'])) ? $_POST['icon'] : null ;

$errorcode = $userDAO->updateUser($userID, $age, $language, $description, $icon);

header('Location: ../../changeprofile.php');
exit();


?>