<?php
require_once("Database.php");

interface  PlayerListDAOInterface
{
    function getAllPlayers();

    function addPlayer($gameID, $userID, $rank, $role, $status);

    function updatePlayer($gameID, $userID, $rank, $role, $status);

    function deletePlayer($gameID, $userID);
}

class PlayerListDAO implements PlayerListDAOInterface
{
    private $dsn;

    function __construct($dsn = "sqlite:../../db/Database.db") {
        $this->dsn = $dsn;
    }

    function addPlayer($gameID, $userID, $rank, $role, $status)
    {
        $gameID = database::encodeData($gameID);
        $userID = database::encodeData($userID);
        $rank = database::encodeData($rank);
        $role = database::encodeData($role);
        $status = database::encodeData($status);
        
        $db = database::connect($this->dsn);

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
            database::disconnect($this->dsn);
            return 1;
        }
    }

    function updatePlayer($gameID, $userID, $rank, $role, $status)
    {
        $gameID = database::encodeData($gameID);
        $userID = database::encodeData($userID);
        $rank = database::encodeData($rank);
        $role = database::encodeData($role);
        $status = database::encodeData($status);


        $db = database::connect($this->dsn);

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
            database::disconnect($this->dsn);
            return 1;
        }
    }

    function deletePlayer($gameID, $userID)
    {
        $gameID = database::encodeData($gameID);
        $userID = database::encodeData($userID);
       
        $db = database::connect($this->dsn);

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
            database::disconnect($this->dsn);
            return 1;
        } 
    }

    function getEntry($gameID, $userID)
    {
        $db = database::connect($this->dsn);

        try {
            $db->beginTransaction();
            $username = database::encodeData($gameID);
            $password = database::encodeData($userID);

            $sql = "SELECT * FROM Playerlist WHERE gameid = :gameID AND userid =:userID;";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':gameID', $gameID);
            $cmd->bindParam(':userID', $userID);
            $cmd->execute();

            database::disconnect($this->dsn);

            return $cmd->fetchObject();

        } catch (Exception $ex) {
            database::disconnect($this->dsn);
            return -1;
        } 
    }
    function alreadyIncluded($gameID, $userID)
    {
            $entry = $this->getEntry($gameID, $userID);

            if( $entry === -1){
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

        $db = database::connect($this->dsn);

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

    function getPlayersForGame($gameID, $ranks, $roles)
    {
        $result = array();
        $helperArry = array();

        $db = database::connect($this->dsn);

        try {

            $sql = "SELECT * FROM Playerlist WHERE gameid = :gameID AND status = 'active'";

            if(count($ranks)>0){
                $sql = $sql . " AND (rank = :rank" . 0;
                for($i = 1; $i<count($ranks);$i++){
                    $sql = $sql . " OR rank = :rank" . $i;
                }
                $sql = $sql . ")";
            }
            $sql = $sql . ";";

            $cmd = $db->prepare($sql);
            $cmd->bindParam(':gameID', $gameID);

            for($i = 0; $i<count($ranks);$i++){
                $string = 'rank'. $i;
                $cmd->bindParam($string, $ranks[$i]);
            }

            if ($cmd->execute()) {
                while ($entry = $cmd->fetchObject()) {
                    if(count($roles)>0){
                        $entryroles = database::decodeArray($entry->role);
                        foreach($roles as $role){
                            if(in_array($role, $entryroles)){
                                array_push($helperArry, $entry);
                                break;
                            }
                        }
                    }else{
                        array_push($helperArry, $entry);
                    }

                }
            }
            foreach ($helperArry as $gamer) {
                $playerSql = "SELECT * FROM User WHERE userid = :obtainedUserId;";
                $cmd = $db->prepare($playerSql);
                $cmd->bindParam(':obtainedUserId', $gamer->userid);
                $cmd->execute();

                if ($cmd->execute()) {
                    while ($item = $cmd->fetchObject()) {
                        array_push($result, $item);
                    }
                }
            }
            return $result;


        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function getPlayerInfo($gameID)
    {
        $result = array();

        try {
            $db = database::connect("sqlite:db/Database.db");
        } catch (Exception $e) {
        }
        try {
            $sql = "SELECT * FROM Playerlist WHERE gameid = :gameID;";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':gameID', $gameID);
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


    function getPlayerByID($userId)
    {
        $result = array();

        try {
            $db = database::connect("sqlite:db/Database.db");
        } catch (Exception $e) {
        }
        try {
            $sql = "SELECT * FROM Playerlist WHERE userid = :userId;";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':userid', $userId);
            $cmd->execute();

            $result = $cmd->fetchObject();
            if ($result != null) {
                database::disconnect();
                return $result;
            } else return false;

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function getRank($gameID, $userID){
        
        $entry = $this->getEntry($gameID, $userID);
        if( $entry === -1){
            return -1; // ERROR
        } 
        if($entry != null){
            return $entry->rank;
        } else{
            return null;
        }
    }
    function getRoles($gameID, $userID){
        
        $entry = $this->getEntry($gameID, $userID);
        if( $entry === -1){
            return -1; // ERROR
        } 
        if($entry != null){
            return database::decodeArray($entry->role);
        } else{
            return [];
        }
    }
    function getStatus($gameID, $userID){
        
        $entry = $this->getEntry($gameID, $userID);
        if( $entry === -1){
            return -1; // ERROR
        } 
        if($entry != null){
            return $entry->status;
        } else{
            return null;
        }
    }

    function getGamesFromPlayer($userID){
        $games = array();
        $db = database::connect($this->dsn);

        try {
            $db->beginTransaction();
            $userID = database::encodeData($userID);

            $sql = "SELECT * FROM Playerlist WHERE userid =:userID;";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':userID', $userID);

            database::disconnect($this->dsn);
            if ($cmd->execute()) {
                while ($item = $cmd->fetchObject()) {
                    array_push($games, $item->gameid);
                }
            }

            return $games;

        } catch (Exception $ex) {
            database::disconnect($this->dsn);
            return -1;
        } 

    }

    function getPlayerByName($userName)
    {
        $result = array();

        try {
            $db = database::connect("sqlite:db/Database.db");
        } catch (Exception $e) {
        }
        try {
            $sql = "SELECT * FROM User WHERE username = :userName;";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':userName', $userName);
            $cmd->execute();

            $result = $cmd->fetchObject();
            if ($result != null) {
                database::disconnect();
                return $result;
            } else return false;

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }


}

?>