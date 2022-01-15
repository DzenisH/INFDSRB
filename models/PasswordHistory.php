<?php 

namespace app\models;

use app\Database;

class PasswordHistory
{
    public ?string $password = null;
    public ?string $type = null;
    public ?int $user_id = null;

    public function load($data)
    {
        $this->password = $data['password'];
        $this->type = $data['type'];
        $this->user_id = $data['user_id'];
    }

    public function save()
    {
        $db = Database::$db;
        $db->addPasswordHistory($this);
    }
}