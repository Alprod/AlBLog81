<?php


namespace App\Controller;

use App\Entity\Users;
use App\Model\MembresModel;
use Config\Config;
use DateTime;
use DateTimeZone;
use Exception;

class MembreController extends Users
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
        } catch (Exception $e) {
            $params=[
                'titre'=>'Inscription',
                'error'=> $e->getMessage()
            ];
            return $this->getConfig()->render('layout.php', "membres/subscribe.php", $params);
        }

        $pwd = $data['mdp2'];
        $crypt = $this->getConfig()->cryptMdp($pwd);
        $pwd_pepper = hash_hmac("sha256", $pwd, $crypt);


        if ($this->getMembreModel()->register($pwd_pepper, $data)) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            return $this->getConfig()->redirect("/login");
        }

        $params = [
           'titre' => 'Erreur d\'inscription',
           'error' => 'Inscription non réussit',
           'pseudo' => $data['pseudo']
        ];
        return $this->getConfig()->render('layout.php', 'membres/subscribe.php', $params);
    }

    public function login()
    {
        try {
            $data = $this->getConfig()->sanitize($_POST);
            $this->verifLogin($data);
        } catch (Exception $e) {
            return $this->getConfig()->render("layout.php", "membres/login.php", [
                'error'=> $e->getMessage(),
                'titre'=> 'Connexion',
            ]);
        }
        $req = $this->getMembreModel()->loginOfConnexion($data['email']);
        $this->getConfig()->createSession($req['idUsers']);

        $_SESSION['membre'] = $req;
        $_SESSION['pseudo_membre'] = $req['pseudo'];
        $_SESSION['email_membre'] = $req['email'];

        return $this->getConfig()->redirect("/");
    }

    public function logout()
    {
        if (isset($_SESSION['id_membre'])) {
            $_SESSION = array();
            session_destroy();
        }
        return $this->getConfig()->redirect("/");
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

        if (empty($fistname)) {
            throw new Exception('Indiquez Votre nom');
        }

        if (empty($lastname)) {
            throw new Exception('Indiquez Votre Prénom');
        }

        $verifpseudo = $this->getMembreModel()->existPseudo($pseudo);
        if (isset($data['pseudo']) && $verifpseudo) {
            throw new Exception('Désolé mais le Pseudo existe déjà');
        }

        if (strlen($data['pseudo']) <= 3) {
            throw new Exception('Désolé mais votre pseudo est trop court');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) && empty($email)) {
            throw new Exception('Le champs de votre email est incorrect');
        }

        if (!empty($mdp) && ($mdp != $mdp2)) {
            throw new Exception('Erreur dans votre mot de passe');
        }

        if (empty($mdp) || empty($mdp2)) {
            throw new Exception('Il vous faut un mot de passe');
        }

        if (!empty($data)) {
            $champsVide = 0;
            foreach ($data as $value) {
                if (empty(trim($value))) {
                    $champsVide++;
                }
            }
            if ($champsVide > 0) {
                throw new Exception('Veuilez remplir tout les champs, il y a '.$champsVide.' champs manquant.');
            }
        }
    }

    public function verifLogin($data)
    {
        $email = $data['email'];
        $pwd = $data['password'];

        $value = $this->getMembreModel()->loginOfConnexion($email);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) && empty($email)) {
            throw new Exception('Le champs de votre email est incorrect');
        }

        if (isset($email) && !$value) {
            throw new Exception('Désolé mais votre mail n\'existe pas');
        }

        $crypt = $this->getConfig()->cryptMdp($pwd);
        $pwd_pepper = hash_hmac("sha256", $pwd, $crypt);

        if ($value['mdp'] != $pwd_pepper) {
            throw new Exception('Désolé erreur dans votre mot de passe');
        }
    }

    public function userProfil()
    {
        $idUser = $_SESSION['id_membre'];
        $userProfil = $this->getMembreModel()->find($idUser);
        $date = \date($userProfil['createdAt']);
        $dateFomate = strftime("%d %B %G", strtotime($date));

        return $this->getConfig()->render("layout.php", "front/membreProfil.php", [
            'titre' => 'Profil',
            'profil' => $userProfil,
            'dateInscription' => $dateFomate
        ]);
    }

    public function mdpUpdate()
    {
        try {
            $data = $this->getConfig()->sanitize($_POST);
            $this->verifMdp($data);
        } catch (Exception $e) {
            $idUser = $_SESSION['id_membre'];
            $profil = $this->getMembreModel()->find($idUser);
            $date = \date($profil['createdAt']);
            $dateFomate = strftime("%d %B %G", strtotime($date));

            return $this->getConfig()->render("layout.php", "front/membreProfil.php", [
                'titre' => 'Profil',
                'errorMdp'=> $e->getMessage(),
                'profil'=> $profil,
                'dateInscription' => $dateFomate
            ]);
        }
        $idUser = $_SESSION['id_membre'];
        $mdpConfirm = $data['mdpComfirm'];

        $criptConfirm = $this->getConfig()->cryptMdp($mdpConfirm);
        $pwd_Confirm = hash_hmac("sha256", $mdpConfirm, $criptConfirm);

        if (isset($data) && !empty($data['mdpActuel'])) {
            $this->getMembreModel()->updateMdp($idUser, $pwd_Confirm);
        }
        return $this->getConfig()->redirect("/profil");
    }

    public function verifMdp($data)
    {
        $idUser = $_SESSION['id_membre'];
        $mdpActuel = $data['mdpActuel'];
        $mdpNew = $data['mdpNew'];
        $mdpConfirm = $data['mdpComfirm'];

        $criptActuel = $this->getConfig()->cryptMdp($mdpActuel);
        $pwd_Actuel = hash_hmac("sha256", $mdpActuel, $criptActuel);

        $criptNew = $this->getConfig()->cryptMdp($mdpNew);
        $pwd_New = hash_hmac("sha256", $mdpNew, $criptNew);

        $criptConfirm = $this->getConfig()->cryptMdp($mdpConfirm);
        $pwd_Confirm = hash_hmac("sha256", $mdpConfirm, $criptConfirm);

        $profil = $this->getMembreModel()->find($idUser);

        if ($pwd_Actuel !== $profil['mdp']) {
            throw new Exception('Désolé mais votre mot de pas est inéxate');
        }

        if ($pwd_New   !== $pwd_Confirm) {
            throw new Exception('les mots de passe ne sont pas identique');
        }
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        $userAdmin = Config::USERS_ADMIN;
        return isset($_SESSION['membre']) && $_SESSION['membre']['roles'] === $userAdmin;
    }

    /**
     * @return bool
     */
    public function isSuperAdmin()
    {
        $superAdmin = Config::SUPER_USERS_ADMIN;
        return isset($_SESSION['membre']) && $_SESSION['membre']['roles'] === $superAdmin;
    }
}
