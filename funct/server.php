<?php

function dates($days, $raw) {
	$dates = array();
	for ($i = 0; $i < $days; $i++) {
	    $dates[] = date('M d', strtotime("-$i days"));
	    $datesraw[] = date('mdY', strtotime("-$i days"));
	}
	
	if(isset($raw) && $raw == "1") {
		$datesraw = array_reverse($datesraw);
		return $datesraw;
	} else {
		$dates = array_reverse($dates);
		return $dates;
	}
}

function findid($id, $array) {
global $key;
	foreach ($array as $key => $val) {
		if ($val['name'] == $id) {
			return $key;
		}
	}
	return null;
}

function dailyping($server, $date) {
global $ping, $result, $off;

	$url = $_SERVER['DOCUMENT_ROOT']."/uptime/".$server."/".$date."-trim.json";
	if(file_exists($url)) {
		$output = file_get_contents($url);
		$output = '{"servers":['.$output.'{"server":"end"}]}';
		$output = utf8_encode($output);
		$json = json_decode($output,true);
	} else {
		return '<i class="fa fa-ban tip" style="color: #808080;" data-toggle="tooltip" title="No Data Available"></i>';
	}

	foreach($json['servers'] as $key=>$ping) {
		if(isset($ping['online'])===true && isset($ping['total'])) {
			$uppercent = $ping['online'] / $ping['total'] * 100;
			$uppercent = round($uppercent, 2, PHP_ROUND_HALF_UP);
		}

		if(isset($ping['offline'])===true && $ping['offline'] > 1) {
			return '<i class="fa fa-exclamation-triangle tip" style="color: #ffa000;" data-toggle="tooltip" title="Uptime: '.$uppercent.'%"></i>';
		}

		if(empty($ping['offline'])) {
			return '<i class="fa fa-check tip" style="color: #00b300;" data-toggle="tooltip" title="Uptime: 100%"></i>';
		}
	}

}

function server($servers)
{
	global $search;
	$search = array_search("storage1", $servers);

	return $search;
}