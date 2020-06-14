<?php

abstract class GameDAOImpl
{
    abstract function connenctToDb();
    abstract function getGames();
    abstract function getGamesByTag($tag);
    abstract function getGameByID($gameID);
    abstract function getGameByName($gameNameks);

}

class GameDAO extends GameDAOImpl
{   
    public $db = null;
    public $dsn = "sqlite:../../db/Database.db";

    public function connenctToDb()
    {
        try {
            $user = "root";
            $pw = null;
            $this->db = new PDO($this->dsn, $user, $pw);
        } catch (PDOException $ex) {
            throw new Exception("something went wrong trying to connect to database: " . $ex->getMessage());
        }
    }
    function getGames(){

    }
    function getGamesByTag($tag){

    }
    function getGameByID($gameID){

    }
    function getGameByName($gameName){
        $this->connenctToDb();
        $db = $this->db;
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
        $this->disconnect();
    }
}

?>