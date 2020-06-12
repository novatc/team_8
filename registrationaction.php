<?php
session_start();

include "db/database.php";
$database = new DatabaseClass();

$error = false;
$required = array('username', 'usermail', 'password', 'passwordrepeat');

$username = $_POST['username'];
$email = $_POST['usermail'];
$pwd = $_POST['password'];
$pwdrepeat = $_POST['password'];
/* Check if input field empty */
foreach ($required as $field){
    if (empty($_POST[$field])){
        $error = true;
        echo ("Nicht alle Felder ausgefüllt!");
    }
}

/* Check if username in DB */
$id = $database->getUser($username)->id;
if($id != false){
    $error = true;
    echo ("Nutzer berits in Datenbank mit ID: $id");
}
/* Check if password and passwordrepeat are identical*/
if($pwd != $pwdrepeat){
    $error = true;
    echo ("Die Passwörter stimmen nicht überein");
}
/* Check if email is correct*/
if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $error = true;
    echo ("Bitte eine gültige Email-Adresse angeben!");
}

if(!$error){
    if ($database->register($username,$email,$pwd)){
        $_SESSION['user'] = $username;
        $_SESSION['isLoggedIn'] = true;
        header('Location: playerprofile.php');
        exit();
    } else{
        echo "Huch etwas ist schief gelaufen. Bitte versuchen Sie es erneut!";
    }
}else{
    header('Location: registration.php');
    exit();
}

    
?>

