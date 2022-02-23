<?php 

namespace app\controllers;

use app\Router;

class ContactController
{
    public function get(Router $router)
    {
        $router->renderView('contact',[]);
    }
}