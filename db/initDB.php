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

    //ownid = your own id,
    //friendID = id of your friend,
    //friends = 0,1 friends or not
    //no way to add friends yet, have to add rows manually to database
    $sql = "CREATE TABLE Friends (
      ownid INTEGER,
      friendID INTEGER,
      friends BOOLEAN,
      FOREIGN KEY (ownid) REFERENCES User(userid)
)";
    $db->exec( $sql );
    echo 'Freunde Tabelle angelegt. ';


    $sql = "CREATE TABLE Chat (
      userid1 INTEGER,
      userid2 INTEGER,
      chatmessage TEXT
)";
    $db->exec($sql);
    echo 'Chat Tabelle angelegt. ';

    $sql = "INSERT INTO User (userid, username, mail, password) VALUES (1, 'Nico', 'nico@mail.de', 'Passwort')";
    $db->exec($sql);

    $sql = "INSERT INTO User (userid, username, mail, password) VALUES (2, 'Hendrick', 'hendrick@mail.de', 'Passwort')";
    $db->exec($sql);

    $sql = "INSERT INTO User (userid, username, mail, password) VALUES (3, 'Lucas', 'lw@mail.de', 'Passwort')";
    $db->exec($sql);

    $sql = "INSERT INTO User (userid, username, mail, password) VALUES (4, 'Tim', 'tim@mail.de', 'Passwort')";
    $db->exec($sql);

    $sql = "INSERT INTO User (userid, username, mail, password) VALUES (5, 'Tom', 'tom@mail.de', 'Passwort')";
    $db->exec($sql);

    $sql = "INSERT INTO User (userid, username, mail, password) VALUES (6, 'Johannes', 'jo@mail.de', 'Passwort')";
    $db->exec($sql);

    $sql = "INSERT INTO Friends (ownID, friendID, friends) VALUES (1, 2, 1)";
    $db->exec($sql);

    $sql = "INSERT INTO Friends (ownID, friendID, friends) VALUES (2, 1, 1)";
    $db->exec($sql);

    echo 'Zwei befreundete Beispieluser erstellt.';



} catch (PDOException $e){
    echo 'Fehler: '. $e->getMessage();
}
?>