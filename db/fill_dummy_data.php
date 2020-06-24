<?php
require_once("Database.php");

$db = Database::connect("sqlite:Database.db");


//Passwort der Beispieluser ist 'Passwort'!
$passwort = password_hash('Passwort', PASSWORD_DEFAULT);

$sql = "INSERT INTO User (userid, username, mail, password) VALUES (1, 'Nico', 'nico@mail.de', '{$passwort}')";
$db->exec($sql);

$sql = "INSERT INTO User (userid, username, mail, password) VALUES (2, 'Hendrick', 'hendrick@mail.de','{$passwort}')";
$db->exec($sql);

$sql = "INSERT INTO User (userid, username, mail, password) VALUES (4, 'Tim', 'tim@mail.de', '{$passwort}')";
$db->exec($sql);

$sql = "INSERT INTO User (userid, username, mail, password) VALUES (5, 'Tom', 'tom@mail.de', '{$passwort}')";
$db->exec($sql);

$sql = "INSERT INTO User (userid, username, mail, password) VALUES (6, 'Johannes', 'jo@mail.de', '{$passwort}')";
$db->exec($sql);

$sql = "INSERT INTO Friends (id1, id2) VALUES (1, 2)";
$db->exec($sql);

$sql = "INSERT INTO Friends (id1, id2) VALUES (5, 1)";
$db->exec($sql);

echo 'Sechs Besipieluser und davon zwei befreundete Beispieluser erstellt.';
        
        
?>