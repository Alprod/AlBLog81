<?php


namespace Config\Params;

class Parameter
{
    const TOKEN_GMAIL = 'M8V-tN7-x3H-5Ry';
    const EMAIL_WEB_MASTER = 'alprod81@gmail.com';

    /**
     * @return string[]
     */
    public function parametersConnectBdd(): array
    {
        $parameters = [
            'connect' => [
                'host' => 'localhost',
                'dbname' => 'my_blog',
                'login' => 'root',
                'password' => 'Alprod_81'
            ]
        ];
        return $parameters;
    }
}
