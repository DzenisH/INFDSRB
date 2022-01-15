<?php 

namespace app\controllers;

use app\models\PasswordHistory;
use app\Router;

class ChangePassword
{
    public function get(Router $router)
    {
        $passwords = $router->db->getPasswordHistory();
        $router->renderView('changePassword',[
            "passwords" => $passwords
        ]);
    }

    public function post(Router $router)
    {
        if($_SERVER['REQUEST_METHOD'] === "POST")
        {
            $passwordHistory = new PasswordHistory();
            $data = [
                "password" => $_SESSION['user']['password'],
                "type" => $_SESSION['user']['type'],
                "user_id" => $_SESSION['user']['id']
            ];
            if($router->db->checkOldPasswords($_POST['newPassword']) === false){
                $passwordHistory->load($data);
                $passwordHistory->save();
                if($router->db->checkPasswords() > 3){  //database will keep max 3 rows in password_history for one user
                    $router->db->deletePasswords();
                }
                $router->db->changePassword($_SESSION['user']['id'],$_SESSION['user']['type']);
            }
        }
        $router->renderView('changePassword',[]);
    }
}