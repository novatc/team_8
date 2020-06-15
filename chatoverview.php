<?php
include "db/UserDAO.php";
include "php/actions/session.php";
startSession();

$userDAO = new UserDAO;
$yourfriends = $userDAO ->getFriends($_SESSION['userid']);

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
                    <!-- thought: need an extra wrapper div for flexbox before each "row" in the grid, did either wrap always or incorrectly though-->
                    <div class="icon" id="avatarTeemo" onclick="location.href='playerprofile.php'"></div>
                    <form action="chat.php">
                        <input class="startChat" type="submit" value="Johannes">
                    </form>
                    <div class="chatcard">
                        <div class="chatcontainer" id="rocketleague" onclick="location.href='lol.php'">
                            <label class="gamelabel">Rocket League</label>
                        </div>
                    </div>

                    <div class="icon" id="avatarFuryhorn" onclick="location.href='playerprofile.php'"></div>
                    <form action="chat.php">
                        <input class="startChat" type="submit" value="Lucas">
                    </form>
                    <div class="chatcard">
                        <div class="chatcontainer" id="valorant" onclick="location.href='lol.php'">
                            <label class="gamelabel">Valorant</label>
                        </div>
                    </div>

                    <div class="icon" id="avatarPingu" onclick="location.href='playerprofile.php'"></div>
                    <form action="chat.php">
                        <input class="startChat" type="submit" value="Tim">
                    </form>
                    <div class="chatcard">
                        <div class="chatcontainer" id="csgo" onclick="location.href='lol.php'">
                            <label class="gamelabel">CS:GO</label>
                        </div>
                    </div>

                    <div class="icon" id="avatarRammus" onclick="location.href='playerprofile.php'"></div>
                    <form action="chat.php">
                        <input class="startChat" type="submit" value="Nico">
                    </form>
                    <div class="chatcard">
                        <div class="chatcontainer" id="lol" onclick="location.href='lol.php'">
                            <label class="gamelabel">League of Legends</label>
                        </div>
                    </div>

                </div>
            </div>
            <div></div>
            <div class="scroll" id="friendsList">
                <div class="gridFriends">

                    <?php while ($zeile = $yourfriends->fetchArray()) : ?>
                        <div class="icon" id="avatarTeemo" onclick="location.href='playerprofile.php'"></div>
                        <form action="chat.php">
                            <input class="startChat" type="submit" value="Johannes">
                        </form>
                    <?php endwhile; ?>



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