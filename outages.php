<?php 
include('includes/config.php');
$outages = json_decode(file_get_contents("cache/outages.db"), true);
$sTable ='
			<thead>
			<tr>
				<th id="name">Name</th>
				<th id="name">Down</th>
				<th id="name">Up</th>
				<th id="name">Total</th>
			</tr>
			</thead>
			<tbody>';
foreach($outages as $outage) {
	$sTable .='<tr><td>' . $outage['name'] . '</td><td>' . date("H:i:s -- d M Y", $outage['down']) . '</td><td>' . date("H:i:s -- d M Y", $outage['upagain']) . '</td><td>' . number_format((($outage['upagain'] - $outage['down']) / 60), 1, '.', '') . ' Minutes</td></tr>';

}
$sJavascript = '';
$sTable .= '</tbody>';
include($index);




?>