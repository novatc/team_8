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
        $_SESSION['loginerror']="Bitte alle Felder ausfüllen!";
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
        
    }  
}
header('Location: ../../login.php');
exit();
?>