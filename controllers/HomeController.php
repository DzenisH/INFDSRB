<?php

namespace app\controllers;

use App\Router;

class HomeController
{
    public function index(Router $router)
    {
        $router->renderView('home',[]);
    }
}