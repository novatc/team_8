<?php
require_once "php/actions/session.php";
updateSession();

require_once "db/user_dao.php";

$userDAO = new UserDAO("sqlite:db/Database.db");
$search = $_GET['search'];
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team8 - Results</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/cardgrid.css">
    <link rel="stylesheet" type="text/css" href="css/games.css">
</head>
<body>
<header>
    <div class="mainnav">
        <?php include "php/header.php"; ?>
    </div>
</header>
<main>
    <h1 class="title">Ergebnisse</h1>
    <ul class="cardview" id="search-result">
        <?php $searchresult = $userDAO->searchUser($search); ?>
        <?php foreach ($searchresult as $user):
                    $userID = $user->userid;
                    $username = $user->username;
                    $profileurl = 'playerprofile.php?id=' . $userID;
                    $userICON = $user->iconid;
                    $ICON = $userDAO->getIcon($userICON)->filename;
                    $age = $user->age;
                    $date = new DateTime($age);
                    $now = new DateTime();
                    $age_in_years = $now->diff($date)->y;
                    if ($age_in_years == 0)
                        $age_in_years = "~";

                    ?>

                    <li class="card" style="">
                        <a href='<?php echo $profileurl ?>' class="container"
                            style="background-image:  url('<?= 'Resourcen/Icons/' . $ICON ?>') ">
                            <div class="name-wrapper"
                                    style="background-image:  url('<?= 'Resourcen/Icons/' . $ICON ?> ') ">
                                <h1><?php echo $username ?></h1>
                            </div>
                            <ul>
                                <li>Sprache: <?php echo $user->language ?></li>
                                <li>Alter: <?php echo $age_in_years ?></li>
                            </ul>
                        </a>
                    </li>
                <?php endforeach; ?>
    </ul>

</main>


<div class="footer">
    <?php include "php/footer.php"; ?>
</div>


</body>
</html>