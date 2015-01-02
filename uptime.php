<?php
$authkey = "";
$auth = $_GET['auth'];

if(empty($auth) && $authkey != NULL) {

  echo '{"Error":"Authentication Key Not Specified"}';

} elseif($auth != $authkey) {

  echo '{"Error":"Authentication Key Mismatch"}';

} else {

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
$array['hostname'] = gethostname();

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
elseif ($memory <= "35%") { $memlevel = "danger"; }
elseif ($memory <= "50%") { $memlevel = "warning"; }

$array['memory'] = '<div class="progress">
<div class="progress-bar progress-bar-'.$memlevel.'" role="progressbar" aria-valuenow="'.$memory.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$memory.'"></div>
</div>';

$hddtotal = disk_total_space("/");
$hddfree = disk_free_space("/");
$hddmath = $hddfree / $hddtotal * 100;
$hdd = round($hddmath) . '%';

if ($hdd >= "51%") { $hddlevel = "success"; }
elseif ($hdd <= "35%") { $hddlevel = "danger"; }
elseif ($hdd <= "50%") { $hddlevel = "warning"; }

$array['hdd'] = '<div class="progress">
<div class="progress-bar progress-bar-'.$hddlevel.'" role="progressbar" aria-valuenow="'.$hdd.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$hdd.'"></div>
</div>';

$load = sys_getloadavg();
$array['load'] = $load[0];

$array['online'] = '<div class="progress">
<div class="bar bar-success" style="width: 100%;"><small>Up</small></div>
</div>';

echo json_encode($array);
}