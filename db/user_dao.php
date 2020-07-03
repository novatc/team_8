<?php
require_once("Database.php");

interface UserDAOInterface
{

    function login($username, $password);

    function register($username, $email, $pwd, $pwdrepeat);

    function getUserByName($username);

    function getUserByID($username);

    function updateUser($userID, $age, $language, $description, $icon);

    function getFriends($userID);

    function saveMessage($id1, $id2, $message);

    function getMessages($id1, $id2);

    function addFriend($id1, $id2);

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
                    return 0;
                else{ return 3;}
            }
            Database::disconnect($this->dsn);
            return 2;


        } catch (Exception $ex) {
            Database::disconnect($this->dsn);
            return 4;
        }
    }

    function register($username, $email, $pwd, $pwdrepeat)
    {
        $db = Database::connect($this->dsn);

        /* Check if username in DB */
        $id = $this->getUserByName($username);
        if($id != false){
            return 2;
        }
        // ToDo Passwort vergleich
        // Check if password and passwordrepeat are identical
        if($pwd != $pwdrepeat){ 
           return 3;
        }
        
        /* Check if email is correct*/
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return 4;
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
            return 5;
        }
        Database::disconnect($this->dsn);
    }

    /* Gets User, returns false if User not in DB */
    function getUserByName($username)
    {
        $db = Database::connect($this->dsn);

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

    

    function updateUser($userID, $age, $language, $description, $icon){
        $db = Database::connect($this->dsn);



        try {
            $db->beginTransaction();

            if($age!= -1){
                $age = Database::encodeData($age);
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

    function saveMessage($userid1, $userid2, $message)
    {

        $db = Database::connect($this->dsn);

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
    }

    function getMessages($userid1, $userid2) {

        $allmessages = array();
        $db = Database::connect($this->dsn);


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
            echo ("Failure:") . $ex->getMessage();
            return 1;
        }
    }

    function addFriend($friendone, $friendtwo) {

        $db = Database::connect($this->dsn);

        try {

            $sql = "SELECT * FROM Friends WHERE id1 = :you AND id2 = :friend OR id1 = :friend AND id2 = :you";
            $cmd = $db->prepare( $sql );
            $cmd->bindParam( ':you', $friendone );
            $cmd->bindParam( ':friend', $friendtwo );
            $cmd->execute();
            if($cmd->fetchObject() != null) {
                return null;
            } else {
                $friendone = Database::encodeData($friendone);
                $friendtwo = Database::encodeData($friendtwo);

                $db->beginTransaction();
                $sql = "INSERT INTO Friends (id1, id2) VALUES (:you, :friend);";
                $cmd = $db->prepare( $sql );
                $cmd->bindParam( ':you', $friendone );
                $cmd->bindParam( ':friend', $friendtwo );
                $cmd->execute();

                $db->commit();
                return 0;
            }

        } catch (Exception $ex) {
            $db->rollBack();
            return 1;
        }
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

            $db->beginTransaction();
            $sql = 'SELECT id2 FROM Friends WHERE id1 = :wert';
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

            $sql = 'SELECT id1 FROM Friends WHERE id2 = :wert';
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
            $db->commit();
            return $result;

        } catch(Exception $ex) {
            echo ("Failure:") . $ex->getMessage();
            $db->rollBack();
            return 1;
        }
    }

    function isFriend($friendone, $friendtwo) {

        $db = Database::connect($this->dsn);

        try {
            $sql = "SELECT * FROM Friends WHERE id1 = :you AND id2 = :friend OR id1 = :friend AND id2 = :you";
            $cmd = $db->prepare( $sql );
            $cmd->bindParam( ':you', $friendone );
            $cmd->bindParam( ':friend', $friendtwo );
            $cmd->execute();
            if($cmd->fetchObject() != null) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $ex) {
            return false;
        }
    }


    function checkIfDBexists(){
        if (file_exists($this->dsn)){
            return true;
        }else{
            chdir("../../db/");
            include "init_db.php";
        }
    }
}