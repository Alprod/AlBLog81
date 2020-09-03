<?php
namespace App\Router;

use Exception;

class RouteNotFoundException extends Exception
{
    public function errorPageNotFound()
    {
        $errorPage = require '../View/404.html';
        return $errorPage;
    }
}