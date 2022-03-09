<?php
namespace App;

require_once("config.php");
class DB
{
    public static $instance;

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            try {
                self::$instance = new \PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
                self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                return self::$instance;
            } catch (\PDOException $e) {
                return $e->getMessage();
            }
        }
        return self::$instance;
    }
}
