<?php

namespace app;
use PDO;

session_start();

class Database
{
    public PDO $pdo;
    public static Database $db; //in every moment there can be only one instance of Database class

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=wp-projekat', 'root' ,''); //zbog toga sto se nalazimo u namespace app moramo pored PDO staviti / (jer se ne nalazimo u globalnom namespace)
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        self::$db = $this;
    }

    public function getPatients()
    {
        $statement = $this->pdo->prepare('SELECT * FROM patient WHERE doctor_id=:id');
        $statement->bindValue(":id",($_SESSION["user"])["id"]);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function checkLogin($login)  //return user or array with lengt of 0 if there are not user
    {
        $statement = $this->pdo->prepare('SELECT * FROM patient WHERE email = :email AND password = :password');
        $statement->bindValue(':email',$login['email']);
        $statement->bindValue(':password',$login['password']);
        $statement->execute();
        $patient =  $statement->fetchAll(PDO::FETCH_ASSOC);
        if(count($patient) === 0){
            $statement2 = $this->pdo->prepare('SELECT * FROM doctor WHERE email = :email AND password = :password');
            $statement2->bindValue(':email',$login['email']);
            $statement2->bindValue(':password',$login['password']);
            $statement2->execute();
            $patient =  $statement2->fetchAll(PDO::FETCH_ASSOC);
        }
        return $patient;
    }
    public function getMessages()  //get all messages for current registered user
    {
        if(($_SESSION["user"])["type"]==="doctor"){
            $statement = $this->pdo->prepare('SELECT * FROM message WHERE doctor_id=:id ORDER BY date_of_sending');
        }else if(($_SESSION["user"])["type"] === "patient"){
            $statement = $this->pdo->prepare('SELECT * FROM message WHERE patient_id=:id ORDER BY date_of_sending');
        }
        $statement->bindValue(':id',($_SESSION['user'])['id'] ?? 0);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPatientMessages($id) //get all patients with corresponding id
    {
        $statement = $this->pdo->prepare('SELECT * FROM patient WHERE id=:id');
        $statement->bindValue(":id",$id);
        $statement->execute();
        $patient =  $statement->fetchAll(PDO::FETCH_ASSOC)[0];
        return $patient;
    }

    public function getPatient($id)  //get patient id
    {
        $statement = $this->pdo->prepare('SELECT * FROM patient WHERE id=:id');
        $statement->bindValue(":id",$id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDoctor($id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM doctor WHERE id=:id');
        $statement->bindValue(":id",$id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}