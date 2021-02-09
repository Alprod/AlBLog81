<?php


namespace App\Entity;

use Config\Config;

/**
 * Class Users
 *
 * @package App\Entity
 */
class Users extends Entity
{
    /**
     * @var
     */
    private $idUsers;
    private $roles;
    private $firstname;
    private $lastname;
    private $pseudo;
    private $mdp;
    private $email;
    private $createdAt;
    private $addressNumber;
    private $addressName;
    private $city;
    private $zip_code;
    private $departement;
    private $country;


    /**
     * Get idUsers
     *
     * @return mixed
     */
    public function getIdUsers()
    {
        return $this->idUsers;
    }


    /**
     * Set idUsers
     *
     * @param mixed $idUsers
     */
    public function setIdUsers($idUsers): void
    {
        $this->idUsers = $idUsers;
    }

    /**
     * Get Roles
     *
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles;
    }


    /**
     * Set Roles
     *
     * @param mixed $roles
     */
    public function setRoles($roles): void
    {
        $this->roles = $roles;
    }


    /**
     * Get Firstname
     *
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }


    /**
     * Set Firstname
     *
     * @param mixed $firstname
     */
    public function setFirstname($firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * Get Lastname
     *
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }


    /**
     * Set Lastname
     *
     * @param mixed $lastname
     */
    public function setLastname($lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * Get Pseudo
     *
     * @return mixed
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }


    /**
     * Set Pseudo
     *
     * @param mixed $pseudo
     */
    public function setPseudo($pseudo): void
    {
        $this->pseudo = $pseudo;
    }

    /**
     * Get Password
     *
     * @return mixed
     */
    public function getMdp()
    {
        return $this->mdp;
    }


    /**
     * Set Password
     *
     * @param mixed $mdp
     */
    public function setMdp($mdp): void
    {
        $this->mdp = $mdp;
    }

    /**
     * Get Email
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }


    /**
     * Set Email
     *
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * Get Created At
     *
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }


    /**
     * Set Created At
     *
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get AddressNumber
     *
     * @return mixed
     */
    public function getAddressNumber()
    {
        return $this->addressNumber;
    }


    /**
     * Set AddressNumber
     *
     * @param mixed $addressNumber
     */
    public function setAddressNumber($addressNumber): void
    {
        $this->addressNumber = $addressNumber;
    }

    /**
     * Get AddressName
     *
     * @return mixed
     */
    public function getAddressName()
    {
        return $this->addressName;
    }


    /**
     * Set AddressName
     *
     * @param mixed $addressName
     */
    public function setAddressName($addressName): void
    {
        $this->addressName = $addressName;
    }

    /**
     * Get City
     *
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }


    /**
     * Set City
     *
     * @param mixed $city
     */
    public function setCity($city): void
    {
        $this->city = $city;
    }

    /**
     * Get ZipCode
     *
     * @return mixed
     */
    public function getZipCode()
    {
        return $this->zip_code;
    }


    /**
     * Set ZipCode
     *
     * @param mixed $zip_code
     */
    public function setZipCode($zip_code): void
    {
        $this->zip_code = $zip_code;
    }

    /**
     * Get Departement
     *
     * @return mixed
     */
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * Set Departement
     *
     * @param mixed $departement
     */
    public function setDepartement($departement): void
    {
        $this->departement = $departement;
    }

    /**
     * Get Country
     *
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }


    /**
     * Set Country
     *
     * @param mixed mixed $country
     */
    public function setCountry($country): void
    {
        $this->country = $country;
    }


    /**
     * Verif if User is admin
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        if ($this->roles == Config::USERS_ADMIN) {
            return true;
        }
        return false;
    }


    /**
     * Verif if User is super admin
     *
     * @return bool
     */
    public function isSuperAdmin(): bool
    {
        if ($this->roles == Config::SUPER_USERS_ADMIN) {
            return true;
        }
        return false;
    }
}
