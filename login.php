<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team8 - Login</title>
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
            <h1>Anmelden</h1>
            <input class="data-input" type="text" name="" placeholder="Benutzername">
            <input class="data-input" type="password" name="" placeholder="Passwort">
            <input class="submit" type="submit" name="" value="Anmelden">
            <h3 onclick="location.href='registration.php'">Noch kein Account?</h3>
        </form>
    </main>
   
    <footer>
            <div class="footer">
                <?php include "php/footer.php";?>
            </div>
    </footer>
</body>
</html>
