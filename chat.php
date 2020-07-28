<?php

require_once "db/user_dao.php";
require_once "php/actions/session.php";
updateSession();

if($_SESSION['userid']==-1){
    header('Location: login.php?dest=chat');
    exit();
}
if(!isset($_GET['user'])){
    header('Location: chatoverview.php');
    exit();
}


$userDAO = new UserDAO("sqlite:db/Database.db");

$onlymessages = array();
$userID = $_SESSION['userid'];
$user = $userDAO->getUserByID($userID);
$usericonid = $user->iconid;

$chatpartnerID = $_GET['user'];
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
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team8 - Chat</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/chat.css">
    <link rel="stylesheet" type="text/css" href="css/icons.css">
    <link rel="stylesheet" type="text/css" href="css/cardgrid.css">
    
</head>
<body>
    <header>
        <div class="mainnav">
            <?php include "php/header.php";?>
        </div>
    </header>
    <main>
        <div id="wholechat">
            <!-- Header-->
            <div class="chatbox" id="chatheader">
                
                    <div class="headgrid">
                        <a href="chat.php">
                            <div class="iconChatHead" style="background-image: url('<?= 'Resourcen/Icons/' . $userDAO->getIcon($chatpartnericonid)->filename?>');"></div>
                        </a>
                        <label id="name"><?= $chatpartnername?></label>
                        <div class="chatcardnopadding">
                        </div>
                    </div>
                
            </div>
                <div class="chatbox" id="chathistory">
                    <div class="chatgrid">
                        <!-- extract sender and message from each sent package, react accordingly whether you are sender or receiver -->
                        <?php foreach($completemessages as $onemessage) :
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
                    </div>
                </div>
                <script>
                    var chat = document.getElementById("chathistory");
                    chat.scrollTop = chat.scrollHeight;
                </script>

                <!-- Senden-->
                <form id="messageform" action="php/actions/send_message_action.php?user=<?= $chatpartnerid?>" method="post">
                    <div class="chatbox" id="sendForm">
                        <div class="wrapper">
                            <input class="messageInput" type="text" name="message" placeholder="Schreibe eine Nachricht...">
                            <input type="submit" class="submitMessage" value="Senden">
                        </div>

                        <input type="hidden" name="token" value="<?=$_SESSION['token']?>"/>
                    </div>
                </form>
            </div>
            <!-- Ende textbereich -->
        </div>
        <!-- Ende wrapper -->
    </main>
    <footer>
            <div class="footer">
                <?php include "php/footer.php";?>
            </div>
    </footer>
</body>
</html>
