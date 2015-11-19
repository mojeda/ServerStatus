<?php


$sSetting['refresh'] = "10000";

//Template options: "default" and "dark"
$template = "./templates/default/";
$index = $template . "index.php";


class DB extends PDO
{
    public function __construct()
    {
        /********************************
         ***** CONFIGURATION OPTIONS ****
         ********************************/
        $host = 'localhost';
        $user = 'xxxxxx';
        $pass = 'xxxxxx';
        $data = 'xxxxxx';

        $dsn = sprintf('mysql:dbname=%s;host%s', $data, $host);
        try {
            parent::__construct($dsn, $user, $pass);
        } catch (PDOException $e) {
            die("Database error: " . $e->getMessage());
        }

    }
}

$db = new DB();