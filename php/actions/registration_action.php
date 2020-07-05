<?php
require_once "session.php";
updateSessionFromAction();

require_once "../../db/user_dao.php";
$userDAO = new UserDAO();

$empty = false;
$required = array('username', 'usermail', 'password', 'passwordrepeat');


/* Check if input field empty */
foreach ($required as $field){
    if (empty($_POST[$field])){
        $error = true;
        $_SESSION['registrationerror'] = 1;
    }
}
if(empty($_POST['acceptterms'])){
    $error = true;
    $_SESSION['registrationerror'] = 6;
}


if(!$error){
    $username = $_POST['username'];
    $email = $_POST['usermail'];
    $pwd = $_POST['password'];
    $pwdrepeat = $_POST['passwordrepeat'];
    $errorcode = $userDAO->register($username, $email, $pwd, $pwdrepeat);
    $_SESSION['registrationerror'] = $errorcode;
    if ($errorcode == 0){
        $_SESSION['user'] = $username;
        $_SESSION['userid'] = $userDAO->getUserByName($username)->userid;
        header('Location: ../../playerprofile.php');
        exit();
    } 
}
header('Location: ../../registration.php');
        exit();
?>