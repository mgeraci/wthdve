<?php
	include('connect.php');
	include('../../shared.php');

	$query = "SELECT * FROM `wp_vegan`";

	if ($query) {
		$result = mysql_query($query);
		if (!$result) {
			echo 'Could not run query: ' . mysql_error();
			exit;
		}
	}

	$tableContents = '';

	while ($row = mysql_fetch_array($result)) {
		$tableContents .= "
			<tr>
				<td class='id'>$row[id]</td>
				<td class='author'>" . getAuthorName($row['author']) . "</td>
				<td class='category'>$row[category]</td>
				<td class='subcategory'>
		";
				
		if ($row['category'] == 'recipe') {
			$tableContents .= '<div class="subcategoryHidden">' . $row['subcategory'] . '</div>' . getCategoryEnglish($row['subcategory']);
		}
		
		if ($row['category'] == 'place') {
			$tableContents .= '<div class="subcategoryHidden">' . $row['subcategory'] . '</div>' . getPlaceName($row['subcategory']);
		}
		
		if ($row['category'] == 'product') {
			$tableContents .= getCategoryEnglish($row['subcategory']);
		}

		$tableContents .= "</td>
				<td class='title'>$row[title]</td>
				<td class='content'><div class='truncateContent'>$row[content]</div></td>
				<td class='editTd'><a href='#' class='edit'>edit</a>
			</tr>
		";
	}
	
	echo $tableContents;
?>