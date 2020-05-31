<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team8 - Profil bearbeiten</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/formular.css">
</head>
<body>
    <header>
        <div class="mainnav">
            <?php include "php/header.php";?>
        </div>
    </header>
    <main>
        <form class="box">
            <h1>Profil anpassen</h1>
            <textarea name="description" class="data-input" placeholder="Beschreibung" cols="30" rows="10"></textarea>
            <ul class="game-list">
                <li class="game-item">
                    <h2>LOL</h1>
                    <label class="radiobutton-container">Master
                        <input type="radio" name="lol">
                        <span class="checkmark"></span>
                    </label>
                    <label class="radiobutton-container">Diamant
                        <input type="radio" name="lol">
                        <span class="checkmark"></span>
                    </label>
                    <label class="radiobutton-container">Platin
                        <input type="radio" name="lol">
                        <span class="checkmark"></span>
                    </label>
                    <label class="radiobutton-container">Gold
                        <input type="radio" name="lol">
                        <span class="checkmark"></span>
                    </label>
                    <label class="radiobutton-container">Silber
                        <input type="radio" name="lol">
                        <span class="checkmark"></span>
                    </label>
                    <label class="radiobutton-container">Bronze
                        <input type="radio" name="lol">
                        <span class="checkmark"></span>
                    </label>
                </li>
                <li class="game-item">
                    <h2>Valorant</h1>
                    <label class="radiobutton-container">Master
                        <input type="radio" name="valorant">
                        <span class="checkmark"></span>
                    </label>
                    <label class="radiobutton-container">Diamant
                        <input type="radio" name="valorant">
                        <span class="checkmark"></span>
                    </label>
                    <label class="radiobutton-container">Platin
                        <input type="radio" name="valorant">
                        <span class="checkmark"></span>
                    </label>
                    <label class="radiobutton-container">Gold
                        <input type="radio" name="valorant">
                        <span class="checkmark"></span>
                    </label>
                    <label class="radiobutton-container">Silber
                        <input type="radio" name="valorant">
                        <span class="checkmark"></span>
                    </label>
                    <label class="radiobutton-container">Bronze
                        <input type="radio" name="valorant">
                        <span class="checkmark"></span>
                    </label>
                </li>
                <li class="game-item">
                    <h2>CSGO</h1>
                    <label class="radiobutton-container">Master
                        <input type="radio" name="csgo">
                        <span class="checkmark"></span>
                    </label>
                    <label class="radiobutton-container">Diamant
                        <input type="radio" name="csgo">
                        <span class="checkmark"></span>
                    </label>
                    <label class="radiobutton-container">Platin
                        <input type="radio" name="csgo">
                        <span class="checkmark"></span>
                    </label>
                    <label class="radiobutton-container">Gold
                        <input type="radio" name="csgo">
                        <span class="checkmark"></span>
                    </label>
                    <label class="radiobutton-container">Silber
                        <input type="radio" name="csgo">
                        <span class="checkmark"></span>
                    </label>
                    <label class="radiobutton-container">Bronze
                        <input type="radio" name="csgo">
                        <span class="checkmark"></span>
                    </label>
                </li>
                <li class="game-item">
                    <h2>Rocket League</h1>
                    <label class="radiobutton-container">Master
                        <input type="radio" name="rocket">
                        <span class="checkmark"></span>
                    </label>
                    <label class="radiobutton-container">Diamant
                        <input type="radio" name="rocket">
                        <span class="checkmark"></span>
                    </label>
                    <label class="radiobutton-container">Platin
                        <input type="radio" name="rocket">
                        <span class="checkmark"></span>
                    </label>
                    <label class="radiobutton-container">Gold
                        <input type="radio" name="rocket">
                        <span class="checkmark"></span>
                    </label>
                    <label class="radiobutton-container">Silber
                        <input type="radio" name="rocket">
                        <span class="checkmark"></span>
                    </label>
                    <label class="radiobutton-container">Bronze
                        <input type="radio" name="rocket">
                        <span class="checkmark"></span>
                    </label>
                </li>
            </ul>
            <input class="submit-btn" id="submit-form" type="submit" name="" value="Speichern">
        </form>

    </main>
    <footer>
            <div class="footer">
                <?php include "php/footer.php";?>
            </div>
    </footer>
</body>
</html>