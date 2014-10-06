<?php
// pull
include('../includes/config.php');

function get_data($url) {
	$opts = array(
	  'http'=>array(
		'method'=>"GET",
		'timeout' => 10,
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
		if($data['uptime'] != null){file_put_contents("../cache/" . $_GET['url'] . ".raw", json_encode($data));}
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
			file_put_contents("../cache/" . $_GET['url'] . ".down", json_encode(array('time'=>$time, 'uptime'=>$old_cache['uptime'])));
		} else {
			$down = json_decode(file_get_contents("../cache/" . $_GET['url'] . ".down"), true);
			$dead = $down['time'] + $failafter;
				if($dead <= $time && !isset($down['mailed']) && $mailme == 1) {
					$message = "Node: " . $servers[$_GET['url']]['name']  . " on host " . $servers[$_GET['url']]['host'] . " is down as of: " .  date("H:i | d M Y", $down['time']) . ". It has currently been down for " . $failafter . " seconds.";
					$message = wordwrap($message, 70, "\r\n");
					mail($emailto, "ServerStatus: " . $servers[$_GET['url']]['name'] . " is down!", $message, 'From: ServerStatus <' . $emailfrom . '>' . "\r\n");
					$down['mailed'] = 'yes';
					file_put_contents("../cache/" . $_GET['url'] . ".down", json_encode($down));
				}
		}
	} else {
		$data["load"] = number_format($data["load"], 2);
		echo json_encode($data);
		if (file_exists("../cache/" . $_GET['url'] . ".down")) {
			$lastfail = json_decode(file_get_contents("../cache/" . $_GET['url'] . ".down"), true);
			unlink("../cache/" . $_GET['url'] . ".down");
			$totalfail = $time - $lastfail['time'];
			if($totalfail > $failafter) {
				$failures = array();
				$failures[] = array('down' => $lastfail['time'], 'upagain' => $time, 'name' => $servers[$_GET['url']]['name'], 'host' => $servers[$_GET['url']]['host'], 'type' => $servers[$_GET['url']]['type'], 'uptime' => $lastfail['uptime']);
				$oldfails = json_decode(file_get_contents("../cache/outages.db"), true);
				if($mailme == 1) {
					$message = "Node: " . $servers[$_GET['url']]['name']  . " on host " . $servers[$_GET['url']]['host'] . " is up as of: " .  date("H:i | d M Y", $time) . ". It was down for: " . number_format((($time - $lastfail['time']) / 60), 0, '.', '') . " Minutes.";
					$message = wordwrap($message, 70, "\r\n");
					mail($emailto, "ServerStatus: " . $servers[$_GET['url']]['name'] . " is up!", $message, 'From: ServerStatus <' . $emailfrom . '>' . "\r\n");
					}
				foreach($oldfails as $fail) {
					$failures[] = $fail;
				}
				file_put_contents("../cache/outages.db", json_encode($failures));
			}
			
		}
		
	}
}