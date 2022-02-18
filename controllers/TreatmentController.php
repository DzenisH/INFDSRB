<?php 

namespace app\controllers;

use app\Router;
use DateTime;

class TreatmentController
{
    public function get(Router $router)
    {
        $treatments = [];
        $date = "";
        if($_SERVER['REQUEST_METHOD'] === "GET"){
            $date = isset($_GET['date']) ? $_GET['date'] : "";
            $treatments = $router->db->getTreatments($date);
        }
        $router->renderView('treatment',[
            "treatments" => $date === "" ? "" : $treatments,
            "date" => $date
        ]);
    }

        public function addTreatment(Router $router)
        {
            if($_SERVER['REQUEST_METHOD'] === "POST")
            {
                $time = $_POST['treatment_time'];
                $realDate = DateTime::createFromFormat('Y-m-d H:i:s',$time);
                $type_of_disease = $_POST['type_of_disease'];
                $place_of_treatment = $_POST['place_of_treatment'];
                $router->db->addTreatment($realDate->format('Y-m-d H:i:s'),$type_of_disease,$place_of_treatment);
                header('Location:/');
            }
            $router->renderView('treatment',[]);

        }
}