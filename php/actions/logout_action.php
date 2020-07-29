<?php
require_once "session.php";
updateSessionFromAction();

include('../../GoogleAPI/google_config.php');

session_unset();
session_destroy();

header('Location: ../../login.php');
exit();

