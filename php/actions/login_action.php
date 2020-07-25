<?php
require_once "session.php";
updateSessionFromAction();

if (empty($_SESSION['token'])) {
    $_SESSION['token'] = uniqid('', true);
}

require_once "../../db/user_dao.php";
$userDAO = new UserDAO();

$empty = false;
$required = array('username', 'password');



/* Check if input field empty */
foreach ($required as $field){
    if (empty($_POST[$field])){
        $empty = true;
        $message="Bitte alle Felder ausfüllen!";
        setcookie("loginmessage", $message, 0, "/");
    }
}


if(!$empty){ 
    $username = $_POST['username'];
    $pwd = $_POST['password'];
    $_SESSION['user'] = $username;
    
    $userid = $userDAO->login($username, $pwd);

    if ($userid != -1){
        $_SESSION['userid'] = $userid;

        /* Check which Destination */
        if(isset($_SESSION['loginDest'])){
            switch ($_SESSION['loginDest']){
                case 'chat':
                    $_SESSION['loginDest']="";
                    header('Location: ../../chatoverview.php');
                    exit();
                    break;
                case 'edit_profile':
                    $_SESSION['loginDest']="";
                    header('Location: ../../edit_profile.php');
                    exit();
                    break;
                case 'edit_games':
                    $_SESSION['loginDest']="";
                    header('Location: ../../edit_games.php');
                    exit();
                    break;
                default:
                    $_SESSION['loginDest']="";
                    header('Location: ../../playerprofile.php');
                    exit();
                    break;

            }
        }else{
            header('Location: ../../playerprofile.php');
            exit();
        }
        
    }  
}
header('Location: ../../login.php');
exit();



?>