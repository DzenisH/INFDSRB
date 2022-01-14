<?php

namespace app\controllers;

// session_start();
// session_destroy();

use app\models\Doctor;
use app\models\Patient;
use app\Router;

class AccountController
{
    public function login(Router $router)
    {
        $loginData = [
            'email' => '',
            'password' => ''
        ];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $loginData['email'] = $_POST['email'];
            $loginData['password'] = $_POST['password'];
            $user = $router->db->checkLogin($loginData); //checkLogin will return user that loged in(if user don't succesufully loged in length of an array will be 0)
            if(count($user) !== 0){   
                $_SESSION["user"] = $user[0]; //session variable user contain user that is currently loged in
                if($_SESSION["user"]["type"] === "patient" && $_SESSION["user"]["doctor_id"] === null){
                    header('Location:/choice');
                }else{
                    header('Location:/');
                }
            }
        }

        $router->renderView('login',[
            $loginData
        ]);
    }

    public function signup(Router $router)
    {
        if($_SERVER["REQUEST_METHOD"]==="POST"){
            $image = $_FILES['image'];
            $fileName = $_FILES['image']['name'];
            $fileTmpName = $_FILES['image']['tmp_name']; //before uploading file is in some temporary directory
            $fileError = $_FILES['image']['error'];  

            $fileExt = explode('.',$fileName);  //get the name of the file and format
            $fileActualExt = strtolower(end($fileExt)); //convert for example JPG to jpg

            $allowed = array('jpg','jpeg','png');  //allowed formats of pictures to upload

            if (in_array($fileActualExt,$allowed)) {
                if($fileError === 0){  //there are no errors
                    $imageNameNew = uniqid('',true).".".$fileActualExt;  //we get tim format in microseconds(so we can't ovverride some existing image)
                    $fileDestination = $_POST["type"] === "patient" ? './images/patients/'.$imageNameNew : './images/doctors/'.$imageNameNew; 
                    move_uploaded_file($fileTmpName,$fileDestination);  //move image from temporary location into new location 
                } else{
                    echo "There was an error uploading your file!";
                }
            } else{
                echo "You cannot upload files of this type!";
            }
            $data = [
                "name" => $_POST["name"],
                "last_name" => $_POST["last_name"],
                "gender" => $_POST["gender"],
                "place_of_birth" => $_POST["place_of_birth"],
                "country_of_birth" => $_POST["country_of_birth"],
                "date_of_birth" => $_POST["date_of_birth"],
                "jmbg" => $_POST["jmbg"],
                "phone_number" => $_POST["phone_number"],
                "email" => $_POST["email"],
                "password" => $_POST["password"],
                "type" => $_POST["type"],
                "image" => $fileDestination,
                "accepted" => 0,  //admin must accept user as patient or doctor
                "request_change" => 0, //if this is 1 that means that patient send request for changing doctor
                "change_doctor_id" => 0,
            ];
            $username = $_POST["name"].rand(1,200);
            while($router->db->Check($username)){
                $username = $_POST["name"].rand(1,200);
            }
            if($_POST["type"] === "patient"){
                //generate unique username for user(doctor or patient)
                $data["username"] = $username;
                $patient = new Patient();
                $patient->load($data);
                $patient->savePatient();
                header('Location:/');
            }else if($_POST["type"] === "doctor"){
                $doctor = new Doctor();
                $data["username"] = $username;
                $doctor->load($data);
                $doctor->saveDoctor();
                header('Location:/');
            }
        }
        $router->renderView('signup',[]);
    }
}