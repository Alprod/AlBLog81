<?php


namespace App\Controller;

use App\Entity\Users;
use App\Model\CommentsModel;
use App\Model\MembresModel;
use App\Model\PostsModel;
use Config\Config;
use DateTime;
use DateTimeZone;
use Exception;
use Date;

class MembreController extends Users
{
    private Config $config;
    private MembresModel $membreModel;
    private PostsModel $postModel;
    private CommentsModel $commentModel;


    /**
     * MembreController constructor.
     *
     */
    public function __construct()
    {
        $this->config = new Config();
        $this->membreModel = new MembresModel();
        $this->postModel = new PostsModel();
        $this->commentModel = new CommentsModel();
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

    public function getPostModel()
    {
        return $this->postModel;
    }

    /**
     * @return CommentsModel
     */
    public function getCommentModel(): CommentsModel
    {
        return $this -> commentModel;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        $userAdmin = Config::USERS_ADMIN;
        return isset($_SESSION['membre']) && $_SESSION['membre']->getRoles() == $userAdmin;
    }

    /**
     * @return bool
     */
    public function membresSubscribe(): bool
    {
        return $this->getConfig()->render("layout.php", "membres/subscribe.php", array(
            'titre' => 'Inscription',
        ));
    }

    /**
     * @return bool
     */
    public function membresConnexion(): bool
    {
        return $this->getConfig()->render("layout.php", "membres/login.php", [
            'titre'=> 'Connexion'
        ]);
    }


    /**
     * @return bool
     */
    public function updateRegister()
    {

        $user = $this->getMembreModel()->find($_SESSION['id_membre']);

        $params = [
            'titre' => 'Modifier les infos',
            'user' => $user
            ];
        return $this->getConfig()->render('layout.php', "membres/subscribe.php", $params);
    }


    /**
     * @return bool|void
     */
    public function inscription(): bool
    {
        try {
            $data= $this->getConfig()->sanitize($_POST);
            $this->validation($data);
            $user = new Users();
            $user->hydrate($data);

            $pwd = $user->getMdp();
            $crypt = $this->getConfig()->cryptMdp($pwd);
            $pwd_pepper = hash_hmac("sha256", $pwd, $crypt);

            if ($this->getMembreModel()->register($pwd_pepper, $user)) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                return $this->getConfig()->redirect("/login");
            }
        } catch (Exception $e) {
            $params=[
                'titre'=>'Erreur d\'inscription',
                'error'=> $e->getMessage()
            ];
            return $this->getConfig()->render('layout.php', "membres/subscribe.php", $params);
        }
    }


    /**
     * @return bool
     */
    public function updateMemberRegister()
    {
        try {
            $data = $this->getConfig()->sanitize($_POST);
            $user = new Users();
            $user->hydrate($data);
            $this->updateValidation($user);
            if (!empty($user->getMdp())) {
                if ($user->getMdp() != $data['mdp2']) {
                    throw new Exception('les mots de passe ne sont pas identique');
                }
                $mdpCripte = $this->getConfig()->cryptMdp($data['mdp2']);
                $pwd_confirm = hash_hmac('sha256', $data['mdp2'], $mdpCripte);
                $idUser = $_SESSION['id_membre'];
                $this->getMembreModel()->updateMdp($idUser, $pwd_confirm);
            }
            $this->getMembreModel()->updateMemberRegister($user);
            $userId = $user->getIdUsers();
            $userProfil = $this->getMembreModel()->find($userId);
            $commentUserId = $this->getCommentModel()->findCommentsByUserId($userId);
            $postUserId = $this->getPostModel()->findPostsByIdUser($userId);
            $date = date($userProfil->getCreatedAt());
            $dateFomate = strftime("%d %B %G", strtotime($date));

            return $this->getConfig()->render('layout.php', 'membres/membreProfil.php', [
                'titre' => 'Profil',
                'profil'=>$userProfil,
                'comments'=>$commentUserId,
                'posts'=>$postUserId,
                'dateInscription' => $dateFomate,
                'success'=>'Information modifier'
            ]);
        } catch (Exception $e) {
            $params = [
                'titre'=> 'Inscription',
                'user' => $user,
                'error' => $e->getMessage()
            ];
            return $this->getConfig()->render('layout.php', 'membres/subscribe.php', $params);
        }
    }


