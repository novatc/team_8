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
        exit("Nicht alle Felder ausgefüllt!");
    }
}

/* Check if username in DB */
$id = $database->getUser($username)->id;
if($id != false){
    exit("Nutzer berits in Datenbank mit ID: $id");
}

/* Check if password and passwordrepeat are identical*/
if($pwd != $pwdrepeat){
    
}
/* Check if email is correct*/
if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    exit("Bitte eine gültige Email-Adresse angeben!");
}

if ($database->register($username,$email,$pwd)){
    $_SESSION['user'] = $username;
    $_SESSION['isLoggedIn'] = true;
    header('Location: playerprofile.php');
    exit();
} else{
    exit("Huch etwas ist schief gelaufen. Bitte versuchen Sie es erneut!");
}
    
?>

