<?php
// ========================================================================================================================================
//                                                                  Live!
// ========================================================================================================================================
//
// By Cameron Munroe ~ Mun
// Website: https://www.qwdsa.com/converse/threads/serverstatus-rebuild.43/ 
// Documentation: https://www.qwdsa.com/converse/threads/serverstatus-rebuild.43/
// Version 0.2
//
// This is cross compatable with ServerStatus2 by @mojeda, but will serve no purpose unless used with 
// ServerStatus2 by @Munroenet
//
// ========================================================================================================================================
//                                                                  Purpose (Readme)
// ========================================================================================================================================
//
// The purpose of this file is to be run in a screen session allowing your servers to be constantly monitored, 
// and to report downtime even when you are not actively viewing the site.
// This is a vital part of your outage reports!

// ========================================================================================================================================
//                                                                  Config
// ========================================================================================================================================

// URL is the website + root folder of your ServerStatus install. i.e. http://example.com/uptime/ or http://uptime.example.com/
$url = 'http://127.0.0.1/uptime/';
$rest = 10; // how long should wewait b eforch eecking again
$max = 100; // max servers we should check!

// ========================================================================================================================================
//                                                                  App!
// ========================================================================================================================================
// Do not edit anything below this line, unless you know what you are doing!

header('Location: ' . $url); // redirect people if they somehow land on this page!

echo "We are running..\n CTRL + A + Z will allow you to leave the screen without killing it!";
do {
    sleep($rest); // we shall wait this long before going again!
	// get count
	$count = file_get_contents($url . '/includes/count.php');
	// sanity check time!
	if($count < 1){continue;} // if we have less then 1 result then skip
	elseif($count > $max){continue;} // prevents a case where count shows way more then we should actually check!
	elseif(!is_numeric($count)){continue;} // hey that isn't a number, get out!
	$run = 0;
	do {
		file_get_contents($url . '/pull/index.php?url=' . $run);
		$run++;
		if($run > $max){break;}
	} while ($count != $run);
	
} while (1 == 1);

// ========================================================================================================================================
//                                                                  Done
// ========================================================================================================================================
?>