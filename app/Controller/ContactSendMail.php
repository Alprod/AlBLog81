<?php


namespace App\Controller;

use Config\Config;

class ContactSendMail extends Config
{
    public function contact()
    {
        return $this->render("layout.php","contact.php",array());
    }

}