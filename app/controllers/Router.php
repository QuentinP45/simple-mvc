<?php

namespace App\Controllers;

use Config\DefineControllers;
use App\Controllers\HomeController;
use Exception;

class Router
{
    private $controller;

    public function __construct()
    {
        $defineControllers = new defineControllers;

        try {
            if (isset($_GET['url'])) {
                if (!empty($_GET['url'])) {
                    $url = strToLower(htmlspecialchars($_GET['url']));

                    // URL PARAMS = [CONTROLLER, ACTION, ID] 
                    $urlParams = explode('/', $url);

                    $controller = $urlParams[0];

                    // URL PARAMS = [ACTION, ID]
                    array_shift($urlParams);

                    $requestMethod = $_SERVER['REQUEST_METHOD'];

                    // AUTOLOAD REQUIRED CONTROLLER
                    switch ($controller) {
                        case HOME:
                        $this->controller = new HomeController;
                        break;

                        default:
                        $this->controller = new HomeController;
                    }
                } else {
                    throw new Exception('Router: paramètre "url vide, page introuvable');
                }
            } else {
                throw new Exception('Router: pas de paramètre "url", page introuvable');
            }
        } catch (Exception $e) {

        }
    }
}
