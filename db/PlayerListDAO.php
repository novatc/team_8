<?php
require_once ("Database.php");

abstract class PlayerListDAOImpl
{
    abstract function getPlayers($gameID, $ranks=NULL, $role = NULL);
    abstract function addPlayerToGame($gameID, $userID, $rank, $role, $status);

}

class PlayerListDAO extends PlayerListDAOImpl
{

    function addPlayerToGame($gameID, $userID, $rank, $role, $status){
        $db = Database::connect();
         

        $gameID = Database::encodeData($gameID);
        $userID = Database::encodeData($userID);
        $rank = Database::encodeData($rank);
        $role = Database::encodeData($role);
        $status = Database::encodeData($status);
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
        Database::disconnect();

    }
    function getPlayers($gameID, $ranks=NULL, $role = NULL){
        
    }

    function getAllPlayers (){
        $db = Database::connect();
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