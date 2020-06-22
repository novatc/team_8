<?php
include "session.php";
startSession();

session_unset();
session_destroy();

header('Location: ../../login.php');
exit();

