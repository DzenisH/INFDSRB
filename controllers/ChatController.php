<?php 

namespace app\controllers;

use app\Router;

class ChatController{

    public function get(Router $router){  //fuction for getting all patients to which doctor had already sent a message
        $id = $_GET["id"] ?? 0;
        $patient = $router->db->getPatient($id);
        $doctor = $router->db->getDoctor($id);
        $patients = [];
        $messages = $router->db->getMessages();
        foreach ($messages as $message) {
            if(in_array($router->db->getPatientMessages($message["patient_id"]),$patients) !== true) //doctor can send multiple messages to same user
            {
                array_push($patients,$router->db->getPatientMessages($message["patient_id"]));
            }
        }
        $router->renderView('chat',[
            "patients" => $patients,
            "messages" => $messages,
            "CurrentPatient" => count($patient) === 0 ? [] : $patient[0],
            "CurrentDoctor" => count($doctor) === 0 ? [] : $doctor[0]
        ]);
    }

    // public function getCurrentPatient(Router $router)
    // {
    //     $id = $_POST["id"];
    //     $patient = $router->db->getPatient($id);
    //     $router->renderView('chat',[
    //         "patient" => $patient //if there are no patient selected return an empty array 
    //     ]);
    // } 
}