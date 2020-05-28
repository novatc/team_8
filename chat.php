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
        <h1></h1>
        <div id="wholechat">
            <!-- Header-->
            <div class="chatbox" id="chatheader">
                <div class="description">
                    <div class="headgrid">
                        <a href="playerprofile.php">
                            <div class="icon" id="avatarTeemo"></div>
                        </a>
                        <label id="name">Johannes:</label>
                        <div class="chatcardnopadding">
                            <div class="chatcontainer" id="rocketleague" onclick="location.href='lol.php'">
                                <label class="gamelabel">Rocket League</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <!-- der eigentliche Chat-->
                <!-- nur mit css ein Fehler -> noch kein scrolling ohne inline -->
                <div class="chatbox" id="chathistory">
                    <div class="chatgrid">

                        <div class="iconSmall" id="avatarTeemo" onclick="location.href='playerprofil.php'"></div>
                        <p class="speech-bubble">
                            dolor sit amet, consetetur sadipscing elitr
                        </p>

                        <div class="iconSmall" id="avatarBard" onclick="location.href='playerprofil.php'"></div>
                        <p class="speech-bubble-self">
                            sed diam nonumy eirmod tempor invidunt ut labore et dolore
                        </p>

                        <div class="iconSmall" id="avatarBard" onclick="location.href='playerprofil.php'"></div>
                        <p class="speech-bubble-self">
                            magna aliquyam erat, sed diam voluptua
                        </p>

                        <div class="iconSmall" id="avatarTeemo" onclick="location.href='playerprofil.php'"></div>
                        <p class="speech-bubble">
                            At vero eos et accusam et justo duo dolores et ea rebum
                        </p>

                        <div class="iconSmall" id="avatarBard" onclick="location.href='playerprofil.php'"></div>
                        <p class="speech-bubble-self">
                            Stet clita kasd gubergren, no sea takimata sanctus est
                            Lorem ipsum dolor sit amet.
                        </p>

                        <div class="iconSmall" id="avatarTeemo" onclick="location.href='playerprofil.php'"></div>
                        <p class="speech-bubble">
                            At vero eos et accusam et justo duo dolores et ea rebum.
                            Stet clita kasd
                        </p>

                        <div class="iconSmall" id="avatarBard" onclick="location.href='playerprofil.php'"></div>
                        <p class="speech-bubble-self">
                            Duis autem vel eum iriure dolor
                        </p>

                        <div class="iconSmall" id="avatarTeemo" onclick="location.href='playerprofil.php'"></div>
                        <p class="speech-bubble">
                            vel illum dolore eu feugiat nulla facilisis at vero
                            eros et accumsan et iusto
                        </p>

                        <div class="iconSmall" id="avatarBard" onclick="location.href='playerprofil.php'"></div>
                        <p class="speech-bubble-self">
                            vel illum dolore eu feugiat nulla facilisis at vero
                            eros et accumsan et iusto
                        </p>

                        <div class="iconSmall" id="avatarTeemo" onclick="location.href='playerprofil.php'"></div>
                        <p class="speech-bubble">
                            vel illum dolore eu feugiat nulla facilisis at vero
                            eros et accumsan et iusto
                        </p>


                    </div>
                </div>

                <!-- Senden-->
                <form id="messageform"
                    action="sendmessage.php" method="post">
                    <div class="chatbox">
                        <div class="bottomgrid">
                        <input class="sendMessage" type="text" id="password" name="password" required>
                        <input type="submit" value="Senden">
                        </div>
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
