<?php
	$server = "";
	$user = "";
	$password = "";
	$database = "";
	$link = mysql_connect($server,$user,$password);
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}
	$res = mysql_select_db($database);
	if (!$res) {
		die('Could not select db: ' . mysql_error());
	}
	
?>
