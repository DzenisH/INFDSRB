<?php

//Router is like bound between Controller and Database
//It will have resolve and renderView methods.
//resolve method call appropriate method from appropriate controller.
//Method that is called send appropriate data to renderView method.

namespace app;

use app\Database;  //because Database is in namespace app

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];
    public Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function get($url,$fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url,$fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function resolve() 
    {
        $currentUrl = $_SERVER['REQUEST_URI'] ?? '/';
        
        if(strpos($currentUrl,'?') !== false){
            $currentUrl = substr($currentUrl,0,strpos($currentUrl,'?'));
        }
        $method = $_SERVER['REQUEST_METHOD'];

        if($method === 'GET'){
            $fn = $this->getRoutes[$currentUrl] ?? null; 
        }else if($method === 'POST'){
            $fn = $this->postRoutes[$currentUrl] ?? null;  
        }

        if($fn){     
            call_user_func($fn, $this);
        }else{
            echo "Page not found";
        }

    }

    public function renderView($view,$params=[]) 
    {
        foreach ($params as $key => $value) {  //on this way names of variable for accessing to them inside view will be same as names that we specify inside our controller(as associative array)
            $$key = $value; 
        }
        ob_start();  
        include_once __DIR__."/views/$view.php";  //$view will have value that we send from our controller
        $content = ob_get_clean();  //$content is variable that is located inside _layout file which will contain header and footer
        include_once __DIR__.'/views/_layout.php';  
    }
}