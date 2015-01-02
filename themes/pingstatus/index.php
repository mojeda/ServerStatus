<?php require_once('header.php');

$dates = dates("7", "0");
$datesraw = dates("7", "1")
?>

    <div class="container content">
		<table class="table table-striped table-ping">
		<thead>
  			<tr>
  				<th width="23%">Name</th>
  				<?php
  					foreach($dates as $key=>$day) {
  						echo '<th width="8%">'.$day.'</th>';
  					}
  				?>
  			</tr>
  		</thead>
  		<tbody>
			<?php

			foreach($servers as $server) {
			echo '    		
			<tr>
				<td style="text-align: left;"><a href="/server.php?id='.$server['name'].'">'.$server['name'].' <i class="glyphicon glyphicon-new-window" style="font-size: 10px;"></i></a></td>';

			foreach($datesraw as $date) {
			echo '
				<td>'.dailyping($server['hostname'], $date).'</td>
			';
			}

			echo '	
			</tr>';
			}


			?>
			</tbody>
			</table>

<?php require_once('footer.php'); ?>