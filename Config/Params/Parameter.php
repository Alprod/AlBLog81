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
                'dbname' => 'my_sql',
                'login' => 'root',
                'password' => 'alprod81'
            ]
        ];
        return $parameters;
    }

}
