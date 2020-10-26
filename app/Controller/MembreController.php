<?php


namespace App\Controller;


use Config\Config;


class MembreController
{
    private Config $config;


    /**
     * MembreController constructor.
     *
     */
    public function __construct()
    {
        $this -> config = new Config();
    }

    /**
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this -> config;
    }

    public function membresSubscribe()
    {

        return $this->getConfig()->render("layout.php", "membres/subscribe.php", array(
            'titre' => 'Inscription'
        ));
    }

}