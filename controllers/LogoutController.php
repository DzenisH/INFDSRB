<?php 

namespace app\controllers;

use app\Router;

class LogoutController
{
    public function get(Router $router)
    {
        $router->renderView('logout',[]);
    }
}