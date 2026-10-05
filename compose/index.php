<html>
	<head>
		<title>What the heck do vegans eat - Admin</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="/js/jquery.js"></script>
		<script type="text/javascript" src="javascript.js"></script>
	</head>
	<body id="compositionPage">
		<div id="centered">
			<div id="flash">
				<div id="flashClose">
					<a id="flashClose" href="#" onclick="return false;">close</a>
				</div>
				<div id="flashContent"></div>
			</div>
			<h1>All Assets</h1>
			<a href="#" id="addAsset">add a new asset</a>
			<br>
			<br>
			<table id="assetsTable"></table>
			<div id="edit">
				<input id="id" type="text" style="display: none;"></input>
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
				<br><input type="submit" value="submit" id="composeSubmit">&nbsp;<input type="submit" value="cancel" id="cancel">
			</div>
		</div>
	</body>
</html>