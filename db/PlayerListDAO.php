<?php

abstract class PlayerListDAOImpl
{
    abstract function getAllPlayers();

    abstract function addPlayer($gameID, $userID, $rank, $role, $status);


}

class PlayerListDAO extends PlayerListDAOImpl
{
    public $db = null;
    public $dsn = "sqlite:/db/Database.db";

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

    public function disconnect()
    {
        $this->db = null;
    }

    public function getAllPlayers()
    {
        $i =0;
        try {
            $this->connenctToDb();
            $db = $this->db;
            $sql = "SELECT username FROM User";
            $result = sqlite_fetch_all($sql, SQLITE_ASSOC);
            foreach ($result as $entry){
                echo 'Name: ' . $entry['username'] . '  E-mail: ' . $entry['mail'];
            }


        } catch (Exception $ex) {

            echo $ex->getMessage();
        }
    }

    function addPlayer($gameID, $userID, $rank, $role, $status)
    {
        // TODO: Implement addPlayer() method.
    }
}

?>