<?php
	// =============
	// = variables =
	// =============
	$username = "lauraerick614155";
	$password = "shaniatrain";
	$host = "sql5c40a.carrierzone.com";
	$database = "wordpress_lauraerickson1_site_aplus_net";

	// connect to the recipes database
	$conn = mysql_connect($host,$username,$password);

	if (!$conn) {
		echo "Could Not Connect to the Recipe Database";
	}

	mysql_select_db($database, $conn);

	$q = strtolower($_GET["q"]);
	if (!$q) return;

	$query = "SELECT DISTINCT name FROM `wp_recipes` WHERE name LIKE '%" . $q . "%' OR recipe LIKE '%" . $q . "%' ORDER BY name ASC";
	
	$result = mysql_query($query);

	while($row = mysql_fetch_array($result)) {
		// get the name
	    $name = $row[0];

		// replace special characters
		$name = preg_replace('/%27/', '\'', $name);
		$name = preg_replace('/%28/', '(', $name);
		$name = preg_replace('/%29/', ')', $name);

		// write the name
	    echo "$name\n";
	}
?>
