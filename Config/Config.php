<?php


namespace Config;

use Config\Params\Parameter;

class Config
{
    const SUPER_USERS_ADMIN = 1;
    const USERS_ADMIN = 2;
    const USERS = 3;
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
     * @param $adress
     * @param $params
     */
    public function redirect($adress,$params)
    {
        if (is_array($params) && !empty($params)){
            extract($params,EXTR_OVERWRITE);
        }
        header('Location:'.$adress);
        exit();
    }

    /**
     * @return array
     */
    public function getTableName(): array
    {
        $table = ucfirst(str_replace(array('Model\\', 'Model'),'', static::class));
        $explode = explode('\\', $table);
        array_shift($explode);
        return $explode;
    }

    /**
     * @param $layout
     * @param $view
     * @param $params
     * @noinspection PhpIncludeInspection
     * @return bool
     */
    public function render($layout,$view,$params): bool
    {
        $dirView = __DIR__.'/../app/View/';
        $pathView = $dirView.$view;
        $pathLayout = $dirView.$layout;
        if (is_array($params) && !empty($params)){
            extract($params,EXTR_OVERWRITE);
        }
        ob_start();
        require $pathView;
        $content= ob_get_clean();
        ob_start();
        require $pathLayout;
        return ob_end_flush();

    }

    /**
     * @param $data
     * @return array
     */
    public function sanitize($data)
    {
        $list = [];
        foreach ($data as $key=>$value) {
            $list[$key] = htmlentities($value);
        }
        return $list;
    }

    /**
     * @param $membre
     */
    public function createSession($membre)
    {
        $_SESSION['id_membre'] = $membre;
    }

    /**
     * @return bool
     */
    public function initSessionId()
    {
        if(!session_id()){
            session_start();
            session_regenerate_id();
            return true;
        }
        return false;
    }

    /**
     * Nettoyage de la session.
     */
    public function cleanSessionPhp()
    {
        session_unset();
        session_destroy();
    }

}