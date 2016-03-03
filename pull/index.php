<?php
include('../includes/config.php');
function get_data($url) {
  $ch = curl_init();
  $timeout = 5;
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}

	$query = $sql->prepare("SELECT * FROM servers WHERE id=:id");
	$query->bindValue(':id', $_GET['url'], PDO::PARAM_INT);
	$query->execute();
	$result = $query->fetchAll();

	$url = "http://".$result[0]['url']."/uptime.php";
	$output = get_data($url);
	if(($output == NULL) || ($output === false)){
		$array = array();
		$array['uptime'] = '
		<div class="progress">
			<div class="bar bar-danger" style="width: 100%;"><small>Down</small></div>
		</div>
		';
		$array['load'] = '
		<div class="progress">
			<div class="bar bar-danger" style="width: 100%;"><small>Down</small></div>
		</div>
		';
		$array['online'] = '
		<div class="progress">
			<div class="bar bar-danger" style="width: 100%;"><small>Down</small></div>
		</div>
		';
		echo json_encode($array);
	} else {
		$data = json_decode($output, true);
		$data["load"] = number_format($data["load"], 2);
		echo json_encode($data);
	}