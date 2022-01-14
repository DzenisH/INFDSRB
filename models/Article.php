<?php 

namespace app\models;

use app\Database;

class Article
{
    public ?string $title = null;
    public ?string $description = null;
    public ?string $content = null;
    public ?string $image = null;
    public ?string $type_of_user = null;
    public ?int $user_id = null;

    public function load($data)
    {
        $this->title = $data['title'];
        $this->description = $data['description'];
        $this->content = $data['content'];
        $this->image = $data['image'];
        $this->type_of_user = $data['type_of_user'];
        $this->user_id = $data['user_id'];
    }

    public function save()
    {
        $db = Database::$db;
        $db->AddArticle($this);
    }
}