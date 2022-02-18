<?php

namespace app\controllers;

use app\Router;

class ChoiceController
{
    public function get(Router $router)  //method for getting all doctors
    {
        $doctors = $router->db->getDoctors();
        $totalNumberOfPatients = $router->db->getTotalNumberOfPatients();
        $totalNumberOfDoctors = $router->db->getTotalNumberOfDoctors();
        $doctors2 = [];
        foreach ($doctors as $doctor) {
           $doctor["number"] = $router->db->getNumberOfPatients($doctor["id"]);
           array_push($doctors2,$doctor);
        }
        $router->renderView('choice',[
            "doctors" => $doctors2,
            "totalNumberOfPatients" => $totalNumberOfPatients,
            "totalNumberOfDoctors" => $totalNumberOfDoctors
        ]);
    }

    public function assignDoctor(Router $router)  //assignDoctor with corresponding id to current loged patient
    {
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $doctor_id = $_POST["doctor_id"];
            $type = $_POST["type"];
            if($type === "select"){
                $router->db->assignDoctor($doctor_id);
                $_SESSION["user"]["doctor_id"] = $doctor_id;
            }else{
                $router->db->requestChange($doctor_id);
            }
            $router->renderView('home',[]);
        }
    }
}