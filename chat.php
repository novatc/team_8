<?php

include "db/UserDAO.php";
include "php/actions/session.php";
startSession();

$userDAO = new UserDAO("sqlite:db/Database.db");

$onlymessages = array();
$you = $userDAO->getUserByID($_SESSION['userid']);
$youricon = $you->icon;

$currentfriend = ($_SESSION['frienduser']);
$currentfriendicon = $currentfriend->icon;
$currentfriendname = $currentfriend->username;
$currentfriendid = $currentfriend->userid;

//completemessages includes the senderID, receiverID and the message itself
$completemessages = $userDAO->getMessages($_SESSION['userid'], $currentfriendid);
//decode stdObject to Array for usability
$completemessages = json_decode(json_encode($completemessages), true);
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
    <link rel="stylesheet" type="text/css" href="css/games.css">

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
                <div class="description">
                    <div class="headgrid">
                        <a href="playerprofile.php">
                            <div class="iconChatHead" id=<?=$currentfriendicon?>></div>
                        </a>
                        <label id="name"><?=$currentfriendname?></label>
                        <div class="chatcardnopadding">
                            <div class="chatcontainer" id="rl" onclick="location.href='lol.php'">
                                <label class="gamelabel">Rocket League</label>
                            </div>
                        </div>
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
                                <div class="iconSmall" id=<?= $youricon ?> onclick="location.href='playerprofile.php'"></div>
                                <p class="speech-bubble-self">
                                    <?= $text ?> </p>
                            <?php elseif($senderID != $_SESSION['userid']) : ?>
                                <div class="iconSmall" id=<?= $currentfriendicon ?> onclick="location.href='playerprofile.php'"></div>
                                <p class="speech-bubble">
                                    <?= $text ?> </p>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Senden-->
                <form id="messageform" action="php/actions/sendmessageaction.php" method="post">
                    <div class="chatbox" id="sendForm">
                        <input class="data-input" id="sendMessage" type="text" name="message" required placeholder="Schreibe eine Nachricht...">
                        <input type="submit" id="sendButton" value="Senden">
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
