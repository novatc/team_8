<?php
include "session.php";
startSession();

$posted = false;
$fields = array('age','language', 'description', 'icon');
foreach ($fields as $field){
    if (!empty($_POST[$field])){
        $_SESSION[$field] = $_POST[$field];
        $posted = true;
    }
}

if($posted) {
    header('Location: ../../changeprofile.php');
    exit();
}

?>