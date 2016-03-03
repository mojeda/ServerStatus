<?php

$host = 'localhost';
$user = '';
$pass = '';
$data = '';
$sSetting['refresh'] = "10000";


try {
$sql = new PDO('mysql:host=' . $host . ';dbname=' . $data, $user, $pass);

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
//Template options: "default" and "dark"
$template = "./templates/default/";
$index = $template . "index.php";
?>