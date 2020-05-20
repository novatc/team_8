<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Team8 - Chat</title>
    <link rel="stylesheet" type="text/css" href="css/chatoverview.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/icons.css">
</head>
<body>
    <header>
        <div class="mainnav">
            <?php include "php/header.php";?>
        </div>
    </header>
    <main>
        <h1>Chatübersicht</h1>
        <div class="grid">
            <div></div>
            <div class="boxname">Aktive Chats</div>
            <div></div>
            <div class="boxname">Freunde</div>
            <div></div>
            <div class="scroll">
                <div class="gridActiveChats">
                    <!-- thought: need an extra wrapper div for flexbox before each "row" in the grid, did either wrap always or incorrectly though-->
                    <div class="icon" id="avatarTeemo" onclick="location.href='playerprofil.php'"></div>
                    <form action="chat.php">
                        <input class="startChat" type="submit" value="Johannes">
                    </form>
                    <img src="Resourcen/call_of_duty.png" alt="CoD" height="120" width="300">

                    <div class="icon" id="avatarFuryhorn" onclick="location.href='playerprofil.php'"></div>
                    <form action="chat.php">
                        <input class="startChat" type="submit" value="Lucas">
                    </form>
                    <img src="Resourcen/2000px-Valorant_logo.svg.png" alt="Valorant" height="120" width="300">

                    <div class="icon" id="avatarPingu" onclick="location.href='playerprofil.php'"></div>
                    <form action="chat.php">
                        <input class="startChat" type="submit" value="Tim">
                    </form>
                    <img src="Resourcen/counter_strike.png" alt="CSGO" height="120" width="300">

                    <div class="icon" id="avatarRammus" onclick="location.href='playerprofil.php'"></div>
                    <form action="chat.php">
                        <input class="startChat" type="submit" value="Nico">
                    </form>
                    <img src="Resourcen/500px-League_of_Legends_2019_vector.svg.png" alt="LoL" height="120" width="300">

                </div>
            </div>
            <div></div>
            <div class="scroll">
                <div class="gridFriends">
                    <div class="icon" id="avatarTeemo" onclick="location.href='playerprofil.php'"></div>
                    <form action="chat.php">
                        <input class="startChat" type="submit" value="Johannes">
                    </form>

                    <div class="icon" id="avatarZac" onclick="location.href='playerprofil.php'"></div>
                    <form action="chat.php">
                        <input class="startChat" type="submit" value="Phil">
                    </form>

                    <div class="icon" id="avatarSquid" onclick="location.href='playerprofil.php'"></div>
                    <form action="chat.php">
                        <input class="startChat" type="submit" value="Hendrick">
                    </form>

                    <div class="icon" id="avatarSpook" onclick="location.href='playerprofil.php'"></div>
                    <form action="chat.php">
                        <input class="startChat" type="submit" value="Florian">
                    </form>
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