<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team8 - Profil bearbeiten</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
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
            <h2>Daten ändern</h2>

            <form id="registrationform"
                action="register.php" method="post">
                <fieldset><legend>Nutzerdaten</legend>
                <div>
                    <label for="username">Benutzername:</label> <input type="text"
                        id="username" name="username" required>
                </div>
                <div>
                    <label for="email">E-Mail:</label> <input type="email"
                        id="email" name="email" required>
                </div>
                <div>
                    <label for="password">Passwort:</label> <input type="text"
                        id="password" name="password" required>
                </div>
                <div>
                    <label for="validationpw">Passwort wiederholen:</label> <input type="text"
                        id="validationpw" name="validationpw" required>
                </div>
                </fieldset>
                <fieldset><legend>Beschreibung</legend>
                    <div>
                        <label>Spiele:</label> <br>
                        <label>
                            <input type="checkbox" name="games" value="valorant">
                            Valorant
                        </label>
                        <label>
                            <input type="checkbox" name="games" value="lol">
                            League of Legends
                        </label>
                        <label>
                            <input type="checkbox" name="games" value="csgo">
                            Counter Strike: Global Offensive
                        </label>
                        <label>
                            <input type="checkbox" name="games" value="cod">
                            Call of Duty
                        </label>
                        <label>
                            <input type="checkbox" name="games" value="other">
                            Sonstige
                        </label>
                        
                    </div>
                    <div>
                        <label for="description">Beschreibung:</label>
                        <textarea id="description" name="description" cols="20" rows="5"></textarea>
                    </div>   
                </fieldset>
                <div>
                    <input type="submit" value="Änderungen speichern">
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