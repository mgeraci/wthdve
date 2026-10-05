<?php
	function getAuthorName($authorID){
		switch ($authorID) {
			case 0:
				$author = 'none';
				break;
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
		return $author;
	}
	
	function convertRecipe($recipe){
		$recipe = preg_replace('/%2C/', ',', $recipe);
		$recipe = preg_replace('/%0D%0A%0D%0A/', '<br><br>', $recipe);
		$recipe = preg_replace('/%0D%0A/', '<br>', $recipe);
		$recipe = preg_replace('/^(<br>)+(\S)/', '$2', $recipe);
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
		$recipe = preg_replace('/%23/', '#', $recipe);
		$recipe = preg_replace('/%3F/', '?', $recipe);
		$recipe = preg_replace('/%21/', '!', $recipe);
		$recipe = preg_replace('/%2B/', '+', $recipe);
		$recipe = preg_replace('/%26/', '&', $recipe);
		$recipe = preg_replace('/%7E/', '~', $recipe);
		$recipe = preg_replace('/%C3%A7/', 'ç', $recipe);
		$recipe = preg_replace('/%C2%BA/', 'º', $recipe);
		$recipe = preg_replace('/%27/', '\'', $recipe);
		$recipe = preg_replace('/%09/', '', $recipe);
		$recipe = preg_replace('/%25/', '%', $recipe);
		$recipe = preg_replace('/%C2%A0/', '', $recipe);
		$recipe = preg_replace('/%2D/', '-', $recipe);
		$recipe = preg_replace('/%C3%B1/', '&ntilde;', $recipe);
		$recipe = preg_replace('/<\/li><br>/', '</li>', $recipe);
		$recipe = preg_replace('/<\/ul><br>/', '</ul>', $recipe);
		$recipe = preg_replace('/<br><ul><br>/', '<ul>', $recipe);
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
	
	
	function getCategoryEnglish($categoryID){
		switch ($categoryID) {
			case 'breakfast':
				$category = 'Breakfast';
				break;
			case 'bread':
				$category = 'Bread';
				break;
			case 'dessert':
				$category = 'Dessert';
				break;
			case 'lunch':
				$category = 'Lunch &amp; Sandwiches';
				break;
			case 'entree':
				$category = 'Entrees';
				break;
			case 'side':
				$category = 'Side Dishes';
				break;
			case 'appetizer':
				$category = 'Appetizers';
				break;
			case 'salad':
				$category = 'Salads';
				break;
			case 'sauce':
				$category = 'Sauces, Dressings, &amp; Seasonings';
				break;
			case 'soup':
				$category = 'Soup';
				break;
			case 'vegetables':
				$category = 'Vegetables';
				break;
			case 'drink':
				$category = 'Drinks';
				break;
		}
		return $category;
	}
	
	function capitalizeTitle($title){
		$title = convertRecipe($title);
		$title = ucwords($title);
		$title = preg_replace('/-(.{1})/e', "'-'.strtoupper('$1')", $title);
		$title = preg_replace('/\/(.{1})/e', "'/'.strtoupper('$1')", $title);
		$title = preg_replace('/\((.{1})/e', "'('.strtoupper('$1')", $title);
		return $title;
	}

	function getPlaceName($placeID){
		switch ($placeID) {
			case 0:
				$place = 'none';
				break;
			case 1:
				$place = 'Austin, TX';
				break;
			case 2:
				$place = 'Chicago, IL';
				break;				
			case 3:
				$place = 'New York, NY';
				break;
			case 4:
				$place = 'Washington, DC';
				break;
			case 5:
				$place = 'Westchester, NY';
				break;
			case 6:
				$place = 'Providence, RI';
				break;
		}
		return $place;
	}
?>