<?php
require_once "session.php";
updateSessionFromAction();

require_once "../../db/user_dao.php";
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
        if(isset($_SESSION['loginDest'])){
            switch ($_SESSION['loginDest']){
                case 'profile':
                    header('Location: ../../playerprofile.php');
                    exit();
                    break;
                case 'chat':
                    header('Location: ../../chatoverview.php');
                    exit();
                    break;
                case 'edit_profile':
                    header('Location: ../../edit_profile.php');
                    exit();
                    break;
                case 'edit_games':
                    header('Location: ../../edit_games.php');
                    exit();
                    break;
            }
                

        }else{
            header('Location: ../../playerprofile.php');
            exit();
        }
        
    } else{
        header('Location: ../../login.php');
        exit();
    }
}

?>