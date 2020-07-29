<?php
require_once "session.php";
updateSessionFromAction();
$publicKey = "6LedxrcZAAAAACLlR3gcWywrkX6TSETOzoln7wAO";
$url = "https://www.google.com/recaptcha/api/siteverify";

if (empty($_SESSION['token'])) {
    $_SESSION['token'] = uniqid('', true);
}


if (array_key_exists('registersubmit', $_POST)){
    //echo "<pre>";print_r($_POST);echo "</pre>";
    $responseKey = $_POST['g-recaptcha-response'];
    $response = file_get_contents($url.'?secret='.$publicKey.'&response='.$responseKey.'&remoteip='.$_SERVER['REMOTE_ADDR']);
    $response = json_decode($response);
    //echo "<pre>";print_r($response);echo "</pre>";

    if ($response->success == 1){
        echo 'DU bis Mensch';

    }
    else{
        echo 'Teil der Roboterapokalypse';
        echo "<pre>";print_r($response);echo "</pre>";

        die();
    }

}


require_once "../../db/user_dao.php";
$userDAO = new UserDAO();

$empty = false;
$error = false;
$required = array('username', 'usermail', 'password', 'passwordrepeat');


/* Check if input field empty */
foreach ($required as $field){
    if (empty($_POST[$field])){
        $empty = true;
        $message="Bitte alle Felder ausfüllen!";
        setcookie("registrationmessage", $message, 0, "/");
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
        $message="Bitte akzeptieren Sie die Nutzungsbedingungen und die Datenschutzerklärung!";
        setcookie("registrationmessage", $message, 0, "/");
    }
    
    if(!$error){
        $userid = $userDAO->register($username, $email, $pwd, $pwdrepeat, 0);
        if ($userid != -1){
            $_SESSION['userid'] = $userid;

            header('Location: ../../playerprofile.php');
            exit();
        } 
    }
    
}

header('Location: ../../registration.php');
exit();
?>