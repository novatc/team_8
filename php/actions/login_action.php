<?php
include "session.php";
startSession();

include "../../db/user_dao.php";
$userDAO = new UserDAO();

$empty = false;
$required = array('username', 'password');


/* Check if input field empty */
foreach ($required as $field){
    if (empty($_POST[$field])){
        $empty = true;
        $_SESSION['registrationerror'] = 1;
    }
}


if(!$empty){
    $username = $_POST['username'];
    $pwd = $_POST['password'];
    
    $errorcode = $userDAO->login($username, $pwd);
    $_SESSION['loginerror'] = $errorcode;
    if ($errorcode == 0){
        $_SESSION['user'] = $username;
        $_SESSION['userid'] = $userDAO->getUserByName($username)->userid;
        header('Location: ../../playerprofile.php');
        exit();
    } else{
        header('Location: ../../login.php');
        exit();
    }
}

?>