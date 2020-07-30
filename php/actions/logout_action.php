<?php
require_once "session.php";
updateSessionFromAction();

include('../../GoogleAPI/google_config.php');

foreach($_COOKIE AS $key => $value) {
    SETCOOKIE($key,$value,TIME()-10000,"/");
}

session_unset();
session_destroy();

header('Location: ../../login.php');
exit();

