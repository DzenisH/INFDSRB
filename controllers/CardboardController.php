<?php 

namespace app\controllers;
use app\Router;

class CardboardController
{
    public function get(Router $router)
    {
        $patient = $router->db->getPatient($_SESSION["user"]["id"]);
        $cardboard = $router->db->getCardboard($_SESSION["user"]["id"]);
        $examinations = $router->db->getExaminations($cardboard["id"]);
        $examinations2 = [];
        foreach ($examinations as $examination) {
            $doctor = $router->db->getDoctor($examination["doctor_id"]);
            $examination["name"] = $doctor["name"];
            $examination["last_name"] = $doctor["last_name"];
            array_push($examinations2,$examination);
        }
        $router->renderView('cardboard',[
            "patient" => $patient,
            "cardboard" => $cardboard,
            "examinations" => $examinations2
        ]);
    }
}
