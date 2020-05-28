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
                    <ul class="elo-list">
                        <li><input type="radio" id="master" name="elo" value="master">
                        <label for="master">Master</label></li>
                        <li><input type="radio" id="dia" name="elo" value="dia" >
                        <label for="dia">Dia</label></li>
                        <li> <input type="radio" id="plat" name="elo" value="plat">
                        <label for="plat">Plat</label></li>
                        <li><input type="radio" id="gold" name="elo" value="gold">
                        <label for="gold">Gold</label></li>
                        <li><input type="radio" id="silber" name="elo" value="silber">
                        <label for="silber">Silber</label></li>
                        <li><input type="radio" id="bronze" name="elo" value="bronze">
                        <label for="bronze">Bronze</label></li>
                    </ul>
                </li>
                <li class="game-item">
                    <h2>Valorant</h1>
                    <ul class="elo-list">
                        <li><input type="radio" id="master" name="elo" value="master">
                        <label for="master">Master</label></li>
                        <li><input type="radio" id="dia" name="elo" value="dia" >
                        <label for="dia">Dia</label></li>
                        <li> <input type="radio" id="plat" name="elo" value="plat">
                        <label for="plat">Plat</label></li>
                        <li><input type="radio" id="gold" name="elo" value="gold">
                        <label for="gold">Gold</label></li>
                        <li><input type="radio" id="silber" name="elo" value="silber">
                        <label for="silber">Silber</label></li>
                        <li><input type="radio" id="bronze" name="elo" value="bronze">
                        <label for="bronze">Bronze</label></li>
                    </ul>
                </li>
                <li class="game-item">
                    <h2>CSGO</h1>
                    <ul class="elo-list">
                        <li><input type="radio" id="master" name="elo" value="master">
                        <label for="master">Master</label></li>
                        <li><input type="radio" id="dia" name="elo" value="dia" >
                        <label for="dia">Dia</label></li>
                        <li> <input type="radio" id="plat" name="elo" value="plat">
                        <label for="plat">Plat</label></li>
                        <li><input type="radio" id="gold" name="elo" value="gold">
                        <label for="gold">Gold</label></li>
                        <li><input type="radio" id="silber" name="elo" value="silber">
                        <label for="silber">Silber</label></li>
                        <li><input type="radio" id="bronze" name="elo" value="bronze">
                        <label for="bronze">Bronze</label></li>
                    </ul>
                </li>
                <li class="game-item">
                    <h2>Rocket League</h1>
                    <ul class="elo-list">
                        <li><input type="radio" id="master" name="elo" value="master">
                        <label for="master">Master</label></li>
                        <li><input type="radio" id="dia" name="elo" value="dia" >
                        <label for="dia">Dia</label></li>
                        <li> <input type="radio" id="plat" name="elo" value="plat">
                        <label for="plat">Plat</label></li>
                        <li><input type="radio" id="gold" name="elo" value="gold">
                        <label for="gold">Gold</label></li>
                        <li><input type="radio" id="silber" name="elo" value="silber">
                        <label for="silber">Silber</label></li>
                        <li><input type="radio" id="bronze" name="elo" value="bronze">
                        <label for="bronze">Bronze</label></li>
                    </ul>
                </li>
            </ul>
            <input class="submit" type="submit" name="" value="Speichern">
        </form>

    </main>
    <footer>
            <div class="footer">
                <?php include "php/footer.php";?>
            </div>
    </footer>
</body>
</html>