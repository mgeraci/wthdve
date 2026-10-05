				<?php
					define('WP_USE_THEMES', false);
					require('./wp-blog-header.php');
					include('shared.php');
					get_header();
				?>
				<div id="allRecipesHeader">
  				<div id="allRecipesTitle">
  					<?php
						$db = @mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

						if (!$db) {
							echo 'Could not connect to the recipe database: ' . mysql_error();
							exit;
						}

						mysql_select_db(DB_NAME, $db);

  						// if you're looking for a particular author
  						if ($_GET["author"]) {
  							// get the author name
  							$author = $_GET["author"];

  							// validate the author
  							if (is_numeric($author) && in_array((int) $author, array(2, 3, 4, 5), true)) {
  								// get all recipes by author
  								$query = "SELECT name, recipe, author, created_at FROM `wp_recipes` WHERE author = $author ORDER BY name ASC";
  								echo '<h2>Recipes posted by ' . getAuthorName($author) . '</h2> <a id="recipesBack" href="/recipes.php">back to all recipes</a>';
  							}
  						} else if ($_GET["search"]) {
  							// get the search term
  							$search = $_GET["search"];

  							// clean the search string
  							$search = mysql_real_escape_string($search);

  							// replace special characters
  							$search = preg_replace("/'/", "%27", $search);
  							$search = preg_replace("/\(/", "%28", $search);
  							$search = preg_replace("/\)/", "%29", $search);

  							// tell people what they searched for
  							echo '<h2>Search results for ' . htmlspecialchars( preg_replace('/\\\\/', '', convertRecipe($search)), ENT_QUOTES ) . '</h2> <a id="recipesBack" href="/recipes.php">back to all recipes</a>';
  							$query = "SELECT name, recipe, author FROM `wp_recipes` WHERE name LIKE '%" . $search . "%' OR recipe LIKE '%" . $search . "%' ORDER BY name ASC";
  						} else if ($_GET["category"]) {
  							// get the searched for category
  							$category = $_GET["category"];

  							// clean the category string
  							$category = mysql_real_escape_string($category);

  							// tell people what they searched for
  							echo '<h2>' . getCategoryEnglish($category) . '</h2> <a id="recipesBack" href="/recipes.php">back to all recipes</a>';
  							$query = "SELECT name, recipe, author FROM `wp_recipes` WHERE category = '$category' ORDER BY name ASC";
  						}
  						 else {
  							// get all recipes
  							$query = 'SELECT name, recipe, author, created_at, category FROM `wp_recipes` ORDER BY name ASC';
  							echo '<h2>All recipes</h2>';
  						}

  						if ($query) {
  							$result = mysql_query($query, $db);
  							if (!$result) {
  								echo 'Could not run query: ' . mysql_error();
  								exit;
  							}
  						}
  					?>
  				</div>
  				<div id="searchContainer">
  					<input type="text" id="recipeSearch" class="inactive" title="search for a recipe or ingredient" style="width: 260px;" />
  					<input id="allRecipesButton" type="button" value="search" onclick="triggerSearch();" />
  				</div>
  			</div>
				<div id="recipeContainer">
					<?php	
						// Display Rows
						$letterIndex = '';
						while ($row = mysql_fetch_row($result)){
							// set current variables
							$author = getAuthorName($row[2]);
							$currentFirstLetter = strtoupper(substr($row[0], 0, 1));
						
							// echo the start of the left column (only the first time and not if there's only one result)
							if ( ($letterIndex == '') && (mysql_num_rows($result) != 1) ){
								echo '<div class="recipeColumn">';
							}
													
							// echo the column split (only once, when we've gotten to or past M in the alphabet)
							if ( (!$secondHalf) && ($currentFirstLetter > 'L') && (mysql_num_rows($result) != 1) ) {
								echo '</div><div class="recipeColumn" style="margin: 0px;">';
								$secondHalf = 'blank';
							}
													
							// echo new letter header if necessary
							if ( ($letterIndex != $currentFirstLetter) && (mysql_num_rows($result) != 1) ) {
								echo '<br><span class="alphabet">' . $currentFirstLetter . '</span><br>';
								$letterIndex = $currentFirstLetter;
							}
						
							// echo the title and recipe
							echo '<a class="recipeLink ' . $author . '" href="#" onclick="return false;">' . capitalizeTitle($row[0]) . '</a><div class="recipe" title="' . capitalizeTitle($row[0]) . '">' . convertRecipe($row[1]) . '</div><br>';
						}

						// echo the error page if there are no results (the div at the start it blank to handle the close div that gets printed no matter what)
						if (mysql_num_rows($result) == 0) {
							echo '<div><img src="/images/puppy.jpg" alt="Sad Puppy" width="626" height="475">';
						}

						// echo the close column div (or it closes the blank div if we're on an error page)
						// only shows if there's not 1 single result
						if ( (mysql_num_rows($result) != 1) ){
							echo '</div>';
						}
					?>
  			</div><!-- closes content from header -->
  		</div>
  		<div id="menu" class='allRecipes'>
  			<ul>
  				<li>
  					browse recipes by author:
  					<ul id="sidebarAuthors">
  						<li>
  							<a class="emily" title="Posts by emily" href="/recipes.php?author=5">emily</a>
  						</li>
  						<li>
  							<a class="katherine" title="Posts by katherine" href="/recipes.php?author=2">katherine</a>
  						</li>
  						<li>
  							<a class="marcy" title="Posts by marcy" href="/recipes.php?author=3">marcy</a>
  						</li>
  						<li>
  							<a class="stacey" title="Posts by stacey" href="/recipes.php?author=4">stacey</a>
  						</li>
  					</ul>
  				</li>
  				<li>
  					browse recipes by type:
  					<ul id="sidebarType">
  						<?php
  							// get all categories
  							$query = 'SELECT DISTINCT category FROM `wp_recipes` ORDER BY name ASC';

  							// run the query
  							if ($query) {
  								$result = mysql_query($query);
  								if (!$result) {
  									echo 'Could not run query: ' . mysql_error();
  									exit;
  								}
  							}
							
  							// print the results
  							while ($row = mysql_fetch_row($result)) {
  								echo '<li><a href="/recipes.php?category=' . $row[0] . '">' . getCategoryEnglish($row[0]) . '</a></li>';
  							}
  						?>
  					</ul>
  				<li><!-- links: -->
  					<ul>
  						<li><a href="/about">about/contact</a></li>
  						<li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS'); ?>"><img class="rssImage" src="/images/rss.png" width="16" height="16"> subscribe with rss</a></li>
  						<li>&nbsp;</li>
  						<li><a href="/">back to the blog</a></li>
  					</ul>
  				</li>
  			</ul>
  		</div>
  		<div class="footer">
  			Copyright <?php echo date("Y") ?>, Emily Clark, Katherine Erickson, Stacey Litner, &amp; Marcelle Pierson
  			<br>Site designed by <a href="http://www.michaelgeraci.com" target="_blank">Michael P. Geraci</a>. Powered by WordPress.
  		</div>
  	</div><!-- closes the centeredContent div from the header -->
	</body>
</html>
