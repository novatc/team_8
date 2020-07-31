<?php
require_once "db/user_dao.php";
require_once "php/actions/session.php";
updateSession();

$userDAO = new UserDAO("sqlite:db/Database.db");

$userID = $_SESSION['userid'];
$user = $userDAO->getUserByID($userID);
$usericonid = $user->iconid;

$chatpartnerID = $_SESSION['chatpartner'];
$chatpartner = $userDAO->getUserByID($chatpartnerID);
$chatpartnericonid = $chatpartner->iconid;
$chatpartnername = $chatpartner->username;
$chatpartnerid = $chatpartner->userid;
$chatpartnerprofile = $profileurl = 'playerprofile.php?id= ' . $chatpartnerid;

//completemessages includes the senderID, receiverID and the message itself
$completemessages = $userDAO->getMessages($_SESSION['userid'], $chatpartnerid);
//decode stdObject to Array for usability
$completemessages = json_decode(json_encode($completemessages), true);

// Read messages
$userDAO->readMessages($userID, $chatpartnerID);

// extract sender and message from each sent package, react accordingly whether you are sender or receiver 

foreach($completemessages as $onemessage) :
    $senderID = reset($onemessage);
    $text = end($onemessage);
    if($senderID == $_SESSION['userid']) : ?>
        <p class="speech-bubble-self">
            <?= ($text) ?> </p>
        <div class="icon-self" style="background-image: url('<?= 'Resourcen/Icons/' . $userDAO->getIcon($usericonid)->filename?>');"></div>
        
    <?php elseif($senderID != $_SESSION['userid']) : ?>
        <div class="icon-user" style="background-image: url('<?= 'Resourcen/Icons/' . $userDAO->getIcon($chatpartnericonid)->filename?>');"></div>
        <p class="speech-bubble-user">
            <?= $text ?> </p>
    <?php endif; ?>
<?php endforeach; ?>