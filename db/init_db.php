<?php
try {

    $user = "root";
    $pw = null;
    $dsn = "sqlite:databse.db";
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
      gameid INTEGER PRIMARY KEY,
      gamename TEXT,
      gamecolor TEXT,
      gameranks TEXT,
      gameroles TEXT,
      tags TEXT   
    )";
    $db->exec( $sql );
    echo 'Spieletabelle angelegt. ';

    $ranks = serialize(['Bronze', 'Silber', 'Gold', 'Platin', 'Diamant', 'Master' ]);
    $roles = serialize(['Top Lane', 'Jungle', 'Mid', 'Bottom', 'Support']);
    $tags = serialize(['Strategie', 'Teamplay', 'Arenakampf']);
    $sql = "INSERT INTO Games (gamename, gamecolor, gameranks, gameroles, tags) VALUES ('League of Legends', 'dcc156', :ranks, :roles, :tags);";
    $cmd =$db->prepare( $sql );
    $cmd->bindParam(":ranks", $ranks);
    $cmd->bindParam(":roles", $roles);
    $cmd->bindParam(":tags", $tags);
    $cmd->execute();
    echo 'Spiel eingefügt. ';

    $ranks = serialize(['Unranked', 'Silber', 'Gold', 'Master Guardian', 'Legendary Eagle', 'Supreme', 'Global']);
    $roles = serialize(['Sniper', 'Stratege', 'Support', 'Awper', 'Entry Fragger']);
    $tags = serialize(['Strategie', 'Teamplay', 'Shooter']);
    $sql = "INSERT INTO Games (gamename, gamecolor, gameranks, gameroles, tags) VALUES ('CS:GO', 'df6f19', :ranks, :roles, :tags);";
    $cmd =$db->prepare( $sql );
    $cmd->bindParam(":ranks", $ranks);
    $cmd->bindParam(":roles", $roles);
    $cmd->bindParam(":tags", $tags);
    $cmd->execute();
    echo 'Spiel eingefügt. ';

    $ranks = serialize(['Unranked', 'Bronze', 'Silber', 'Gold', 'Platin', 'Diamant', 'Master', 'Grand Champion' ]);
    $roles = serialize([]);
    $tags = serialize(['Teamplay', 'Arenakampf']);
    $sql = "INSERT INTO Games (gamename, gamecolor, gameranks, gameroles, tags) VALUES ('Rocket League', '5a46be', :ranks, :roles, :tags);";
    $cmd =$db->prepare( $sql );
    $cmd->bindParam(":ranks", $ranks);
    $cmd->bindParam(":roles", $roles);
    $cmd->bindParam(":tags", $tags);
    $cmd->execute();
    echo 'Spiel eingefügt. ';

    $ranks = serialize(['Mercenary', 'Soldier', 'Veteran', 'Hero', 'Legend', 'Mythic', 'Immortal', 'Valorant']);
    $roles = serialize(['Breach', 'Brimstone', 'Cypher', 'Jett', 'Omen', 'Phoenix', 'Raze', 'Reyna', 'Sage', 'Sova', 'Viper']);
    $tags = serialize(['Strategie', 'Teamplay', 'Shooter']);
    $sql = "INSERT INTO Games (gamename, gamecolor, gameranks, gameroles, tags) VALUES ('Valorant', 'ff4655', :ranks, :roles, :tags);";
    $cmd =$db->prepare( $sql );
    $cmd->bindParam(":ranks", $ranks);
    $cmd->bindParam(":roles", $roles);
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

    $sql = "INSERT INTO Friends (ownID, friendID, friends) VALUES (1, 2, 1)";
    $db->exec($sql);

    $sql = "INSERT INTO Friends (ownID, friendID, friends) VALUES (2, 1, 1)";
    $db->exec($sql);

    echo 'Sechs Besipieluser und davon zwei befreundete Beispieluser erstellt.';



} catch (PDOException $e){
    echo 'Fehler: '. $e->getMessage();
}
?>