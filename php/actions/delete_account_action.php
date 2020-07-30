<?php
require_once "session.php";
updateSessionFromAction();

require_once "../../db/user_dao.php";
$userDAO = new UserDAO();

$isLoggedIn = $_SESSION['userid']>-1;

$userID = $_SESSION['userid'];

if($isLoggedIn){
    if($_POST['csrf'] == $_SESSION['csrf_token']) {

        $username = $_POST['username'];
        $pwd = $_POST['password'];
        
        $errorcode = $userDAO->deleteUser($userID, $username, $pwd);

        if($errorcode!=-1){
            $message = "Ihr Account wurde erfolgreich gelöscht!";
            setcookie("loginmessage", $message, 0, "/");
            header('Location: ../../login.php');
            exit();
        }
    }
}
header('Location: ../../delete_account.php');
exit();
?>