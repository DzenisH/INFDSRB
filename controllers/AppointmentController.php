<?php 

namespace app\controllers;

use app\Router;
use DateTime;

class AppointmentController
{
    public function get(Router $router)
    {
        $appointments = [];
        if($_SERVER['REQUEST_METHOD'] === "GET"){
            $date = isset($_GET['date']) ? $_GET['date'] : "";
            $appointments = $router->db->getAppointments($date);
        }
        $router->renderView('appointment',[
            "appointments" => $date === "" ? [] : $appointments
        ]);
    }
    public function addAppointment(Router $router)
    {
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            $time = $_POST['time'];
            $date = $_POST['date2'];
            // $realDate = new DateTime($date);
            // $router->db->addAppointment(date('Y-m-d H:i:s',strtotime($date.$time."00:00")));
            $router->db->addAppointment(date('Y-m-d H:i:s',strtotime($time)));
            header('Location:/');
        }
        $router->renderView('appointment',[]);
    }
}