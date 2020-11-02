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
        $result->bindValue(':pseudo', $pseudo);
        $result->execute();
        $data = $result->fetch();
        if($data) return $data;
        else return false;
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
        $date = date('d-m-Y H:i');
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

        $result->bindValue(':roles', $userRole);
        $result->bindValue(':firstname', $firstname);
        $result->bindValue(':lastname', $lastname);
        $result->bindValue(':pseudo', $pseudo);
        $result->bindValue('mdp', $mdp);
        $result->bindValue(':email', $email);
        $result->bindValue(':dateAt', $date);
        $result->bindValue(':addressNumber', $voie);
        $result->bindValue(':addressName', $addressName);
        $result->bindValue(':city', $ville);
        $result->bindValue(':zipcode', $zip);
        $result->bindValue(':departement', $dept);
        $result->bindValue(':country', $pays);

        $result->execute();
    }

}