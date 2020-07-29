<?php

//config.php

//Include Google Client Library for PHP autoload file
if(file_exists('GoogleAPI/vendor/autoload.php') ){
    require_once 'GoogleAPI/vendor/autoload.php';
}else{
    require_once '../../GoogleAPI/vendor/autoload.php';
}

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('972566574192-8bi62ksmrmthhpn4q4e11q5is0p6vm4r.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('_qgEJEnJphojJq46Iwdj8xhF');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/team8/login.php');

//
$google_client->addScope('email');

$google_client->addScope('profile');

?>
