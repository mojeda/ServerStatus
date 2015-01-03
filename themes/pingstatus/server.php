<?php
require_once('header.php');

if(isset($_GET['date'])) { $dateclean = htmlspecialchars($_GET['date']); }
if(isset($dateclean)===false) { $date = date('mdY'); } else { $date = $dateclean; }
$readabledate = substr($date, 0, 2)."/".substr($date, 2, 2)."/".substr($date, 4, 4);

$name = htmlspecialchars($_GET['id']);
$name = str_replace(chr(0), '', $name);
$id = findid($name, $servers);
if(is_numeric($id)==true) {
$url = "./uptime/".$servers[$id]['hostname']."/".$date.".json";
$output = file_get_contents($url);
$output = '{"servers":['.$output.'{"server":"end"}]}';
$output = utf8_encode($output);
$json = json_decode($output,true);

$result = array_reverse($json['servers']);
} else { exit('<div class="container"><div class="alert alert-danger">No server by the name "'.$name.'" found.</div></div>'); }

?>

    <div class="container content">
        <div class="row">
            <div class="col-md-4">

              <?php
                echo '
                <div class="server single">
                    <div class="pull-right"><a href="server.php?id='.$servers[$id]['name'].'" class="details"><i class="glyphicon glyphicon-new-window"></i></a></div>
                    <div class="hostname">'.$servers[$id]['name'].'</div>
                    <div class="row">
                      <div class="col-md-6 statsUptime">
                        <div class="uptime" id="uptime'.$servers[$id]['name'].'">N/A</div>
                        <div class="subtext">Uptime</div>
                      </div>
                      <div class="col-md-6 statsLoad">
                        <div class="load" id="load'.$servers[$id]['name'].'">N/A</div>
                        <div class="subtext">Load</div>
                      </div>
                      <hr />
                      <div class="col-md-6 minigraph">
                        <div class="memory" id="memory'.$servers[$id]['name'].'">
                          <div class="progress">
                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                          </div>
                        </div>
                        <div class="subtext">RAM</div>
                      </div>
                      <div class="col-md-6 minigraph">
                        <div class="hdd" id="hdd'.$servers[$id]['name'].'">
                          <div class="progress">
                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                          </div>
                        </div>
                        <div class="subtext">HDD</div>
                      </div>
                    </div>
                  </div>
                  <div class="box">
                    <table class="table table-condensed">
                      <tr>
                        <td><strong>Location</strong></td>
                        <td>'.$servers[$id]['location'].'</td>
                      </tr>
                      <tr>
                        <td><strong>Host</strong></td>
                        <td>'.$servers[$id]['host'].'</td>
                      </tr>
                      <tr>
                        <td><strong>Type</strong></td>
                        <td>'.$servers[$id]['type'].'</td>
                      </tr>
                    </table>
                  </div>
                ';
                global $js;
                $js .= '<script type="text/javascript">function uptime() {$(function() {$.getJSON("pull/index.php?url='.$servers[$id]['name'].'",function(result){$("#online'.$servers[$id]['name'].'").html(result.online);$("#uptime'.$servers[$id]['name'].'").html(result.uptime);$("#load'.$servers[$id]['name'].'").html(result.load);$("#memory'.$servers[$id]['name'].'").html(result.memory);$("#hdd'.$servers[$id]['name'].'").html(result.hdd);});});}uptime();setInterval(uptime, '.$refresh.');</script>';


              ?>
            </div>
            <div class="col-md-8">
                <?php

                $online = "0";
                foreach ($result as $server) {
                  if ($server['server'] != "end" ) {
                    $online++;
                    if ($online < 16) {
                      if($server['ping'] == "") { $timestamp .= "\"".$server['timestamp']."\","; $ping .= "\"0\","; } else {
                        $timestamp .= "\"".$server['timestamp']."\",";
                        $ping .= "\"".round($server['ping'])."\",";
                      }
                    }

                  }
                }

                ?>

                <h1>Ping History for <?php echo $readabledate; ?></h1>
                <div class="pull-right">Last 15 Events</div>
                <canvas id="uptime" width="750" height="200"></canvas>

                <script>
                    var uptime = document.getElementById('uptime').getContext('2d');
                   

                    var data = {
                        
                        labels: [<?php echo $timestamp; ?>],
                        datasets: [
                            {
                                label: "Uptime",
                                fillColor: "#5cb85c",
                                strokeColor: "#5cb85c",
                                pointColor: "#5cb85c",
                                pointStrokeColor: "#fff",
                                pointHighlightFill: "#fff",
                                pointHighlightStroke: "#fff",
                                data: [<?php echo $ping; ?>]
                            }
                        ]
                    };

                    var options = {
                        bezierCurve : false,
                        scaleBeginAtZero: true,
                    };


                     new Chart(uptime).Line(data,options);
                </script>

                <?php

                $count = "0";
                $online = "0";
                $offline = "0";
                foreach($json['servers'] as $key=>$server) {
                  if ($server['server'] != "end" ) {


                    if($server['ping'] != "" && $offline == "1") { 
                      
                        $online++;
                        $time2 = $server['timestamp'];
                      
                    }
                    
                    if($server['ping'] == "" && $offline == "0") { $offline++; $time1 = $server['timestamp']; }

                    if($offline == "1" && $online == "1" && $time1 != "") {
                      $outage .= "
                      <tr>
                        <td><i class='fa fa-arrow-circle-o-down' style='color: #b30000; font-size: 2em;'></i></td>
                        <td>".$time1."</td>
                        <td>".$time2."</td>
                      </tr>
                      ";
                      $time1 = "";
                      $time2 = "";
                      $online = "0";
                      $offline = "0";
                    } 
                  }
                }

                ?>

                <h1>Outages for <?php echo $readabledate; ?></h1>
                <table class="table table-condensed table-striped table-history">
                    <tr>
                        <th width="50">Status</th>
                        <th>Down</th>
                        <th>Up</th>
                    </tr>
                    <?php if (isset($outage)) { echo $outage; } else { echo "<tr><td colspan='3'>Yay No Outages!</td></tr>"; } ?>
                </table>

            </div>

        </div>

<?php require_once('footer.php'); ?>
