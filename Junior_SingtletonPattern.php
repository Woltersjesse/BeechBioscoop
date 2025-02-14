<?php 
    class DBConn { 
 
        private static $obj; 
 
        private final function  __construct() { 
            echo __CLASS__ . " initializes only once\n"; 
        } 
 
        public static function getConn() { 
            if(!isset(self::$obj)) { 
                self::$obj = new DBConn(); 
            } 
            return self::$obj; 
        } 
    } 
 
    $obj1 = DBConn::getConn(); 
    $obj2 = DBConn::getConn(); 
     
    var_dump($obj1 == $obj2); 
?>

