<?php

namespace app\controllers;

use app\Router;

class AccountController
{
    public function login(Router $router)
    {
        $router->renderView('login',[]);
    }
}