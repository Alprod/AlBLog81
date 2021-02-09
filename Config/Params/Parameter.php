<?php


namespace Config\Params;

class Parameter
{
    const TOKEN_GMAIL = '';
    const EMAIL_WEB_MASTER = '';

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
                'password' => ''
            ]
        ];
        return $parameters;
    }
}
