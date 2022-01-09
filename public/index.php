<?php

use app\controllers\AccountController;
use app\controllers\HomeController;
use app\controllers\PatientController;

use app\Router;

require_once __DIR__.'/../vendor/autoload.php';

$router = new Router();

$router->get('/',[HomeController::class,'index']);  //for route '/' call get method of PatientController
$router->get('/login',[AccountController::class,'login']);
$router->post('/login',[AccountController::class,'login']);
$router->get('/patients',[PatientController::class,'get']);

$router->resolve();