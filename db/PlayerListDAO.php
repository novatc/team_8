<?php
require_once("Database.php");

abstract class PlayerListDAOImpl
{
    abstract function getAllPlayers();

    abstract function addPlayer($gameID, $userID, $rank, $role, $status);

    abstract function updatePlayer($gameID, $userID, $rank, $role, $status);

    abstract function deletePlayer($gameID, $userID);
}

class PlayerListDAO extends PlayerListDAOImpl
{
    private $dsn;

    function __construct($dsn = "sqlite:../../db/Database.db") {
        $this->dsn = $dsn;
    }

    function addPlayer($gameID, $userID, $rank, $role, $status)
    {
        $gameID = Database::encodeData($gameID);
        $userID = Database::encodeData($userID);
        $rank = Database::encodeData($rank);
        $role = Database::encodeData($role);
        $status = Database::encodeData($status);
        
        $db = Database::connect($this->dsn);

        try {
            $db->beginTransaction();

            $sql = "INSERT INTO Playerlist (gameid, userid, rank, role, status) VALUES (:gameid, :userid, :rank, :role, :status);";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':gameid', $gameID);
            $cmd->bindParam(':userid', $userID);
            $cmd->bindParam(':rank', $rank);
            $cmd->bindParam(':role', $role);
            $cmd->bindParam(':status', $status);
            $cmd->execute();

            $db->commit();
            return 0;

        } catch (Exception $ex) {
            $db->rollBack();
            Database::disconnect($this->dsn);
            return 1;
        }
    }

    function updatePlayer($gameID, $userID, $rank, $role, $status)
    {
        $gameID = Database::encodeData($gameID);
        $userID = Database::encodeData($userID);
        $rank = Database::encodeData($rank);
        $role = Database::encodeData($role);
        $status = Database::encodeData($status);


        $db = Database::connect($this->dsn);

        try {
            $db->beginTransaction();

            $sql = "UPDATE Playerlist Set rank = :rank, role = :role, status = :status WHERE gameid = :gameid AND userid =:userid;";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':gameid', $gameID);
            $cmd->bindParam(':userid', $userID);
            $cmd->bindParam(':rank', $rank);
            $cmd->bindParam(':role', $role);
            $cmd->bindParam(':status', $status);
            $cmd->execute();

            $db->commit();
            return 0;

        } catch (Exception $ex) {
            $db->rollBack();
            Database::disconnect($this->dsn);
            return 1;
        }
    }

    function deletePlayer($gameID, $userID)
    {
        $gameID = Database::encodeData($gameID);
        $userID = Database::encodeData($userID);
       
        $db = Database::connect($this->dsn);

        try {
            $db->beginTransaction();

            $sql = "DELETE FROM Playerlist WHERE gameid = :gameid AND userid =:userid;";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':gameid', $gameID);
            $cmd->bindParam(':userid', $userID);
            $cmd->execute();

            $db->commit();
            return 0;

        } catch (Exception $ex) {
            $db->rollBack();
            Database::disconnect($this->dsn);
            return 1;
        } 
    }

    function getEntry($gameID, $userID)
    {
        $db = Database::connect($this->dsn);

        try {
            $db->beginTransaction();
            $username = Database::encodeData($gameID);
            $password = Database::encodeData($userID);

            $sql = "SELECT * FROM Playerlist WHERE gameid = :gameID AND userid =:userID;";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':gameID', $gameID);
            $cmd->bindParam(':userID', $userID);
            $cmd->execute();

            Database::disconnect($this->dsn);

            return $cmd->fetchObject();

        } catch (Exception $ex) {
            Database::disconnect($this->dsn);
            return -1;
        } 
    }
    function alreadyIncluded($gameID, $userID)
    {
            $entry = $this->getEntry($gameID, $userID);

            if( $entry == -1){
                return -1; // ERROR
            } 
            if ($entry != null) {
                return true;
            } else {
                return false;
            }
    }

    function getAllPlayers()
    {
        $result = array();

        $db = Database::connect($this->dsn);

        try {
            $sql = "SELECT * FROM User;";
            $cmd = $db->prepare($sql);
            $cmd->execute();


            if ($cmd->execute()) {
                while ($row = $cmd->fetchObject()) {
                    array_push($result, $row);
                }
            }
            return $result;


        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function getPlayersForGame($gameID)
    {
        $result = array();
        $helperArry = array();
        try {
            $db = Database::connect($this->dsn);
        } catch (Exception $e) {
        }
        try {
            $sql = "SELECT userid FROM Playerlist WHERE gameid = :gameID;";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':gameID', $gameID);
            $cmd->execute();

            if ($cmd->execute()) {
                while ($row = $cmd->fetchObject()) {
                    array_push($helperArry,$row);
                }
            }
            foreach ($helperArry as $gamer){
                $playerSql = "SELECT * FROM User WHERE userid = :obtainedUserId;";
                $cmd = $db->prepare($playerSql);
                $cmd->bindParam(':obtainedUserId', $gamer->userid);
                $cmd->execute();

                if ($cmd->execute()){
                    while ($item = $cmd->fetchObject()){
                        array_push($result, $item);
                    }
                }
            }
            return $result;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function getRank($gameID, $userID){
        
        $entry = $this->getEntry($gameID, $userID);
        if( $entry == -1){
            return -1; // ERROR
        } 
        if($entry != null){
            return $entry->rank;
        } else{
            return null;
        }
            

    }

}

?>