<?php

include "db/user_dao.php";
include "php/actions/session.php";
startSession();

$friendlist = array();
$userDAO = new UserDAO("sqlite:db/databse.db");
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
                            <div class="icon" id=<?= $activeIcon ?> onclick="location.href='<?php echo $profileurl?>'"></div>
                            <form action="chat.php">
                                <input class="startChat" type="submit" value=<?= $activeName ?>>
                            </form>
                            <div class="chatcard">
                                <div class="chatcontainer" id="rl" onclick="location.href='lol.php'">
                                    <label class="gamelabel">Rocket League</label>
                                </div>
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
                        <div class="icon" id= <?=$friendicon?> onclick="location.href='<?php echo $profileurl?>'"></div>
                        <form action="php/actions/start_chat_action.php" method="post">
                            <input class="startChat" type="submit" name="friend" value=<?=$friendusername?>>
                        </form>
                    <?php endforeach; ?>



                    <!--<div class="icon" id="avatarTeemo" onclick="location.href='playerprofile.php'"></div>
                    <form action="chat.php">
                        <input class="startChat" type="submit" value="Johannes">
                    </form>

                    <div class="icon" id="avatarZac" onclick="location.href='playerprofile.php'"></div>
                    <form action="chat.php">
                        <input class="startChat" type="submit" value="Phil">
                    </form>

                    <div class="icon" id="avatarSquid" onclick="location.href='playerprofile.php'"></div>
                    <form action="chat.php">
                        <input class="startChat" type="submit" value="Hendrick">
                    </form>

                    <div class="icon" id="avatarSpook" onclick="location.href='playerprofile.php'"></div>
                    <form action="chat.php">
                        <input class="startChat" type="submit" value="Florian">
                    </form>-->
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