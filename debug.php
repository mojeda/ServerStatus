<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo 'PHP Version: '.phpversion().'<br>';

echo 'Web Server: '.$_SERVER['SERVER_SOFTWARE'].'<br>';

if (function_exists('disk_total_space')) { 
	print "disk_total_space is [enabled] <br>";
} else {
	print "disk_total_space is [disabled] <br>";
}

if (function_exists('disk_free_space')) { 
	print "disk_free_space is [enabled] <br>";
} else {
	print "disk_free_space is [disabled] <br>";
}

if (function_exists('sys_getloadavg')) { 
	print "sys_getloadavg is [enabled] <br><br>";
} else {
	print "sys_getloadavg is [disabled] <br><br>";
}

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
echo '<h2>Uptime</h2>'.sec2human($uptime[0]).'';


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

echo '
<h2>Memory</h2>

Here we determine how much free memory there is<br>
<table>
	<tr>
		<th style="min-width:50px;">Cached</th>
		<th style="min-width:25px;"></th>
		<th style="min-width:50px;">Free</th>
		<th style="min-width:25px;"></th>
		<th style="min-width:50px;">Result</th>
	</tr>
	<tr>
		<td>'.$memcache.'</td>
		<td align="center">+</td>
		<td>'.$memfree.'</td>
		<td align="center">=</td>
		<td>'.$memmath.'&nbsp;KB</td>
	</tr>
</table>

Here we determine what percent of the total memory is free<br>
<table>
	<tr>
		<th style="min-width:50px;">Total Free</th>
		<th style="min-width:25px;"></th>
		<th style="min-width:50px;">Total</th>
		<th style="min-width:25px;"></th>
		<th style="min-width:50px;">Result</th>
	</tr>
	<tr>
		<td>'.$memmath.'</td>
		<td align="center">/</td>
		<td>'.$memtotal.'</td>
		<td align="center">=</td>
		<td>'.$memmath2.'&nbsp;%</td>
	</tr>
</table>

Now we round the percentage for usability<br>
<table>
	<tr>
		<th style="min-width:50px;">Result</th>
	</tr>
	<tr>
		<td>'.$memory.'</td>
	</tr>
</table>';

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

echo '
<h2>Storage</h2>

Here we determine how much free disk space there is<br>
<table>
	<tr>
		<th style="min-width:50px;">Disk Total</th>
		<th style="min-width:25px;"></th>
		<th style="min-width:50px;">Disk Free</th>
		<th style="min-width:25px;"></th>
		<th style="min-width:50px;">Result</th>
	</tr>
	<tr>
		<td>'.$hddtotal.'</td>
		<td align="center">/</td>
		<td>'.$hddfree.'</td>
		<td align="center">=</td>
		<td>'.$hddmath.'&nbsp;%</td>
	</tr>
</table>

Again we round the percentage...

<table>
	<tr>
		<th style="min-width:50px;">Result</th>
	</tr>
	<tr>
		<td>'.$hdd.'</td>
	</tr>
</table>';

if ($hdd >= "51%") { $hddlevel = "success"; }
elseif ($hdd <= "50%") { $hddlevel = "warning"; }
elseif ($hdd <= "35%") { $hddlevel = "danger"; }


$array['hdd'] = '<div class="progress progress-striped active">
<div class="bar bar-'.$hddlevel.'" style="width: '.$hdd.';">'.$hdd.'</div>
</div>';

$load = sys_getloadavg();
echo '<h2>Load</h2> '.$load[0].'';

$array['online'] = '<div class="progress">
<div class="bar bar-success" style="width: 100%;"><small>Up</small></div>
</div>';
