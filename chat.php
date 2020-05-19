<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Team8 - Chat</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/chat.css">
</head>
<body>
    <header>
        <div class="mainnav">
            <?php include "php/header.php";?>
        </div>
    </header>
    <main>
        <div id="wrapper">
            <div id="textarea">
                <h2>Chat</h2>
                <!-- Chatbox mit hilfe der CSS stylen -->
                <h3>Dein aktiver Chat mit Johannes 
                    <a href="playerprofil.php">
                        <img src="Resourcen/Icons/Teemo.jpg" alt="TEEMO" height="35" width="35">
                </a>:
                    <img src="Resourcen/call_of_duty.png" alt="CoD" height="70" width="300"></h3>
                <div id="chatbox">
                    <ul style="list-style-type:none">
                        <li>
                            <p>
                            <div id="avatarT"></div>[Johannes]: Lorem ipsum
                            </p>
                        </li>
                        <li>
                            <p>
                            <div id="avatarB"></div>[Du]: dolor sit amet, consetetur sadipscing elitr
                            </p>
                        </li>
                        <li>
                            <p>
                            <div id="avatarB"></div>[Du]: sed diam nonumy eirmod tempor invidunt ut labore et dolore
                            </p>
                        </li>
                        <li>
                            <p>
                            <div id="avatarT"></div>[Johannes]: magna aliquyam erat, sed diam voluptua
                            </p>
                        </li>
                        <li>
                            <p>
                            <div id="avatarB"></div>[Du]: At vero eos et accusam et justo duo dolores et ea rebum
                            </p>
                        </li>
                        <li>
                            <p>
                            <div id="avatarT"></div>[Johannes]: Stet clita kasd gubergren, no sea takimata sanctus est
                            Lorem ipsum dolor sit amet.
                            </p>
                        </li>
                        <li>
                            <p>
                            <div id="avatarB"></div>[Du]: At vero eos et accusam et justo duo dolores et ea rebum. Stet
                            clita kasd gubergren, no sea takimata <br> sanctus est Lorem ipsum dolor sit amet. Lorem
                            ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy <br> eirmod tempor
                            invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
                            </p>
                        </li>
                        <li>
                            <p>
                            <div id="avatarT"></div>[Johannes]: At vero eos et accusam et justo duo dolores et ea rebum.
                            Stet clita kasd
                            </p>
                        </li>
                        <li>
                            <p>
                            <div id="avatarB"></div>[Du]: Duis autem vel eum iriure dolor
                            </p>
                        </li>
                        <li>
                            <p>
                            <div id="avatarT"></div>[Johannes]: vel illum dolore eu feugiat nulla facilisis at vero
                            eros et accumsan et iusto
                            </p>
                        </li>
                    </ul>
                </div>

                <!-- Formular zum senden von Nachrichten -->
                <form id="messageform"
                    action="sendmessage.php" method="post">
                    <div>
                        <input type="text"
                            id="password" name="password" required> <input type="submit" value="Senden">
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
