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
        <h1>Registrieren</h1>
        <input class="data-input" type="text" name="" placeholder="Benutzername">
        <input class="data-input" type="email" name="" placeholder="Mail">
        <input class="data-input" type="password" name="" placeholder="Passwort">
        <input class="data-input" type="password" name="" placeholder="Passwort wiederholen">
        <input class="submit" type="submit" name="" value="Registrieren">

    </form>

</main>

<footer>
    <div class="footer">
        <?php include "php/footer.php";?>
    </div>
</footer>
</body>
</html>
