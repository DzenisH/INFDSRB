<?php 

namespace app\controllers;

use app\Router;

class VerificationController
{
    public function get(Router $router)
    {
        $router->renderView("verification",[]);
    }
}