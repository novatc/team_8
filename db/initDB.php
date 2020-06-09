<?php
try {

    $user = "root";
    $pw = null;
    $dsn = "sqlite:DUMMYdatabase.db";
    $id_feld = "id INTEGER PRIMARY KEY AUTOINCREMENT,"; // SQLite-Syntax
    $dbUser = new PDO($dsn, $user, $pw);


    $sql = "CREATE TABLE user ( 
      id INTEGER PRIMARY KEY,  
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
    echo 'Nutzertabelle angelegt.';
    

    $sql = "CREATE TABLE leagueoflegends (
      userid INTEGER PRIMARY KEY,
      rank TEXT,
      position TEXT
)";
    $dbUser->exec( $sql );
    echo 'LolTabelle angelegt.';
   

    $sql = "CREATE TABLE csgo (
      userid INTEGER PRIMARY KEY,
      rank TEXT,
      position TEXT
)";
    $dbUser->exec( $sql );
    echo 'csgo Tabelle angelegt.';
    

    $sql = "CREATE TABLE valorant (
      userid INTEGER PRIMARY KEY,
      rank TEXT,
      position TEXT
)";
    $dbUser->exec( $sql );
    echo 'valorant Tabelle angelegt.';
    
    $sql = "CREATE TABLE rocketleague (
      userid INTEGER PRIMARY KEY,
      rank TEXT,
      position TEXT
)";
    $dbUser->exec( $sql );
    echo 'Rocketleague Tabelle angelegt.';
    

} catch (PDOException $e){
    echo 'Fehler: '. $e->getMessage();
}
?>