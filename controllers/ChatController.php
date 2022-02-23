<?php 

namespace app\controllers;

use app\Router;
use DateTime;
use app\models\Message;

class ChatController{

    public function get(Router $router){  //fuction for getting all patients to which doctor had already sent a message
        $patients = $router->db->getPatients();
        $doctor = '';
        $id = 0;
        if($_SESSION["user"]["type"] === "patient"){
            $doctor = $router->db->getDoctor($_SESSION["user"]["doctor_id"]);
        }
        $messages = $router->db->getMessages();
        if(count($messages) > 0 || isset($_GET["id"])){
            $id = $_GET["id"] ?? $messages[0]["patient_id"];   
        }else if(count($messages) === 0 && !isset($_GET["id"]) && $_SESSION["user"]["type"] === "doctor"){
            $id = ($patients[0])["id"]; 
        }
        $patient = $router->db->getPatient($id);
        $_SESSION["currentPatient"] = $patient;
        $router->renderView('chat',[
            "patients" => count($patients) === 0 ? "" : $patients,
            "messages" => count($messages) === 0 ? '' : $messages,
            "CurrentPatient" => $patient === '' ? '' : $patient,
            "doctor" => $doctor
        ]);
    }

    public function sendMessage(Router $router)
    {
        $currentDate = new DateTime();
        $messageData = [
            'date_of_sending'=>$currentDate,
            'content' => '',
            'type_of_sender'=>'',
            'doctor_id'=>'',
            'patient_id'=>''
        ];

        $message = new Message();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if($_POST["type"] === "one"){
                $messageData['content'] = $_POST['content'];
                $messageData['type_of_sender'] = $_SESSION["user"]["type"];
                $messageData["doctor_id"] = $_SESSION["user"]["type"] === "doctor" ? $_SESSION["user"]["id"] : $_SESSION["user"]["doctor_id"];
                $messageData["patient_id"] = $_SESSION["user"]["type"] === "patient" ? $_SESSION["user"]["id"] : $_SESSION["currentPatient"]["id"];
                $message->load($messageData);
                $message->save();
            }else{
                $patients = $router->db->getPatients();
                foreach ($patients as  $patient) {
                    $messageData['content'] = $_POST['content'];
                    $messageData['type_of_sender'] = $_SESSION["user"]["type"];
                    $messageData["doctor_id"] = $_SESSION["user"]["type"] === "doctor" ? $_SESSION["user"]["id"] : $_SESSION["user"]["doctor_id"];
                    $messageData["patient_id"] = $_SESSION["user"]["type"] === "patient" ? $_SESSION["user"]["id"] : $patient["id"];
                    $message->load($messageData);
                    $message->save();
                }
            }
        }
        header('Location:/chat');
        $router->renderView('chat',[]);
    }
}