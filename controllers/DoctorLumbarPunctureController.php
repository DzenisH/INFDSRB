<?php 

namespace app\controllers;

use app\Router;

class DoctorLumbarPunctureController
{
    public function get(Router $router)
    {
        $lumbar_puntures = $router->db->getDoctorLumbarPunctures();
        $lumbar_puntures2 = [];
        foreach($lumbar_puntures as $lumbar_punture){
            $user = $router->db->getPatient($lumbar_punture['patient_id']);
            $lumbar_punture['name'] = $user['name'];
            $lumbar_punture['last_name'] = $user['last_name'];
            $lumbar_punture['gender'] = $user['gender'];
            $lumbar_punture['date_of_birth'] = $user['date_of_birth'];
            $lumbar_punture['phone_number'] = $user['phone_number'];
            $lumbar_punture['email'] = $user['email'];
            array_push($lumbar_puntures2,$lumbar_punture);
        }
        $router->renderView('doctorLumbarPuncture',[
            "lumbar_puntures" => $lumbar_puntures2
        ]);
    }
}