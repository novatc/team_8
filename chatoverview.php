<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Team8 - Chat</title>
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
        <fieldset><legend>Aktiv</legend>
            <ul style="list-style-type:none">
                <li>
                    <form action="chat.php">
                        <img src="Resourcen/Icons/Teemo.jpg" alt="TEEMO" height="35" width="35"> &nbsp;
                        <input type="submit" value="Johannes">
                        <img src="Resourcen/call_of_duty.png" alt="CoD" height="50" width="150">
                    </form>
                </li>
                <li>
                    <form action="chat.php">
                        <img src="Resourcen/Icons/Furyhorn.png" alt="Furyhorn" height="35" width="35"> &nbsp;
                        <input type="submit" value="Lucas">
                        <img src="Resourcen/2000px-Valorant_logo.svg.png" alt="Valorant" height="50" width="150">
                    </form>
                </li>
                <li>
                    <form action="chat.php">
                        <img src="Resourcen/Icons/Featherknight.png" alt="Pingu" height="35" width="35"> &nbsp;
                        <input type="submit" value="Tim">
                        <img src="Resourcen/counter_strike.png" alt="CSGO" height="50" width="150">
                    </form>
                </li>
                <li>
                    <form action="chat.php">
                        <img src="Resourcen/Icons/Rammus.jpg" alt="Armordillo" height="35" width="35"> &nbsp;
                        <input type="submit" value="Nico"> 
                        <img src="Resourcen/500px-League_of_Legends_2019_vector.svg.png" alt="LoL" height="50" width="150">
                    </form>
                </li>
            </ul>
        </fieldset>
        <fieldset><legend>Freunde</legend>
            <ul style="list-style-type:none">
                <li>
                    <form action="chat.php">
                        <img src="Resourcen/Icons/Teemo.jpg" alt="TEEMO" height="35" width="35"> &nbsp;
                        <input type="submit" value="Johannes">
                    </form>
                </li>
                <li>
                    <form action="chat.php">
                        <img src="Resourcen/Icons/Zac.jpg" alt="Slime" height="35" width="35"> &nbsp;
                        <input type="submit" value="Phil">
                    </form>
                </li>
                <li>
                    <form action="chat.php">
                        <img src="Resourcen/Icons/Squid.jpg" alt="Squid" height="35" width="35"> &nbsp;
                        <input type="submit" value="Hendrick">
                    </form>
                </li>
                <li>
                    <form action="chat.php">
                        <img src="Resourcen/Icons/Spooky.jpg" alt="Ghost" height="35" width="35"> &nbsp;
                        <input type="submit" value="Florian">
                    </form>
                </li>
            </ul>
        </fieldset>
    </main>
    
    <footer>
            <div class="footer">
                <?php include "php/footer.php";?>
            </div>
    </footer>
</body>
</html>