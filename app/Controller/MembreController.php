<?php


namespace App\Controller;


use App\Model\MembresModel;
use Config\Config;
use DateTime;
use DateTimeZone;
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

    /**
     * @return bool
     */
    public function membresSubscribe()
    {
        return $this->getConfig()->render("layout.php", "membres/subscribe.php", array(
            'titre' => 'Inscription'
        ));
    }

    public function membresConnexion()
    {
        return $this->getConfig()->render("layout.php", "membres/login.php", [
            'titre'=> 'Connexion'
        ]);
    }

    public function inscription()
    {
        try {
            $data= $this->getConfig()->sanitize($_POST);
            $this->validation($data);
        }catch (Exception $e){
           return $this->getConfig()->render('layout.php', "membres/subscribe.php", [
                'titre'=>'Inscription',
                'error'=> $e->getMessage()
            ]);
        }
        //Afin de verifier le mdp lors de la connexion utiliser la fonction password_verify()
        $pwd = $data['mdp2'];
        $crypt = $this->cryptMdp($pwd);
        $pwd_pepper = hash_hmac("sha256",$pwd,$crypt);


       if($this->getMembreModel()->register($pwd_pepper,$data)){

           if(session_status() === PHP_SESSION_NONE){
               session_start();
           }

           $id_user = $this->getMembreModel()->getLatest();
           $this->getConfig()->createSession($id_user);

           $home = new HomeController();
           $laDateDuJour= $home->dateOfTheDay();
           $heure = new DateTime('now',  new DateTimeZone( 'EUROPE/Paris' ));
           $heureDuJour = $heure->format('H:i');
           $calendarChinese= $home->calendarChinese(date('Y'));

           return $this->getConfig()->render('layout.php','base.php',[
               'success' => 'Bienvenue à vous',
               'pseudo' => $data['pseudo'],
               'laDateDuJour' => $laDateDuJour,
               'heureDuJour' => $heureDuJour,
               'calendarChinese' => $calendarChinese
           ]);
       }

        return $this->getConfig()->render('layout.php', 'membres/subscribe.php',[
            'titre' => 'Erreur d\'inscription',
            'error' => 'Inscription non réussit',
            'pseudo' => $data['pseudo']
        ]);

    }

    public function login()
    {
        try {
            $data = $this->getConfig()->sanitize($_POST);
            $this->verifLogin($data);

        }catch (Exception $e){
            return $this->getConfig()->render("layout.php", "membres/login.php", [
               'error'=> $e->getMessage(),
                'titre'=> 'Connexion'
            ]);
        }

    }

    /**
     * @param $data
     * @throws Exception
     */
    public function validation($data)
    {
        $fistname = $data['firstname'];
        $lastname = $data['lastname'];
        $pseudo = $data['pseudo'];
        $email = $data['email'];
        $mdp = $data['mdp'];
        $mdp2 = $data['mdp2'];

        /**/

        if (empty($fistname)){
            throw new Exception('Indiquez Votre nom');
        }

        if (empty($lastname)){
            throw new Exception('Indiquez Votre Prénom');
        }

        $verifpseudo = $this->getMembreModel()->existPseudo($pseudo);
        if(isset($data['pseudo']) && $verifpseudo){
            throw new Exception('Désolé mais le Pseudo existe déjà');
        }

        if(strlen($data['pseudo']) <= 3){
            throw new Exception('Désolé mais votre pseudo est trop court');
        }

        if(!filter_var($email,FILTER_VALIDATE_EMAIL) && empty($email)){
            throw new Exception('Le champs de votre email est incorrect');
        }

        if(!empty($mdp) && ($mdp != $mdp2)){
            throw new Exception('Erreur dans votre mot de passe');
        }

        if(empty($mdp) || empty($mdp2)){
            throw new Exception('Il vous faut un mot de passe');
        }

        if(!empty($data)){
            $champsVide = 0;
            foreach ($data as $value){
                if(empty(trim($value))) $champsVide++;
            }
            if ($champsVide > 0){
                throw new Exception('Veuilez remplir tout les champs, il y a '.$champsVide.' champs manquant.');
            }
        }
    }

    public function verifLogin($data)
    {
      $email = $data['email'];
      $pwd = $data['password'];

      $value = $this->getMembreModel()->loginOfConnexion($email);

        if(!filter_var($email,FILTER_VALIDATE_EMAIL) && empty($email)){
            throw new Exception('Le champs de votre email est incorrect');
        }

      if(isset($email) && !$value){
          throw new Exception('Désolé mais votre mail n\'existe pas');
      }

      $crypt = $this->cryptMdp($pwd);
      $pwd_pepper = hash_hmac("sha256",$pwd,$crypt);
      $pwd_hash = password_hash($pwd_pepper, PASSWORD_BCRYPT);


      if($value['mdp'] != $pwd_hash){
          throw new Exception('Désolé erreure dans vore mot de passe');
      }

    }

    /**
     * @param $mdp
     * @return string
     */
    public function cryptMdp($mdp)
    {
        $salt = 'AlBlog_81';
        $mdp_crypt = md5($mdp.$salt);
        return $mdp_crypt;
    }




}