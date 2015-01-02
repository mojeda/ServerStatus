<?php require_once('header.php');?>

    <div class="container content">

      <?php

      foreach($servers as $server) {
      	echo '
      	
      		<div class="server">
		      <div class="pull-right"><a href="server.php?id='.$server['name'].'" class="details"><i class="glyphicon glyphicon-new-window"></i></a></div>
			    <div class="hostname">'.$server['name'].'</div>
		      <div class="row">
		        <div class="col-md-6 statsUptime">
		          <div class="uptime" id="uptime'.$server['name'].'">N/A</div>
		          <div class="subtext">Uptime</div>
		        </div>
		        <div class="col-md-6 statsLoad">
		          <div class="load" id="load'.$server['name'].'">N/A</div>
		          <div class="subtext">Load</div>
		        </div>
		        <hr />
		        <div class="col-md-6 minigraph">
		          <div class="memory" id="memory'.$server['name'].'">
		            <div class="progress">
		              <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
		            </div>
		          </div>
		          <div class="subtext">RAM</div>
		        </div>
		        <div class="col-md-6 minigraph">
		          <div class="hdd" id="hdd'.$server['name'].'">
		            <div class="progress">
		              <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
		            </div>
		          </div>
		          <div class="subtext">HDD</div>
		        </div>
		      </div>
		    </div>
      	';
      	global $js;
      	$js .= '<script type="text/javascript">function uptime() {$(function() {$.getJSON("pull/index.php?url='.$server['name'].'",function(result){$("#online'.$server['name'].'").html(result.online);$("#uptime'.$server['name'].'").html(result.uptime);$("#load'.$server['name'].'").html(result.load);$("#memory'.$server['name'].'").html(result.memory);$("#hdd'.$server['name'].'").html(result.hdd);});});}uptime();setInterval(uptime, '.$refresh.');</script>';

      }


      ?>

<?php require_once('footer.php'); ?>
