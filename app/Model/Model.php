<?php /** @noinspection NullPointerExceptionInspection */


namespace App\Model;


use Config\PDOmanager;
use PDO;

class Model extends PDOmanager
{
    private $bdd;

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

    public function getTableName(): string
    {
        $table = strtolower(str_replace(array('Model\\', 'Model'),'', static::class));

        return $table;
    }

    public function findAll()
    {
        $requete = ' SELECT * FROM  Posts';
        $resultat = $this->getBdd()->query($requete);
        //$donnees = $resultat->fetch();
        if (!$resultat) {
            return false;
        }

        return $resultat;
    }



}