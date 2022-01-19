<?php

namespace app;

use app\models\Article;
use app\models\Doctor;
use app\models\Message;
use app\models\PasswordHistory;
use app\models\Patient;
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

    public function getPatients() //get patients for current loged doctor
    {
        $statement = $this->pdo->prepare('SELECT * FROM patient WHERE doctor_id=:id AND accepted=1');
        $statement->bindValue(":id",($_SESSION["user"])["id"]);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function checkLogin($login)  //return user or array with length of 0 if there are not user
    {
        $statement = $this->pdo->prepare('SELECT * FROM patient WHERE email = :email AND password = :password');
        $statement->bindValue(':email',$login['email']);
        $statement->bindValue(':password',$login['password']);
        $statement->execute();
        $patient =  $statement->fetchAll(PDO::FETCH_ASSOC);
        if(count($patient) !== 0){
            $statement = $this->pdo->prepare('SELECT * FROM patient WHERE email = :email AND password = :password
            AND accepted=1');
            $statement->bindValue(':email',$login['email']);
            $statement->bindValue(':password',$login['password']);
            $statement->execute();
            $patient =  $statement->fetchAll(PDO::FETCH_ASSOC);
            if(count($patient) === 0){
                return ''; //when we return this that means the user entered corect informtaion but it has not yet been accepted by the admin
            }
        }
        if(count($patient) === 0){
            $statement2 = $this->pdo->prepare('SELECT * FROM doctor WHERE email = :email AND password = :password
            AND accepted=1');
            $statement2->bindValue(':email',$login['email']);
            $statement2->bindValue(':password',$login['password']);
            $statement2->execute();
            $patient =  $statement2->fetchAll(PDO::FETCH_ASSOC);
        }
        if(count($patient) === 0)
        {
            $statement2 = $this->pdo->prepare('SELECT * FROM admin WHERE email = :email AND password = :password');
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

    public function getPatient($id)  //get patient based on id
    {
        $statement = $this->pdo->prepare('SELECT * FROM patient WHERE id=:id');
        $statement->bindValue(":id",$id);
        $statement->execute();
        $patients = $statement->fetchAll(PDO::FETCH_ASSOC);
        return count($patients) === 0 ? '' : $patients[0];
    }

    public function getDoctor($id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM doctor WHERE id=:id');
        $statement->bindValue(":id",$id);
        $statement->execute();
        $doctors = $statement->fetchAll(PDO::FETCH_ASSOC);
        return count($doctors) === 0 ? '' : $doctors[0];
    }

    public function createMessage(Message $message)
    {
        $statement = $this->pdo->prepare("INSERT INTO message (date_of_sending,content,type_of_sender,doctor_id,patient_id)
        VALUES (:date_of_sending,:content,:type_of_sender,:doctor_id,:patient_id)");
        $statement->bindValue(":date_of_sending",$message->date_of_sending->format('Y-m-d H:i:s'));
        $statement->bindValue(":content",$message->content);
        $statement->bindValue(":type_of_sender",$message->type_of_sender);
        $statement->bindValue(":doctor_id",$message->doctor_id);
        $statement->bindValue(":patient_id",$message->patient_id);
        $statement->execute();
    }

    public function getDoctors()
    {
        $statement = $this->pdo->prepare("SELECT * FROM doctor WHERE accepted=1");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNumberOfPatients($id) //get number of patients for doctor based on id of doctor
    {
        $statement = $this->pdo->prepare("SELECT * FROM patient WHERE doctor_id=:id AND accepted=1");
        $statement->bindValue(":id",$id);
        $statement->execute();
        $patients = $statement->fetchAll(PDO::FETCH_ASSOC);
        return count($patients);
    }

    public function getTotalNumberOfPatients()
    {
        $statement = $this->pdo->prepare("SELECT * FROM patient WHERE accepted=1");
        $statement->execute();
        $patients = $statement->fetchAll(PDO::FETCH_ASSOC);
        return count($patients);
    }

    public function getTotalNumberOfDoctors()
    {
        $statement = $this->pdo->prepare("SELECT * FROM doctor WHERE accepted=1");
        $statement->execute();
        $doctors = $statement->fetchAll(PDO::FETCH_ASSOC);
        return count($doctors);
    }

    public function assignDoctor($id)
    {
        $statement = $this->pdo->prepare("UPDATE patient SET doctor_id = :doctor_id WHERE id=:id");
        $statement->bindValue(":id",$_SESSION["user"]["id"]);
        $statement->bindValue(":doctor_id",$id);
        $statement->execute();
    }

    public function getCardboard($id) // $id presents id of patient
    {
        $statement = $this->pdo->prepare('SELECT * FROM cardboard WHERE patient_id=:id');
        $statement->bindValue(":id",$id);
        $statement->execute();
        $cardboard = $statement->fetchAll(PDO::FETCH_ASSOC);
        return count($cardboard) === 0 ? '' : $cardboard[0];
    }

    public function getExaminations($id) //id presents id of cardboard
    {
        $statement = $this->pdo->prepare("SELECT * FROM examination WHERE cardboard_id=:id");
        $statement->bindValue(":id",$id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createPatient(Patient $patient)
    {
        $statement = $this->pdo->prepare("INSERT INTO patient (username,name,last_name,gender,
        place_of_birth,country_of_birth,date_of_birth,JMBG,phone_number,email,password,type,image,accepted)
        VALUES (:username,:name,:last_name,:gender,:place_of_birth,:country_of_birth,:date_of_birth,
        :JMBG,:phone_number,:email,:password,:type,:image,:accepted)");
        $statement->bindValue(":username",$patient->username);
        $statement->bindValue(":name",$patient->name);
        $statement->bindValue(":last_name",$patient->last_name);
        $statement->bindValue(":gender",$patient->gender);
        $statement->bindValue(":place_of_birth",$patient->place_of_birth);
        $statement->bindValue(":country_of_birth",$patient->country_of_birth);
        $statement->bindValue(":date_of_birth",$patient->date_of_birth->format('Y-m-d'));
        $statement->bindValue(":JMBG",$patient->jmbg);
        $statement->bindValue(":phone_number",$patient->phone_number);
        $statement->bindValue(":email",$patient->email);
        $statement->bindValue(":password",$patient->password);
        $statement->bindValue(":type",$patient->type);
        $statement->bindValue(":image",$patient->image);
        $statement->bindValue(":accepted",$patient->accepted);
        $statement->execute();
    }
    public function createDoctor(Doctor $doctor)
    {
        $statement = $this->pdo->prepare("INSERT INTO doctor (username,name,last_name,gender,
        place_of_birth,country_of_birth,date_of_birth,JMBG,phone_number,email,password,type,image,accepted)
        VALUES (:username,:name,:last_name,:gender,:place_of_birth,:country_of_birth,:date_of_birth,
        :JMBG,:phone_number,:email,:password,:type,:image,:accepted)");
        $statement->bindValue(":username",$doctor->username);
        $statement->bindValue(":name",$doctor->name);
        $statement->bindValue(":last_name",$doctor->last_name);
        $statement->bindValue(":gender",$doctor->gender);
        $statement->bindValue(":place_of_birth",$doctor->place_of_birth);
        $statement->bindValue(":country_of_birth",$doctor->country_of_birth);
        $statement->bindValue(":date_of_birth",$doctor->date_of_birth->format('Y-m-d'));
        $statement->bindValue(":JMBG",$doctor->jmbg);
        $statement->bindValue(":phone_number",$doctor->phone_number);
        $statement->bindValue(":email",$doctor->email);
        $statement->bindValue(":password",$doctor->password);
        $statement->bindValue(":type",$doctor->type);
        $statement->bindValue(":image",$doctor->image);
        $statement->bindValue(":accepted",$doctor->accepted);
        $statement->execute();
    }

    public function getNotAcceptedPatients()
    {
        $statement = $this->pdo->prepare('SELECT * FROM patient WHERE accepted=0');
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNotAcceptedDoctors()
    {
        $statement = $this->pdo->prepare('SELECT * FROM doctor WHERE accepted=0');
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function acceptUser($id,$type)  //accept registration of user based on id
    {
        if($type === "patient"){
            $statement = $this->pdo->prepare('UPDATE patient SET accepted=1 WHERE id=:id');
            $statement->bindValue(':id',$id);
            $statement->execute();
        }
        else{
            $statement = $this->pdo->prepare('UPDATE doctor SET accepted=1 WHERE id=:id');
            $statement->bindValue(':id',$id);
            $statement->execute();
        }
    }

    public function getAcceptedPatients()
    {
        $statement = $this->pdo->prepare('SELECT * FROM patient WHERE accepted=1');
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteUser($id,$type)
    {
        if($type === "patient"){
            $statement = $this->pdo->prepare('DELETE FROM patient  WHERE id=:id');
            $statement->bindValue(':id',$id);
            $statement->execute();
        }
        else{
            $statement = $this->pdo->prepare('DELETE FROM doctor WHERE id=:id');
            $statement->bindValue(':id',$id);
            $statement->execute();
        }
    }

    public function requestChange($id)
    {
        $statement = $this->pdo->prepare('UPDATE patient SET request_change=1,change_doctor_id=:doctor_id WHERE id=:id');
        $statement->bindValue(':doctor_id',$id);
        $statement->bindValue(':id',$_SESSION['user']['id']);
        $statement->execute();
    }

    public function getRequestsChange()
    {
        $statement = $this->pdo->prepare('SELECT * FROM patient WHERE request_change=1');
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function postRequestChange($id,$type)
    {
        if($type === "approve"){
            $statement1 = $this->pdo->prepare('SELECT * FROM patient WHERE id=:id');
            $statement1->bindValue(':id',$id);
            $statement1->execute();
            $patient = $statement1->fetchAll(PDO::FETCH_ASSOC)[0];
            $statement2 = $this->pdo->prepare('UPDATE patient SET doctor_id=:doctor_id,request_change=0,change_doctor_id=0 WHERE id=:id');
            $statement2->bindValue(':doctor_id',$patient['change_doctor_id']);
            $statement2->bindValue(':id',$id);
            $statement2->execute();
        }else if($type === "decline"){
            $statement = $this->pdo->prepare('UPDATE patient SET request_change=0,change_doctor_id=0 WHERE id=:id');
            $statement->bindValue(':id',$id);
            $statement->execute();
        }
    }

    public function Check($username)  //function for checking if there is user(patient or doctor) with corresponding username
    {
        $statement = $this->pdo->prepare('SELECT * FROM patient WHERE username=:username');
        $statement->bindValue(':username',$username);
        $statement->execute();
        $patients = $statement->fetchAll(PDO::FETCH_ASSOC);
        if(count($patients) > 0){
            return true;
        }else{
            $statement2 = $this->pdo->prepare('SELECT * FROM doctor WHERE username=:username');
            $statement2->bindValue(':username',$username);
            $statement2->execute();
            $doctors = $statement->fetchAll(PDO::FETCH_ASSOC);
            if(count($doctors)>0){
                return true;
            }else{
                return false;
            }
        }
    }

    public function AddArticle(Article $article)
    {
        $statement = $this->pdo->prepare('INSERT INTO article (title,content,user_id,type_of_user,
        image,description) 
        VALUES (:title,:content,:user_id,:type_of_user,:image,:description)');
        $statement->bindValue(':title',$article->title);
        $statement->bindValue(':description',$article->description);
        $statement->bindValue(':content',$article->content);
        $statement->bindValue(':image',$article->image);
        $statement->bindValue(':user_id',$article->user_id);
        $statement->bindValue(':type_of_user',$article->type_of_user);
        $statement->execute();
    }

    public function getArticles()
    {
        $statement = $this->pdo->prepare('SELECT * FROM article');
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArticle($id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM article WHERE id=:id');
        $statement->bindValue(':id',$id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC)[0];
    }

    public function getArticleAuthor($id)  //based on id of article find author of that article
    {
        $statement = $this->pdo->prepare('SELECT * FROM article WHERE id=:id');
        $statement->bindValue(':id',$id);
        $statement->execute();
        $article = $statement->fetchAll(PDO::FETCH_ASSOC)[0];
        if($article['type_of_user'] === "doctor"){
            $statement2 = $this->pdo->prepare('SELECT * FROM doctor WHERE id=:id');
            $statement2->bindValue(':id',$article['user_id']);
            $statement2->execute();
            $user = $statement2->fetchAll(PDO::FETCH_ASSOC);
        }else if($article['type_of_user'] === "admin"){
            $statement2 = $this->pdo->prepare('SELECT * FROM admin WHERE id=:id');
            $statement2->bindValue(':id',$article['user_id']);
            $statement2->execute();
            $user = $statement2->fetchAll(PDO::FETCH_ASSOC);
        }

        return $user[0];
    }

    public function deleteArticle($id)
    {
        $statement = $this->pdo->prepare('DELETE FROM article WHERE id=:id');
        $statement->bindValue(':id',$id);
        $statement->execute();
    }

    public function addPasswordHistory(PasswordHistory $passwordHistory)
    {
        $statement = $this->pdo->prepare('INSERT INTO password_history (
            password,type,user_id) VALUES (:password,:type,:user_id)');
        $statement->bindValue(':password',$passwordHistory->password);
        $statement->bindValue(':type',$passwordHistory->type);
        $statement->bindValue(':user_id',$passwordHistory->user_id);
        $statement->execute();
    }

    public function changePassword($user_id,$type)
    {
        if($type === "patient"){
            $statement = $this->pdo->prepare('UPDATE patient SET password=:password WHERE id=:id');
            $statement->bindValue(':id',$user_id);
            $statement->bindValue(':password',$_POST['newPassword']);
            $_SESSION['user']['password'] = $_POST['newPassword'];
            $statement->execute();
        }else if($type === "doctor"){
            $statement = $this->pdo->prepare('UPDATE doctor SET password=:password WHERE id=:id');
            $statement->bindValue(':id',$user_id);
            $statement->bindValue(':password',$_POST['newPassword']);
            $_SESSION['user']['password'] = $_POST['newPassword'];  
            $statement->execute();
        }else{
            $statement = $this->pdo->prepare('UPDATE admin SET password=:password WHERE id=:id');
            $statement->bindValue(':id',$user_id);
            $statement->bindValue(':password',$_POST['newPassword']);
            $_SESSION['user']['password'] = $_POST['newPassword'];
            $statement->execute();
        }

    }

    public function checkPasswords()  //number of old function for currently loged user
    {
        $statement = $this->pdo->prepare('SELECT * FROM password_history 
        WHERE user_id=:id AND type=:type');
        $statement->bindValue(':id',$_SESSION['user']['id']);
        $statement->bindValue(':type',$_SESSION['user']['type']);
        $statement->execute();
        $passwords = $statement->fetchAll(PDO::FETCH_ASSOC);
        return count($passwords);
    }

    public function deletePasswords()  //delete all password from password_history table for current loged user
    {
        $statement = $this->pdo->prepare('DELETE FROM password_history 
        WHERE user_id=:id AND type=:type');
         $statement->bindValue(':id',$_SESSION['user']['id']);
         $statement->bindValue(':type',$_SESSION['user']['type']);
         $statement->execute();
    }

    public function checkOldPasswords($password)        
    {
        $statement = $this->pdo->prepare('SELECT * FROM password_history WHERE 
        user_id=:id AND type=:type AND password=:password');
        $statement->bindValue(':id',$_SESSION['user']['id']);
        $statement->bindValue(':type',$_SESSION['user']['type']);
        $statement->bindValue(':password',$password);
        $statement->execute();
        $array = $statement->fetchAll(PDO::FETCH_ASSOC);
        if(count($array)>0){
            return true;  //there is matching between new and some old password
        }else{
            return false;
        }
    }

    public function getPasswordHistory()
    {
        $statement = $this->pdo->prepare('SELECT * FROM password_history
        WHERE user_id=:id AND type=:type');
        $statement->bindValue(':id',$_SESSION['user']['id']);
        $statement->bindValue(':type',$_SESSION['user']['type']);
        $statement->execute();
        $passwords = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $passwords;
    }

    public function addCardboard($patientId)
    {
        $date = date('Y-m-d');
        $statement = $this->pdo->prepare('INSERT INTO cardboard (date,patient_id)
        VALUES (:date,:patient_id)');
        $statement->bindValue(':date',$date);
        $statement->bindValue(':patient_id',$patientId);
        $statement->execute();
    }

    public function getAppointments($date)  //get all appointments for specific date
    {
        // $date = date('Y-m-d');
        // $datetime = date('Y-m-d H:i:s');
        // $hours = date('H',strtotime($datetime));
        // if($hours > 18){  // if current is more then 16 hours then patient could to schedule but tomorrow(in in each of the free terms for that day or days after)   
        //     $date = date('Y-m-d',strtotime(date("Y-m-d", strtotime($date)) . "+1 day"));
        // }
        $statement = $this->pdo->prepare('SELECT * FROM appointment WHERE date_time LIKE :date AND 
        done=0');
        $statement->bindValue(':date',"%$date%");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addAppointment($datetime)
    {
        $statement = $this->pdo->prepare('INSERT INTO appointment (date_time,patient_id,
        doctor_id,done) VALUES (:date_time,:patient_id,:doctor_id,:done)');
        $statement->bindValue(':date_time',$datetime);
        $statement->bindValue(':patient_id',$_SESSION['user']['id']);
        $statement->bindValue(':doctor_id',$_SESSION['user']['doctor_id']);
        $statement->bindValue(':done',0);
        $statement->execute();
    }

}