<?php

abstract class DatabaseDAO
{
    abstract function register($user, $email, $password);

    abstract function isUserInDataBase($user);

    abstract function isPasswordCorrect($user, $password);

    abstract function addUserRow($user, $email, $password);
}

class SQLite extends DatabaseDAO
{

    public $db = null;
    public $databaseFile = "..db/DUMMYdatabase.db";

    public function connenctToDb($database)
    {
        try {
            if (!is_writable($database)) {
                chmod($database, 0777);
            }
            $this->db = new PDO("sqlite3:" . $database);
            return $this->db;
        } catch (PDOException $ex) {
            throw new Exception("something went wrong trying to connect to database: " . $ex->getMessage());
        }
    }

    public function disconnect()
    {
        $this->db = null;
    }

    public function login($user, $password)
    {
        try {
            $db = $this->connenctToDb($this->databaseFile);
            $cmd = $db;
            $cmd->exec();
            $cmd->beginTransaction();
            $valid = false;

            $isUserRegistered = $this->isUserInDataBase($user);
            if ($isUserRegistered) {
                $validPassword = $this->isPasswordCorrect($user, $password);
                if ($validPassword) {
                    $valid = true;
                }
            }
            $cmd->commit();
            return $valid;
        } catch (Exception $ex) {
            $cmd->rollBack();
            return false;
        }
    }

    public function isUserInDataBase($user)
    {
        try {
            $user = htmlspecialchars($user);
            $db = $this->connenctToDb($this->databaseFile);
            $sql = "SELECT * FROM user WHERE name = :user";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(":user", $user);
            $cmd->execute();

            if (!$cmd->fetchObject() == null) {
                return true;
            } else {
                return false;
            }
            $this->disconnect();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function register($user, $email, $password)
    {
        try {
            $db = $this->connenctToDb($this->databaseFile);
            $cmd = $db;
            $cmd->exec();
            $cmd->beginTransaction();
            $valid = false;

            $isUserInDatabse = $this->isUserInDataBase($user);
            if (!$isUserInDatabse) {
                $this->addUserRow($user, $email, $password);
                $valid = true;
            }
            $cmd->commit();
            return $valid;
        } catch (Exception $ex) {
            $cmd->rollBack();
            return false;
        }
        // TODO: Implement register() method.
    }

    function isPasswordCorrect($user, $password)
    {
        try {
            $user = htmlspecialchars($user);
            $db = $this->connenctToDb($this->databaseFile);
            $query = "SELECT * FROM user WHERE name = :user";
            $cmd = $db->prepare($query);
            $cmd->bindParam(":user", $user);
            $cmd->execute();
            $hasedPassword = $cmd->fetchObject()->password;
            $validPassword = $this->validatePassword($password, $hasedPassword);
            $this->disconnect();
            return $validPassword;
        } catch (Exception $ex) {
            echo ("Failure:") . $ex->getMessage();
        }
    }

    function addUserRow($user, $email, $password)
    {
        try {
            $user = htmlspecialchars($user);
            $email = htmlspecialchars($email);
            $password = $this->encodePassword($password);


            $db = $this->connenctToDb($this->databaseFile);
            $sqlinsert = "INSERT INTO user (name,mail, password) VALUES (:user, :mail, :password)";
            $cmd = $db->prepare($sqlinsert);

            $cmd->bindParam(":user", $user);
            $cmd->bindParam(":mail", $email);
            $cmd->bindParam(":password", $password);
            $cmd->execute();
            $this->disconnect();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    private function validatePassword($password, $hash)
    {
        if (password_verify($password, $hash)) {
            return true;
        }
        return false;
    }

    private function encodePassword($password)
    {
        $encoded = password_hash($password, PASSWORD_DEFAULT);
        return $encoded;
    }
}