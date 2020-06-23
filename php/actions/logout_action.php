<?php
include "session.php";
updateSession();

session_unset();
session_destroy();

header('Location: ../../login.php');
exit();

