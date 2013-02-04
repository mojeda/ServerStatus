<!DOCTYPE html>
<html>
	<head>
		<title>Server Status</title>
		<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
		<?php echo $sJavascript; ?>
		<script src="<?php echo $templates; ?>js/bootstrap.min.js"></script>
		<script type="text/javascript">
			$(function () {
				$("[rel='tooltip']").tooltip();
			});
		</script>
		<link href="<?php echo $templates; ?>css/bootstrap.css" rel="stylesheet">
		<link href="<?php echo $templates; ?>css/custom.css" rel="stylesheet">
		<style>
			body { padding-top: 60px; }
		</style>
	</head>
	<body>
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<a class="brand" href="/">Server Status</a>
				</div>
			</div>
		</div>

		<div class="container content">
			<table class="table table-striped table-condensed">
				<tr>
					<th style="text-align: center;">Status</th>
					<th>Name</th>
					<th>Type</th>
					<th>Host</th>
					<th>Location</th>
					<th>Uptime</th>
					<th>Load</th>
					<th>RAM <small>(Free)</small></th>
					<th>HDD <small>(Free)</small></th>
				</tr>
			<?php echo $sTable; ?>
			</table>
		</div>

		<div class="container">
			<p><center>Base Script Provided by <a href="http://bluevm.com" target="_blank">BlueVM</a> - Customized by <a href="http://www.mojeda.com">Michael Ojeda</a></center></p>
		</div>
	</body>
</html>
