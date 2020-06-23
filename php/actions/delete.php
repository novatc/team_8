<?php
include "../../db/user_dao.php";
$userDAO = new UserDAO();

$userDAO->deleteUser();

?>