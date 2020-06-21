<?php
require_once ("Database.php");

interface GameDAOInterface
{
    function getGames($tags);
    function getGameByID($gameID);
    function getGameByName($gameNameks);

}

class GameDAO implements GameDAOInterface
{  
    private $dsn;

    function __construct($dsn = "sqlite:../../db/Database.db") {
        $this->dsn = $dsn;
    }

    function getGames($tags){
        $games = array();
        $helperArry = array();

        $db = Database::connect($this->dsn);
        
        try {
            
            $sql = "SELECT * FROM Games";

            $cmd = $db->prepare($sql);
            
            if ($cmd->execute()) {
                while ($game = $cmd->fetchObject()) {
                    if(count($tags)>0){
                        $gametags = Database::decodeArray($game->tags);
                        foreach($tags as $tag){
                            if(in_array($tag, $gametags)){
                                array_push($games, $game);
                                break;
                            }
                        }
                    }else{
                        array_push($games, $game);
                    }
                }
            }
            return $games;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function getGameByID($gameID){
        $db = Database::connect($this->dsn);
         
        try {
            $db->beginTransaction();
            $gameID = Database::encodeData($gameID);
            $sql = "SELECT * FROM Games WHERE gameid = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(":id", $gameID);
            $cmd->execute();

            $game = $cmd->fetchObject();
            
            return $game;

        } catch (Exception $ex) {
            return NULL;
        }
        Database::disconnect($this->dsn);
    }
    
    function getGameByName($gameName){
        $db = Database::connect($this->dsn);
         
        try {
            $db->beginTransaction();
            $gameName = Database::encodeData($gameName);
            $sql = "SELECT * FROM Games WHERE gamename = :name";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(":name", $gameName);
            $cmd->execute();

            $game = $cmd->fetchObject();
            
            return $game;

        } catch (Exception $ex) {
            return NULL;
        }
        Database::disconnect($this->dsn);
    }
    function getRanksFromGame($gameID){
        $db = Database::connect($this->dsn);
         
        try {
            
            $sql = "SELECT * FROM Games WHERE gameid = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(":id", $gameID);
            $cmd->execute();
            $game = $cmd->fetchObject();

            $ranks = Database::decodeArray($game->gameranks);
            
            return $ranks;

        } catch (Exception $ex) {
            return NULL;
        }
        Database::disconnect($this->dsn);
    }
    function getRolesFromGame($gameID){
        $db = Database::connect($this->dsn);
         
        try {
            
            $sql = "SELECT * FROM Games WHERE gameid = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(":id", $gameID);
            $cmd->execute();
            $game = $cmd->fetchObject();

            $roles = Database::decodeArray($game->gameroles);
            
            return $roles;

        } catch (Exception $ex) {
            return NULL;
        }
        Database::disconnect($this->dsn);
    }
    function getAllTags(){
        $db = Database::connect($this->dsn);
        $finaltags = []; 
        try {
            
            $sql = "SELECT tags FROM Games";
            $cmd = $db->prepare($sql);
            $cmd->execute();

            if ($cmd->execute()) {
                while ($game = $cmd->fetchObject()) {
                    $tags = Database::decodeArray($game->tags);

                    foreach($tags as $tag) {
                        if(!in_array($tag, $finaltags))
                            array_push($finaltags, $tag);
                    }
                }
            }
            return $finaltags;

        } catch (Exception $ex) {
            return NULL;
        }
        Database::disconnect($this->dsn);
    }
    
}

?>