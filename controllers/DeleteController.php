<?php 

namespace app\controllers;

use app\Router;

class DeleteController
{
    public function get(Router $router)
    {
        $doctors = $router->db->getDoctors();
        $patients = $router->db->getAcceptedPatients();

        $router->renderView('delete',[
            "users" => array_merge($doctors,$patients)
        ]);
    }

    public function delete(Router $router)
    {
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $id = $_POST["id"];
            $type = $_POST["type"];
            $router->db->deleteUser($id,$type);
            header('Location:/delete');
        }
        $router->renderView('delete',[]);
    }
}