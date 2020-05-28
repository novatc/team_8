<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
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
            <h1>Login</h1>
            <input type="text" name="" placeholder="Benutzername">
            <input type="password" name="" placeholder="Passwort">
            <input type="submit" name="" value="Login">
            <label onclick="location.href='registration.php'">Registrieren</label>
        </form>
    </main>
   
    <footer>
            <div class="footer">
                <?php include "php/footer.php";?>
            </div>
    </footer>
</body>
</html>
