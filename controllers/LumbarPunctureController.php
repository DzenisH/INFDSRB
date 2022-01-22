<?php 

namespace app\controllers;

use app\Router;
use DateTime;

class LumbarPunctureController
{
    public function get(Router $router)
    {
        $lumbar_punctures = [];
        $date = "";
        if($_SERVER['REQUEST_METHOD'] === "GET"){
            $date = isset($_GET['date']) ? $_GET['date'] : "";
            $lumbar_punctures = $router->db->getLumbarPunctures($date);
        }
        $router->renderView('lumbar_puncture',[
            "lumbar_punctures" => $date === "" ? "" : $lumbar_punctures,
            "date" => $date
        ]);
    }

    public function addLumbarPuncture(Router $router)
    {
        if($_SERVER['REQUEST_METHOD'] === "POST")
        {
            $time = $_POST['lumbar_puncture_time'];
            $realDate = DateTime::createFromFormat('Y-m-d H:i:s',$time);
            $takes_medication = $_POST['takes_medication'];
            $router->db->addLumbarPunction($realDate->format('Y-m-d H:i:s'),$takes_medication);
            header('Location:/');
        }
        $router->renderView('lumbar_puncture',[]);

    }
}