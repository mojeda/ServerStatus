<?php

$servers = array();
// Example array below!
//$servers[] = array('url' => '', 'name' => '', 'location' => '', 'host' => '', 'type' => '');
//============================================================================================
// The order you put your arrays in will be how they show up on the server!
$servers[] = array('url' => 'http://www.munroenet.com/uptime.php', 'name' => 'WebServer', 'location' => 'LALA Land', 'host' => 'NSA', 'type' => 'WWW');
$servers[] = array('url' => 'https://cdn.content-network.net/.uptime.txt', 'name' => 'CDN', 'location' => 'Dallas,TX', 'host' => 'Catalysthost is the best host', 'type' => 'CDN');




$template = "./templates/default/"; // currently default and dark are the only options
$index = $template . "index.php"; 
$refresh = 10005; // this defines how quickly clients will recheck the uptime server for updates
$cache = 10; // this is how long before the cache expires, set to 0 to turn off.
$failafter = 60; // this defines what we see as an outage or not in seconds. 
// (cont.) This protects against failed queries unless there is an actual outage for more then X. 
$rtype = 'free'; // this is at the bottom of the page  and will tell your users if you are showing 
// free or used resources to make it more clear for them!
$mailme = 1; // anything other then 1 will make it not send emails to you!
$emailto = '@gmail.com' // where should we send down and up alerts?
$emailfrom = 'serverstatus@'; // where will we send the emails from?
?>