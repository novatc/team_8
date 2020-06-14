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
      age INTEGER,
      language TEXT,
      description TEXT,
      icon TEXT,
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
    $tags = serialize($tags);
    $sql = "INSERT INTO Games (gameid, gamename, tags) VALUES ('lol', 'League of Legends', :tags);";
    $cmd =$db->prepare( $sql );
    $cmd->bindParam(":tags", $tags);
    $cmd->execute();
    echo 'Spiel eingefügt. ';

    $tags =['Strategie', 'Teamplay', 'Shooter'];
    $tags = serialize($tags);
    $sql = "INSERT INTO Games (gameid, gamename, tags) VALUES ('csgo', 'CS:GO', :tags);";
    $cmd =$db->prepare( $sql );
    $cmd->bindParam(":tags", $tags);
    $cmd->execute();
    echo 'Spiel eingefügt. ';

    $tags =['Teamplay', 'Arenakampf'];
    $tags = serialize($tags);
    $sql = "INSERT INTO Games (gameid, gamename, tags) VALUES ('rl', 'Rocket League', :tags);";
    $cmd =$db->prepare( $sql );
    $cmd->bindParam(":tags", $tags);
    $cmd->execute();
    echo 'Spiel eingefügt. ';

    $tags =['Strategie', 'Teamplay', 'Shooter'];
    $tags = serialize($tags);
    $sql = "INSERT INTO Games (gameid, gamename, tags) VALUES ('val', 'Valorant', :tags);";
    $cmd =$db->prepare( $sql );
    $cmd->bindParam(":tags", $tags);
    $cmd->execute();
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