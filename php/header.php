<?php
require_once "actions/session.php";
updateSession();

$isLoggedIn = $_SESSION['userid']> -1;
?>

<nav>
    <div class="grid-container">
        <div class="main-nav">
            <a id = "home-link" href="index.php">Home</a>
            <a id = "game-link" href="gameoverview.php">Spiele</a>
        </div>
        <form class="search-wrapper" action="search.php" method="get">
            <img class = search-icon src="Resourcen/Navigation/search-black-24dp.svg">
            <input class="search" type="text" placeholder="Nutzer suchen..." name="search">
        </form>
        <div class="profil-nav">
            <?php if ($isLoggedIn): ?>
                <a id = "message-link" href="chatoverview.php">Nachrichten</a>
                <a id = "profil-link" href="playerprofile.php">Profil</a>  
            <?php else: ?>
                <a class = "btn" id = "login-link" href="login.php?dest=profile">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>


