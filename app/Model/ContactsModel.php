<?php


namespace App\Model;

use App\Entity\Contacts;
use Config\PDOmanager;

class ContactsModel extends PDOmanager
{
    public function insertMailSendByUser(Contacts $contact)
    {
        $date = date('Y-m-d H:i');
        $req = 'INSERT INTO Contacts (
                                        nameContact,
                                        email,
                                        sujet,
                                        message,
                                        createdMailDate)
                                    VALUES (
                                            :contactName,
                                            :email,
                                            :sujet,
                                            :message,
                                            :createdMailDate
                                    )';
        $result = $this->getBdd()->prepare($req);
        $result->bindValue(':contactName', $contact->getNameContact());
        $result->bindValue(':email', $contact->getEmail());
        $result->bindValue(':sujet', $contact->getSujet());
        $result->bindValue(':message', $contact->getMessage());
        $result->bindValue(':createdMailDate', $date);

        return $result->execute();
    }
}
