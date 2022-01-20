<?php 

namespace app\controllers;

use app\Router;

class TreatmentController
{
    public function get(Router $router)
    {
        $treatments = [];
        if($_SERVER['REQUEST_METHOD'] === "GET"){
            $date = isset($_GET['date']) ? $_GET['date'] : "";
            $treatments = $router->db->getTreatments($date);
        }
        $router->renderView('treatment',[
            "treatments" => $date === "" ? "" : $treatments
        ]);
    }

    public function addTreatment(Router $router)
    {
        if($_SERVER['REQUEST_METHOD'] === "POST")
        {
            $type_of_disease = $_POST['type_of_disease'];
            $router->db->addTreatment($type_of_disease);
            header('Location:/');
        }
        $router->renderView('treatment',[]);

    }
}