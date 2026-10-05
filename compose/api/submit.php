<?php
	include('api/connect.php');
	
	// get the information from the form
	$id = $_GET['id'];
	$author = $_GET['author'];
	$category = $_GET['category'];
	$subcategory = $_GET['subcategory'];
	$title = $_GET['title'];
	$content = $_GET['content'];

	// construct the query
	if ($id) {
		$query = "UPDATE wp_vegan (`author`, `category`, `subcategory`, `title`, `content`) VALUES ('$author', '$category', '$subcategory', '$title', '$content') WHERE id='$id'";
	} else {
		$query = "INSERT INTO wp_vegan (`id`, `author`, `category`, `subcategory`, `title`, `content`, `created_at`) VALUES ('', '$author', '$category', '$subcategory', '$title', '$content', NOW( ))";
	}

	// run the query
	mysql_query($query);

	// return the id (get it if you just added a new item)
	if ($id) {
		echo $id;
	} else {
		$query = "SELECT id FROM wp_vegan ORDER BY created_at DESC LIMIT 1";

		// run the query
		mysql_query($query);
		
		while ($row = mysql_fetch_array($result)) {
			echo $row[0];
		}
	}
?>