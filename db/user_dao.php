<?php
require_once("Database.php");

interface UserDAOInterface
{

    function login($username, $password);

    function register($username, $email, $pwd, $pwdrepeat, $googleaccount);

    function getUserByName($username, $googleaccount);

    function getUserByID($username);

    function updateUser($userID, $age, $language, $description, $iconID);

    function getFriends($userID);

    function saveMessage($senderid, $receiverid, $message);

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

            $sql = "SELECT * FROM User WHERE username = :user AND google=0";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(":user", $username);
            $cmd->execute();

            $usernameObject = $cmd->fetchObject();
            if ($usernameObject != null){
                $hasheduserpw = $usernameObject->password;
                if (password_verify($password, $hasheduserpw)){
                    $message="";
                    setcookie("loginmessage", $message, 0, "/");
                    if (empty($_SESSION['csrf_token'])) {
                        $_SESSION['csrf_token'] = uniqid('', true);
                    }
                    return $usernameObject->userid;
                }else{ 
                   
                    $message = "Das Passwort ist falsch!";
                    setcookie("loginmessage", $message, 0, "/");
                    return -1;
                }
            }
            Database::disconnect($this->dsn);
            $message="Nutzer existiert nicht!";
            setcookie("loginmessage", $message, 0, "/");
            return -1;


        } catch (Exception $ex) {
            Database::disconnect($this->dsn);
            $message="Huch, etwas ist schief gelaufen!";
            setcookie("loginmessage", $message, 0, "/");
            return -1;
        }
    }

    function register($username, $email, $pwd, $pwdrepeat, $googleaccount)
    {
        $db = Database::connect($this->dsn);

        /* Check if username in DB */
        $id = $this->getUserByName($username, 0);
        if($id != false){
            $message="Nutzername bereits vergeben!";
            setcookie("registrationmessage", $message, 0, "/");
            return -1 ;
        }
        // Check if password and passwordrepeat are identical
        if($pwd != $pwdrepeat){ 
            $message="Passwörter stimmen nicht überein!";
            setcookie("registrationmessage", $message, 0, "/");
            return -1;
        }
        
        /* Check if email is correct*/
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $message="E-Mail Adresse ungültig!";
            setcookie("registrationmessage", $message, 0, "/");
            return -1;
        }

        try {
            $db->beginTransaction();
            $username = Database::encodeData($username);
            $email = Database::encodeData($email);
            $hashedpw = password_hash($pwd,PASSWORD_DEFAULT );
            $sql = "INSERT INTO User (username, mail, password, google) VALUES (:user, :email, :password, :google);";
            $cmd = $db->prepare( $sql );
            $cmd->bindParam( ':user', $username );
            $cmd->bindParam( ':email', $email );
            $cmd->bindParam( ':password', $hashedpw );
            $cmd->bindParam( ':google', $googleaccount );
            $cmd->execute();

            $db->commit();
            $message="";
            setcookie("registrationmessage", $message, 0, "/");
            if (empty($_SESSION['csrf_token'])) {
                $_SESSION['csrf_token'] = uniqid('', true);
            }
            return $this->getUserByName($username, 0)->userid;

        } catch (Exception $ex) {
            $db->rollBack();
            $message="Huch, etwas ist schief gelaufen!";
            setcookie("registrationmessage", $message, 0, "/");
            Database::disconnect($this->dsn);
            return -1;
        }
        
    }
    function googleLoginAndRegister($username, $email){
        $db = Database::connect($this->dsn);

        try {
            $db->beginTransaction();
            $username = Database::encodeData($username);
            $email = Database::encodeData($email);
            $google = 1;
            $sql = "SELECT * FROM User WHERE username = :user AND mail = :email AND google=1";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(":user", $username);
            $cmd->bindParam(":email", $email);
            $cmd->execute();

            $usernameObject = $cmd->fetchObject();
            if ($usernameObject != null){
                    $message="";
                    setcookie("loginmessage", $message, 0, "/");
                    $db->commit();
                    if (empty($_SESSION['csrf_token'])) {
                        $_SESSION['csrf_token'] = uniqid('', true);
                    }
                    return $usernameObject->userid;
            }else{
                
                $sql = "INSERT INTO User (username, mail, google) VALUES (:user, :email, :google);";
                $cmd = $db->prepare( $sql );
                $cmd->bindParam( ':user', $username );
                $cmd->bindParam( ':email', $email );
                $cmd->bindParam( ':google', $google);
                $cmd->execute();
                $message="";
                setcookie("loginmessage", $message, 0, "/");
                $db->commit();
                if (empty($_SESSION['csrf_token'])) {
                    $_SESSION['csrf_token'] = uniqid('', true);
                }
                return $this->getUserByName($username, 1)->userid;
            }
            
        } catch (Exception $ex) {
            $db->rollBack();
            Database::disconnect($this->dsn);
            $message="Huch, etwas ist schief gelaufen!";
            setcookie("loginmessage", $message, 0, "/");
            return -1;
        }
    }

    function isGoogleAccount($userID){
        $db = Database::connect($this->dsn);

        try {
            $userID = Database::encodeData($userID);
            $sql = "SELECT * FROM User WHERE userid = :userid and google=1";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':userid', $userID);
            $cmd->execute();

            $user = $cmd->fetchObject();
            if ( $user != null) {
                return true;
            } else {
                Database::disconnect($this->dsn);
                return false;
            }
            Database::disconnect($this->dsn);
        } catch (Exception $ex) {
            return false;
        }
        Database::disconnect($this->dsn);
    }

    function deleteUser($userID, $username, $password){
        $userID = Database::encodeData($userID);
       
        if(($userID != $this->login($username, $password)) and ($userID != $this->getUserByName($username, 1)->userid)){
            $message="Falsche Nutzerdaten!";
            setcookie("deletionmessage", $message, 0, "/");
            return -1;
        }
            
        $db = Database::connect($this->dsn);

        try {
            $db->beginTransaction();

            $sql = "DELETE FROM User WHERE userid =:userid;";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':userid', $userID);
            $cmd->execute();

            $sql = "DELETE FROM Playerlist WHERE userid =:userid;";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':userid', $userID);
            $cmd->execute();

            $sql = "DELETE FROM Friends WHERE id1 =:userid OR id2 =:userid;";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':userid', $userID);
            $cmd->execute();

            $sql = "DELETE FROM Chat WHERE senderid =:userid OR receiverid =:userid;";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':userid', $userID);
            $cmd->execute();

            $db->commit();
            return null;

        } catch (Exception $ex) {
            $db->rollBack();
            Database::disconnect($this->dsn);
            $message="Huch, etwas ist schief gelaufen!";
            setcookie("deletionmessage", $message, 0, "/");
            return -1;
        } 

    }

    /* Gets User, returns false if User not in DB */
    function getUserByName($username, $googleaccount)
    {
        $db = Database::connect($this->dsn);

        try {
            $username = Database::encodeData($username);
            $sql = "SELECT * FROM User WHERE username = :user AND google = :google";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':user', $username);
            $cmd->bindParam(':google', $googleaccount);
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

    

    function updateUser($userID, $age, $language, $description, $iconID){
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
            if($iconID!=-1){
                $iconID = Database::encodeData($iconID);
                $sql = "UPDATE User SET iconid = :iconid WHERE userid = :userid;";
                $cmd = $db->prepare( $sql );
                $cmd->bindParam( ':userid', $userID );
                $cmd->bindParam( ':iconid', $iconID );
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
    function getIcon($iconID){
        $db = Database::connect($this->dsn);
        try {
            $iconID = Database::encodeData($iconID);
            $sql = "SELECT * FROM Icons WHERE iconid = :iconid";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':iconid', $iconID);
            $cmd->execute();

            $icon = $cmd->fetchObject();
            if ( $icon != null) {
                Database::disconnect($this->dsn);
                return $icon;
            } else {
                Database::disconnect($this->dsn);
                return -1;
            }
            
        } catch (Exception $ex) {
            Database::disconnect($this->dsn);
        }
    }
    function getAllIcons(){
        $db = Database::connect($this->dsn);
        try {
            $icons = array();
            $sql = "SELECT * FROM Icons";
            $cmd = $db->prepare($sql);

            if ($cmd->execute()) {
                while ($icon = $cmd->fetchObject()) {
                    array_push($icons, $icon);
                }
            }
            return $icons;
            
        } catch (Exception $ex) {
            Database::disconnect($this->dsn);
        }
    }
    
    

    function saveMessage($senderid, $receiverid, $message)
    {

        $db = Database::connect($this->dsn);

        try {
            $db->beginTransaction();
            $senderid = Database::encodeData($senderid);
            $receiverid = Database::encodeData($receiverid);
            $message = Database::encodeData($message);
            $sql = "INSERT INTO Chat (senderid, receiverid, chatmessage) VALUES (:senderid, :receiverid, :message);";
            $cmd = $db->prepare( $sql );
            $cmd->bindParam( ':senderid', $senderid );
            $cmd->bindParam( ':receiverid', $receiverid );
            $cmd->bindParam( ':message', $message );
            $cmd->execute();

            $db->commit();
            return true;

        } catch (Exception $ex) {
            $db->rollBack();
            return false;
        }
    }

    function readMessages($userid, $chatpartnerid)
    {
        $db = Database::connect($this->dsn);
        try {
            $userid = Database::encodeData($userid);
            $chatpartnerid = Database::encodeData($chatpartnerid);
            $sql = "UPDATE Chat SET read = 1 WHERE senderid = :sender AND receiverid =:receiver;";
            $cmd = $db->prepare( $sql );
            $cmd->bindParam( ':sender', $chatpartnerid );
            $cmd->bindParam( ':receiver', $userid );
            $cmd->execute();
            return 0;

        } catch (Exception $ex) {
            return -1;
        }
    }
    function getMessages($userid1, $userid2) {

        $allmessages = array();
        $db = Database::connect($this->dsn);


        try {
            $sql = 'SELECT * FROM Chat WHERE senderid = :you AND receiverid = :friend OR  senderid = :friend AND receiverid = :you';
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

                $sql = "INSERT INTO Friends (id1, id2) VALUES (:you, :friend);";
                $cmd = $db->prepare( $sql );
                $cmd->bindParam( ':you', $friendone );
                $cmd->bindParam( ':friend', $friendtwo );
                $cmd->execute();
                return 0;
            }

        } catch (Exception $ex) {
            return 1;
        }
    }
    function removeFriend($friendone, $friendtwo) {

        $db = Database::connect($this->dsn);

        try {
            $sql = "DELETE FROM Friends WHERE id1 = :you AND id2 = :friend OR id1 = :friend AND id2 = :you";
            $cmd = $db->prepare( $sql );
            $cmd->bindParam( ':you', $friendone );
            $cmd->bindParam( ':friend', $friendtwo );
            $cmd->execute();
            return 0;
            

        } catch (Exception $ex) {
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
            return array_reverse($result);

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

    function getChats($ownid) {
        $result = array();

        try {
            $db = Database::connect($this->dsn);
        } catch (Exception $e) {
        }
        try {

            $db->beginTransaction();
            $sql = 'SELECT DISTINCT senderid FROM Chat WHERE receiverid = :wert';
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

            $sql = 'SELECT DISTINCT receiverid FROM Chat WHERE senderid = :wert';
            $cmd = $db->prepare( $sql );
            $cmd->bindParam( ':wert', $ownid );
            $cmd->execute();

            if ($cmd->execute()) {
                while ($help = $cmd->fetchObject()) {
                    //extra step to get usable ids in array
                    foreach($help as $friendid) {
                        if(!in_array($friendid, $result))
                            array_push($result, $friendid);
                    }
                }
            }
            $db->commit();
            return array_reverse($result);

        } catch(Exception $ex) {
            $db->rollBack();
            return -1;
        }
    }

    function getNumberOfUnreadMessagesFromChat($userid, $chatpartnerid){
        $db = Database::connect($this->dsn);

        try {
            $sql = "SELECT COUNT(*) AS number FROM Chat WHERE senderid = :sender AND receiverid = :receiver AND read = 0";
            $cmd = $db->prepare( $sql );
            $cmd->bindParam( ':sender', $chatpartnerid );
            $cmd->bindParam( ':receiver', $userid );
            $cmd->execute();

            return $cmd->fetchObject()->number;
            
        } catch (Exception $ex) {
            return -1;
        }
    }
    
    function getNumberOfAllUnreadMessages($userid){
        $db = Database::connect($this->dsn);

        try {
            $sql = "SELECT COUNT(*) AS number FROM Chat WHERE receiverid = :receiver AND read = 0";
            $cmd = $db->prepare( $sql );
            $cmd->bindParam( ':receiver', $userid );
            $cmd->execute();

            return $cmd->fetchObject()->number;
            
        } catch (Exception $ex) {
            return -1;
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