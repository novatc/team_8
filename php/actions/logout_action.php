<?php
require_once "session.php";
updateSessionFromAction();

session_unset();
session_destroy();

header('Location: ../../login.php');
exit();

