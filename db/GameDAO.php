<?php
require_once ("Database.php");

abstract class GameDAOInterface
{
    abstract function getGames($tags);
    abstract function getGameByID($gameID);
    abstract function getGameByName($gameNameks);

}

class GameDAO extends GameDAOInterface
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
}

?>