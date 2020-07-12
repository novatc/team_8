<?php
require_once "php/actions/session.php";
updateSession();

if (isset($_GET['dest']))
    $_SESSION['loginDest'] = $_GET['dest'];

if(isset($_SESSION['loginmessage'])){
    $message = $_SESSION['loginmessage'];
}else{
    $message = "";
}

if(isset($_SESSION['user'])){
    $username = $_SESSION['user'];
}else{
    $username = "";
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


    <form class="box" method="post" action="php/actions/login_action.php">
        <h2 id='error-message'><?= $message?></h2>
        <h1>Login</h1>
        <input class="login-input" type="text" name="username" placeholder="Benutzername" value= "<?=$username?>" required>
        <input class="login-input" type="password" name="password" placeholder="Passwort" required>
        <input class="submit-btn" id="submit-form" type="submit" name="loginsubmit" value="Login">
        <div class="center">
            <a class="no-link" href='registration.php'>Noch kein Account?</a>
        </div>
    </form>
</main>

<footer>
    <div class="footer">
        <?php include "php/footer.php"; ?>
    </div>
</footer>
</body>
</html>
