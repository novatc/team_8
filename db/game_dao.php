<?php
require_once("databse.php");

interface GameDAOInterface
{
    function getGames($tags);
    function getGameByID($gameID);
    function getGameByName($gameNameks);

}

class GameDAO implements GameDAOInterface
{  
    private $dsn;

    function __construct($dsn = "sqlite:../../db/databse.db") {
        $this->dsn = $dsn;
    }

    function getGames($tags){
        $games = array();
        $helperArry = array();

        $db = databse::connect($this->dsn);
        
        try {
            
            $sql = "SELECT * FROM Games";

            $cmd = $db->prepare($sql);
            
            if ($cmd->execute()) {
                while ($game = $cmd->fetchObject()) {
                    if(count($tags)>0){
                        $gametags = databse::decodeArray($game->tags);
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
        $db = databse::connect($this->dsn);
         
        try {
            $db->beginTransaction();
            $gameID = databse::encodeData($gameID);
            $sql = "SELECT * FROM Games WHERE gameid = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(":id", $gameID);
            $cmd->execute();

            $game = $cmd->fetchObject();
            
            return $game;

        } catch (Exception $ex) {
            return NULL;
        }
        databse::disconnect($this->dsn);
    }
    
    function getGameByName($gameName){
        $db = databse::connect($this->dsn);
         
        try {
            $db->beginTransaction();
            $gameName = databse::encodeData($gameName);
            $sql = "SELECT * FROM Games WHERE gamename = :name";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(":name", $gameName);
            $cmd->execute();

            $game = $cmd->fetchObject();
            
            return $game;

        } catch (Exception $ex) {
            return NULL;
        }
        databse::disconnect($this->dsn);
    }
    function getRanksFromGame($gameID){
        $db = databse::connect($this->dsn);
         
        try {
            
            $sql = "SELECT * FROM Games WHERE gameid = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(":id", $gameID);
            $cmd->execute();
            $game = $cmd->fetchObject();

            $ranks = databse::decodeArray($game->gameranks);
            
            return $ranks;

        } catch (Exception $ex) {
            return NULL;
        }
        databse::disconnect($this->dsn);
    }
    function getRolesFromGame($gameID){
        $db = databse::connect($this->dsn);
         
        try {
            
            $sql = "SELECT * FROM Games WHERE gameid = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(":id", $gameID);
            $cmd->execute();
            $game = $cmd->fetchObject();

            $roles = databse::decodeArray($game->gameroles);
            
            return $roles;

        } catch (Exception $ex) {
            return NULL;
        }
        databse::disconnect($this->dsn);
    }
    function getAllTags(){
        $db = databse::connect($this->dsn);
        $finaltags = []; 
        try {
            
            $sql = "SELECT tags FROM Games";
            $cmd = $db->prepare($sql);
            $cmd->execute();

            if ($cmd->execute()) {
                while ($game = $cmd->fetchObject()) {
                    $tags = databse::decodeArray($game->tags);

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
        databse::disconnect($this->dsn);
    }
    
}

?>