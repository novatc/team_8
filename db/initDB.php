<?php
try {

    $user = "root";
    $pw = null;
    $dsn = "sqlite:Database.db";
    $id_feld = "id INTEGER PRIMARY KEY AUTOINCREMENT,"; // SQLite-Syntax
    $db = new PDO($dsn, $user, $pw);


    $sql = "CREATE TABLE User ( 
      userid INTEGER PRIMARY KEY,  
      username TEXT,
      mail TEXT,
      password TEXT,
      nickename TEXT,
      age INTEGER,
      language TEXT,
      description TEXT,
      chat TEXT
    )";
    $db->exec( $sql );
    echo 'Nutzertabelle angelegt. ';
    

    $sql = "CREATE TABLE Games (
      gameid TEXT PRIMARY KEY,
      gamename TEXT,
      tags TEXT   
    )";
    $db->exec( $sql );
    echo 'Spieletabelle angelegt. ';

    $tags =['Strategie', 'Teamplay', 'Arenakampf'];
    $sql = "INSERT INTO Games (gameid, gamename, tags) VALUES ('lol', 'League of Legends', 'serialize($tags)');";
    $db->exec( $sql );
    echo 'Spiel eingefügt. ';

    $tags =['Strategie', 'Teamplay', 'Shooter'];
    $sql = "INSERT INTO Games (gameid, gamename, tags) VALUES ('csgo', 'CS:GO', 'serialize($tags)');";
    $db->exec( $sql );
    echo 'Spiel eingefügt. ';

    $tags =['Teamplay', 'Arenakampf'];
    $sql = "INSERT INTO Games (gameid, gamename, tags) VALUES ('rl', 'Rocket League', 'serialize($tags)');";
    $db->exec( $sql );
    echo 'Spiel eingefügt. ';

    $tags =['Strategie', 'Teamplay', 'Shooter'];
    $sql = "INSERT INTO Games (gameid, gamename, tags) VALUES ('val', 'Valorant', 'serialize($tags)');";
    $db->exec( $sql );
    echo 'Spiel eingefügt. ';
   

    $sql = "CREATE TABLE Playerlist (
      gameid TEXT,
      userid INTEGER ,
      rank TEXT,
      role TEXT,
      status TEXT,
      FOREIGN KEY (gameid) REFERENCES Games(gameid),
      FOREIGN KEY (userid) REFERENCES User(userid) 
)";
    $db->exec( $sql );
    echo 'Playerliste Tabelle angelegt. ';


} catch (PDOException $e){
    echo 'Fehler: '. $e->getMessage();
}
?>