<?php
require_once "actions/session.php";
updateSession();

require_once "db/user_dao.php";
$userDAO = new UserDAO("sqlite:db/Database.db");
$userID = $_SESSION['userid'];
$isLoggedIn = $userID > -1;
?>

<nav>
    <div class="grid-container">
        <div class="main-nav">
            <a id = "home-link" href="index.php">XX</a>
            <a id = "game-link" href="gameoverview.php">XX</a>
        </div>
        <form class="search-wrapper" action="search.php" method="get">
            <img class = search-icon src="Resourcen/Navigation/search-black-24dp.svg">
            <input class="search" type="text" placeholder="Nutzer suchen..." name="search">
        </form>
        <div class="profil-nav">
            <?php if ($isLoggedIn): ?>
                <div class="message-wrapper">
                    <a id = "message-link" href="chatoverview.php">XX</a>
                    <?php
                        $num = $userDAO->getNumberOfAllUnreadMessages($userID);
                        if($num>0): 
                    ?>
                            <label class="message-counter"><?= $num ?></label>
                    <?php endif?>
                </div>
                <a id = "profil-link" href="playerprofile.php">XX</a>  
            <?php else: ?>
                <a class = "btn" id = "login-link" href="login.php?dest=profile">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>


