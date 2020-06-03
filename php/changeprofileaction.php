<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$posted = false;
$fields = array('age','language', 'description');
foreach ($fields as $field){
    if (!empty($_POST[$field])){
        $_SESSION[$field] = $_POST[$field];
        $posted = true;
    }
}

if($posted) {
    header('Location: ../changeprofile.php');
    exit();
}

?>