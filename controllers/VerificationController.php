<?php 

namespace app\controllers;

use app\Router;

class VerificationController
{
    public function get(Router $router)
    {
        $router->renderView("verification",[]);
    }

    public function verify(Router $router)
    {
        $result = false;
        if($_SERVER['REQUEST_METHOD'] === "POST")
        {
            $email = $_POST["email"];
            $code = $_POST["code"];
            $result = $router->db->verify($email,$code);
        }
        $router->renderView("verification",[
            "result" => $result
        ]);

    }
}