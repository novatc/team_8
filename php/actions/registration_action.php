<?php
include "session.php";
startSession();

include "../../db/user_dao.php";
$userDAO = new UserDAO();

$error = false;
$required = array('username', 'usermail', 'password', 'passwordrepeat');


/* Check if input field empty */
foreach ($required as $field){
    if (empty($_POST[$field])){
        $error = true;
        ?>
        <script>
            var label = document.getElementById("error-message");
            label.innerHTML = "Bitte alles ausfüllen!";   
        </script>
        <?php 
    }
}


if(!$error){
    $username = $_POST['username'];
    $email = $_POST['usermail'];
    $pwd = $_POST['password'];
    $pwdrepeat = $_POST['password'];
    $errorcode = $userDAO->register($username, $email, $pwd, $pwdrepeat);
    $_SESSION['registrationerror'] = $errorcode;
    if ($errorcode == 0){
        $_SESSION['user'] = $username;
        $_SESSION['userid'] = $userDAO->getUserByName($username)->userid;
        header('Location: ../../playerprofile.php');
        exit();
    } else{
        header('Location: ../../registration.php');
        exit();
    }
}
   
?>