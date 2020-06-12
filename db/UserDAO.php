<?php

abstract class UserDAOImpl
{
    abstract function login($username, $password);

    abstract function register($username, $email, $password);

    abstract function getUser($username);   

}

class UserDAO extends UserDAOImpl
{

    public $db = null;
    public $dsn = "sqlite:db/DUMMYdatabase.db";

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

            $sql = "SELECT * FROM user WHERE name = :user";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(":user", $username);
            $cmd->execute();

            $usernameObject = $cmd->fetchObject();
            if ($usernameObject != null){
                $usernamepassword = $usernameObject->password;
                if ($this->validatePassword($password, $usernamepassword)){
                    if($usernamepassword == $password){
                        return true;
                    }else return false;
                }
            }return false;

        } catch (Exception $ex) {
            return false;
        }
    }
    function getUser($username)
    {
        $this->connenctToDb();
        $db = $this->db;
        try {
            $username = htmlspecialchars($username);
            $sql = "SELECT * FROM user WHERE name = :user";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(":user", $username);
            $cmd->execute();

            $username = $cmd->fetchObject();
            if ( $username != null) {
                return $username;
            } else {
                return false;
            }
            $this->disconnect();
        } catch (Exception $ex) {
            echo ("Failure:") . $ex->getMessage();
        }
    }

    function register($username, $email, $password)
    {
        $this->connenctToDb();
        $db = $this->db;
        try {
            $db->beginTransaction();
            $username = htmlspecialchars($username);
            $email = htmlspecialchars($email);
            $password = $this->encodePassword($password);
            $sql = "INSERT INTO user (name,mail, password) VALUES (:user, :email, :password);";
            $cmd = $db->prepare( $sql );
            $cmd->bindParam( ':user', $username );
            $cmd->bindParam( ':email', $email );
            $cmd->bindParam( ':password', $password );
            $cmd->execute();

            $db->commit();
            return true;

        } catch (Exception $ex) {
            $db->rollBack();
            return false;
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