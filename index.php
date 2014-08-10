<?php
// main page
include('./includes/config.php');
global $sJavascript, $sTable;

	$sJavascript .= '<script type="text/javascript">
		function uptime() {
			$(function() {';
$id = 0;
$sTable ='
			<thead>
			<tr>
				<th id="status" style="text-align: center;">Status</th>
				<th id="name">Name</th>
				<th id="type">Type</th>
				<th id="host">Host</th>
				<th id="location">Location</th>
				<th id="uptime">Uptime</th>
				<th id="load">Load</th>
				<th id="ram">RAM</th>
				<th id="hdd">HDD</th>
			</tr>
			</thead>
			<tbody>';
foreach($servers as $result) {
	$sJavascript .= '$.getJSON("pull/index.php?url='.$id.'",function(result){
	$("#online'.$id.'").html(result.online);
	$("#uptime'.$id.'").html(result.uptime);
	$("#load'.$id.'").html(result.load);
	$("#memory'.$id.'").html(result.memory);
	$("#hdd'.$id.'").html(result.hdd);
	});';
	$sTable .= '
		<tr>
			<td id="online'.$id.'">
				<div class="progress">
					<div class="bar bar-danger" style="width: 100%;"><small>Down</small></div>
				</div>
			</td>
			<td>'.$result["name"].'</td>
			<td>'.$result["type"].'</td>
			<td>'.$result["host"].'</td>
			<td>'.$result["location"].'</td>
			<td id="uptime'.$id.'">n/a</td>
			<td id="load'.$id.'">n/a</td>
			<td id="memory'.$id.'">
				<div class="progress progress-striped active">
					<div class="bar bar-danger" style="width: 100%;"><small>n/a</small></div>
				</div>
			</td>
			<td id="hdd'.$id.'">
				<div class="progress progress-striped active">
					<div class="bar bar-danger" style="width: 100%;"><small>n/a</small></div>
				</div>
			</td>
		</tr>
	';
	$id++;
}
$sTable .= '</tbody>';
	$sJavascript .= '});
	}
	uptime();
	setInterval(uptime, '.$refresh.');
	</script>';

include($index);

?>
