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
}