<?php

namespace app\models;

use DateTime;

use app\Database;

class Message
{
    public ?DateTime $date_of_sending = null;
    public ?string $content = null;
    public ?string $type_of_sender = null;
    public ?int $doctor_id = null;
    public ?int $patient_id = null;

    public function load($data)
    {
        $this->date_of_sending = $data['date_of_sending'];
        $this->content = $data['content'];
        $this->type_of_sender = $data['type_of_sender'];
        $this->doctor_id = $data['doctor_id'];
        $this->patient_id = $data['patient_id'];
    }

    public function save()
    {
        $db = Database::$db;
        $db->createMessage($this);
    }
}