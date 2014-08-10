<?php
$url = 'http://127.0.0.1/uptime';
header('Location: ' . $url);

echo "We are now running in the background.\nWe will continue to check every 60 seconds\nto see if your servers are up.";
do {
	// get count
	$count = file_get_contents($url . '/includes/count.php');
	$run = 0;
	do {
		file_get_contents($url . '/pull/index.php?url=' . $run);
		$run++;
	} while ($count != $run);
	sleep(60);
} while (1 == 1);
?>