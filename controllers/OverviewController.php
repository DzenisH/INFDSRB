<?php 

namespace app\controllers;

use app\Router;

class OverviewController
{
    public function get(Router $router)
    {
        $router->renderView('overview',[]);
    }
}