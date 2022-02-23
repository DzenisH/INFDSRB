<?php 

namespace app\controllers;

use app\models\Examination;
use app\Router;
use DateTime;

class ExaminationController
{
    public function get(Router $router)
    {    
        if(isset($_GET['treatment_id']) && isset($_GET['treatment_done'])){
            $treatmentId = $_GET['treatment_id'];
            $done = $_GET['treatment_done'];
        }
        if(isset($treatmentId)===true && isset($done)===true){
            $router->db->finishTreatment($treatmentId,$done);
        }

        if(isset($_GET['appointment_id']) && isset($_GET['appointment_done'])){
            $appointmentId = $_GET['appointment_id'];
            $done = $_GET['appointment_done'];
        }
        if(isset($appointmentId)===true && isset($done)===true){
            $router->db->finishAppointment($appointmentId,$done);
        }

        if(isset($_GET['lumbar_puncture_id']) && isset($_GET['lumbar_puncture_done'])){
            $lumbarPunctureId = $_GET['lumbar_puncture_id'];
            $done = $_GET['lumbar_puncture_done'];
        }
        if(isset($lumbarPunctureId)===true && isset($done)===true){
            $router->db->finishLumbarPuncture($lumbarPunctureId,$done);
        }
        
        $router->renderView('examination',[]);
    }

    public function addExamination(Router $router)
    {
        $cardboard = $router->db->getCardboard($_GET["patient_id"]);
        $date = "";

        if(isset($_GET["appointment_id"])){
            $date = $router->db->getDateForOneOfServices("appointment",$_GET["appointment_id"]);
        }

        if(isset($_GET["treatment_id"])){
            $date = $router->db->getDateForOneOfServices("treatment",$_GET["treatment_id"]);
        }

        if(isset($_GET["lumbar_puncture_id"])){
            $date = $router->db->getDateForOneOfServices("lumbar_puncture",$_GET["lumbar_puncture_id"]);
        }
        $data = [
            "date" => DateTime::createFromFormat('Y-m-d H:i:s', $date),
            "diagnosis" => $_POST['diagnosis'],
            "therapy" => $_POST['therapy'],
            "cardboard_id" =>  $cardboard['id'],
            "doctor_id" => $_SESSION['user']['id']
        ];

        $examination = new Examination();
        $examination->load($data);
        $examination->save();

        header('Location:/');
        $router->renderView('examination',[]);
    }
}