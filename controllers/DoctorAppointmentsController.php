<?php 

namespace app\controllers;

use app\Router;

class DoctorAppointmentsController
{
    public function get(Router $router)
    {   
        $appointments = $router->db->getDoctorAppointments();
        $appointments2 = [];
        foreach($appointments as $appointment){
            $patient = $router->db->getPatient($appointment['patient_id']);
            $appointment['name'] = $patient['name'];
            $appointment['last_name'] = $patient['last_name'];
            $appointment['gender'] = $patient['gender'];
            $appointment['date_of_birth'] = $patient['date_of_birth'];
            $appointment['email'] = $patient['email'];
            $appointment['phone_number'] = $patient['phone_number'];
            array_push($appointments2,$appointment);
        }
        $router->renderView('doctorAppointments',[
            "appointments" => $appointments2
        ]);
    }
}