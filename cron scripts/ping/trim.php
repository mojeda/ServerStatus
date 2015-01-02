<?php
error_reporting(E_ERROR);
include('../public_html/includes/config.php');
$path = "../public_html/uptime/";
$date = date("mdY");
//$date = "11172014";

foreach ($servers as $serverinfo) {
	$off = "";
	$on = "";
	$total = "";
	$url = "".$path.$serverinfo['hostname']."/".$date.".json";

	if(file_exists($url)) {
		$output = file_get_contents($url);
		$output = '{"servers":['.$output.'{"server":"end"}]}';
		$output = utf8_encode($output);
		$json = json_decode($output,true);

		foreach($json['servers'] as $key=>$server) {
			$total++;
			if(isset($server['ping']) && $server['ping'] == "") {
				$off++;
			} else {
				$on++;
			}
		}

		$file = fopen($path.$serverinfo['hostname'].'/'.$date.'-trim.json', "w");
		fwrite($file, '{"server":"'.$serverinfo['hostname'].'","online":"'.$on.'","offline":"'.$off.'","total":"'.$total.'"},');
		fclose($file);
	}

}

