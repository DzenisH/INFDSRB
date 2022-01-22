<?php 

namespace app\controllers;

use app\Router;
use DateTime;

class AppointmentController
{
    public function get(Router $router)
    {
        $appointments = [];
        $date = "";
        if($_SERVER['REQUEST_METHOD'] === "GET"){
            $date = isset($_GET['date']) ? $_GET['date'] : "";
            $appointments = $router->db->getAppointments($date);
        }
        $router->renderView('appointment',[
            "appointments" => $date === "" ? "" : $appointments,
            "date" => $date
        ]);
    }
    public function addAppointment(Router $router)
    {
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            $time = $_POST['time'];
            $realDate = DateTime::createFromFormat('Y-m-d H:i:s',$time);
            $router->db->addAppointment($realDate->format('Y-m-d H:i:s'));
            header('Location:/');
        }
        $router->renderView('appointment',[]);
    }
}