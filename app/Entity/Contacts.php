<?php


namespace App\Entity;

class Contacts extends Entity
{
    private $idContacts;
    private $nameContact;
    private $email;
    private $sujet;
    private $message;
    private $createdMailDate;

    /**
     * @return mixed
     */
    public function getIdContacts()
    {
        return $this -> idContacts;
    }

    /**
     * @param mixed $idContacts
     */
    public function setIdContacts($idContacts): void
    {
        $this -> idContacts = $idContacts;
    }

    /**
     * @return mixed
     */
    public function getNameContact()
    {
        return $this -> nameContact;
    }

    /**
     * @param mixed $nameContact
     */
    public function setNameContact($nameContact): void
    {
        $this -> nameContact = $nameContact;
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
    public function getSujet()
    {
        return $this -> sujet;
    }

    /**
     * @param mixed $sujet
     */
    public function setSujet($sujet): void
    {
        $this -> sujet = $sujet;
    }



    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this -> message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this -> message = $message;
    }

    /**
     * @return mixed
     */
    public function getCreatedMailDate()
    {
        return $this -> createdMailDate;
    }

    /**
     * @param mixed $createdMailDate
     */
    public function setCreatedMailDate($createdMailDate): void
    {
        $this -> createdMailDate = $createdMailDate;
    }
}
