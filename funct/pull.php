<?php
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

function jsonData($url){
	$cachefile = $_SERVER['DOCUMENT_ROOT'].'/cache/'.md5($url).'.json';
	$opts = array(
	  'http'=>array(
	  	'timeout' => "10",
	    'method'=>"GET",
	    'header'=>"Accept-language: en\r\n" .
	              "Cookie: foo=bar\r\n"
	  )
	);
	if(file_exists($cachefile)) {
		$cf = fopen($cachefile, 'r');
		$cachetime = trim(fgets($cf));

		if ($cachetime > strtotime('-30 seconds')) {
			$jsoncache = fgets($cf);
		} else {
			unlink($cachefile);

			$context = stream_context_create($opts);
			$json = file_get_contents($url, false, $context);

			file_put_contents($cachefile, time()."\n".$json, LOCK_EX);

			$jsoncache = fgets($cf);
		}
		
		fclose($cf);
			
	} else {
		$context = stream_context_create($opts);
		$json = file_get_contents($url, false, $context);

		file_put_contents($cachefile, time()."\n".$json, LOCK_EX);

		$jsoncache = file_get_contents($cachefile);
	}
	return $jsoncache;

}