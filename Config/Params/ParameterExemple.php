<?php


namespace Config\Params;

/*
 * Modifer ParametreExemple par Parametre
 */
class ParameterExemple
{
    const TOKEN_GMAIL = 'your_code_mail';
    const EMAIL_WEB_MASTER = 'your_address_mail';
    /**
     * @return string[]
     */
    public function parametersConnectBdd(): array
    {
        $parameters = [
            'connect' => [
                'host' => 'localhost',
                'dbname' => 'my_blog',
                'login' => 'yourLogin',
                'password' => 'yourPassword'
            ]
        ];
        return $parameters;
    }
}
