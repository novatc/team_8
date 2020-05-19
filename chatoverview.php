<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Team8 - Chat</title>
    <link rel="stylesheet" type="text/css" href="css/chatoverview.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
    <header>
        <div class="mainnav">
            <?php include "php/header.php";?>
        </div>
    </header>
    <main>
        <h1>Deine Chats</h1>
        <div class="grid">
            <div class="scroll">
                <fieldset><legend>Aktiv</legend>
                    <div class="gridActiveChats">

                        <div class="icon" id="avatarTeemo"></div>
                        <form action="chat.php">
                            <input type="submit" value="Johannes">
                        </form>
                        <img src="Resourcen/call_of_duty.png" alt="CoD" height="120" width="300">

                        <div class="icon" id="avatarFuryhorn"></div>
                        <form action="chat.php">
                            <input type="submit" value="Lucas">
                        </form>
                        <img src="Resourcen/2000px-Valorant_logo.svg.png" alt="Valorant" height="120" width="300">

                        <div class="icon" id="avatarPingu"></div>
                        <form action="chat.php">
                            <input type="submit" value="Tim">
                        </form>
                        <img src="Resourcen/counter_strike.png" alt="CSGO" height="120" width="300">

                        <div class="gridActiveChatsItem" id="avatarRammus"></div>
                        <form action="chat.php">
                            <input type="submit" value="Nico">
                        </form>
                        <img src="Resourcen/500px-League_of_Legends_2019_vector.svg.png" alt="LoL" height="120" width="300">

                    </div>
                </fieldset>
            </div>
            <div class="scroll">
                <fieldset><legend>Freunde</legend>
                    <div class="gridFriends">
                        <div class="icon" id="avatarTeemo"></div>
                        <form action="chat.php">
                            <input type="submit" value="Johannes">
                        </form>

                        <div class="icon" id="avatarZac"></div>
                        <form action="chat.php">
                            <input type="submit" value="Phil">
                        </form>

                        <div class="icon" id="avatarSquid"></div>
                        <form action="chat.php">
                            <input type="submit" value="Hendrick">
                        </form>

                        <div class="icon" id="avatarSpook"></div>
                        <form action="chat.php">
                            <input type="submit" value="Florian">
                        </form>
                    </div>
                </fieldset>
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