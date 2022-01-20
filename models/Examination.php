<?php 

namespace app\models;
use app\Database;
use DateTime;

class Examination
{
    public ?DateTime $date = null;
    public ?string $diagnosis = null;
    public ?string $therapy = null;
    public ?int $cardboard_id = null;
    public ?int $doctor_id = null;

    public function load($data)
    {
        $this->date = $data['date'];
        $this->diagnosis = $data['diagnosis'];
        $this->therapy = $data['therapy'];
        $this->cardboard_id = $data['cardboard_id'];
        $this->doctor_id = $data['doctor_id'];
    }

    public function save()
    {
        $db = Database::$db;
        $db->addExamination($this);
    }
}