<?php


namespace Config;


use Exception;
use PDO;
use PDOStatement;

class PDOmanager extends PDO
{
    /**
     * @var null
     */
    private static $instance = null;

    /**
     * @var PDO
     */
    private PDO $bdd;


    public function __construct()
    {
        $this->bdd = $this->getPdo();
    }

    /**
     * @return mixed
     */
    public function getBdd()
    {
        return $this->bdd;
    }


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


    /**
     * @return PDO
     */
    public function getPdo(): PDO
    {
        $config = new Config();
        $paramBdd = $config->getParametersConnect();
        $options = [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET utf8",
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

        try {
            $bdd = new PDO('mysql:host='.$paramBdd['host'].';dbname='.$paramBdd['dbname'],
                $paramBdd['login'],
                $paramBdd['password'],$options);
        } catch (Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
        return $bdd;

    }

    public function bindArrayValue($req,$array,$typeArray = false)
    {
        foreach ($array as $key => $val) {
            if($typeArray){
                $req->bindValue(":$key",$val,$typeArray[$key]);
            }
        }
    }


}