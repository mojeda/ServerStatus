<?php
// pull
include('../includes/config.php');

function get_data($url) {
	$opts = array(
	  'http'=>array(
		'method'=>"GET",
		'timeout' => 4,
		'header'=>"Accept-language: en\r\n" .
				  "Cookie: foo=bar\r\n" . 
				  "User-Agent: ServerStatus @  ". $_SERVER['SERVER_NAME']
	  )
	);
	$context = stream_context_create($opts);
	$data = file_get_contents($url, false, $context);
  return $data;
}
if(is_numeric($_GET['url'])){
	$time = time();
	$old_cache = json_decode(file_get_contents("../cache/" . $_GET['url']  . ".raw"), true);
	$cachetime = $old_cache['time'] + $cache;
	if($cachetime <= $time) {
		$result = $servers[$_GET['url']];
		if($result == null) { exit('WOW THERE, THIS ID DOES NOT EXIST');}
		$data = json_decode(get_data($result['url']), true);
		$data["time"] = $time;
		file_put_contents("../cache/" . $_GET['url'] . ".raw", json_encode($data));
		unset($data['time']);
	} else {
	unset($old_cache['time']);
	$data = $old_cache;
	}
	
	if(($data == NULL) || ($data === false)){
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
		if (!file_exists("../cache/" . $_GET['url'] . ".down")) {
			file_put_contents("../cache/" . $_GET['url'] . ".down", $time);
		}
	} else {
		$data["load"] = number_format($data["load"], 2);
		echo json_encode($data);
		if (file_exists("../cache/" . $_GET['url'] . ".down")) {
			$lastfail = file_get_contents("../cache/" . $_GET['url'] . ".down");
			unlink("../cache/" . $_GET['url'] . ".down");
			$failures = array();
			$failures[] = array('down' => $lastfail, 'upagain' => $time, 'name' => $servers[$_GET['url']]['name']);
			$oldfails = json_decode(file_get_contents("../cache/outages.db"), true);
			foreach($oldfails as $fail) {
				$failures[] = $fail;
			}
			file_put_contents("../cache/outages.db", json_encode($failures));
			
		}
		
	}
}