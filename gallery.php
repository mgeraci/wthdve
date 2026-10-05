<?php
	// ** MySQL settings - You can get this info from your web host ** //
	/** The name of the database for WordPress */
	$database='wordpress_lauraerickson1_site_aplus_net';

	/** MySQL database username */
	$user='lauraerick614155';

	/** MySQL database password */
	$password='shellwax36';

	/** MySQL hostname */
	$host='sql5c40a.carrierzone.com';
	
	$connect=mysql_connect($host, $user, $password);
	
	mysql_select_db($database, $connect);
	
	$query="SELECT file FROM wp_gallery";
	
	$result = mysql_query($query);
	
	while ($row = mysql_fetch_assoc($result)) {
		$file = $row["file"];	
		$inner_query="SELECT ID FROM wp_posts WHERE post_content like '%$file%' AND post_status = 'publish'";
		$inner_result = mysql_query($inner_query);
		while ($inner_row = mysql_fetch_assoc($inner_result)) {
				$post_ID = $inner_row["ID"];		
				echo "$file $post_ID <br>";
		}
	}
?>