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
     */
    public function redirect($adress): void
    {
        header('Location:'.$adress);
        exit();
    }

    /**
     * @param $url
     * @return string
     */
    public function assets($url): string
    {
        return "http://localhost/AlBlog81/".$url;
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
}