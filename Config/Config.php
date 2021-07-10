<?php


namespace Config;

use App\Entity\Users;
use Config\Params\Parameter;
use Config\Superglobal;

class Config
{
    public const SUPER_USERS_ADMIN = 1;
    public const USERS_ADMIN = 2;
    public const USERS = 3;

    /**
     * @var array $parameters
     */
    protected array $parameters;


    public function __construct()
    {
        $params = new Parameter();
        $this->parameters = $params->parametersConnectBdd();
    }

    /**
     * @return array
     */
    public function getParametersConnect(): array
    {
        return $this->parameters['connect'];
    }

    /**
     * @return array
     */
    public function getTableName(): array
    {
        $table = ucfirst(str_replace(array('Model\\', 'Model'), '', static::class));
        $explode = explode('\\', $table);
        array_shift($explode);
        return $explode;
    }

    /**
     * @param $adress
     *
     */
    public function redirect($adress) : void
    {
        header('Location:'.$adress);
        exit();
    }

    /**
     * @param $layout
     * @param $view
     * @param $params
     * @noinspection PhpIncludeInspection
     * @return bool
     */
    public function render($layout, $view, $params): bool
    {
        $dirView = __DIR__.'/../app/View/';
        $pathView = $dirView.$view;
        $pathLayout = $dirView.$layout;
        if (is_array($params) && !empty($params)) {
            extract($params, EXTR_OVERWRITE);
        }
        ob_start();
        require_once $pathView;
        $content= ob_get_clean();
        ob_start();
        require_once $pathLayout;
        return ob_end_flush();
    }

    /**
     * @param $mdp
     * @return string
     */
    public function cryptMdp($mdp): string
    {
        $salt = 'AlBlog_81';
        $mdp_crypt = md5($mdp.$salt);
        return $mdp_crypt;
    }

    /**
     * @param $data
     * @return array
     */
    public function sanitize($data): array
    {
        $list = [];
        foreach ($data as $key => $value) {
            $list[$key] = htmlentities($value);
        }
        return $list;
    }


    public function createSession($membre) : void
    {
        $_SESSION['id_membre'] = $membre;
        setcookie("timeUsers", $membre, time()+3600*24, "/", "www.alblog81.fr", false, false);
    }

    /**
     * @return bool
     */
    public function initSessionId(): bool
    {
        if (!session_id()) {
            session_start();
            session_regenerate_id();
            return true;
        }
        return false;
    }

    /**
     * Nettoyage de la session.
     */
    public function cleanSessionPhp() : void
    {
        session_unset();
        session_destroy();
    }
}
