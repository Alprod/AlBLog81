<?php /** @noinspection NullPointerExceptionInspection */


namespace App\Model;


use Config\PDOmanager;


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
        $requete = 'SELECT idPosts,title,contenu,images,DATE_FORMAT(create_at, "Créer le : %d/%m/%Y") as create_at FROM  Posts';
        $resultat = $this->getBdd()->query($requete);

        if (!$resultat) {
            return false;
        }

        return $resultat;
    }


}
