<?php


namespace App\Controller;


use App\Model\MembresModel;
use Config\Config;
use Exception;


class MembreController
{
    private Config $config;
    private MembresModel $membreModel;


    /**
     * MembreController constructor.
     *
     */
    public function __construct()
    {
        $this->config = new Config();
        $this->membreModel = new MembresModel();

    }

    /**
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this -> config;
    }

    /**
     * @return MembresModel
     */
    public function getMembreModel(): MembresModel
    {
        return $this -> membreModel;
    }

    public function membresSubscribe()
    {
        return $this->getConfig()->render("layout.php", "membres/subscribe.php", array(
            'titre' => 'Inscription'
        ));
    }

    public function inscription()
    {

    }

    public function validation($data)
    {
        $fistname = $data['firstname'];
        $lastname = $data['lastname'];
        $pseudo = $data['pseudo'];
        $email = $data['email'];
        $mdp = $data['mdp'];
        $mdp2 = $data['mdp2'];

        if(!empty($data)){
            $champsVide = 0;
            foreach ($data as $value){
                if(empty(trim($value))) $champsVide++;
            }
            if ($champsVide > 0){
                throw new Exception('Veuilez remplir tout les champs, il y a '.$champsVide.' manquant.');
            }

        }

        if (empty($fistname)){
            throw new Exception('Indiquez Votre nom');
        }

        if (empty($lastname)){
            throw new Exception('Indiquez Votre nom');
        }

        $verifpseudo = $this->getMembreModel()->existPseudo($pseudo);
        if(isset($data['pseudo']) && $verifpseudo){
            throw new Exception('Désolé mais le Pseudo existe déjà');
        }

        if(strlen($data['pseudo']) <= 3){
            throw new Exception('Désolé mais pseudo trop court');
        }


    }

    public function cryptMdp($mdp)
    {
        $salt = 'AlBlog_81';
        $mdp_crypt = md5($mdp.$salt);
        return $mdp_crypt;
    }


}