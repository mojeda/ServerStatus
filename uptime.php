<?php
function sec2human($time) {
  $seconds = $time%60;
	$mins = floor($time/60)%60;
	$hours = floor($time/60/60)%24;
	$days = floor($time/60/60/24);
	return $days > 0 ? $days . ' day'.($days > 1 ? 's' : '') : $hours.':'.$mins.':'.$seconds;
}

$array = array();
$fh = fopen('/proc/uptime', 'r');
$uptime = fgets($fh);
fclose($fh);
$uptime = explode('.', $uptime, 2);
$array['uptime'] = sec2human($uptime[0]);


$fh = fopen('/proc/meminfo', 'r');
  $mem = 0;
  while ($line = fgets($fh)) {
    $pieces = array();
    if (preg_match('/^MemTotal:\s+(\d+)\skB$/', $line, $pieces)) {
      $memtotal = $pieces[1];
    }
    if (preg_match('/^MemFree:\s+(\d+)\skB$/', $line, $pieces)) {
      $memfree = $pieces[1];
    }
    if (preg_match('/^Cached:\s+(\d+)\skB$/', $line, $pieces)) {
      $memcache = $pieces[1];
      break;
    }
  }
fclose($fh);

$memmath = $memcache + $memfree;
$memmath2 = $memmath / $memtotal * 100;
$memory = round($memmath2) . '%';

if ($memory >= "51%") { $memlevel = "success"; }
elseif ($memory <= "50%") { $memlevel = "warning"; }
elseif ($memory <= "35%") { $memlevel = "danger"; }

$array['memory'] = '<div class="progress progress-striped active">
<div class="bar bar-'.$memlevel.'" style="width: '.$memory.';">'.$memory.'</div>
</div>';

$hddtotal = disk_total_space("/");
$hddfree = disk_free_space("/");
$hddmath = $hddfree / $hddtotal * 100;
$hdd = round($hddmath) . '%';

if ($hdd >= "51%") { $hddlevel = "success"; }
elseif ($hdd <= "50%") { $hddlevel = "warning"; }
elseif ($hdd <= "35%") { $hddlevel = "danger"; }


$array['hdd'] = '<div class="progress progress-striped active">
<div class="bar bar-'.$hddlevel.'" style="width: '.$hdd.';">'.$hdd.'</div>
</div>';

$load = sys_getloadavg();
$array['load'] = $load[0];

$array['online'] = '<div class="progress">
<div class="bar bar-success" style="width: 100%;"><small>Up</small></div>
</div>';

if ($_GET['lg'] == true) { echo '
<div class="row" style="text-align: center;">
<div class="span3">
Uptime <span class="badge">'.$array['uptime'].'</span>
</div>
<div class="span3">
Load <span class="badge">'.$array['load'].'</span>
</div>
<div class="span3">
Memory <span class="badge">'.$memory.'</span>
</div>
<div class="span3">
Disk Space <span class="badge">'.$hdd.'</span>
</div>
</div>
'; } else { echo json_encode($array); };
?>