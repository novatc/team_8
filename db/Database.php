<?php

class Database
{
    private static $db = null;


    public static function connect($dsn)
    {
        try {
            $user = "root";
            $pw = null;
            self::$db = new PDO($dsn, $user, $pw);
            self::createIfNotExists(self::$db);

            return self::$db;
        } catch (PDOException $ex) {
            return null;
        }
    }
    public static function disconnect()
    {
        try {
            self::$db = null;
        } catch (PDOException $ex) {
        }
    }
    public static function encodeData($data){
        if(is_array($data)){
            for($i = 0; $i< count($data); $i++){
                $data[$i] = htmlspecialchars($data[$i]);
            }
            return serialize($data);
        }else{
            return htmlspecialchars($data);
        }
    }
    /* Only necessary for arrays */
    public static function decodeArray($data){
            return unserialize($data);
    }

    private function createIfNotExists($db){
        try {
            $db->beginTransaction();
            // Create User table
            $sql = "CREATE TABLE IF NOT EXISTS User ( 
              userid INTEGER PRIMARY KEY,  
              username TEXT,
              mail TEXT,
              password TEXT,
              google BIT DEFAULT 0,
              age INTEGER,
              language TEXT,
              description TEXT,
              iconid INTEGER DEFAULT 0
            )";
            $db->exec( $sql );
            
            // create Games table
            $sql = "CREATE TABLE IF NOT EXISTS Games (
              gameid INTEGER PRIMARY KEY,
              gamename TEXT,
              gamecolor TEXT,
              gameranks TEXT,
              gameroles TEXT,
              tags TEXT
            )";
            $db->exec( $sql );

             // Insert games
             $ranks = serialize(['Bronze', 'Silber', 'Gold', 'Platin', 'Diamant', 'Master' ]);
             $roles = serialize(['Top Lane', 'Jungle', 'Mid', 'Bottom', 'Support']);
             $tags = serialize(['Strategie', 'Teamplay', 'Arenakampf']);
             $sql = "REPLACE INTO Games (gameid, gamename, gamecolor, gameranks, gameroles, tags) VALUES (1, 'League of Legends', 'dcc156', :ranks, :roles, :tags);";
             $cmd =$db->prepare( $sql );
             $cmd->bindParam(":ranks", $ranks);
             $cmd->bindParam(":roles", $roles);
             $cmd->bindParam(":tags", $tags);
             $cmd->execute();
         
             $ranks = serialize(['Unranked', 'Silber', 'Gold', 'Master Guardian', 'Legendary Eagle', 'Supreme', 'Global']);
             $roles = serialize(['Sniper', 'Stratege', 'Support', 'Awper', 'Entry Fragger']);
             $tags = serialize(['Strategie', 'Teamplay', 'Shooter']);
             $sql = "REPLACE INTO Games (gameid, gamename, gamecolor, gameranks, gameroles, tags) VALUES (2, 'CS:GO', 'df6f19', :ranks, :roles, :tags);";
             $cmd =$db->prepare( $sql );
             $cmd->bindParam(":ranks", $ranks);
             $cmd->bindParam(":roles", $roles);
             $cmd->bindParam(":tags", $tags);
             $cmd->execute();
         
             $ranks = serialize(['Unranked', 'Bronze', 'Silber', 'Gold', 'Platin', 'Diamant', 'Master', 'Grand Champion' ]);
             $roles = serialize([]);
             $tags = serialize(['Teamplay', 'Arenakampf']);
             $sql = "REPLACE INTO Games (gameid, gamename, gamecolor, gameranks, gameroles, tags) VALUES (3, 'Rocket League', '5a46be', :ranks, :roles, :tags);";
             $cmd =$db->prepare( $sql );
             $cmd->bindParam(":ranks", $ranks);
             $cmd->bindParam(":roles", $roles);
             $cmd->bindParam(":tags", $tags);
             $cmd->execute();
         
             $ranks = serialize(['Mercenary', 'Soldier', 'Veteran', 'Hero', 'Legend', 'Mythic', 'Immortal', 'Valorant']);
             $roles = serialize(['Breach', 'Brimstone', 'Cypher', 'Jett', 'Omen', 'Phoenix', 'Raze', 'Reyna', 'Sage', 'Sova', 'Viper']);
             $tags = serialize(['Strategie', 'Teamplay', 'Shooter']);
             $sql = "REPLACE INTO Games (gameid, gamename, gamecolor, gameranks, gameroles, tags) VALUES (4, 'Valorant', 'ff4655', :ranks, :roles, :tags);";
             $cmd =$db->prepare( $sql );
             $cmd->bindParam(":ranks", $ranks);
             $cmd->bindParam(":roles", $roles);
             $cmd->bindParam(":tags", $tags);
             $cmd->execute();  
           
            // Create Playerlist table
            $sql = "CREATE TABLE IF NOT EXISTS Playerlist (
              gameid INTEGER,
              userid INTEGER ,
              rank TEXT,
              role TEXT,
              status TEXT,
              FOREIGN KEY (gameid) REFERENCES Games(gameid),
              FOREIGN KEY (userid) REFERENCES User(userid) 
            )";
            $db->exec( $sql );
            
            $sql = "CREATE TABLE IF NOT EXISTS Friends (
              id1 INTEGER,
              id2 INTEGER,
              FOREIGN KEY (id1) REFERENCES User(userid)
            )";
            $db->exec( $sql );
        
            // Create Chat table
            $sql = "CREATE TABLE IF NOT EXISTS Chat (
              senderid INTEGER,
              receiverid INTEGER,
              read BIT DEFAULT 0,
              chatmessage TEXT              
            )";
            $db->exec($sql);
        

            // Create Icon table
            $sql = "CREATE TABLE IF NOT EXISTS Icons (
                iconid INTEGER PRIMARY KEY,
                filename TEXT
            )";
            $db->exec($sql);
            $icons = ['iconBC.jpg', 'iconLee.jpg', 'iconFizz.jpg', 'iconGaren.jpg', 'iconGragas.jpg', 'iconGraves.jpg', 'iconKennen.jpg', 'iconSinged.jpg', 'iconZiggs.jpg'];
            $sql = "REPLACE INTO Icons (iconid, filename) VALUES (:id, :filename);";
            $i = 0;
            foreach($icons as $icon){
                $cmd = $db->prepare( $sql );
                $cmd->bindParam(":id", $i);
                $cmd->bindParam(":filename", $icon);
                $cmd->execute(); 
                $i++;
            }




            $db->commit();
        
        } catch (Exception $e){
            $db->rollBack();
            echo 'Fehler: '. $e->getMessage();
        }

    }
}

?>
