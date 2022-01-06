<?php

namespace app\models;

use DateTime;
use app\Database;

class Patient
{
    public ?int $id = null;
    public ?string $ime = null;
    public ?string $prezime = null;
    public ?string $pol = null;
    public ?string $mesto_rodjenja = null;
    public ?string $drzava_rodjenja = null;
    public ?DateTime $datum_rodjenja = null;
    public ?int $jmbg = null;
    public ?int $telefon = null;
    public ?string $email = null;

    public function load($data)
    {
        
    }

    public function save()
    {
        $db = Database::$db;
    }
}