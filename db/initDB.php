<?php
try {

    $user = "root";
    $pw = null;
    $dsn = "sqlite:DUMMYdatabase.db";
    $id_feld = "id INTEGER PRIMARY KEY AUTOINCREMENT,"; // SQLite-Syntax
    $dbUser = new PDO($dsn, $user, $pw);


    $sql = "CREATE TABLE User ( 
      userid INTEGER PRIMARY KEY,  
      name TEXT,
      mail TEXT,
      password TEXT,
      nickename TEXT,
      age INTEGER,
      language TEXT,
      description TEXT,
      chat TEXT
    )";
    $dbUser->exec( $sql );
    echo 'Nutzertabelle angelegt. ';
    

    $sql = "CREATE TABLE Games (
      gameid TEXT PRIMARY KEY,
      gamename TEXT,
      tags TEXT,   
    )";
    $dbUser->exec( $sql );
    echo 'Spieletabelle angelegt. ';
   

    $sql = "CREATE TABLE Playerlist (
      gameid TEXT FOREIGN KEY REFERENCES Games(gameid),
      userid INTEGER FOREIGN KEY REFERENCES User(userid),
      rank TEXT,
      role TEXT,
      status TEXT,     
)";
    $dbUser->exec( $sql );
    echo 'Plyerliste Tabelle angelegt. ';


} catch (PDOException $e){
    echo 'Fehler: '. $e->getMessage();
}
?>