<?php
include('./includes/config.php');

$query = mysql_query("SELECT * FROM servers ORDER BY id") or die(mysql_error());
	$sJavascript .= '<script type="text/javascript">
		function uptime() {
			$(function() {';
while($result = mysql_fetch_array($query)){
	$sJavascript .= '$.getJSON("pull/index.php?url='.$result["id"].'",function(result){
	$("#online'.$result["id"].'").html(result.online);
	$("#uptime'.$result["id"].'").html(result.uptime);
	$("#load'.$result["id"].'").html(result.load);
	$("#memory'.$result["id"].'").html(result.memory);
	$("#hdd'.$result["id"].'").html(result.hdd);
	});';
	$sTable .= '
		<tr>
			<td class="center" id="online'.$result["id"].'">
				<div class="progress">
					<div class="bar bar-danger" style="width: 100%;"><small>Down</small></div>
				</div>
			</td>
			<td class="center">'.$result["name"].'</td>
			<td class="center">'.$result["type"].'</td>
			<td class="center">'.$result["host"].'</td>
			<td class="center">'.$result["location"].'</td>
			<td class="center" id="uptime'.$result["id"].'">n/a</td>
			<td class="center" id="load'.$result["id"].'">n/a</td>
			<td class="center" id="memory'.$result["id"].'">
				<div class="progress progress-striped active">
					<div class="bar bar-danger" style="width: 100%;"><small>n/a</small></div>
				</div>
			</td>
			<td class="center" id="hdd'.$result["id"].'">
				<div class="progress progress-striped active">
					<div class="bar bar-danger" style="width: 100%;"><small>n/a</small></div>
				</div>
			</td>
		</tr>
	';
}
	$sJavascript .= '});
	}
	uptime();
	setInterval(uptime, '.$sSetting['refresh'].');
	</script>';
include('./templates/default/index.php');
?>
