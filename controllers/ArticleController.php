<?php 

namespace app\controllers;

use app\models\Article;
use app\Router;

class ArticleController
{
    public function get(Router $router)
    {
        $articles = $router->db->getArticles();
        $router->renderView('articles',[
            "articles" => $articles
        ]);
    }
    public function addArticle(Router $router)
    {
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $image = $_FILES['image'];
            $fileName = $_FILES['image']['name'];
            $fileTmpName = $_FILES['image']['tmp_name']; 
            $fileError = $_FILES['image']['error'];  

            $fileExt = explode('.',$fileName);  
            $fileActualExt = strtolower(end($fileExt)); 

            $allowed = array('jpg','jpeg','png'); 

            if (in_array($fileActualExt,$allowed)) {
                if($fileError === 0){  //there are no errors
                    $imageNameNew = uniqid('',true).".".$fileActualExt;  //we get tim format in microseconds(so we can't ovverride some existing image)
                    $fileDestination =  './images/articles/'.$imageNameNew; 
                    move_uploaded_file($fileTmpName,$fileDestination);  //move image from temporary location into new location 
                } else{
                    echo "There was an error uploading your file!";
                }
            } else{
                echo "You cannot upload files of this type!";
            }
            $data = [
                "doctor_id" => $_POST["id"],
                "title" => $_POST["title"],
                "description" => $_POST["description"],
                "content" => $_POST["content"],
                "user_id" => $_SESSION['user']['id'],
                "image" => $fileDestination,
                "type_of_user" => $_POST["type_of_user"]
            ];
            $article = new Article();
            $article->load($data);
            $article->save();
            header('Location:/myArticles');
        }
        $router->renderView('addArticle',[]);
    }

    public function get2(Router $router)
    {
        $id = $_GET["id"];
        $article = $router->db->getArticle($id);
        $author = $router->db->getArticleAuthor($id);
        $router->renderView('detailArticle',[
            "article" => $article,
            "author" => $author
        ]);
    }

    public function deleteArticle(Router $router)
    {
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            $id = $_POST['id'];
            $router->db->deleteArticle($id);   
            header('Location:/articles');
        }     

        $router->renderView('articles',[]);
    }
}