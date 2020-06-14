<?php

function startSession(){
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
        $_SESSION['isLoggedIn'] = true;
    }
}
