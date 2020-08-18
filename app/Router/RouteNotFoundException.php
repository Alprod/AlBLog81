<?php
namespace App\Router;

use Exception;

class RouteNotFoundException extends Exception
{
    public function errorPageNotFound()
    {
        $errorPage = include '../View/404.html';
        return $errorPage;
    }
}