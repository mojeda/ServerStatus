<?php

$template = "./themes/default/";
$index = $template . "index.php";
$refresh = "30000";

$servers = array
(
	/* EXAMPLE
	array(
		"name" 		=> 'hostname',
		"url"		=> 'http://server.tld/path/to/uptime.php', //the full path to your server's uptime.php file.
		"location"	=> 'Oompa Loompa Land',
		"host"		=> 'Willy Wonka',
		"type"		=> 'Web Server',
	),

	OR

	array( "name" => 'hostname', "url" => 'http://server.tld/path/to/uptime.php', "location" => 'Oompa Loompa Land', "host" => 'Willy Wonka',"type" => 'Web Server',),

	*/

	
);


include ($_SERVER['DOCUMENT_ROOT']."/funct/server.php");
include ($_SERVER['DOCUMENT_ROOT']."/funct/pull.php");