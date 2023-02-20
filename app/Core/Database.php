<?php

namespace app\Core;

use PDO;

class Database
{
    private PDO $pdo;

    public function __construct()
    {
        $dbCredentials = [
            "database" => "products",
            "username" => "root",
            "password" => "password",
            "servername" => "localhost"
        ];

        $database = $dbCredentials['database'];
        $servername = $dbCredentials['servername'];
        $username = $dbCredentials['username'];
        $password = $dbCredentials['password'];


        $dsn = "mysql:dbname=$database;host=$servername:3306";

        $this->pdo = new PDO($dsn, $username, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function save()
    {
        // Todo
    }

    public function delete()
    {
        // Todo
    }
}