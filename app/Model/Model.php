<?php /** @noinspection NullPointerExceptionInspection */


namespace App\Model;


use Config\PDOmanager;

class Model
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = PDOmanager::getInstance()->getPdo();
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
        $requete = "SELECT * FROM".$this->getTableName();
        $resultat = $this->getBdd()->query($requete);
        $donnees = $resultat->fetchAll(\PDO::FETCH_CLASS,'Entity\\'.ucfirst($this->getTableName()));
        if (!$donnees) {
            return false;
        }

        return $donnees;
    }



}