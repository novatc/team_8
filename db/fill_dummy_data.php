<?php
require_once("Database.php");

$db = Database::connect("sqlite:Database.db");

// Beispiel Nutzer
// Passwort der Beispieluser ist 'Passwort'!+
$passwort = password_hash('Passwort', PASSWORD_DEFAULT);
$sql = "REPLACE INTO User (userid, username, mail, password, google, age, language, description, iconid) VALUES (1, 'Nico', 'nico@mail.de', '{$passwort}', 0, '1999-04-04', 'Deutsch, Englisch, Französisch', 'Hallo und Herzlich Wilkommen!', 2)";
$db->exec($sql);

$sql = "REPLACE INTO User (userid, username, mail, password, google, age, language, description, iconid) VALUES (2, 'Lucas', 'lucas@mail.de', '{$passwort}', 0, '1996-08-27', 'Deutsch, Englisch und vieles mehr', 'Hallo, ich bins der Lucas.', 5)";
$db->exec($sql);

$sql = "REPLACE INTO User (userid, username, mail, password, google, age, language, description, iconid) VALUES (3, 'Johannes', 'jo@mail.de', '{$passwort}', 0, '1998-12-26', 'Latein, Deutsch, Englisch', 'Gut Kick!', 3)";
$db->exec($sql);

$sql = "REPLACE INTO User (userid, username, mail, password, google, age, language, description, iconid) VALUES (4, 'Bot', 'jo@mail.de', '{$passwort}', 0, '200-01-01', 'Python', 'Hallo, ich bin ein Bot!', 0)";
$db->exec($sql);

// Bespielfreunde
$sql = "REPLACE INTO Friends (id1, id2) VALUES (1, 2)";
$db->exec($sql);

$sql = "REPLACE INTO Friends (id1, id2) VALUES (1, 4)";
$db->exec($sql);

$sql = "REPLACE INTO Friends (id1, id2) VALUES (2, 3)";
$db->exec($sql);

// Usern Spiele hinzufügen

// Nico
$roles = serialize(['Top Lane','Jungle']);
$sql = "REPLACE INTO Playerlist (gameid, userid, rank, role, status) VALUES (1, 1, 'Gold', :roles, 'active')";
$cmd =$db->prepare( $sql );
$cmd->bindParam(":roles", $roles);
$cmd->execute();

$roles = serialize(['Sniper','Support']);
$sql = "REPLACE INTO Playerlist (gameid, userid, rank, role, status) VALUES (2, 1, 'Silber', :roles, 'active' )";
$cmd =$db->prepare( $sql );
$cmd->bindParam(":roles", $roles);
$cmd->execute();

$roles = serialize([]);
$sql = "REPLACE INTO Playerlist (gameid, userid, rank, role, status) VALUES (3, 1, 'Diamant', :roles, 'inactive' )";
$cmd =$db->prepare( $sql );
$cmd->bindParam(":roles", $roles);
$cmd->execute();

// Lucas
$roles = serialize(['Entry Fragger']);
$sql = "REPLACE INTO Playerlist (gameid, userid, rank, role, status) VALUES (2, 2, 'Global', :roles, 'active' )";
$cmd =$db->prepare( $sql );
$cmd->bindParam(":roles", $roles);
$cmd->execute();

$roles = serialize([]);
$sql = "REPLACE INTO Playerlist (gameid, userid, rank, role, status) VALUES (3, 2, 'Diamant', :roles, 'active' )";
$cmd =$db->prepare( $sql );
$cmd->bindParam(":roles", $roles);
$cmd->execute();

$roles = serialize([]);
$sql = "REPLACE INTO Playerlist (gameid, userid, rank, role, status) VALUES (4, 2, 'Mercenary', :roles, 'inactive' )";
$cmd =$db->prepare( $sql );
$cmd->bindParam(":roles", $roles);
$cmd->execute();

// Johannes
$roles = serialize([]);
$sql = "REPLACE INTO Playerlist (gameid, userid, rank, role, status) VALUES (3, 3, 'Grand Champion', :roles, 'active' )";
$cmd =$db->prepare( $sql );
$cmd->bindParam(":roles", $roles);
$cmd->execute();

$roles = serialize(['Breach','Viper']);
$sql = "REPLACE INTO Playerlist (gameid, userid, rank, role, status) VALUES (4, 3, 'Hero', :roles, 'active' )";
$cmd =$db->prepare( $sql );
$cmd->bindParam(":roles", $roles);
$cmd->execute();

$roles = serialize(['Top Lane','Mid']);
$sql = "REPLACE INTO Playerlist (gameid, userid, rank, role, status) VALUES (1, 4, 'Gold', :roles, 'inactive' )";
$cmd =$db->prepare( $sql );
$cmd->bindParam(":roles", $roles);
$cmd->execute();

// Bot
$roles = serialize(['Phoenix','Reyna']);
$sql = "REPLACE INTO Playerlist (gameid, userid, rank, role, status) VALUES (4, 4, 'Valorant', :roles, 'active' )";
$cmd =$db->prepare( $sql );
$cmd->bindParam(":roles", $roles);
$cmd->execute();

$roles = serialize(['Jungle','Mid']);
$sql = "REPLACE INTO Playerlist (gameid, userid, rank, role, status) VALUES (1, 4, 'Bronze', :roles, 'active' )";
$cmd =$db->prepare( $sql );
$cmd->bindParam(":roles", $roles);
$cmd->execute();

$roles = serialize(['Awper']);
$sql = "REPLACE INTO Playerlist (gameid, userid, rank, role, status) VALUES (2, 4, 'Supreme', :roles, 'inactive' )";
$cmd =$db->prepare( $sql );
$cmd->bindParam(":roles", $roles);
$cmd->execute();



// Chats
$sql = "REPLACE INTO Chat (senderid, receiverid, chatmessage) VALUES (1, 2, 'Hallo Lucas')";
$db->exec($sql);

$sql = "REPLACE INTO Chat (senderid, receiverid, chatmessage) VALUES (2, 1, 'Was geht?')";
$db->exec($sql);

$sql = "REPLACE INTO Chat (senderid, receiverid, chatmessage) VALUES (2, 4, 'Hey, Lust ner Runde Valorant zu spielen?')";
$db->exec($sql);

$sql = "REPLACE INTO Chat (senderid, receiverid, chatmessage) VALUES (4, 2, 'Ja, klar!')";
$db->exec($sql);

$sql = "REPLACE INTO Chat (senderid, receiverid, chatmessage) VALUES (3, 2, 'Moinsen')";
$db->exec($sql);

$sql = "REPLACE INTO Chat (senderid, receiverid, chatmessage) VALUES (3, 1, 'Hey Nico')";
$db->exec($sql);

$sql = "REPLACE INTO Chat (senderid, receiverid, chatmessage) VALUES (1, 3, 'Hallo!')";
$db->exec($sql);
$message = "Datenbank erfolgreich gefüllt.";
setcookie("loginmessage", $message, 0, "/");
header('Location: ../login.php');
exit();
?>