<?php

namespace app\models;

use DateTime;
use app\Database;

class Patient
{
    public ?string $username = null;
    public ?string $name = null;
    public ?string $last_name = null;
    public ?string $gender = null;
    public ?string $place_of_birth = null;
    public ?string $country_of_birth = null;
    public ?DateTime $date_of_birth = null;
    public ?int $jmbg = null;
    public ?string $phone_number = null;
    public ?string $email = null;
    public ?string $password = null;
    public ?string $type = null;
    public ?string $image = null;
    public ?string $accepted = null;
    public ?int $request_change = null;
    public ?int $change_doctor_id = null;
    public ?string $verification_code = null;
    public ?string $verified = null;

    public function load($data)
    {
        $this->username = $data["username"];
        $this->name = $data["name"];
        $this->last_name = $data["last_name"];
        $this->gender = $data["gender"];
        $this->place_of_birth = $data["place_of_birth"];
        $this->country_of_birth = $data["country_of_birth"];
        $this->date_of_birth = DateTime::createFromFormat('Y-m-d',$_POST["date_of_birth"]); 
        $this->jmbg = $data["jmbg"];
        $this->phone_number = $data["phone_number"];
        $this->email = $data["email"];
        $this->password = $data["password"];
        $this->type = $data["type"];
        $this->accepted = $data["accepted"];
        $this->image = $data["image"];
        $this->request_change = $data["request_change"];
        $this->change_doctor_id = $data["change_doctor_id"];
        $this->verification_code = $data["verification_code"];
        $this->verified = $data["verified"];
    }

    public function savePatient()
    {
        $db = Database::$db;
        $db->createPatient($this);
    }
}