<?php

function startSession(){
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
        
        if(!isset($_SESSION['userid'])){
            $_SESSION['userid']= -1;
        }
            

    }
}
