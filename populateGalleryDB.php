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
	
	$year='2011'; $month='02'; 
	
	if ($handle = opendir('./wp-content/uploads/'.$year.'/'.$month)) {
	   while (false !== ($file = readdir($handle))){
	          if ($file != "." && $file != ".."){
				if (!preg_match('/x/',$file)){
	          		$query="INSERT INTO wp_gallery (year, month, file) VALUES ('$year', '$month', '$file')";
					mysql_query($query);
				}
	          }
	       }
	  closedir($handle);
	  }
	
?>