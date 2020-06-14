<?php
require_once ("Database.php");

abstract class PlayerListDAOImpl
{
    abstract function getPlayers($gameID, $ranks=NULL, $role = NULL);
    abstract function addPlayer($gameID, $userID, $rank, $role, $status);
    abstract function updatePlayer($gameID, $userID, $rank, $role, $status);
    abstract function deletePlayer($gameID, $userID);
}

class PlayerListDAO extends PlayerListDAOImpl
{

    function addPlayer($gameID, $userID, $rank, $role, $status){

        $gameID = Database::encodeData($gameID);
        $userID = Database::encodeData($userID);
        $rank = Database::encodeData($rank);
        $role = Database::encodeData($role);
        $status = Database::encodeData($status);

        $db = Database::connect();
        try {
            $db->beginTransaction();
            
            $sql = "INSERT INTO Playerlist (gameid, userid, rank, role, status) VALUES (:gameid, :userid, :rank, :role, :status);";
            $cmd = $db->prepare( $sql );
            $cmd->bindParam( ':gameid', $gameID );
            $cmd->bindParam( ':userid', $userID );
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

    function updatePlayer($gameID, $userID, $rank, $role, $status){

        $gameID = Database::encodeData($gameID);
        $userID = Database::encodeData($userID);
        $rank = Database::encodeData($rank);
        $role = Database::encodeData($role);
        $status = Database::encodeData($status);   

        $db = Database::connect();
        try {
            $db->beginTransaction();
            
            $sql = "UPDATE Playerlist Set rank = :rank, role = :role, status = :status WHERE gameid = :gameid AND userid =:userid;";
            $cmd = $db->prepare( $sql );
            $cmd->bindParam( ':gameid', $gameID );
            $cmd->bindParam( ':userid', $userID );
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

    function deletePlayer($gameID, $userID){

        $gameID = Database::encodeData($gameID);
        $userID = Database::encodeData($userID);
        $db = Database::connect();

        try {
            $db->beginTransaction();
    
            $sql = "DELETE FROM Playerlist WHERE gameid = :gameid AND userid =:userid;";
            $cmd = $db->prepare( $sql );
            $cmd->bindParam( ':gameid', $gameID );
            $cmd->bindParam( ':userid', $userID );
            $cmd->execute();

            $db->commit();
            return 0;

        } catch (Exception $ex) {
            $db->rollBack();
            return 1;
        }
        Database::disconnect();

    }
    function alreadyIncluded($gameID, $userID){
        $db = Database::connect();
         
        try {
            $db->beginTransaction();
            $username = Database::encodeData($gameID);
            $password = Database::encodeData($userID);

            $sql = "SELECT * FROM Playerlist WHERE gameid = :gameID AND userid =:userID;";
            $cmd = $db->prepare( $sql );
            $cmd->bindParam( ':gameID', $gameID );
            $cmd->bindParam( ':userID', $userID );
            $cmd->execute();

            $entry = $cmd->fetchObject();
            Database::disconnect();

            if ($entry == null){
                return false;
            }else{
                return true;
            }
            
            


        } catch (Exception $ex) {
            Database::disconnect();
            return null;
        }
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