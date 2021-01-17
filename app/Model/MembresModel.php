<?php

namespace App\Model;

use App\Entity\Users;
use Config\Config;
use Config\PDOmanager;
use PDO;
use PDOStatement;

class MembresModel extends PDOmanager
{
    /**
     * @return array|false
     */
    public function findAll()
    {
        $req = "SELECT * FROM Users";
        $result = $this->getBdd()->prepare($req);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_CLASS, 'App\Entity\Users');
        $data = $result->fetchAll();
        if (!$data) {
            return false;
        }
        return $data;
    }

    /**
     * @param $idMember
     * @return mixed
     */
    public function find($idMember)
    {
        $req = "SELECT * FROM Users WHERE idUsers = :id";
        $result = $this->getBdd()->prepare($req);
        $result->bindParam(':id', $idMember);
        $result->execute();
        $result->setFetchMode(self::FETCH_CLASS, "App\Entity\Users");
        $data = $result->fetch();
        $result->closeCursor();
        if ($data) {
            return $data;
        }
        return false;
    }


    /**
     * @param $pseudo
     * @return false|mixed
     *
     */
    public function existPseudo($pseudo)
    {
        $req = 'SELECT * FROM Users WHERE pseudo = :pseudo';
        $result = $this->getBdd()->prepare($req);
        $result->bindParam(':pseudo', $pseudo);
        $result->execute();
        $data = $result->fetch();
        $result->closeCursor();
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    /**
     * @param $email
     * @return false|mixed
     */
    public function loginOfConnexion($email)
    {
        $req = 'SELECT * FROM Users WHERE email = :email';
        $result = $this->getBdd()->prepare($req);
        $result->bindParam(':email', $email);
        $result->execute();
        $result->setFetchMode(self::FETCH_CLASS, 'App\Entity\Users');
        $data = $result->fetch();

        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    /**
     * @return bool|PDOStatement
     */
    public function getLatest()
    {
        $req = 'SELECT id FROM Users ORDER BY id DESC LIMIT 0,1';
        return $this->getBdd()->prepare($req);
    }

    /**
     * Update Password
     * @param $idUsers
     * @param $mdp
     */
    public function updateMdp($idUsers, $mdp)
    {
        $bdd = $this->getBdd();
        $req = 'UPDATE Users SET mdp = :mdp WHERE idUsers = :idUsers';
        $result = $bdd->prepare($req);
        $result->bindParam(':idUsers', $idUsers, PDO::PARAM_INT);
        $result->bindValue(':mdp', $mdp, PDO::PARAM_STR);
        $result->execute();
    }

    /**
     * @param $mdp
     * @param $data
     * @return bool
     */
    public function register($mdp, Users $data): bool
    {
        $firstname = $data->getFirstname();
        $lastname = $data->getLastname();
        $pseudo = $data->getPseudo();
        $email = $data->getEmail();
        $voie = $data->getAddressNumber();
        $addressName = $data->getAddressName();
        $ville = $data->getCity();
        $zip = $data->getZipCode();
        $dept = $data->getDepartement();
        $pays = $data->getCountry();
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
        $result->bindParam(':mdp', $mdp);
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

    /**
     * @param Users $user
     */
    public function updateMemberRegister(Users $user)
    {
        $bdd = $this->getBdd();
        $req = 'UPDATE Users SET firstname = :firstname,
                                 lastname = :lastname,
                                 pseudo = :pseudo,
                                 email = :email,
                                 addressNumber = :addressNumber,
                                 addressName = :addressName,
                                 city = :city,
                                 zip_code = :zipcode,
                                 departement = :departement,
                                 country = :country
                             WHERE idUsers = :idUser';
        $result = $bdd->prepare($req);
        $result->bindValue(':firstname', $user->getFirstname());
        $result->bindValue(':lastname', $user->getLastname());
        $result->bindValue(':pseudo', $user->getPseudo());
        $result->bindValue(':email', $user->getEmail());
        $result->bindValue(':addressNumber', $user->getAddressNumber());
        $result->bindValue(':addressName', $user->getAddressName());
        $result->bindValue(':city', $user->getCity());
        $result->bindValue(':zipcode', $user->getZipCode());
        $result->bindValue(':departement', $user->getDepartement());
        $result->bindValue(':country', $user->getCountry());
        $result->bindValue(':idUser', $user->getIdUsers());
        $result->execute();
    }

    /**
     * @param Users $roles
     */
    public function updateUserToMembre(Users $roles)
    {
        $bdd = $this->getBdd();
        $bloggerRole = Config::USERS;
        $req = 'UPDATE Users SET roles = :roles WHERE idUsers = :id';
        $result = $bdd->prepare($req);
        $result->bindValue(':id', $roles->getIdUsers());
        $result->bindValue(':roles', $bloggerRole);
        $result->execute();
    }

    public function updateMembreToBlogger(Users $roles)
    {
        $bdd = $this->getBdd();
        $bloggerRole = Config::USERS_ADMIN;
        $req = 'UPDATE Users SET roles = :roles WHERE idUsers = :id';
        $result = $bdd->prepare($req);
        $result->bindValue(':id', $roles->getIdUsers());
        $result->bindValue(':roles', $bloggerRole);
        $result->execute();
    }

    /**
     * @param Users $roles
     */
    public function updateMembreToSuperAdmin(Users $roles)
    {
        $bdd = $this->getBdd();
        $superAdminRole = Config::SUPER_USERS_ADMIN;
        $req = 'UPDATE Users SET roles = :roles WHERE idUsers = :id';
        $result = $bdd->prepare($req);
        $result->bindValue(':id', $roles->getIdUsers());
        $result->bindValue(':roles', $superAdminRole);
        $result->execute();
    }

    /**
     * @param Users $idUser
     */
    public function deleteMembersRegister(Users $idUser)
    {
        $req = 'DELETE FROM Users WHERE idUsers = :id ';
        $result = $this->getBdd()->prepare($req);
        $result->bindValue(':id', $idUser->getIdUsers());
        $result->execute();
    }
}
