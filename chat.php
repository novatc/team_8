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
$_SESSION['chatpartner']= $chatpartnerID;
$chatpartner = $userDAO->getUserByID($chatpartnerID);
$chatpartnericonid = $chatpartner->iconid;
$chatpartnername = $chatpartner->username;
$chatpartnerprofile = $profileurl = 'playerprofile.php?id= ' . $chatpartnerID;

//completemessages includes the senderID, receiverID and the message itself
$completemessages = $userDAO->getMessages($_SESSION['userid'], $chatpartnerID);
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
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        function autoRefresh_chat()
        {
            $("#chat").load("load_chat.php").show();
        }
        
        setInterval('autoRefresh_chat()', 1000);
    </script>
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
                    <input type="hidden" name="receiver" value="<?=$chatpartnerID?>">
                    <a href="chat.php">
                        <div class="iconChatHead" style="background-image: url('<?= 'Resourcen/Icons/' . $userDAO->getIcon($chatpartnericonid)->filename?>');"></div>
                    </a>
                    <label id="name"><?= $chatpartnername?></label>
                    <div class="chatcardnopadding">
                    </div>
                </div>
            
            </div>
            <div class="chatbox" id="chathistory">
                <div class="chatgrid" id="chat">
                <?php
                    include("load_chat.php");
                ?> 
                </div>
            </div>
            <!-- Senden-->
            <form action="php/actions/send_message_action.php?user=<?= $chatpartnerID?>" method="post" id="messageform" name="messageform">
                <div class="chatbox" id="sendForm">
                    <div class="wrapper">
                        <input class="messageInput" id="messageInput" type="text" name="message" placeholder="Schreibe eine Nachricht...">
                        <input type="submit" class="submitMessage" value="Senden">
                    </div>
                    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf_token']?>">
                </div>
            </form>
        </div>
    </main>
    <script>
        var chat = document.getElementById("chathistory");
        chat.scrollTop = chat.scrollHeight;
        var input = document.getElementById('messageInput');
        input.focus();
        input.select();
    </script>
    <footer>
        <div class="footer">
            <?php include "php/footer.php";?>
        </div>
    </footer>
</body>
</html>
