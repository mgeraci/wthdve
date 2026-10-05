<?php
	/**
	 * @package uploadRecipe
	 * @author Michael P. Geraci
	 * @version 1.0
	 */
	/*
	Plugin Name: Edit Post Contents TEST
	Plugin URI: http://wordpress.org/#
	Description: blah blah blah
	Author: Michael P. Geraci
	Version: 1.0
	Author URI: http://www.michaelgeraci.com
	*/

	function editPost($content){
		// db variables
		$username = "lauraerick614155";
		$password = "shaniatrain";
		$host = "sql5c40a.carrierzone.com";
		$database = "wordpress_lauraerickson1_site_aplus_net";
		
		// connect to the recipes database
		$conn = mysql_connect($host, $username, $password);
		mysql_select_db($database, $conn);

		// get the highest id from the vegan table
		// assign it to $max
		$query = "SELECT max(id) FROM `wp_vegan`";

		if ($query) {
			$result = mysql_query($query);
			if (!$result) {
				exit;
			}
		}

		while($row = mysql_fetch_array($result)) {
		    $max = $row[0];
		}



		// get the highest id from the vegan table
		// assign it to $max
		$query = "INSERT INTO `wp_vegan` (`name`, `content`, `created_at`, `author`, `category`, `subcategory`) VALUES ('test', '$content', NOW( ), '$author', 'test cat', 'subkitty')";

		if ($query) {
			$result = mysql_query($query);
			if (!$result) {
				exit;
			}
		}



		// add to the content and return it to the post
		$newMax = $max + 1;

		$content = $newMax . '::' . $content;

		return $content;
	}

	function uploadDetails($id){
		// get the post
		$post = get_post($id);

		// get the content of the post
		$content = urlencode($post->post_content);

		// get the author of the post
		$author = urlencode($post->post_author);


		
		// $query = "INSERT INTO `wp_vegan` (`name`, `content`, `created_at`, `author`, `category`, `subcategory`) VALUES ('test', '$content', NOW( ), '$author', 'test cat', 'subkitty')";
		// mysql_query($query);
	}

	add_filter('content_save_pre', 'editPost');
	// add_action('publish_post', 'uploadDetails');
?>