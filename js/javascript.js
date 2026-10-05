// ==============================================
// = JavaScript for vegan.katherineerickson.com =
// =     copyright 2010, michael p. geraci      =
// =            mgeraci@gmail.com               =
// ==============================================


// Load these functions when the document is ready:
$(function(){
	stylesheets();
	stylePosts();
	setRecipeDialogs();
	expandRecipes();
	singleRecipe();
	allTitleSearch();
	enterInSearch();
	searchFormatting();
	productsTest();
});

// load browser-specific stylesheets
function stylesheets(){
	if(jQuery.browser.opera){
		$('head').append("<link type='text/css' rel='stylesheet' href='/js/browserStyles/opera.css'>");
	}
	if(jQuery.browser.chrome){
		$('head').append("<link type='text/css' rel='stylesheet' href='/js/browserStyles/chrome.css'>");
	}
}

function stylePosts(){
	// add the author class, remove Filed Under: Uncategorized if present, hide recipes
	// and not on About
	// hide recipes
	$('div.recipe').css('display', 'none');

	if ($('#noJS').length == 0) {
		// style posts
		$('div.post').each(function(){
			// get author
			author = $(this).children('.meta').children('.postAuthor').html();

			// make it uppercase
			authorUpcase = author.substr(0, 1).toUpperCase() + author.substr(1);

			// add the author class to the post
			$(this).addClass('postBy' + authorUpcase);

			// set the author class on the post title
			$(this).children('h3').children('a').attr('class', author);

			// get rid of the 'Filed under: Uncategorized'
			if ($(this).children('.meta').children('.postCategory').html().match(/Uncategorized/)){
				$(this).children('.meta').children('.postCategory').html('');
			}
		});
	}

	// add the author class to each sidebar author
	$('#sidebarAuthors').children('li').each(function(){
		author = $(this).children('a').html();
		$(this).children('a').addClass(author);
	});

	// remove uneccesary whitespace at end of recipes
	$('.recipe').each(function(){
		recipe = $(this).html().replace(/[ \t\r\n]+$/, '').replace(/<p>/g, '').replace(/<\/p>$/, '').replace(/<\/p>/g, '<br><br>').replace(/<span style="display: none;">.+?<\/span>/, '').replace(/^<br>/, '');
		$(this).html(recipe);
	});
}

// create and initialize the dialog div
function setRecipeDialogs(){
	if ($('#header').length != 0){
		$dialog = $('<div></div>').dialog({
			autoOpen: false,
			modal: true,
			width: 500
		});
	}
}

// make the recipe dialog when the span is clicked
function expandRecipes(){
	$('.recipeLink').click(function(){
		// if we're in a post
		if ($(this).parents('.post').length != 0){
			name = $(this).parents('.post').attr('class').match(/postBy([A-Za-z]+)/)[1];

			// make lowercase
			name = name.substr(0, 1).toLowerCase() + name.substr(1);
		// if we're in the recent recipe list
		} else if ($(this).parent('li').parent('ul').parent('li#recentRecipes').length != 0){
			name = $(this).parents('li').attr('class');
		// if we're on the recipes page
		} else if ($('#allRecipesTitle').length != 0){
			name = $(this).attr('class').replace(/recipeLink\s/, '');
		}

		// set the name to the dialog
		$('.ui-dialog').attr('id', name);

		// if the recipe is on the all recipes page or in the sidebar
		if ( ($('#allRecipesTitle').length == 1) || ($(this).parent().parent().parent('li#recentRecipes').length == 1) ){
			title = $(this).next('.recipe').attr('title');
			$dialog.html($(this).nextAll('.recipe').html()).append('<br><br><span class="' + name + '">posted by ' + name + '</span>').dialog('option', 'title', title).dialog('open');
		// in the body, if it's a sibline
		} else if ($(this).next('.recipe').length == 1) {
			title = $(this).next('.recipe').attr('title');
			$dialog.html($(this).nextAll('.recipe').html()).append('<br><br><span class="' + name + '">posted by ' + name + '</span>').dialog('option', 'title', title).dialog('open');
		// in the body, if it's the parent's sibling
		} else {
			title = $(this).parent().next('.recipe').attr('title');
			$dialog.html($(this).parent().next('.recipe').html()).append('<br><br><span class="' + name + '">posted by ' + name + '</span>').dialog('option', 'title', title).dialog('open');
		}
		// set the modal bg to turn off the dialog
		clickableOverlay();
	});
}

// enable clicking the background of the modal dialog to turn it off
function clickableOverlay(){
	$('.ui-widget-overlay').click(function(){
		$dialog.dialog("close"); 
	});
}

// if there's only one recipe on the recipe page, don't worry about the popup
function singleRecipe(){
	if ($('#allRecipesTitle').length != 0) {
		// if there's one recipe link
		if ($('.recipeLink').length == 1) {
			// get the author
			author = $('.recipeLink').attr('class').replace(/recipeLink\s/, '');

			// make nothing happen when you click on it
			$('.recipeLink').unbind('click');

			// add a spacer between the title and the recipe
			$('.recipeLink').after('<br><br>');

			// make it not hover
			$('.recipeLink').removeClass('recipeLink');

			// make the recipe appear
			$('.recipe').css('display', 'block');

			// append the author name
			$('.recipe').append('<br><br><span class="' + author + '">posted by ' + author + '</span>');
		}
	}
}

// set the autocomplete
function allTitleSearch(){
	// set the autocomplete
	if ($('#recipeSearch').length != 0){
		$("#recipeSearch").autocomplete("recipesSQL.php", {
				width: 260,
				matchContains: true,
				selectFirst: false,
				maxItemsToShow: 10,
				onFindValue: executeSearch,
				onItemSelect: executeSearch
			}
		);
	}
}

// what happens when you select an item
function executeSearch(li) {
	// display the value in the text box
	var result = li.selectValue;

	// replace spaces with pluses
	result = result.replace(/\s/g, '+');
	location.href='http://vegan.katherineerickson.com/recipes.php?search=' + result;
}


// redirect to the search page on submitting an autocomplete
function titleSearch(result){
	result = result.replace(/\s/g, '+');
	location.href='http://vegan.katherineerickson.com/recipes.php?search=' + result;
}

// when you hit enter in the search box, submit whatever you've typed
function enterInSearch(){
	if ( ($('#recipeSearch').length != 0) && (!jQuery.browser.msie) ) {
		$("#recipeSearch").keyup(function (e) {
		    if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
				triggerSearch();
		        return false;  
		    } else {  
		        return true;  
		    }  
		});
	}
}

// redirect to the search page on hitting enter in the search box
function triggerSearch(){
	inputBox = $('#recipeSearch').val();
	inputBox = inputBox.replace(/\s/g, '+');
	window.location.href='http://vegan.katherineerickson.com/recipes.php?search=' + inputBox;
}

// handle the class and content of the search box
function searchFormatting(){
	// set box value on load
	if ($('#recipeSearch').length != 0){
		$('#recipeSearch').val($('#recipeSearch').attr('title'));
	}

	// empty box and make active on click
	$('#recipeSearch').focus(function(){
		if ($(this).attr('class').match(/inactive/)){
			$(this).val('');
			$(this).removeClass('inactive').addClass('active');
		}
	});

	// on blur, see if it's empty, if so, reset
	$('#recipeSearch').blur(function(){
		if ($(this).val() == '') {
			$(this).removeClass('active').addClass('inactive');
			$(this).val($(this).attr('title'));
		}
	});
}