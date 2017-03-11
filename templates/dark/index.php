<!DOCTYPE html>
<html>
	<head>
		<title>ServerStatus</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="<?php echo $template; ?>css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap 3.3.7 -->
		<link href="<?php echo $template; ?>css/custom.css" rel="stylesheet">
		<style>
			body { padding-top: 60px; }
			@media (max-width: 979px) {
  				body { padding-top: 0px; }
			}
		</style>
	</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
	  <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="#">ServerStatus</a>
		</div>
		
		<!-- Put other links here 
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		  <ul class="nav navbar-nav">
		  		<li><a class="" href="#">Link 1</a></li>
		  		<li><a class="" href="#">Link 2</a></li>
		  		<li><a class="" href="#">Link 3</a></li>
		  		<li><a class="" href="#">Link 4</a></li>
		  </ul>
		</div>-->
	  </div><!-- /.container-fluid -->
	</nav>
	<br/>
	<br/>

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
		<p style="text-align: center; font-size: 10px;"><a href="https://github.com/mojeda/ServerStatus">ServerStatus</a> by <a href="http://www.mojeda.com">Michael Ojeda</a></p>
	</div>
	<script src="<?php echo $template; ?>js/jquery.min.js"></script> <!-- jQuery 3.1.1 -->
	<script src="<?php echo $template; ?>js/bootstrap.min.js"></script> <!-- Bootstrap 3.3.7 -->
	<?php echo $sJavascript; ?>
</body>
</html>
