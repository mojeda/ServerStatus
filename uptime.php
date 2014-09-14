<?php
// ========================================================================================================================================
//                                                                  Uptime (free resources)
// ========================================================================================================================================
//
// By Cameron Munroe ~ Mun
// Website: https://www.qwdsa.com/converse/threads/serverstatus-rebuild.43/ 
// Version 0.1a
//
//
// should be cross compatiable with ServerStatus2 by @mojeda
// rebuild off the original uptime.php file, which can be found here:
// https://raw.githubusercontent.com/Munroenet/ServerStatus/master/uptime.php
// ========================================================================================================================================


// ========================================================================================================================================
//                                                                  Settings!
// ========================================================================================================================================

$dl = 10; // At this percent of usage we will show it as RED!
$wl = 25; // At this percent of usage we will show it as Yellow!

$memloc = '/proc/meminfo'; // This is where we get our info for meminfo.
// Debian / Ubuntu it is /proc/meminfo and should be the default for Linux!

$fileloc = '/'; // This is the drive we are monitoring!
// You can change this to what ever folder you like, but root i.e. '/' is
// most important on your system!

$uptimeloc = '/proc/uptime'; // this is where we get our info for uptime!

$loadtime = 0; // the settings are:
//  0 for 1  minute average
//  1 for 5  minute average
//  2 for 15 minute average

// ========================================================================================================================================
//                                                                  Getting Data!
// ========================================================================================================================================
// You shouldn't edit anything below here, unless you know 
// what you are doing!

$post = array(); // this is the info that will be posted to the page,
// be careful what you put under this handle!

$internal = array(); // internal array!

$internal['uptime'] = explode('.', file_get_contents($uptimeloc), 2);
$internal['memraw'] = file_get_contents($memloc);
$internal['hddtotal'] = disk_total_space($fileloc);
$internal['hddfree'] = disk_free_space($fileloc);
$internal['load'] = sys_getloadavg();

// ========================================================================================================================================
//                                                              Process The Data!
// ========================================================================================================================================

// uptime
$post['uptime'] = sec2human($internal['uptime'][0]); // Processing uptime and putting in post field!
// uptime done!


// memory
preg_match_all('/MemTotal:(.*)kB/', $internal['memraw'], $internal['memtotal']); // Get Total Memory!
$internal['memtotal'] = trim($internal['memtotal'][1][0], " ");  // Make nice.
preg_match_all('/MemFree:(.*)kB/', $internal['memraw'], $internal['memfree']); // Get Free Memory!
$internal['memfree'] = trim($internal['memfree'][1][0], " "); // Make nice.
preg_match_all('/Cached:(.*)kB/', $internal['memraw'], $internal['memcache']); // Get Cached Memory!
$internal['memfree'] = trim($internal['memcache'][1][0], " ") + $internal['memfree']; // Making cache seen as Free Memory!


$internal['memperc'] = floor(($internal['memfree'] / $internal['memtotal']) * 100); // calculations
$post['memory'] = levels($internal['memperc'], $dl, $wl);  // adding to the post field!
// memory done!

// HDD 
$internal['hddperc'] = floor(($internal['hddfree'] / $internal['hddtotal']) * 100); // calculations!
$post['hdd'] = levels($internal['hddperc'], $dl, $wl); // adding hdd to the post field!
// HDD done! 

// load 
$post['load'] = $internal['load'][$loadtime]; // posting load avg.
// load done

// Are we online?
$post['online'] = '<div class="progress"><div class="bar bar-success" style="width: 100%;"><small>Up</small></div></div>';
// YES WE ARE!

// ========================================================================================================================================
//                                                                  Post Data
// ========================================================================================================================================

echo json_encode($post); // Time to show the world what we are made of!
// ========================================================================================================================================
//                                                                  Functions
// ========================================================================================================================================


function levels($perc, $dl, $wl){
    // make nice green bars
    if($perc < 30) {
        $width = 30;
    } else {
        $width = $perc;
    }
    if($perc > $wl) { 
        $return = '<div class="progress progress-striped active"><div class="bar bar-success" style="width: ' . $width . '%;">' . $perc . '%</div</div>';
    }
    elseif($perc < $wl) {
        $return = '<div class="progress progress-striped active"><div class="bar bar-warning" style="width: ' . $width . '%;">' . $perc . '%</div></div>';
    }
    elseif($perc < $dl) {
        $return = '<div class="progress progress-striped active"><div class="bar bar-danger" style="width: ' . $width . '%;">' . $perc . '%</div></div>';
    }
    return $return;
    
}


// Sec2Human is from the original Script
function sec2human($time) {
  $seconds = $time%60;
	$mins = floor($time/60)%60;
	$hours = floor($time/60/60)%24;
	$days = floor($time/60/60/24);
	return $days > 0 ? $days . ' day'.($days > 1 ? 's' : '') : $hours.':'.$mins.':'.$seconds;
}

// ========================================================================================================================================
//                                                                  Done
// ========================================================================================================================================


?>