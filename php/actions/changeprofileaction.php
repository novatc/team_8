<?php
include "session.php";
startSession();

include "../../db/UserDAO.php";
$userDAO = new UserDAO();

$posted = false;
$userID = $_SESSION['userid'];
$fields = array('age','language', 'description', 'icon');
if (!empty($_POST['age'])){
    $errorcode = $userDAO->updateUser($userID, $_POST['age'], NULL, NULL, NULL);
    echo $errorcode;
    if( $errorcode==0){
        $_SESSION['age'] = $_POST['age'];
        $posted = true;
    }     
}

if (!empty($_POST['language'])){
    $errorcode = $userDAO->updateUser($userID, NULL, $_POST['language'], NULL, NULL);
    echo $errorcode;
    if( $errorcode==0){
        $_SESSION['language'] = $_POST['language'];
        $posted = true;
    }     
}
if (!empty($_POST['description'])){
    $errorcode = $userDAO->updateUser($userID, NULL, NULL, $_POST['description'], NULL);
    echo $errorcode;
    if( $errorcode==0){
        $_SESSION['description'] = $_POST['description'];
        $posted = true;
    }     
}
if (!empty($_POST['icon'])){
    $errorcode = $userDAO->updateUser($userID, NULL, NULL, NULL, $_POST['icon']);
    echo $errorcode;
    if( $errorcode==0){
        $_SESSION['icon'] = $_POST['icon'];
        $posted = true;
    }     
}

if($posted) {
    header('Location: ../../changeprofile.php');
    exit();
}

?>