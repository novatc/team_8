<?php
require_once ("Database.php");

interface UserDAOInterface
{

    function login($username, $password);

    function register($username, $email, $pwd, $pwdrepeat);

    function getUserByName($username);

    function getUserByID($username);

    function updateUser($userID, $age, $language, $description, $icon);


}

class UserDAO implements UserDAOInterface
{
    private $dsn;


    function __construct($dsn = "sqlite:../../db/Database.db") {
        $this->dsn = $dsn;
    }
    
    function login($username, $password)
    {
        $db = Database::connect($this->dsn);
        $this->checkIfDBexists();

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
                $hasheduserpw = $usernameObject->password;


                if (password_verify($password, $hasheduserpw))
                    return $usernameObject->userid;


            }
            Database::disconnect($this->dsn);
            return false;


        } catch (Exception $ex) {
            Database::disconnect($this->dsn);
            return false;
        }
    }

    /* Gets User, returns false if User not in DB */
    function getUserByName($username)
    {
        $db = Database::connect($this->dsn);
        $this->checkIfDBexists();


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
                Database::disconnect($this->dsn);
                return false;
            }
            Database::disconnect($this->dsn);
        } catch (Exception $ex) {
            echo ("Failure:") . $ex->getMessage();
        }
        Database::disconnect($this->dsn);
    }

    /* Gets User, returns false if User not in DB */
    function getUserByID($userID)
    {
        $db = Database::connect($this->dsn);
        $this->checkIfDBexists();


        try {
            $userID = Database::encodeData($userID);
            $sql = "SELECT * FROM User WHERE userid = :userid";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':userid', $userID);
            $cmd->execute();

            $user = $cmd->fetchObject();
            if ( $user != null) {
                return $user;
            } else {
                Database::disconnect($this->dsn);
                return false;
            }
            Database::disconnect($this->dsn);
        } catch (Exception $ex) {
            echo ("Failure:") . $ex->getMessage();
        }
        Database::disconnect($this->dsn);
    }

    function register($username, $email, $pwd, $pwdrepeat)
    {

        $db = Database::connect($this->dsn);
        $this->checkIfDBexists();



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
            $hashedpw = password_hash($pwd,PASSWORD_DEFAULT );
            $sql = "INSERT INTO User (username, mail, password) VALUES (:user, :email, :password);";
            $cmd = $db->prepare( $sql );
            $cmd->bindParam( ':user', $username );
            $cmd->bindParam( ':email', $email );
            $cmd->bindParam( ':password', $hashedpw );
            $cmd->execute();

            $db->commit();
            return 0;

        } catch (Exception $ex) {
            $db->rollBack();
            return 4;
        }
        Database::disconnect($this->dsn);
    }

    function updateUser($userID, $age, $language, $description, $icon){
        $db = Database::connect($this->dsn);
        $this->checkIfDBexists();



        try {
            $db->beginTransaction();

            if($age!= -1){
                $language = Database::encodeData($language);
                $sql = "UPDATE User SET age = :age WHERE userid = :userid;";
                $cmd = $db->prepare( $sql );
                $cmd->bindParam( ':userid', $userID );
                $cmd->bindParam( ':age', $age );
                $cmd->execute();
                
            }
            if($language!=-1){
                $language = Database::encodeData($language);
                $sql = "UPDATE User SET language = :language WHERE userid = :userid;";
                $cmd = $db->prepare( $sql );
                $cmd->bindParam( ':userid', $userID );
                $cmd->bindParam( ':language', $language );
                $cmd->execute();
            }
            if($description!=-1){
                $description = Database::encodeData($description);
                $sql = "UPDATE User SET description = :description WHERE userid = :userid;";
                $cmd = $db->prepare( $sql );
                $cmd->bindParam( ':userid', $userID );
                $cmd->bindParam( ':description', $description );
                $cmd->execute();
            }
            if($icon!=-1){
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
        Database::disconnect($this->dsn);
        
    }

    //chat part
    //list up all your friends in chat overview
    function getFriends($ownid) {
        $result = array();

        try {
            $db = Database::connect($this->dsn);
        } catch (Exception $e) {
        }
        try {
            $sql = 'SELECT friendID FROM Friends WHERE ownid = :wert';
            $cmd = $db->prepare( $sql );
            $cmd->bindParam( ':wert', $ownid );
            $cmd->execute();

            if ($cmd->execute()) {
                while ($help = $cmd->fetchObject()) {
                    //extra step to get usable ids in array
                    foreach($help as $friendid) {
                        array_push($result, $friendid);
                    }
                }
            }
            return $result;

        } catch(Exception $ex) {
            echo ("Failure:") . $ex->getMessage();
        }
        Database::disconnect($this->dsn);
    }

    function saveMessage($userid1, $userid2, $message)
    {

        $db = Database::connect($this->dsn);
        $this->checkIfDBexists();


        try {
            $db->beginTransaction();
            $userid1 = Database::encodeData($userid1);
            $userid2 = Database::encodeData($userid2);
            $message = Database::encodeData($message);
            $sql = "INSERT INTO Chat (userid1, userid2, chatmessage) VALUES (:user1, :user2, :message);";
            $cmd = $db->prepare( $sql );
            $cmd->bindParam( ':user1', $userid1 );
            $cmd->bindParam( ':user2', $userid2 );
            $cmd->bindParam( ':message', $message );
            $cmd->execute();

            $db->commit();
            return 0;

        } catch (Exception $ex) {
            $db->rollBack();
            return 1;
        }
        Database::disconnect($this->dsn);
    }

    function getMessages($userid1, $userid2) {

        $allmessages = array();
        $db = Database::connect($this->dsn);
        $this->checkIfDBexists();


        try {
            $sql = 'SELECT * FROM Chat WHERE userid1 = :you AND userid2 = :friend OR  userid1 = :friend AND userid2 = :you';
            $cmd = $db->prepare( $sql );
            $cmd->bindParam( ':you', $userid1 );
            $cmd->bindParam( ':friend', $userid2 );
            $cmd->execute();

            if ($cmd->execute()) {
                while ($result = $cmd->fetchObject()) {
                    array_push($allmessages, $result);
                }
            }
            return $allmessages;

        } catch( Exception $ex) {

        }
        Database::disconnect();
    }

    function addFriend($yourID, $friendID) {

        $db = Database::connect($this->dsn);
        $this->checkIfDBexists();


        try {

            $sql = "SELECT * FROM Friends WHERE ownid = :you AND friendID = :friend OR ownid = :friend AND friendID = :you";
            $cmd = $db->prepare( $sql );
            $cmd->bindParam( ':you', $yourID );
            $cmd->bindParam( ':friend', $friendID );
            $cmd->execute();
            if($cmd->fetchObject() != null) {
                return null;
            } else {
                $yourID = Database::encodeData($yourID);
                $friendID = Database::encodeData($friendID);

                $db->beginTransaction();
                $sql = "INSERT INTO Friends (ownid, friendID) VALUES (:you, :friend);";
                $cmd = $db->prepare( $sql );
                $cmd->bindParam( ':you', $yourID );
                $cmd->bindParam( ':friend', $friendID );
                $cmd->execute();

                $sql = "INSERT INTO Friends (ownid, friendID) VALUES (:friend, :you);";
                $cmd = $db->prepare( $sql );
                $cmd->bindParam( ':friend', $friendID );
                $cmd->bindParam( ':you', $yourID );
                $cmd->execute();
                $db->commit();
                return 0;
            }

        } catch (Exception $ex) {
            $db->rollBack();
            return 1;
        }
        Database::disconnect($this->dsn);
    }

    function checkIfDBexists(){
        if (file_exists($this->dsn)){
            return true;
        }else{
            include "initDB.php";
        }
    }
}