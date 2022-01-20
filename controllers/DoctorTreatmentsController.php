<?php 

namespace app\controllers;

use app\Router;

class DoctorTreatmentsController
{
    public function get(Router $router)
    {
        $treatments = $router->db->getDoctorTreatments();
        $treatments2 = [];
        foreach($treatments as $treatment){
            $user = $router->db->getPatient($treatment['patient_id']);
            $treatment['name'] = $user['name'];
            $treatment['last_name'] = $user['last_name'];
            $treatment['gender'] = $user['gender'];
            $treatment['date_of_birth'] = $user['date_of_birth'];
            $treatment['phone_number'] = $user['phone_number'];
            $treatment['email'] = $user['email'];
            array_push($treatments2,$treatment);
        }
        $router->renderView('doctorTreatments',[
            "treatments" => $treatments2
        ]);
    }   
}