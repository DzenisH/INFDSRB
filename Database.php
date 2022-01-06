<?php

namespace app;
use PDO;

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
        $statement = $this->pdo->prepare('SELECT * FROM patient');
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}