<?php
require_once ("Database.php");

abstract class UserDAOImpl
{

    abstract function login($username, $password);

    abstract function register($username, $email, $pwd, $pwdrepeat);

    abstract function getUserByName($username);

    abstract function updateUser($userID, $age, $language, $description, $icon);


}

class UserDAO extends UserDAOImpl
{

    function login($username, $password)
    {
        $db = Database::connect();
         
        try {
            $db->beginTransaction();
            $username = Database::encodeData($username);
            $password = Database::encodeData($password);

            $sql = "SELECT * FROM User WHERE username = :user";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(":user", $username);
            $cmd->execute();

            $usernameObject = $cmd->fetchObject();
            if ($usernameObject != null){
                $usernamepassword = $usernameObject->password;
                $un = $usernameObject->username;

                if ($usernamepassword == $password) 
                    return $usernameObject->userid;


            }
            Database::disconnect();
            return false;


        } catch (Exception $ex) {
            Database::disconnect();
            return false;
        }
    }

    /* Gets User, returns false if User not in DB */
    function getUserByName($username)
    {
        $db = Database::connect();
         
        try {
            $username = Database::encodeData($username);
            $sql = "SELECT * FROM User WHERE username = :user";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':user', $username);
            $cmd->execute();

            $user = $cmd->fetchObject();
            if ( $username != null) {
                return $user;
            } else {
                Database::disconnect();
                return false;
            }
            Database::disconnect();
        } catch (Exception $ex) {
            echo ("Failure:") . $ex->getMessage();
        }
        Database::disconnect();
    }

    //list up all your friends in chat overview
    function getFriends($ownid) {
        $result = array();

        try {
            $db = Database::connect("sqlite:db/Database.db");
        } catch (Exception $e) {
        }
        try {
            $sql = 'SELECT friendID FROM Friends WHERE ownid = :wert';
            $cmd = $db->prepare( $sql );
            $cmd->bindValue( ':wert', $ownid );
            $cmd->execute();

            if ($cmd->execute()) {
                while ($friendid = $cmd->fetchObject()) {
                    array_push($result, $friendid);
                }
            }
            return $result;

        } catch(Exception $ex) {
            echo ("Failure:") . $ex->getMessage();
        }
        Database::disconnect();
    }

    function register($username, $email, $pwd, $pwdrepeat)
    {

        $db = Database::connect();
         

        /* Check if username in DB */
        $id = $this->getUserByName($username);
        if($id != false){
            return 1;
        }
        // ToDo Passwort vergleich
        /* Check if password and passwordrepeat are identical
        if(strcmp($PWD, $pwdrepeat)!==0){ 
           return 2;
        }
        */
        /* Check if email is correct*/
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return 3;
        }

        try {
            $db->beginTransaction();
            $username = Database::encodeData($username);
            $email = Database::encodeData($email);
            $password = $this->encodePassword($pwd);
            $sql = "INSERT INTO User (username, mail, password) VALUES (:user, :email, :password);";
            $cmd = $db->prepare( $sql );
            $cmd->bindParam( ':user', $username );
            $cmd->bindParam( ':email', $email );
            $cmd->bindParam( ':password', $pwd );
            $cmd->execute();

            $db->commit();
            return 0;

        } catch (Exception $ex) {
            $db->rollBack();
            return 4;
        }
        Database::disconnect();
    }
    


    private function validatePassword($password, $hash)
    {
        return password_verify($password, $hash);
    }

    private function encodePassword($password)
    {
        $encoded = password_hash($password, PASSWORD_DEFAULT);
        return $encoded;
    }

    function updateUser($userID, $age, $language, $description, $icon){
        $db = Database::connect();
         

        try {
            $db->beginTransaction();

            if($age!=NULL){
                $language = Database::encodeData($language);
                $sql = "UPDATE User SET age = :age WHERE userid = :userid;";
                $cmd = $db->prepare( $sql );
                $cmd->bindParam( ':userid', $userID );
                $cmd->bindParam( ':age', $age );
                $cmd->execute();
                
            }
            if($language!=NULL){
                $language = Database::encodeData($language);
                $sql = "UPDATE User SET language = :language WHERE userid = :userid;";
                $cmd = $db->prepare( $sql );
                $cmd->bindParam( ':userid', $userID );
                $cmd->bindParam( ':language', $language );
                $cmd->execute();
            }
            if($description!=NULL){
                $description = Database::encodeData($description);
                $sql = "UPDATE User SET description = :description WHERE userid = :userid;";
                $cmd = $db->prepare( $sql );
                $cmd->bindParam( ':userid', $userID );
                $cmd->bindParam( ':description', $description );
                $cmd->execute();
            }
            if($icon!=NULL){
                $icon = Database::encodeData($icon);
                $sql = "UPDATE User SET icon = :icon WHERE userid = :userid;";
                $cmd = $db->prepare( $sql );
                $cmd->bindParam( ':userid', $userID );
                $cmd->bindParam( ':icon', $icon );
                $cmd->execute();
            }
            $db->commit();
            return 0;

        } catch (Exception $ex) {
            $db->rollBack();
            return 1;
        }
        Database::disconnect();
        
    }
}