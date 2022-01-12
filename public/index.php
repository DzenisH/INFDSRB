<?php

use app\controllers\AccountController;
use app\controllers\Cardboard;
use app\controllers\CardboardController;
use app\controllers\ChatController;
use app\controllers\ChoiceController;
use app\controllers\HomeController;
use app\controllers\PatientController;

use app\Router;

require_once __DIR__.'/../vendor/autoload.php';

$router = new Router();

$router->get('/',[HomeController::class,'index']);  //for route '/' call get method of PatientController
$router->get('/login',[AccountController::class,'login']);
$router->post('/login',[AccountController::class,'login']);
$router->get('/patients',[PatientController::class,'get']);
$router->get('/chat',[ChatController::class,'get']);
$router->post('/chat',[ChatController::class,'sendMessage']);
$router->get('/choice',[ChoiceController::class,'get']);
$router->post('/choice',[ChoiceController::class,'assignDoctor']);
$router->get('/cardboard',[CardboardController::class,'get']);

$router->resolve();