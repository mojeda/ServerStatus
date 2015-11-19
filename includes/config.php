<?php

$host = 'localhost';
$user = '';
$pass = '';
$data = '';
$sSetting['refresh'] = "10000";

//Template options: "default" and "dark"
$template = "./templates/default/";
$index = $template . "index.php";


class DB extends PDO
{
    public function __construct($db)
    {
        $dsn = sprintf('mysql:dbname=%s;host%s', $db['data'], $db['host']);
        try {
            return new PDO($dsn, $db['user'], $db['pass'], PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die("Database error: " . $e->getMessage());
        }

    }
}

$db = new DB(['host' => $host, 'user' => $user, 'pass' => $pass, 'data' => $data]);