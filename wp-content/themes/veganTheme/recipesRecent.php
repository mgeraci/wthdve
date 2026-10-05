<?php
	include('shared.php');

	$db = @mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

	if (!$db) {
		echo 'Could not connect to the recipe database: ' . mysql_error();
		exit;
	}

	mysql_select_db(DB_NAME, $db);

	$query = "SELECT name, recipe, author FROM `wp_recipes` ORDER BY created_at DESC LIMIT 0, 4";
	$result = mysql_query($query, $db);

	// Display Rows
	while ($row = mysql_fetch_row($result)){
		switch ($row[2]) {
			case 3:
				$author = 'marcy';
				break;
			case 2:
				$author = 'katherine';
				break;
			case 5:
				$author = 'emily';
				break;
			case 4:
				$author = 'stacey';
				break;
		}
		echo '
			<li class="' . $author . '">
				<a class="recipeLink ' . $author . '" href="#" onclick="return false;">
					' . convertRecipe($row[0]) . '
				</a>
				<div class="recipe" title="' . ucwords(convertRecipe($row[0])) . '">
					' . convertRecipe($row[1]) . '
				</div>
			</li>
		';
	}
?>
