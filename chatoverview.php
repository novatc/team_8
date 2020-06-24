<?php
require_once "php/actions/session.php";
updateSession();

if($_SESSION['userid']==-1){
    header('Location: login.php?dest=chat');
    exit();
}

require_once "db/user_dao.php";

$friendlist = array();
$userDAO = new UserDAO("sqlite:db/Database.db");
$yourfriendids = $userDAO ->getFriends($_SESSION['userid']);

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
            <div class="boxname" id="active">Aktive Chats</div>
            <div></div>
            <div class="boxname" id="friends">Freunde</div>
            <div></div>
            <div class="scroll" id="activeChats">
                <div class="gridActiveChats">
                    <?php if(isset($_SESSION['activechats'])) : ?>
                        <?php $array = $_SESSION['activechats']; ?>
                        <?php foreach($array as $item) :
                            $activeIcon = $item->icon;
                            $activeName = $item->username;
                            $activeID = $item->userid;
                            $profileurl = 'playerprofile.php?id= ' . $activeID ;?>
                            <div class="icon" id=<?= htmlspecialchars($activeIcon) ?> onclick="location.href='<?php echo htmlspecialchars($profileurl)?>'"></div>
                            <form action="chat.php">
                                <input class="startChat" type="submit" value=<?= htmlspecialchars($activeName) ?>>
                            </form>
                            <div class="chatcard">
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div></div>
            <div class="scroll" id="friendsList">
                <div class="gridFriends">

                    <?php foreach($yourfriendids as $friend) :
                        $frienduser = $userDAO ->getUserByID($friend);
                        $friendicon = $frienduser->icon;
                        $friendusername = $frienduser->username;
                        $friendID = $frienduser->userid;
                        $profileurl = 'playerprofile.php?id= ' . $friendID ;
                        array_push($friendlist, $friendicon);?>
                        <div class="icon" id= <?= htmlspecialchars($friendicon) ?> onclick="location.href='<?php echo htmlspecialchars($profileurl)?>'"></div>
                        <form action="php/actions/start_chat_action.php" method="post">
                            <input class="startChat" type="submit" name="friend" value=<?= htmlspecialchars($friendusername) ?>>
                        </form>
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