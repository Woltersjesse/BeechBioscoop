<?php
class DBConn
{

    private static ?DBConn $instance = null;

    private final function __construct()
    {
        echo __CLASS__ . " initializes only once\n";
    }

    public static function getConn()
    {
        if (self::$instance === null) {
            self::$instance = new DBConn();
        }
        return self::$instance;
    }

    // Prevent cloning the object
    private function __clone()
    {
    }

    // Prevent unserializing the object
    private function __wakeup()
    {
    }

    // Add a sample method for database interactions (just for illustration)
    public function getConnection()
    {

    }

}

$obj1 = DBConn::getConn();
$obj2 = DBConn::getConn();

var_dump($obj1 === $obj2);
?>