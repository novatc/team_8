<?php

require_once "db/user_dao.php";
require_once "php/actions/session.php";
updateSession();

if($_SESSION['userid']==-1){
    header('Location: login.php?dest=chat');
    exit();
}

$userDAO = new UserDAO("sqlite:db/Database.db");

$onlymessages = array();
$you = $userDAO->getUserByID($_SESSION['userid']);
$youriconid = $you->iconid;

$frienduser = $userDAO->getUserByID($_GET['user']);
$friendiconid = $frienduser->iconid;
$friendname = $frienduser->username;
$friendid = $frienduser->userid;
$friendprofile = $profileurl = 'playerprofile.php?id= ' . $friendid;

//completemessages includes the senderID, receiverID and the message itself
$completemessages = $userDAO->getMessages($_SESSION['userid'], $friendid);
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
                        <a href="chat.php">
                            <div class="iconChatHead" style="background-image: url('<?= 'Resourcen/Icons/' . $userDAO->getIcon($friendiconid)->filename?>');"></div>
                        </a>
                        <label id="name"><?= $friendname?></label>
                        <div class="chatcardnopadding">
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
                                <div class="iconSmall" href='playerprofile.php' style="background-image: url('<?= 'Resourcen/Icons/' . $userDAO->getIcon($youriconid)->filename?>');"></div>
                                <p class="speech-bubble-self">
                                    <?= ($text) ?> </p>
                            <?php elseif($senderID != $_SESSION['userid']) : ?>
                                <div class="iconSmall" href='<?php echo $friendprofile?>' style="background-image: url('<?= 'Resourcen/Icons/' . $userDAO->getIcon($friendiconid)->filename?>');"></div>
                                <p class="speech-bubble">
                                    <?= $text ?> </p>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Senden-->
                <form id="messageform" action="php/actions/send_message_action.php?user=<?= $friendid?>" method="post">
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
