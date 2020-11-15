<?php


namespace App\Entity;


class Users
{
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
     * @return mixed
     */
    public function getIdUsers()
    {
        return $this -> idUsers;
    }

    /**
     * @param mixed $idUsers
     */
    public function setIdUsers($idUsers): void
    {
        $this -> idUsers = $idUsers;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this -> roles;
    }

    /**
     * @param mixed $roles
     */
    public function setRoles($roles): void
    {
        $this -> roles = $roles;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this -> firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname): void
    {
        $this -> firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this -> lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname): void
    {
        $this -> lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getPseudo()
    {
        return $this -> pseudo;
    }

    /**
     * @param mixed $pseudo
     */
    public function setPseudo($pseudo): void
    {
        $this -> pseudo = $pseudo;
    }

    /**
     * @return mixed
     */
    public function getMdp()
    {
        return $this -> mdp;
    }

    /**
     * @param mixed $mdp
     */
    public function setMdp($mdp): void
    {
        $this -> mdp = $mdp;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this -> email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this -> email = $email;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this -> createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this -> createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getAddressNumber()
    {
        return $this -> addressNumber;
    }

    /**
     * @param mixed $addressNumber
     */
    public function setAddressNumber($addressNumber): void
    {
        $this -> addressNumber = $addressNumber;
    }

    /**
     * @return mixed
     */
    public function getAddressName()
    {
        return $this -> addressName;
    }

    /**
     * @param mixed $addressName
     */
    public function setAddressName($addressName): void
    {
        $this -> addressName = $addressName;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this -> city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city): void
    {
        $this -> city = $city;
    }

    /**
     * @return mixed
     */
    public function getZipCode()
    {
        return $this -> zip_code;
    }

    /**
     * @param mixed $zip_code
     */
    public function setZipCode($zip_code): void
    {
        $this -> zip_code = $zip_code;
    }

    /**
     * @return mixed
     */
    public function getDepartement()
    {
        return $this -> departement;
    }

    /**
     * @param mixed $departement
     */
    public function setDepartement($departement): void
    {
        $this -> departement = $departement;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this -> country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country): void
    {
        $this -> country = $country;
    }
}