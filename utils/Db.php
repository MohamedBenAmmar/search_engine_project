<?php

namespace Database;
class Db
{
    private static $dbInstance;
    private function __construct() {
    }
    public static function getInstance() : \PDO {
        if ( is_null(static::$dbInstance) ){
            try{
                static::$dbInstance = new \PDO("mysql:host=localhost;dbname=mini_project;", "root","");
            }
            catch (\Exception $e){
                print_r($e);
            }
        }
        return static::$dbInstance;
    }
}