    /**
     * @return bool|void
     */
    public function login(): bool
    {
        try {
            $data = $this->getConfig()->sanitize($_POST);
            $this->verifLogin($data);

            $user = $this->getMembreModel()->loginOfConnexion($data['email']);
            $this->getConfig()->createSession($user->getIdUsers());
            $_SESSION['membre'] = $user;
            $_SESSION['pseudo_membre'] = $user->getPseudo();
            $_SESSION['email_membre'] = $user->getEmail();
            return $this->getConfig()->redirect("/");
        } catch (Exception $e) {
            return $this->getConfig()->render("layout.php", "membres/login.php", [
                'error'=> $e->getMessage(),
                'titre'=> 'Connexion',
            ]);
        }
    }


    public function logout()
    {
        if (isset($_SESSION['id_membre'])) {
            $this->getConfig()->cleanSessionPhp();
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

    public function updateValidation(Users $data)
    {
        $userMembre = $this->getMembreModel()->find($data->getIdUsers());

        if (empty($data->getFirstname())) {
            throw new Exception('Veuiilez indiquer un votre nom');
        }

        if (empty($data->getLastname())) {
            throw new Exception('Indiquez votre prénom');
        }

        if (strlen($data->getPseudo()) <= 3 || empty($data->getPseudo())) {
            throw new Exception('Votre pseudo est trop court');
        }

        if ($data->getPseudo() != $userMembre->getPseudo()) {
            if ($this->getMembreModel()->existPseudo($data->getPseudo())) {
                throw new Exception('Désolé mais le pseudo existe déjà');
            }
        }

        if ($data->getEmail() != $userMembre->getEmail()) {
            if (!filter_var($data->getEmail(), FILTER_VALIDATE_EMAIL)) {
                throw new Exception('Le champs de votre email est incorrect');
            }
        }

        switch ($data) {
            case empty($data->getAddressNumber()):
            case empty($data->getAddressName()):
            case empty($data->getZipCode()):
            case empty($data->getCity()):
            case empty($data->getDepartement()):
            case empty($data->getCountry()):
                throw new Exception('Veuillez Remplir les champs maquent');
                break;
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

        if ($value->getMdp() != $pwd_pepper) {
            throw new Exception('Désolé erreur dans votre mot de passe');
        }
    }


    public function userProfil()
    {
        $idUser = $_SESSION['id_membre'];
        $userProfil = $this->getMembreModel()->find($idUser);
        $date = date($userProfil->getCreatedAt());
        $dateFomate = strftime("%d %B %G", strtotime($date));

        $commentUserId = $this->getCommentModel()->findCommentsByUserId($idUser);

        $postUserId = $this->getPostModel()->findPostsByIdUser($idUser);


        return $this->getConfig()->render("layout.php", "membres/membreProfil.php", [
            'titre' => 'Profil',
            'profil' => $userProfil,
            'comments' => $commentUserId,
            'posts' => $postUserId,
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
            $commentUserId = $this->getPostModel()->findCommentById($idUser);
            $date = date($profil->getCreateAt());
            $dateFomate = strftime("%d %B %G", strtotime($date));

            return $this->getConfig()->render("layout.php", "membres/membreProfil.php", [
                'titre' => 'Profil',
                'errorMdp'=> $e->getMessage(),
                'profil'=> $profil,
                'comments' => $commentUserId,
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

        if ($pwd_Actuel !== $profil->getMdp()) {
            throw new Exception('Désolé mais votre mot de pas est inéxate');
        }

        if ($pwd_New   !== $pwd_Confirm) {
            throw new Exception('les mots de passe ne sont pas identique');
        }
    }
}
