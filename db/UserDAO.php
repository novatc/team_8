<?php

abstract class UserDAOImpl
{
    abstract function connenctToDb();
    abstract function login($username, $password);

    abstract function register($username, $email, $pwd, $pwdrepeat);

    abstract function getUserByName($username);

}

class UserDAO extends UserDAOImpl
{

    public $db = null;
    public $dsn = "sqlite:../../db/Database.db";

    public function connenctToDb()
    {
        try {
            $user = "root";
            $pw = null;
            $this->db = new PDO($this->dsn, $user, $pw);
        } catch (PDOException $ex) {
            throw new Exception("something went wrong trying to connect to database: " . $ex->getMessage());
        }
    }

    public function disconnect()
    {
        $this->db = null;
    }

    function login($username, $password)
    {
        $this->connenctToDb();
        $db = $this->db;
        try {
            $db->beginTransaction();
            $username = htmlspecialchars($username);
            $password = htmlspecialchars($password);

            $sql = "SELECT * FROM User WHERE username = :user";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(":user", $username);
            $cmd->execute();

            $usernameObject = $cmd->fetchObject();
            if ($usernameObject != null){
                $usernamepassword = $usernameObject->password;
                $un = $usernameObject->username;

                if ($usernamepassword == $password) return $usernameObject->userid;


            }
            $this->disconnect();
            return false;


        } catch (Exception $ex) {
            return false;
        }
        $this->disconnect();
    }
    function getUserByName($username)
    {
        $this->connenctToDb();
        $db = $this->db;
        try {
            $username = htmlspecialchars($username);
            $sql = "SELECT * FROM User WHERE username = :user";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':user', $username);
            $cmd->execute();

            $user = $cmd->fetchObject();
            if ( $username != null) {
                return $user;
            } else {
                $this->disconnect();
                return false;
            }
            $this->disconnect();
        } catch (Exception $ex) {
            echo ("Failure:") . $ex->getMessage();
        }
        $this->disconnect();
    }

    function register($username, $email, $pwd, $pwdrepeat)
    {

        $this->connenctToDb();
        $db = $this->db;

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
            $username = htmlspecialchars($username);
            $email = htmlspecialchars($email);
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
        $this->disconnect();
    }
    /* Gets UserID, returns false if User not in DB */


    private function validatePassword($password, $hash)
    {
        return password_verify($password, $hash);
    }

    private function encodePassword($password)
    {
        $encoded = password_hash($password, PASSWORD_DEFAULT);
        return $encoded;
    }
}