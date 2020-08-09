<?php


namespace Config;

class PDOmanager
{
    /**
     * @var null
     */
    private static $instance = null;

    private function __construct(){}
    private function __clone(){}

    /**
     * @return null
     */
    public static function getInstance()
    {
        if(is_null(self::$instance)){
            self::$instance;
        }
        return self::$instance;
    }

    public function getPdo()
    {

    }


}