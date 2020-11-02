<?php


namespace App\Model;


use Config\Config;
use Config\PDOmanager;

class MembresModel extends PDOmanager
{
    public function existPseudo($pseudo)
    {
        $req = 'SELECT * FROM Users WHERE pseudo = :pseudo';
        $result = $this->getBdd()->prepare($req);
        $result->bindParam(':pseudo', $pseudo);
        $result->execute();
        $data = $result->fetch();
        if($data) return $data;
        else return false;
    }

    public function getLatest()
    {
        $req = 'SELECT id FROM Users ORDER BY id DESC LIMIT 0,1';
        return $this->getBdd()->prepare($req);

    }

    public function register($mdp,$data)
    {
        $firstname = $data['firstname'];
        $lastname = $data['lastname'];
        $pseudo = $data['pseudo'];
        $email = $data['email'];
        $voie = $data['voie'];
        $addressName = $data['adresse'];
        $ville = $data['city'];
        $zip = $data['zipcode'];
        $dept = $data['state'];
        $pays = $data['country'];
        $date = date('Y-m-d H:i:s');
        $userRole = Config::USERS;

        $req = 'INSERT INTO Users (
                                    roles,
                                    firstname,
                                    lastname,
                                    pseudo,
                                    mdp,
                                    email,
                                    createdAt,
                                    addressNumber,
                                    addressName,
                                    city,
                                    zip_code,
                                    departement,
                                    country) 
                                VALUES (
                                    :roles,
                                    :firstname,
                                    :lastname,
                                    :pseudo,
                                    :mdp,
                                    :email,
                                    :dateAt,
                                    :addressNumber,
                                    :addressName,
                                    :city,
                                    :zipcode,
                                    :departement,
                                    :country)';
        $result = $this->getBdd()->prepare($req);

        $result->bindParam(':roles', $userRole);
        $result->bindParam(':firstname', $firstname);
        $result->bindParam(':lastname', $lastname);
        $result->bindParam(':pseudo', $pseudo);
        $result->bindParam('mdp', $mdp);
        $result->bindParam(':email', $email);
        $result->bindParam(':dateAt', $date);
        $result->bindParam(':addressNumber', $voie);
        $result->bindParam(':addressName', $addressName);
        $result->bindParam(':city', $ville);
        $result->bindParam(':zipcode', $zip);
        $result->bindParam(':departement', $dept);
        $result->bindParam(':country', $pays);

        return $result->execute();
    }

}