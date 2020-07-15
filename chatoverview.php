<?php
require_once "php/actions/session.php";
updateSession();

if($_SESSION['userid']==-1){
    header('Location: login.php?dest=chat');
    exit();
}
$userID = $_SESSION['userid'];
require_once "db/user_dao.php";

$friendlist = array();
$userDAO = new UserDAO("sqlite:db/Database.db");
$friendids = $userDAO->getFriends($userID);
$chatpartnerids = $userDAO->getChats($userID);
echo implode(", ", $chatpartnerids);
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team8 - Chat</title>
    <link rel="stylesheet" type="text/css" href="css/chatoverview.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
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
        <h1>Chatübersicht</h1>
        <div class="chat-grid">
            <div></div>
            <div class="boxname" id="active">Alle Chats</div>
            <div></div>
            <div class="boxname" id="friends">Freunde</div>
            <div></div>
            <div class="scroll" id="activeChats">
                <div class="gridActiveChats">
                        <?php foreach($chatpartnerids as $partnerid) :
                            $user = $userDAO ->getUserByID($partnerid);
                            $iconid = $user->iconid;
                            $name = $user->username;
                            $id = $user->userid;
                            $profileurl = 'playerprofile.php?id=' . $id ;?>
                            <a class="icon" href='<?= $profileurl?>' style="background-image: url('<?= 'Resourcen/Icons/' . $userDAO->getIcon($iconid)->filename?>');"></a>
                            <a class="startChat" href="chat.php?user=<?= $id?>"><?= $name?></a>
                            <div class="chatcard">
                            </div>
                        <?php endforeach; ?>
                </div>
            </div>
            <div></div>
            <div class="scroll" id="friendsList">
                <div class="gridFriends">

                    <?php foreach($friendids as $friendid) :
                        $frienduser = $userDAO ->getUserByID($friendid);
                        $friendiconid = $frienduser->iconid;
                        $friendname = $frienduser->username;
                        $profileurl = 'playerprofile.php?id=' . $friendid;?>
                        <a class="icon" href='<?= $profileurl?>' style="background-image: url('<?= 'Resourcen/Icons/' . $userDAO->getIcon($friendiconid)->filename?>');"></a>
                        <a class="startChat" href="chat.php?user=<?= $friendid?>"><?= $friendname?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </main>

    
    <footer>
            <div class="footer">
                <?php include "php/footer.php";?>
            </div>
    </footer>
</body>
</html>