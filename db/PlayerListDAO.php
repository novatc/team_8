<?php

abstract class PlayerListDAOImpl
{
    abstract function connenctToDb();
    abstract function getPlayers($gameID, $ranks=NULL, $role = NULL);
    abstract function addPlayerToGame($gameID, $userID, $rank, $role, $status);
    


}

class PlayerListDAO extends PlayerListDAOImpl
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

    function addPlayerToGame($gameID, $userID, $rank, $role, $status){
        $this->connenctToDb();
        $db = $this->db;

        $gameID = htmlspecialchars($gameID);
        $userID = htmlspecialchars($userID);
        $rank = htmlspecialchars($rank);
        $role = htmlspecialchars($role);
        $status = htmlspecialchars($status);
        $role = serialize($role);

        try {
            $db->beginTransaction();
            
            $sql = "INSERT INTO Playerlist (gameid, userid, rank, role, status) VALUES (:gameID, :userID, :rank, :role, :status);";
            $cmd = $db->prepare( $sql );
            $cmd->bindParam( ':gameID', $gameID );
            $cmd->bindParam( ':userID', $userID );
            $cmd->bindParam( ':rank', $rank );
            $cmd->bindParam( ':role', $role );
            $cmd->bindParam( ':status', $status );
            $cmd->execute();

            $db->commit();
            return 0;

        } catch (Exception $ex) {
            $db->rollBack();
            return 1;
        }
        $this->disconnect();

    }
    function getPlayers($gameID, $ranks=NULL, $role = NULL){
        
    }

    function getAllPlayers (){
        $this->connenctToDb();
        $db = $this->db;
        try {
            $sql = "SELECT * FROM User";
            $cmd = $db->prepare($sql);
            $cmd->execute();

            $result = array();

            if ($cmd->execute()){
                while ($row = $cmd->fetchObject()){
                    array_push($result, $row);
                }
            }
            return $result;





        }catch (Exception $ex){
            echo $ex->getMessage();
        }
    }

}

?>