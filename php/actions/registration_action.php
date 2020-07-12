<?php
require_once "session.php";
updateSessionFromAction();

require_once "../../db/user_dao.php";
$userDAO = new UserDAO();

$empty = false;
$error = false;
$required = array('username', 'usermail', 'password', 'passwordrepeat');


/* Check if input field empty */
foreach ($required as $field){
    if (empty($_POST[$field])){
        $empty = true;
        $_SESSION['registrationmessage'] = "Bitte alle Felder ausfüllen!";
    }
}

if(!$empty){
    $username = $_POST['username'];
    $email = $_POST['usermail'];
    $pwd = $_POST['password'];
    $pwdrepeat = $_POST['passwordrepeat'];

    $_SESSION['user'] = $username;
    $_SESSION['email'] = $email;

    if(empty($_POST['acceptterms'])){
        $error = true;
        $_SESSION['registrationmessage'] ="Bitte akzeptieren Sie die Nutzungsbedingungen und die Datenschutzerklärung!";
    }
    
    if(!$error){
        $errorcode = $userDAO->register($username, $email, $pwd, $pwdrepeat);
        $_SESSION['registrationerror'] = $errorcode;
        if ($errorcode == 0){
        
            $_SESSION['userid'] = $userDAO->getUserByName($username)->userid;
            header('Location: ../../playerprofile.php');
            exit();
        } 
    }
    
}

header('Location: ../../registration.php');
exit();
?>