<?php


function updateSession(){#
    require_once "db/user_dao.php";
    $userDAO = new UserDAO("sqlite:db/Database.db");

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
        if(!isset($_SESSION['userid'])){
            $_SESSION['userid']= -1;
        }
    }
    $userid = $_SESSION['userid'];
    if($userid != -1){
        if($userDAO->getUserByID($userid) == false){
            $_SESSION['userid'] = -1;
        }
            
    }
}

function updateSessionFromAction(){
    require_once "../../db/user_dao.php";
    $userDAO = new UserDAO("sqlite:../../db/Database.db");

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
        if(!isset($_SESSION['userid'])){
            $_SESSION['userid']= -1;
        }
    }
    $userid = $_SESSION['userid'];
    if($userid != -1){
        if($userDAO->getUserByID($userid) == false){
            $_SESSION['userid'] = -1;
        }
            
    }
}
?>
