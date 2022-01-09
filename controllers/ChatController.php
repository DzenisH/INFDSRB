<?php 

namespace app\controllers;

use app\Router;

class ChatController{
    public function getPatients(Router $router){  //fuction for getting all patients to which doctor had already sent a message
        $router->renderView('chat',[]);
    }
}