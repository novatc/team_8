<?php
include ("Database.php");

abstract class GameDAOImpl
{
    abstract function getGames();
    abstract function getGamesByTag($tag);
    abstract function getGameByID($gameID);
    abstract function getGameByName($gameNameks);

}

class GameDAO extends GameDAOImpl
{   
    function getGames(){

    }
    function getGamesByTag($tag){

    }
    function getGameByID($gameID){

    }
    function getGameByName($gameName){
        $db = Database::connect();
         
        try {
            $db->beginTransaction();
            $gameName = htmlspecialchars($gameName);
            $sql = "SELECT * FROM Games WHERE gamename = :name";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(":name", $gameName);
            $cmd->execute();

            $game = $cmd->fetchObject();
            
            return $game;

        } catch (Exception $ex) {
            return NULL;
        }
        Database::disconnect();
    }
}

?>