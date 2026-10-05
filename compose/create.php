<html>
	<head>
		<title>What the heck do vegans eat - Admin</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="/js/jquery.js"></script>
		<script type="text/javascript" src="javascript.js"></script>
	</head>
	<body id="compositionPage">
		<div id="centered">
			<a href="index.php">see all assets</a>
			<h1>Add a New Vegan Asset</h1>
			<h2>author</h2>
			<br><select id="author">
				<option select="selected" value="0">no author</option>
				<option value="5">emily</option>
				<option value="2">katherine</option>
				<option value="4">stacey</option>
				<option value="3">marcy</option>
			</select>
			<br>
			<br>
			<h2>category</h2>
			<br><select id="category">
				<option select="selected" value="recipe">recipe</option>
				<option value="place">place</option>
				<option value="product">product</option>
			</select>
			<br>
			<br>
			<h2 id="subcategoryTitle">recipe class</h2>
			<br><select id="subcategory">
				<option value="breakfast">Breakfast</option>
				<option value="bread">Bread</option>
				<option value="dessert">Dessert &amp; Fruit</option>
				<option value="lunch">Lunch &amp; Sandwiches</option>
				<option value="entree">Entrees</option>
				<option value="side">Side Dishes</option>
				<option value="appetizer">Appetizers</option>
				<option value="salad">Salad</option>
				<option value="sauce">Sauces, Dressings, &amp; Seasonings</option>
				<option value="soup">Soup</option>
				<option value="vegetable">Vegetables</option>
				<option value="drink">Drinks</option>
			</select>
			<br>
			<br><h2 id="titleTitle">recipe title</h2>
			<br><input id="title"></input>
			<br>
			<br><h2>content</h2> <i>compose only in html, kiddos (see below for a rundown)</i>
			<br><textarea id="content" cols="60" rows="20"></textarea>
			<br>
			<br><input type="submit" value="submit" id="composeSubmit">
			<!-- explanation -->
			<div id="howToCode">
				<h1>how to write things in "html"</h1>
				<b>a list looks like this:</b>
				<br><xmp>
					<ul>
						<li>first ingredient</li>
						<li>second ingredient</li>
						<li>etc.</li>
					</ul>
				</xmp>
				<br><b>a link looks like this:</b>
				<xmp>
					<a href="http://www.thePageYouAreLinkingTo.com" target="_blank">click here or whatever</a>
				</xmp>
				<br><b>every time you want a return, toss this in:</b>
				<xmp>
					<br>
				</xmp>
			</div>
		</div>
	</body>
</html>