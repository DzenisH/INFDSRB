<?php 

namespace app\controllers;

use app\models\PasswordHistory;
use app\Router;

class RequestController
{
    public function get(Router $router)
    {
        $patients = $router->db->getNotAcceptedPatients();
        $doctors = $router->db->getNotAcceptedDoctors();
        $router->renderView('requests',[
            "users" => array_merge($doctors,$patients)
        ]);
    }

    public function accept(Router $router)
    {
        if($_SERVER['REQUEST_METHOD'] === "POST")
        {
            if($_POST["operation"] === "accept")
            {
                $id = $_POST["id"];
                $type = $_POST["type"];
                if($type === "doctor"){
                    $user = $router->db->getDoctor($id);
                }else if($type === "patient"){
                    $user = $router->db->getPatient($id);
                    $router->db->addCardboard($user['id']);
                }
                $data = [
                    "password" => $user['password'],
                    "type" => $user['type'],
                    "user_id" => $user['id']
                ];
                $passwordHistory = new PasswordHistory();
                $passwordHistory->load($data);
                $passwordHistory->save();
                $router->db->acceptUser($id,$type);
            }
            else if($_POST["operation"] === "decline")
            {
                $router->db->deleteUser($_POST["id"],$_POST["type"]);
            }
            header('Location:/requests');
        }

        $router->renderView('requests',[]);
    }
}