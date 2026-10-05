<?php
	/**
	 * @package uploadRecipe
	 * @author Michael P. Geraci
	 * @version 1.0
	 */
	/*
	Plugin Name: Upload Recipe
	Plugin URI: http://wordpress.org/#
	Description: Checks a post when posted to see if it's got a recipe.  If so, uploads it to the recipe database.
	Author: Michael P. Geraci
	Version: 1.0
	Author URI: http://www.michaelgeraci.com
	*/

	function uploadRecipe($id){
		// get the post
		$post = get_post($id);

		// get the content of the post
		$content = urlencode($post->post_content);

		// get the author of the post
		$author = urlencode($post->post_author);

		// if there's a recipe in the post
		if (preg_match('/%3Cdiv\+class%3D%22recipe%22/', $content)) {
			// match each recipe (if there's more than one)
			preg_match_all('/%3Cdiv\+class%3D%22recipe%22\+title%3D%22.+?%22.+?%3C%2Fdiv%3E/', $content, $matches);
			foreach ($matches[0] as $matches) {		
				// get the title
				$title = preg_replace('/%3Cdiv\+class%3D%22recipe%22\+title%3D%22/', '', $matches);
				$title = preg_replace('/\+/', ' ', $title);
				$title = preg_replace('/%22.+/', '', $title);

				// get the category
				// %3Cdiv class%3D%22recipe%22 title%3D%22                             %22%3E%3Cspan\+style%3D%22display%3Anone%22%3E XXX %3C%2Fspan%3E
				$category = preg_replace('/%3Cdiv\+class%3D%22recipe%22\+title%3D%22.+?%22.+?%3Cspan\+style%3D%22display%3A\+none%3B%22%3E/', '', $matches);
				$category = preg_replace('/%3C.+/', '', $category);

				// get the recipe
				$recipe = preg_replace('/%3Cdiv\+class%3D%22recipe%22\+title%3D%22.+?%22.+?%3Cspan\+style%3D%22display%3A\+none%3B%22%3E.+?%3C%2Fspan%3E/', '', $matches);
				$recipe = preg_replace('/\+/', ' ', $recipe);
				$recipe = preg_replace('/%3C%2Fdiv%3E/', '', $recipe);
				$recipe = preg_replace('/(%0D%0A)+$/', '', $recipe);
			
				// ========================
				// = insert/update recipe =
				// ========================
				$query = "INSERT INTO `wp_recipes` (`name`, `recipe`, `created_at`, `author`, `category`) VALUES ('$title', '$recipe', NOW( ), '$author', '$category')
				ON DUPLICATE KEY UPDATE recipe = '$recipe', modified_at = NOW( ), author='$author', category='$category'";
				mysql_query($query);
			}
		} else {}
	}

	add_action('publish_post', 'uploadRecipe');
?>