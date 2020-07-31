<?php
require_once "php/actions/session.php";
updateSession();

require_once "db/user_dao.php";
$userDAO = new UserDAO("sqlite:db/Database.db");


if (isset($_GET['dest']))
    $_SESSION['loginDest'] = $_GET['dest'];

if (isset($_COOKIE['loginmessage'])) {
    $message = $_COOKIE['loginmessage'];
} else {
    $message = "";
}

if (isset($_SESSION['user'])) {
    $username = $_SESSION['user'];
} else {
    $username = "";
}

// Google Api (Source: https://www.webslesson.info/2019/09/how-to-make-login-with-google-account-using-php.html)
include('GoogleAPI/google_config.php');

//This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
if (isset($_GET["code"])) {
    //It will Attempt to exchange a code for an valid authentication token.
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

    //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
    if (!isset($token['error'])) {
        //Set the access token used for requests
        $google_client->setAccessToken($token['access_token']);

        //Store "access_token" value in $_SESSION variable for future use.
        $_SESSION['access_token'] = $token['access_token'];

        //Create Object of Google Service OAuth 2 class
        $google_service = new Google_Service_Oauth2($google_client);

        //Get user profile data from google
        $data = $google_service->userinfo->get();

        $_SESSION['userid'] = $userDAO->googleLoginAndRegister($data['given_name'] . $data['family_name'], $data['email']);
    }
}

$login_button = '';

//Create a URL to obtain user authorization
$login_button = '<a href="' . $google_client->createAuthUrl() . '"><img id="googlebutton" src="Resourcen/sign-in-with-google.png" /></a>';

if ($_SESSION['userid'] != -1) {
    header('Location: playerprofile.php');
    exit();
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
        <h2 id='error-message'><?= $message ?></h2>
        <h1>Login</h1>
        <input class="login-input" type="text" name="username" placeholder="Benutzername" value="<?= $username ?>"
               required>
        <input class="login-input" type="password" name="password" placeholder="Passwort" required>
        <input class="submit-btn" id="submit-form" type="submit" name="loginsubmit" value="Login">
        <div class="center">
            <a class="no-link" href='registration.php'>Noch kein Account?</a>
        </div>
    </form>
    <div class="google-wrapper">
        <a class="google-btn" href="<?= $google_client->createAuthUrl() ?>"><img alt="Google" class="google-img"
                                                                                 src="Resourcen/sign-in-with-google.png"/></a>
    </div>


</main>

<div class="footer">
    <?php include "php/footer.php"; ?>
</div>
</body>
</html>
