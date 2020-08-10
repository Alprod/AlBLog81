<?php


namespace Config;


class PDOmanager extends PDO
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

    public function getPdo(): PDO
    {
        $config = new Config();
        $paramBdd = $config->getParametersConnect();

        return new PDO('mysql:host='.$paramBdd['host'].';dbname='.$paramBdd['dbname'],
            $paramBdd['login'],
            $paramBdd['password'],[
                PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8'
            ]);

    }


}