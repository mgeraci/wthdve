<?php
	$username = "lauraerick614155";
	$password = "shaniatrain";
	$host = "sql5c40a.carrierzone.com";
	$database = "wordpress_lauraerickson1_site_aplus_net";

	$conn = mysql_connect($host,$username,$password);
	mysql_select_db($database, $conn);

	if (!$conn) {
		echo "Could Not Connect to the Database";
	}
?>