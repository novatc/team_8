<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Team8</title>
</head>
<body>
    <header>
        <div class="mainnav">
            <?php include "../header.php";?>
        </div>
    </header>
<div id="wrapper">
    <div id="textarea">
        <h2>Login</h2>
        <form id="loginform"
            action="login.php" method="post">
            <fieldset>
            <div>
                <label for="username">Benutzername:</label> <input type="text"
                    id="username" name="username" required>
            </div>
            <div>
                <label for="password">Passwort:</label> <input type="text"
                    id="password" name="password" required>
            </div>
            </fieldset>
            <div>
                <input type="submit" value="Anmelden">
            </div>
        </form>
    </div>
    <!-- Ende textbereich -->
</div>
<!-- Ende wrapper -->

</body>
</html>
