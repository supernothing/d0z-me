<?php
	$link = mysql_connect($DB_SERVER,$DB_USER,$DB_PASSWORD);
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}
	$res = mysql_select_db($DB_DATABASE);
	if (!$res) {
		die('Could not select db: ' . mysql_error());
	}
	
?>
