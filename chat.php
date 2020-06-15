<?php
include "php/actions/session.php";
startSession();

$currentfriend = $_SESSION['frienduser'];
$currentfriendicon = $currentfriend->icon;
$currentfriendname = $currentfriend->username;

$validLogin = isset($_SESSION['user']);
$messages = array(); //just an empty array to stop errors when $_SESSION['messages'] is not yet initialized.
$result = array(); //foreach can't call $_SESSION['messages'] properly, so the contents are copied to this array for output.

if (true){ //valid login later

    //reason for if:isset($_POST['message']: no empty speech bubbles on empty chat. isset($_SESSION['messagesexist']: save chat for whole session (will be replaced with database)
    if(isset($_POST['message']) OR isset($_SESSION['messagesexist'])){
        if(!isset($_SESSION['messages'])) {
            $_SESSION['messages'] = $messages;
        }

        //unoptimized workaround: if you reload the page, your last message will be repeated and put into a new speech
        //bubble without this. Now, this is prevented, but you can't send the same message twice in a row.
        if(end($_SESSION['messages']) != $_POST['message'] && isset($_POST['message'])) {
            array_push($_SESSION['messages'], $_POST['message']);
        }
        $result = $_SESSION['messages'];

        /*unset($_POST['message']); tried to unset POST variable in case you reload the chat without sending anything,
                                    but the if statement (if(isset($_POST['message'])) still goes through, hence
                                    the workaround with if(end()). */
        $_SESSION['messagesexist'] = true;

    }else{
        $message = '';
    }

} else{
    $username = '';
    $message='';
}
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
    <link rel="stylesheet" type="text/css" href="css/games.css">

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
                        <a href="playerprofile.php">
                            <div class="iconChatHead" id=<?=$currentfriendicon?>></div>
                        </a>
                        <label id="name"><?=$currentfriendname?></label>
                        <div class="chatcardnopadding">
                            <div class="chatcontainer" id="rocketleague" onclick="location.href='lol.php'">
                                <label class="gamelabel">Rocket League</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="chatbox" id="chathistory">
                    <div class="chatgrid">

                        <div class="iconSmall" id="avatarTeemo" onclick="location.href='playerprofile.php'"></div>
                        <p class="speech-bubble">
                            dolor sit amet, consetetur sadipscing elitr
                        </p>

                        <div class="iconSmall" id="avatarBard" onclick="location.href='playerprofile.php'"></div>
                        <p class="speech-bubble-self">
                            sed diam nonumy eirmod tempor invidunt ut labore et dolore
                        </p>

                        <div class="iconSmall" id="avatarBard" onclick="location.href='playerprofile.php'"></div>
                        <p class="speech-bubble-self">
                            magna aliquyam erat, sed diam voluptua
                        </p>

                        <div class="iconSmall" id="avatarTeemo" onclick="location.href='playerprofile.php'"></div>
                        <p class="speech-bubble">
                            At vero eos et accusam et justo duo dolores et ea rebum
                        </p>

                        <div class="iconSmall" id="avatarBard" onclick="location.href='playerprofile.php'"></div>
                        <p class="speech-bubble-self">
                            Stet clita kasd gubergren, no sea takimata sanctus est
                            Lorem ipsum dolor sit amet.
                        </p>

                        <div class="iconSmall" id="avatarTeemo" onclick="location.href='playerprofile.php'"></div>
                        <p class="speech-bubble">
                            At vero eos et accusam et justo duo dolores et ea rebum.
                            Stet clita kasd
                        </p>

                        <div class="iconSmall" id="avatarBard" onclick="location.href='playerprofile.php'"></div>
                        <p class="speech-bubble-self">
                            Duis autem vel eum iriure dolor
                        </p>

                        <div class="iconSmall" id="avatarTeemo" onclick="location.href='playerprofile.php'"></div>
                        <p class="speech-bubble">
                            vel illum dolore eu feugiat nulla facilisis at vero
                            eros et accumsan et iusto
                        </p>

                        <div class="iconSmall" id="avatarBard" onclick="location.href='playerprofile.php'"></div>
                        <p class="speech-bubble-self">
                            vel illum dolore eu feugiat nulla facilisis at vero
                            eros et accumsan et iusto
                        </p>

                        <?php if(isset($_SESSION['messagesexist'])) : ?>
                            <?php if($_SESSION['messagesexist'] == true) : ?>
                                <?php foreach($result as $newmessage => $val) : ?>
                                    <div class="iconSmall" id="avatarTeemo" onclick="location.href='playerprofile.php'"></div>
                                    <p class="speech-bubble">
                                        <?= $val ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endif; ?>

                    </div>
                </div>

                <!-- Senden-->
                <form id="messageform" action="" method="post">
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
