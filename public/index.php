<?php

use app\controllers\AccountController;
use app\controllers\ArticleController;
use app\controllers\CardboardController;
use app\controllers\ChangePassword;
use app\controllers\ChatController;
use app\controllers\ChoiceController;
use app\controllers\DeleteController;
use app\controllers\HomeController;
use app\controllers\PatientController;
use app\controllers\RequestChangeController;
use app\controllers\RequestController;
use app\Router;

require_once __DIR__.'/../vendor/autoload.php';

$router = new Router();

$router->get('/',[HomeController::class,'index']);  //for route '/' call get method of PatientController
$router->get('/login',[AccountController::class,'login']);
$router->post('/login',[AccountController::class,'login']);
$router->get('/signup',[AccountController::class,'signup']);
$router->post('/signup',[AccountController::class,'signup']);
$router->get('/patients',[PatientController::class,'get']);
$router->get('/chat',[ChatController::class,'get']);
$router->post('/chat',[ChatController::class,'sendMessage']);
$router->get('/choice',[ChoiceController::class,'get']);
$router->post('/choice',[ChoiceController::class,'assignDoctor']);
$router->get('/cardboard',[CardboardController::class,'get']);
$router->get('/requests',[RequestController::class,'get']);
$router->post('/requests',[RequestController::class,'accept']);
$router->get('/delete',[DeleteController::class,'get']);
$router->post('/delete',[DeleteController::class,'delete']);
$router->get('/request-change',[RequestChangeController::class,'get']);
$router->post('/request-change',[RequestChangeController::class,'request']);
$router->get('/addArticle',[ArticleController::class,'addArticle']);
$router->post('/addArticle',[ArticleController::class,'addArticle']);
$router->get('/articles',[ArticleController::class,'get']);
$router->get('/detailArticle',[ArticleController::class,'get2']);
$router->get('/changePassword',[ChangePassword::class,'get']);
$router->post('/changePassword',[ChangePassword::class,'post']);
$router->resolve();