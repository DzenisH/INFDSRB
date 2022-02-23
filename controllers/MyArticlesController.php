<?php 

namespace app\controllers;

use app\Router;

class MyArticlesController
{
    public function get(Router $router)
    {
        $articles = $router->db->getMyArticles();
        $router->renderView('myArticles',[
            "articles" => $articles
        ]);
    }

    public function deleteArticle(Router $router)
    {
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            $id = $_POST['id'];
            $router->db->deleteArticle($id);   
            header('Location:/myArticles');
        }     

        $router->renderView('myArticles',[]);
    }
}