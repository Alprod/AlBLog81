<?php


namespace Config\Params;


class Parameter
{
    /**
     * @return string[]
     */
    public function parametersConnectBdd(): array
    {
        $parameters = [
            'connect' => [
                'host' => 'localhost',
                'dbname' => 'PoleNord',
                'login' => 'root',
                'password' => ''
            ]
        ];
        return $parameters;
    }

}
