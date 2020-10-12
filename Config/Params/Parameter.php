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
                'dbname' => 'my_blog',
                'login' => 'alprod',
                'password' => 'Alprod81'
            ]
        ];
        return $parameters;
    }



}
