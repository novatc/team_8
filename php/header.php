<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$validLogin = isset($_SESSION['user']);
?>

<nav>
    <div class="grid-container">
        <div class="main-nav">
            <a class = "home-link" href="index.php">Home</a>
            <a class = "game-link" href="gameoverview.php">Spiele</a>
        </div>
        <div class="search-wrapper">
            <img class= search-icon src="Resourcen/Navigation/search-black-24dp.svg">
            <input class="search" type="text" placeholder="Suche.." name="search">
        </div> 
        <div class="profil-nav">
            <?php if ($validLogin): ?>
                <a class = "message-link" href="chatoverview.php">Nachrichten</a>
                <a class = "profil-link" href="playerprofile.php">Profil</a>  
            <?php else: ?>
                <a class = "login-link" href="login.php">Anmelden</a>
            <?php endif; ?>
        </div>
    </div>
</nav>


