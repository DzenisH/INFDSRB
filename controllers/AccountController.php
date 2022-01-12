<?php

namespace app\controllers;

// session_start();
// session_destroy();

use app\Router;

class AccountController
{
    public function login(Router $router)
    {
        $loginData = [
            'email' => '',
            'password' => ''
        ];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $loginData['email'] = $_POST['email'];
            $loginData['password'] = $_POST['password'];
            $user = $router->db->checkLogin($loginData); //checkLogin will return user that loged in(if user don't succesufully loged in length of an array will be 0)
            if(count($user) !== 0){   
                $_SESSION["user"] = $user[0]; //session variable user contain user that is currently loged in
                if($_SESSION["user"]["type"] === "patient" && $_SESSION["user"]["doctor_id"] === null){
                    header('Location:/choice');
                }else{
                    header('Location:/');
                }
            }
        }

        $router->renderView('login',[
            $loginData
        ]);
    }
}