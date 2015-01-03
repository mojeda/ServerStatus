<?php
include('../includes/config.php');

$name = htmlspecialchars($_GET['url']);
$name = str_replace(chr(0), '', $name);

$id = findid($name, $servers);

$url = $servers[$id]['url'];
	
$output = jsonData($url);
if(($output == NULL) || ($output === false)){
	$array = array();
	$array['uptime'] = 'N/A';
	$array['load'] = 'N/A';
	$array['online'] = 'N/A';
	echo json_encode($array);
} else {
	$data = json_decode($output, true);
	$data["load"] = number_format($data["load"], 2);
	echo json_encode($data);
}
