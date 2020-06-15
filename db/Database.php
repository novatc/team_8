<?php

class Database
{   
    private static $db = null;
    

    public static function connect($dsn)
    {
        try {
            $user = "root";
            $pw = null;
            self::$db = new PDO($dsn, $user, $pw);
            return self::$db;
        } catch (PDOException $ex) {
            return null;
        }
    }
    public static function disconnect()
    {
        try {
            self::$db = null;
        } catch (PDOException $ex) {
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
