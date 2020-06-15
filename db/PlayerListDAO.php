<?php
require_once("Database.php");

abstract class PlayerListDAOImpl
{
    abstract function getPlayers($gameID, $ranks = NULL, $role = NULL);

    abstract function addPlayer($gameID, $userID, $rank, $role, $status);

    abstract function updatePlayer($gameID, $userID, $rank, $role, $status);

    abstract function deletePlayer($gameID, $userID);
}

class PlayerListDAO extends PlayerListDAOImpl
{

    function addPlayer($gameID, $userID, $rank, $role, $status)
    {

        $gameID = Database::encodeData($gameID);
        $userID = Database::encodeData($userID);
        $rank = Database::encodeData($rank);
        $role = Database::encodeData($role);
        $status = Database::encodeData($status);

        try {
            $db = Database::connect();
        } catch (Exception $e) {
        }
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
            Database::disconnect();
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

        try {
            $db = Database::connect();
        } catch (Exception $e) {
        }
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
            Database::disconnect();
            return 1;
        }


    }

    function deletePlayer($gameID, $userID)
    {

        $gameID = Database::encodeData($gameID);
        $userID = Database::encodeData($userID);
        try {
            $db = Database::connect();
        } catch (Exception $e) {
        }

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
            Database::disconnect();
            return 1;
        } catch (Exception $e) {
        }


    }

    function alreadyIncluded($gameID, $userID)
    {
        try {
            $db = Database::connect();
        } catch (Exception $e) {
        }

        try {
            $db->beginTransaction();
            $username = Database::encodeData($gameID);
            $password = Database::encodeData($userID);

            $sql = "SELECT * FROM Playerlist WHERE gameid = :gameID AND userid =:userID;";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':gameID', $gameID);
            $cmd->bindParam(':userID', $userID);
            $cmd->execute();

            $entry = $cmd->fetchObject();
            Database::disconnect();

            if ($entry == null) {
                return false;
            } else {
                return true;
            }


        } catch (Exception $ex) {
            Database::disconnect();
            return null;
        } catch (Exception $e) {
        }
    }


    function getAllPlayers()
    {
        $result = array();
        try {
            $db = Database::connect("sqlite:db/Database.db");
        } catch (Exception $e) {
        }
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
            $db = Database::connect("sqlite:db/Database.db");
        } catch (Exception $e) {
        }
        try {
            $sql = "SELECT userid FROM Playerlist WHERE gameid = :gameID;";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':gameID', $gameID);
            $cmd->execute();

            if ($cmd->execute()) {
                while ($row = $cmd->fetchObject()) {
                    array_push($helperArry, $row);
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
            $db = Database::connect("sqlite:db/Database.db");
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
            $db = Database::connect("sqlite:db/Database.db");
        } catch (Exception $e) {
        }
        try {
            $sql = "SELECT * FROM Playerlist WHERE userid = :userId;";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':userid', $userId);
            $cmd->execute();

            $result = $cmd->fetchObject();
            if ($result != null) {
                Database::disconnect();
                return $result;
            } else return false;

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function getPlayers($gameID, $ranks = NULL, $role = NULL)
    {
        // TODO: Implement getPlayers() method.
    }
}

?>