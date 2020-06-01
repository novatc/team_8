<?php
session_start();

$validLogin = isset($_SESSION['user']);
$posted = false;
if ($validLogin){
    $username = $_SESSION['user'];
    $age = $_SESSION['age'];
    $description = $_SESSION['description'];
    $language = $_SESSION['language'];
} else{
    $username = '';
    $description = '';
    $language = '';
}

$fields = array('age','language', 'description');
foreach ($fields as $field){
    if (!empty($_POST[$field])){
        $_SESSION[$field] = $_POST[$field];
        $posted = true;
    }
}

if($posted) {
    header('Location: changeprofile.php');
    exit();
}

?>
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
        <form class="box" method="post">
            <h1>Profil anpassen</h1>
            <div class="input-wrapper">
                <textarea name="description" class="textarea-input" cols="30" rows="10"><?= htmlspecialchars($description)?></textarea>
                <label class="top-label">Beschreibung</label>
            </div> 
            <div class="input-wrapper">
                <input class="data-input" type="number" name="age" value= "<?= htmlspecialchars($age)?>">
                <label class="left-label">Alter</label>
            </div>
            <div class="input-wrapper">
                <input class="data-input" type="text" name="language" value= "<?= htmlspecialchars($language)?>">
                <label class="left-label">Sprachen</label>
            </div>
            
            <input class="submit-btn" id="submit-form" type="submit" name="changesubmit" value="Speichern">
        </form>

    </main>
    <footer>
            <div class="footer">
                <?php include "php/footer.php";?>
            </div>
    </footer>
</body>
</html>