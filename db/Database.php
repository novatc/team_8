<?php

class Database
{   
    private static $db = null;
    private static $dsn = "sqlite:../../db/Database.db";

    public static function connect()
    {
        try {
            $user = "root";
            $pw = null;
            self::$db = new PDO(self::$dsn, $user, $pw);
            return self::$db;
        } catch (PDOException $ex) {
            return null;
            throw new Exception("something went wrong trying to connect to database: " . $ex->getMessage());
        }
    }
    public static function disconnect()
    {
        try {
            self::$db = null;
        } catch (PDOException $ex) {
            throw new Exception("something went wrong trying to connect to database: " . $ex->getMessage());
        }
    }
}

?>
