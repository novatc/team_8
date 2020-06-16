<?php

include "db/UserDAO.php";
include "php/actions/session.php";
startSession();

$userDAO = new UserDAO("sqlite:db/Database.db");

$currentfriend = $_SESSION['frienduser'];
$currentfriendicon = $currentfriend->icon;
$currentfriendname = $currentfriend->username;
$currentfriendid = $currentfriend->userid;

$yourmessages = $userDAO->getMessages($_SESSION['userid'], $currentfriendid);


$validLogin = isset($_SESSION['user']);
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
                            <div class="chatcontainer" id="rocketleague" onclick="location.href='lol.php'">
                                <label class="gamelabel">Rocket League</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="chatbox" id="chathistory">
                    <div class="chatgrid">
                        <?php foreach($yourmessages as $message) :
                            if($message!=null) : ?>
                                <div class="iconSmall" id="avatarTeemo" onclick="location.href='playerprofile.php'"></div>
                                <p class="speech-bubble">
                                    <?= $message ?> </p>
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
