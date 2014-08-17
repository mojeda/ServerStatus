<?php 
$title = 'Outages';
$name = htmlspecialchars($_GET['name']);
$host = htmlspecialchars($_GET['host']);
header( "refresh:600;url=./outages.php" );
include('includes/config.php');
$outages = json_decode(file_get_contents("cache/outages.db"), true);
$sTable ='
			<thead>
			<tr>
				<th id="name">Name</th>
				<th id="name">Host</th>
				<th id="name">Type</th>
				<th id="name">Down</th>
				<th id="name">Up</th>
				<th id="name">Total</th>
			</tr>
			</thead>
			<tbody>';
			
if ($name == null && $host == null) {
	foreach($outages as $outage) {
		$sTable .='<tr><td><a href="outages.php?name=' . $outage['name'] . '">'. $outage['name'] . '</a></td><td><a href="outages.php?host=' . $outage['host'] . '">'. $outage['host'] . '</a></td><td>' . $outage['type'] . '</td><td>' . date("H:i:s -- d M Y", $outage['down']) . '</td><td>' . date("H:i:s -- d M Y", $outage['upagain']) . '</td><td>' . number_format((($outage['upagain'] - $outage['down']) / 60), 1, '.', '') . ' Minutes</td></tr>';
	}
}
elseif($name != null && $host == null) {
	foreach($outages as $outage) {
		if ($name == $outage['name']) {
			$sTable .='<tr><td><a href="outages.php?name=' . $outage['name'] . '">'. $outage['name'] . '</a></td><td><a href="outages.php?host=' . $outage['host'] . '">'. $outage['host'] . '</a></td><td>' . $outage['type'] . '</td><td>' . date("H:i:s -- d M Y", $outage['down']) . '</td><td>' . date("H:i:s -- d M Y", $outage['upagain']) . '</td><td>' . number_format((($outage['upagain'] - $outage['down']) / 60), 1, '.', '') . ' Minutes</td></tr>';
		}
	}
}
elseif($name == null && $host != null) {
	foreach($outages as $outage) {
		if ($host == $outage['host']) {
			$sTable .='<tr><td><a href="outages.php?name=' . $outage['name'] . '">'. $outage['name'] . '</a></td><td><a href="outages.php?host=' . $outage['host'] . '">'. $outage['host'] . '</a></td><td>' . $outage['type'] . '</td><td>' . date("H:i:s -- d M Y", $outage['down']) . '</td><td>' . date("H:i:s -- d M Y", $outage['upagain']) . '</td><td>' . number_format((($outage['upagain'] - $outage['down']) / 60), 1, '.', '') . ' Minutes</td></tr>';
		}
	}
}
elseif($name != null && $host != null) {
	foreach($outages as $outage) {
		if ($host == $outage['host'] && $host == $outage['host']) {
			$sTable .='<tr><td><a href="outages.php?name=' . $outage['name'] . '">'. $outage['name'] . '</a></td><td><a href="outages.php?host=' . $outage['host'] . '">'. $outage['host'] . '</a></td><td>' . $outage['type'] . '</td><td>' . date("H:i:s -- d M Y", $outage['down']) . '</td><td>' . date("H:i:s -- d M Y", $outage['upagain']) . '</td><td>' . number_format((($outage['upagain'] - $outage['down']) / 60), 1, '.', '') . ' Minutes</td></tr>';
		}
	}
}

$sJavascript = '';
$sTable .= '</tbody>';
include($index);




?>