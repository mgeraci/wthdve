<?php
	// =============
	// = variables =
	// =============
	$username = "lauraerick614155";
	$password = "shaniatrain";
	$host = "sql5c40a.carrierzone.com";
	$database = "recipes_lauraerickson1_site_aplus_net";

	// connect to the recipes database
	$conn = mysql_connect($host,$username,$password);
	mysql_select_db($database, $conn);

	$query = "SELECT name, recipe, author FROM `recipes` ORDER BY created_at DESC LIMIT 0, 10";

	$result = mysql_query($query);

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
		echo '<li class="' . $author . '"><span class="recipeLink ' . $author . '">' . $row[0] . '</span><div class="recipe" title="' . $row[0] . '">' . convertRecipe($row[1]) . '</div></li>';
	}

	function convertRecipe($recipe){
		$recipe = preg_replace('/%2C/', ',', $recipe);
		$recipe = preg_replace('/%0D%0A%0D%0A/', '<br><br>', $recipe);
		$recipe = preg_replace('/%0D%0A/', '', $recipe);
		$recipe = preg_replace('/%24/', '$', $recipe);
		$recipe = preg_replace('/%2F/', '/', $recipe);
		$recipe = preg_replace('/%22/', '"', $recipe);
		$recipe = preg_replace('/%3A/', ':', $recipe);
		$recipe = preg_replace('/%28/', '(', $recipe);
		$recipe = preg_replace('/%29/', ')', $recipe);
		$recipe = preg_replace('/%3C/', '<', $recipe);
		$recipe = preg_replace('/%3D/', '=', $recipe);
		$recipe = preg_replace('/%3E/', '>', $recipe);
		$recipe = preg_replace('/%3B/', ';', $recipe);
		$recipe = preg_replace('/%27/', '\'', $recipe);
		$recipe = preg_replace('/%09/', '', $recipe);
		$recipe = preg_replace('/%25/', '%', $recipe);
		$recipe = preg_replace('/%C2%A0/', '', $recipe);
		$recipe = preg_replace('/%2D/', '-', $recipe);
		$recipe = stripWhitespaceAtEnd($recipe);
		return $recipe;
	}

	function stripWhitespaceAtEnd($recipe){
		// get the last character
		preg_match('/.{4}$/', $recipe, $matches);
		$lastChar = $matches[0];
		if ($lastChar == '<br>'){
			$recipe = preg_replace('/.{4}$/', '', $recipe);
			$recipe = stripWhitespaceAtEnd($recipe);
		}
		return $recipe;
	}
?>