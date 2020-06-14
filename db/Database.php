<?php

class Database
{   
    private static $db = null;
    private static $dsn = "sqlite:../../db/Database.db";

    public static function connect($dsn = "sqlite:../../db/Database.db")
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
    public static function encodeData($data){
        if(is_array($data)){
            for($i = 0; $i< count($data); $i++){
                $data[$i] = htmlspecialchars($data[$i]);
            }
            return serialize($data);
        }else{
            return htmlspecialchars($data);
        } 
    }
    /* Only necessary for arrays */
    public static function decodeData($data){
        if(is_array($data)){
            return unserialize($data);
        }
    }
}

?>
