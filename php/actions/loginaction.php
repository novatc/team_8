<?php
include "session.php";
startSession();

include "../../db/UserDAO.php";
$userDAO = new UserDAO();

$error = false;
$required = array('username', 'password');

foreach ($required as $field) {
    if (empty($_POST[$field])) {
        $error = true;
    }
}
if ($error == false) {
    $name = $_POST['username'];
    $pwd = $_POST['password'];

    
    $userid = $userDAO->login($name, $pwd);
    if ($userid!=false) {
        $_SESSION['user'] = $_POST['username'];
        $_SESSION['userid'] = $userid;
        header('Location: ../../playerprofile.php');
        
        exit();
    }
    else{
        echo "Login nicht erfolgreich";

    }
}
?>