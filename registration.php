<?php
session_start();
include "db/DUMMYdatabase.db";
include "dbScripts/database.php";
$database = new DatabaseClass();

$required = array('username', 'usermail', 'password', 'repeatpassword');
$error = false;
$_SESSION['isLoggedIn'] = false;

foreach ($required as $field){
    if (empty($_POST[$field])){
        $error = true; 
    }
}
if($error==false){
    if($_POST["password"]!=$_POST["repeatpassword"]){
        $error=true;
    }
}
if ($error==false) {
    $name = $_POST['username'];
    $email = $_POST['usermail'];
    $pwd = $_POST['password'];
    if (filter_var($email, FILTER_VALIDATE_EMAIL)){
        if ($database->register($name,$email,$pwd)){
            $_SESSION['user'] = $_POST['username'];
            header('Location: playerprofile.php');
            $_SESSION['isLoggedIn'] = true;
            exit();
        }
    }

}


?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team8 - Login</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/formular.css">

</head>
<body>
<header>
    <div class="mainnav">
        <?php include "php/header.php"; ?>
    </div>
</header>
<main>

    <form class="box" method="post">
        <h1>Registrieren</h1>
        <input class="login-input" type="text" name="username" placeholder="Benutzername" required>
        <input class="login-input" type="email" name="usermail" placeholder="Mail" required>
        <input class="login-input" type="password" name="password" placeholder="Passwort" required>
        <input class="login-input" type="password" name="repeatpassword" placeholder="Passwort wiederholen" required>
        <input class="submit-btn" id="submit-form" type="submit" name="registersubmit" value="Registrieren">

    </form>

</main>

<footer>
    <div class="footer">
        <?php include "php/footer.php"; ?>
    </div>
</footer>
</body>
</html>
