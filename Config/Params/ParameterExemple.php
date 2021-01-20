<?php


namespace Config\Params;

/*
 * Modifer ParametreExemple par Parametre
 */
class ParameterExemple
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
                'login' => 'yourLogin',
                'password' => 'yourPassword'
            ]
        ];
        return $parameters;
    }
}
