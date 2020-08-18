<?php


namespace Config;

use Config\Params\Parameter;
class Config
{
    /**
     * @var array $parameters
     */
    protected array $parameters;


    public function __construct()
    {
        $params = new Parameter();
        $this->parameters = $params->parametersConnectBdd();

    }

    public function getParametersConnect(): array
    {
        return $this->parameters['connect'];
    }
}