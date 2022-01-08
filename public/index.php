<?php

use app\controllers\AccountController;
use app\controllers\PatientController;

use app\Router;

require_once __DIR__.'/../vendor/autoload.php';

$router = new Router();

$router->get('/',[PatientController::class,'get']);  //for route '/' call get method of PatientController
$router->get('/login',[AccountController::class,'login']);

$router->resolve();