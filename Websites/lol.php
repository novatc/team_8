<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Team8 - LOL</title>
</head>
<body>
    <header>
        <div class="mainnav">
            <?php include "../header.php";?>
        </div>
    </header>
<h1>Spielerseite</h1>
<input type="search" id="site-search" style="float: right" >

<button style="float: right" >Suche Spieler</button>
<div style="width: auto; padding-top: 20px">

    <aside style="width: 20%; float: left">
        <h2>Liga: </h2>

        <form>
            <input type="radio" id="master" name="elo" value="master">
            <label for="master">Master</label><br>
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

            <h2>Position: </h2>

            <input type="radio" id="top" name="position" value="top">
            <label for="master">Top</label><br>
            <input type="radio" id="jng" name="position" value="jng">
            <label for="master">jng</label><br>
            <input type="radio" id="mid" name="position" value="mid">
            <label for="master">mid</label><br>
            <input type="radio" id="bot" name="position" value="bot">
            <label for="master">bot</label><br>
            <input type="radio" id=sup name="position" value="sup">
            <label for="master">sup</label><br>
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


</body>
</html>