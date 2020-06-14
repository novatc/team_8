<?php
include ("Database.php");

abstract class PlayerListDAOImpl
{
    abstract function getPlayers($gameID, $ranks=NULL, $role = NULL);
    abstract function addPlayerToGame($gameID, $userID, $rank, $role, $status);

}

class PlayerListDAO extends PlayerListDAOImpl
{

    function addPlayerToGame($gameID, $userID, $rank, $role, $status){
        $db = Database::connect();
         

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
        Database::disconnect();

    }
    function getPlayers($gameID, $ranks=NULL, $role = NULL){
        
    }

}

?>