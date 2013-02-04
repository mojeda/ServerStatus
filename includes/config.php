<?php

$host = 'localhost';
$user = '';
$pass = '';
$data = '';
$sSetting['refresh'] = "10000";

mysql_connect($host, $user, $pass) or die(mysql_error());
mysql_select_db($data) or die(mysql_error());
$templates = "./templates/default/";
?>