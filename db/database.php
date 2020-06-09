<?php

abstract class DatabaseDAO
{
    abstract function register($user, $email, $password);

    abstract function getUser($user);

    abstract function login($user, $password);

}

class DatabaseClass extends DatabaseDAO
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

    function login($user, $password)
    {   
        $this->connenctToDb();
        $db = $this->db;
        try {
            $db->beginTransaction();
            $user = htmlspecialchars($user);
            $password = htmlspecialchars($password);

            $sql = "SELECT * FROM user WHERE name = :user";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(":user", $user);
            $cmd->execute();

            $userObject = $cmd->fetchObject();
            if ($userObject != null){
                $userpassword = $userObject->password;
                if ($this->validatePassword($password, $userpassword)){
                    if($userpassword == $password){
                        return true;
                    }else return false;
                }
            }return false;

        } catch (Exception $ex) {
            return false;
        }
    }
    function getUser($user)
    {
        $this->connenctToDb();
        $db = $this->db;
        try {
            $user = htmlspecialchars($user);
            $sql = "SELECT * FROM user WHERE name = :user";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(":user", $user);
            $cmd->execute();

            $user = $cmd->fetchObject();
            if ( $user != null) {
                return $user;
            } else {
                return false;
            }
            $this->disconnect();
        } catch (Exception $ex) {
            echo ("Failure:") . $ex->getMessage();
        }
    }

    function register($user, $email, $password)
    {
        $this->connenctToDb();
        $db = $this->db;
        try {
            $db->beginTransaction();
            $user = htmlspecialchars($user);
            $email = htmlspecialchars($email);
            $password = $this->encodePassword($password);
            $sql = "INSERT INTO user (name,mail, password) VALUES (:user, :email, :password);";
            $cmd = $db->prepare( $sql );
            $cmd->bindParam( ':user', $user );
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