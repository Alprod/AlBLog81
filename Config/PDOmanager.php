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
        $options = [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8',
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT];

        try {
            $bdd = new PDO('mysql:host='.$paramBdd['host'].';dbname='.$paramBdd['dbname'],
                $paramBdd['login'],
                $paramBdd['password'],$options);
        } catch (\Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
        return $bdd;

    }


}