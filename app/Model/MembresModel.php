<?php


namespace App\Model;


use Config\PDOmanager;

class MembresModel extends PDOmanager
{
    public function existPseudo($pseudo)
    {
        $req = 'SELECT * FROM Users WHERE pseudo = :pseudo';
        $result = $this->getBdd()->prepare($req);
        $result->bindValue(':pseudo', $pseudo);
        $result->execute();
        $data = $result->fetch();
        if($data) return $data;
        else return false;
    }

}