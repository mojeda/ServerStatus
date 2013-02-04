<?php
$array = array();
$data = shell_exec('uptime');
$uptime = explode(' up ', $data);
$uptime = explode(',', $uptime[1]);
$array['uptime'] = $uptime[0];

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

if ($memory <= "35%") $memlevel = "danger";

if ($memory <= "50%") $memlevel = "warning";

if ($memory >= "51%") $memlevel = "success"; 

$array['memory'] = '<div class="progress progress-striped active">
<div class="bar bar-'.$memlevel.'" style="width: '.$memory.';">'.$memory.'</div>
</div>';

$hddtotal = disk_total_space("/");
$hddfree = disk_free_space("/");

$hddmath = $hddfree / $hddtotal * 100;

$hdd = round($hddmath) . '%';

if ($hdd <= "35%") $hddlevel = "danger";

if ($hdd <= "50%") $hddlevel = "warning";

if ($hdd >= "51%") $hddlevel = "success";

$array['hdd'] = '<div class="progress progress-striped active">
<div class="bar bar-'.$hddlevel.'" style="width: '.$hdd.';">'.$hdd.'</div>
</div>';

$load = sys_getloadavg();
$array['load'] = $load[0];

$array['online'] = '<div class="progress">
<div class="bar bar-success" style="width: 100%;"><small>Online</small></div>
</div>';

echo json_encode($array);