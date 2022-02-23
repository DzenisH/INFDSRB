<?php 

namespace app\controllers;

use app\Router;

class RequestChangeController
{
    public function get(Router $router)
    {
        $requests = $router->db->getRequestsChange();
        $router->renderView('requestChange',[
            "requests"=> $requests
        ]);
    }

    public function request(Router $router)
    {
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            $id = $_POST["id"];
            $type = $_POST["type"]; //approve or decline
            $patient = $router->db->getPatient($id);
            if($type === "approve"){
                $router->db->deleteMessagesBetweenPatientAndDoctor($id,$patient['doctor_id']);
            }
            $router->db->postRequestChange($id,$type);
            header('Location:/request-change');
        }
        $router->renderView('requestChange',[]);
    }
}