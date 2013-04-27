<!DOCTYPE html>
<html>
	<head>
		<title>ServerStatus</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.0/css/bootstrap-combined.min.css" rel="stylesheet">
		<link href="<?php echo $template; ?>css/custom.css" rel="stylesheet">
		<style>
			body { padding-top: 60px; }
			@media (max-width: 979px) {
  				body { padding-top: 0px; }
			}
		</style>
	</head>
<body>
	<div class="navbar navbar-fixed-top navbar-inverse">
	  <div class="navbar-inner">
	  	<div class="container">
		    <a class="brand" href="#">ServerStatus</a>
		</div>
	  </div>
	</div>

	<div class="container content">
		<table class="table table-striped table-condensed">
			<thead>
			<tr>
				<th id="status" style="text-align: center;">Status</th>
				<th id="name">Name</th>
				<th id="type">Type</th>
				<th id="host">Host</th>
				<th id="location">Location</th>
				<th id="uptime">Uptime</th>
				<th id="load">Load</th>
				<th id="ram">RAM</th>
				<th id="hdd">HDD</th>
			</tr>
			</thead>
			<tbody>
			<?php echo $sTable; ?>
			</tbody>
		</table>
	</div>
	
	<div class="container">
		<p style="text-align: center; font-size: 10px;"><a href="https://github.com/mojeda/ServerStatus">ServerStatus</a> - Base Script Provided by <a href="http://bluevm.com" target="_blank">BlueVM</a> - Customized by <a href="http://www.mojeda.com">Michael Ojeda</a></p>
	</div>
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.0/js/bootstrap.min.js"></script>
	<?php echo $sJavascript; ?>
</body>
</html>