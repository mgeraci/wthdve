$(function(){
	loadList();
	compose();
});

function loadList(){
	if ($('#assetsTable').length != 0) {
		headerRow = '<tr id="header"><td>id</td><td>author</td><td>category</td><td>subcateory</td><td>title</td><td id="contentColumn">content (excerpted)</td><td>edit</td></tr>';

		$.ajax({
			url: "api/list.php",
			success: function(data) {
				$('#assetsTable').html(headerRow + data);
				editRow();
			}
		});
	}
}

function compose(){
	if ($('body#compositionPage').length != 0) {
		// open the window cleared, for adding
		$('#addAsset').click(function(){
			// set the fields to the default (recipe)
			changeFields('recipe');
			
			$('#author').val('');
			$('#category').val('');
			$('#subcategory').val('');
			$('#title').val('');
			$('#content').val('');
			
			$('#edit').fadeIn('medium');
		});
		
		// cancel out of the composition window
		$('#cancel').click(function(){
			$('#edit').fadeOut('medium');
		});
		
		// if you change the category, change the field names and content
		$('#category').change(function(){
			changeFields($(this).val());
		});
		
		// submit your edit/new asset
		$('#composeSubmit').click(function(){
			alert('submitting');
			// assign the variables
			id = $('#id').val();
			author = $('#author').val();
			category = $('#category').val();
			subcategory = $('#subcategory').val();
			title = $('#title').val();
			content = $('#content').val();

			urlVar = "api/submit.php?id=" + id + "&author=" + author + "&category=" + category + "&subcategory=" + subcategory + "&title=" + title + "&content=" + content;

			$.ajax({
				url: urlVar,
				success: function(data) {
					$('#edit').fadeOut('medium');
					$('#flashContent').html('submitted. the id of what you just worked on is: ' + data + '<br>paste this into your wordpress window to link to this item:<br>&lt;a href="#"&gt;blah&lt;/a&gt;')
					$('#flashContent').slideDown('medium');
					loadList();
				}
			});
		});
		
		// close the flash message
		$('#flashClose').click(function(){
			$('#flash').slideUp('medium');
		})
	}
}

function changeFields(category){
	if (category == 'recipe') {
		$('h2#subcategoryTitle').html('recipe class');
		$('#subcategory').html('\
			<option value="breakfast">Breakfast</option>\
			<option value="bread">Bread</option>\
			<option value="dessert">Dessert &amp; Fruit</option>\
			<option value="lunch">Lunch &amp; Sandwiches</option>\
			<option value="entree">Entrees</option>\
			<option value="side">Side Dishes</option>\
			<option value="appetizer">Appetizers</option>\
			<option value="salad">Salad</option>\
			<option value="sauce">Sauces, Dressings, &amp; Seasonings</option>\
			<option value="soup">Soup</option>\
			<option value="vegetable">Vegetables</option>\
			<option value="drink">Drinks</option>\
		');
		
		$('h2#titleTitle').html('recipe title');
	}

	if (category == 'place') {
		$('h2#subcategoryTitle').html('city');
		$('#subcategory').html('\
			<option value="0">Nationwide</option>\
			<option value="1">Austin, TX</option>\
			<option value="2">Chicago, IL</option>\
			<option value="3">New York, NY</option>\
			<option value="4">Washington, DC</option>\
			<option value="5">Westchester, NY</option>\
			<option value="6">Providence, RI</option>\
		');
		
		$('h2#titleTitle').html('place name');
	}

	if (category == 'product') {
		$('h2#subcategoryTitle').html('i\'m not sure');
		$('#subcategory').html('\
			<option>hoo hah</option>\
			<option>wah wah wee wah</option>\
			<option>pooty oah</option>\
		');
		
		$('h2#titleTitle').html('product name');
	}
}

function editRow(){
	// open the composition window and populate it
	$('.edit').click(function(){
		// change the fields to match the category
		changeFields($(this).parent().prevAll('td.category').html());
		
		// populate the fields
		$('#id').val($(this).parent().prevAll('td.id').html());
		$('#author').val($(this).parent().prevAll('td.author').html());
		$('#category').val($(this).parent().prevAll('td.category').html());
		$('#subcategory').val($(this).parent().prevAll('td.subcategory').children('.subcategoryHidden').html());
		$('#title').val($(this).parent().prevAll('td.title').html());
		$('#content').val($(this).parent().prevAll('.content').html().replace(/<div class="truncateContent">/, '').replace(/.{6}$/, ''));

		// fade in the edit
		$('#edit').fadeIn('medium');
	});
}