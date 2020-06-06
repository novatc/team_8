<?php
try {

    $dbUser = new SQLite3('DUMMYuser.db');
    $dbGames = new SQLite3('DUMMYgames.db');
    $dbLol = new SQLite3('lol.db');
    $dbcsgo = new SQLite3('csgo.db');
    $dbvalorant = new SQLite3('valorant.db');
    $dbrocketleague = new SQLite3('rocketleague.db');

    $sql = "CREATE TABLE user (
      id INTEGER PRIMARY KEY,  
      name TEXT,
      mail TEXT,
      password TEXT,
      nickename TEXT,
      age INTEGER,
      language TEXT,
      description TEXT,
      chat TEXT,
    )";
    if ( $dbUser->exec( $sql ) ) {
        echo 'Nutzertabelle angelegt.';
    } else {
        echo 'Fehler beim Anlegen der Tabelle!';
    }

    $sql = "CREATE TABLE leagueoflegends (
      userid INTEGER PRIMARY KEY,
      rank TEXT,
      position TEXT
)";
    if ( $dbUser->exec( $sql ) ) {
        echo 'LolTabelle angelegt.';
    } else {
        echo 'Fehler beim Anlegen der Tabelle!';
    }

    $sql = "CREATE TABLE csgo (
      userid INTEGER PRIMARY KEY,
      rank TEXT,
      position TEXT
)";
    if ( $dbUser->exec( $sql ) ) {
        echo 'csgo Tabelle angelegt.';
    } else {
        echo 'Fehler beim Anlegen der Tabelle!';
    }

    $sql = "CREATE TABLE valorant (
      userid INTEGER PRIMARY KEY,
      rank TEXT,
      position TEXT
)";
    if ( $dbUser->exec( $sql ) ) {
        echo 'valorant Tabelle angelegt.';
    } else {
        echo 'Fehler beim Anlegen der Tabelle!';
    }
    $sql = "CREATE TABLE rocketleague (
      userid INTEGER PRIMARY KEY,
      rank TEXT,
      position TEXT
)";
    if ( $dbUser->exec( $sql ) ) {
        echo 'Rocketleague Tabelle angelegt.';
    } else {
        echo 'Fehler beim Anlegen der Tabelle!';
    }

} catch (Exception $e){
    echo 'Fehler: '. $e->getMessage();
}
?>