<?php 

namespace app\controllers;

use app\Router;

class RequestController
{
    public function get(Router $router)
    {
        $patients = $router->db->getNotAcceptedPatients();
        $doctors = $router->db->getNotAcceptedDoctors();
        $router->renderView('requests',[
            "users" => array_merge($doctors,$patients)
        ]);
    }

    public function accept(Router $router)
    {
        if($_SERVER['REQUEST_METHOD'] === "POST")
        {
            $id = $_POST["id"];
            $type = $_POST["type"];
            $router->db->acceptUser($id,$type);
            header('Location:/requests');
        }

        $router->renderView('requests',[]);
    }
}