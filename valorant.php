<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Team8 - Valorant</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
    <header>
        <div class="mainnav">
            <?php include "php/header.php";?>
        </div>
    </header>
    <h1>Valorant</h1>
    <input type="search" id="site-search" style="float: right" >

    <button style="float: right" >Suche Spieler</button>
    <div style="width: auto; padding-top: 20px">

        <aside style="width: 20%; float: left">
            <h2>Liga: </h2>

            <form>
                <input type="radio" id="Immortal" name="elo" value="Immortal">
                <label for="Immortal">Immortal</label><br>
                <input type="radio" id="dia" name="elo" value="dia">
                <label for="dia">Dia</label><br>
                <input type="radio" id="plat" name="elo" value="plat">
                <label for="plat">Plat</label><br>
                <input type="radio" id="gold" name="elo" value="gold">
                <label for="gold">Gold</label><br>
                <input type="radio" id="silber" name="elo" value="silber">
                <label for="silber">Silber</label><br>
                <input type="radio" id="bronze" name="elo" value="bronze">
                <label for="bronze">Bronze</label><br>

                <h2>Origin: </h2>

                <input type="radio" id="UnitedKingdom" name="origin" value="uk">
                <label for="UnitedKingdom">United Kingdom</label><br>
                <input type="radio" id="southKorea" name="origin" value="south korea">
                <label for="southKorea">jng</label><br>
                <input type="radio" id="usa" name="origin" value="usa">
                <label for="usa">USA</label><br>
                <input type="radio" id="russia" name="origin" value="russia">
                <label for="russia">Russia</label><br>
                <input type="radio" id=marocco name="origin" value="marocco">
                <label for="marocco">Marocco</label><br>
                <input type="radio" id="china" name="origin" value="china">
                <label for="china">China</label><br>
                <input type="radio" id="elsalvador" name="origin" value="elsalvador">
                <label for="elsalvador">El Salvador</label><br>
                <br>

                <input type="submit" value="Filtern">

            </form>

        </aside>
        <section style="float: inside; width: available">
            <table style="width: 80%;" border="3" cellpadding="5">
                <tbody>
                <tr>
                    <td width="300" height="300">
                        <p style="float: top">Spieler 1</p>
                        <ul>
                            <li>Name: </li>
                            <li>Elo: </li>
                            <li>Mains: </li>
                        </ul>
                    </td>
                    <td width="300" height="300">
                        <p style="float: top">Spieler 2</p>
                        <ul>
                            <li>Name: </li>
                            <li>Elo: </li>
                            <li>Mains: </li>
                        </ul>
                    </td>
                    <td width="300" height="300">
                        <p style="float: top">Spieler 3</p>
                        <ul>
                            <li>Name: </li>
                            <li>Elo: </li>
                            <li>Mains: </li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td width="300" height="300">
                        <p style="float: top">Spieler 4</p>
                        <ul>
                            <li>Name: </li>
                            <li>Elo: </li>
                            <li>Mains: </li>
                        </ul>
                    </td>
                    <td width="300" height="300">
                        <p style="float: top">Spieler 5</p>
                        <ul>
                            <li>Name: </li>
                            <li>Elo: </li>
                            <li>Mains: </li>
                        </ul>
                    </td>
                    <td width="300" height="300">
                        <p style="float: top">Spieler 6</p>
                        <ul>
                            <li>Name: </li>
                            <li>Elo: </li>
                            <li>Mains: </li>
                        </ul>
                    </td>
                </tr>
                </tbody>
            </table>
            <hr>
        </section>

    </div>    
    <footer>
            <div class="footer">
                <?php include "php/footer.php";?>
            </div>
    </footer>


</body>
</html>