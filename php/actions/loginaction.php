<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

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

    $validLogginAttemd = $userDAO->login($name, $pwd);

    if ($validLogginAttemd) {
        $_SESSION['user'] = $_POST['username'];
        header('Location: ../../playerprofile.php');
        $_SESSION['isLoggedIn'] = true;
        exit();
    }
    else{
        echo "Login nicht erfolgreich";

    }
}
?>