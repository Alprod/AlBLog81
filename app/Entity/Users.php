<?php


namespace App\Entity;


class Users
{
    private $idUsers;
    private $firstname;
    private $lastname;
    private $pseudo;
    private $email;
    private $password;
    private $roles;
    private $subscribe_date;

    /**
     * @return mixed
     */
    public function getIdUsers()
    {
        return $this->idUsers;
    }

    /**
     * @param mixed $idUsers
     */
    public function setIdUsers($idUsers): void
    {
        $this->idUsers = $idUsers;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param mixed $pseudo
     */
    public function setPseudo($pseudo): void
    {
        $this->pseudo = $pseudo;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param mixed $roles
     */
    public function setRoles($roles): void
    {
        $this->roles = $roles;
    }

    /**
     * @return mixed
     */
    public function getSubscribeDate()
    {
        return $this->subscribe_date;
    }

    /**
     * @param mixed $subscribe_date
     */
    public function setSubscribeDate($subscribe_date): void
    {
        $this->subscribe_date = $subscribe_date;
    }



}