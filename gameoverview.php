<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Team8 - Spieleseite</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
    <header>
        <div class="mainnav">
            <?php include "php/header.php";?>
        </div>
    </header>
    <h1>Spiele</h1>
    <input type="search" id="site-search" style="float: right" >

    <button style="float: right" >Suche</button>
    <div style="width: auto; padding-top: 20px">

        <aside style="width: 20%; float: left">
            <h2>Tags: </h2>

            <form>
                <input type="radio" id="shooter" name="tag" value="shooter">
                <label for="shooter">Shooter</label><br>
                <input type="radio" id="moba" name="tag" value="moba">
                <label for="moba">MOBA</label><br>
                <input type="radio" id="action" name="tag" value="action">
                <label for="action">Action</label><br>
                <input type="radio" id="adventure" name="tag" value="adventure">
                <label for="adventure">Adventure</label><br>
                <input type="radio" id="racing" name="tag" value="racing">
                <label for="racing">Racing</label><br>
                <input type="radio" id="simulation" name="tag" value="simulation">
                <label for="simulation">Simulation</label><br>

                <input type="submit" value="Filtern">

            </form>

        </aside>
        <!-- not using images as backgrounds for now, validator says it's not allowed in <td> -->
        <section>
            <table style="width: 80%;" border="3" cellpadding="5">
                <tbody>
                <tr>
                    <td width="300" height="300">
                        <a href="/team8/lol.php">
                            <img src="/team8/Resourcen/500px-League_of_Legends_2019_vector.svg.png" alt="LoL" height="100" width="300">
                        </a>
                        <p>&nbsp;</p>
                        <p style="float: top">Anzahl:</p>
                    </td>
                    <td width="300" height="300">
                        <a href="/team8/valorant.php">
                            <img src="/team8/Resourcen/2000px-Valorant_logo.svg.png" alt="Valorant" height="100" width="300">
                        </a>
                        <p>&nbsp;</p>
                        <p style="float: top">Anzahl:</p>
                    </td>
                    <td width="300" height="300">
                        <img src="/team8/Resourcen/counter_strike.png" alt="CSGO" height="100" width="300">
                        <p>&nbsp;</p>
                        <p style="float: top">Anzahl:</p>
                    </td>
                    <td width="300" height="300">
                        <img src="/team8/Resourcen/call_of_duty.png" alt="CoD" height="100" width="300">
                        <p>&nbsp;</p>
                        <p style="float: top">Anzahl:</p>
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