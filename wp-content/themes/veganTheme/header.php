<?php
/**
 * @package WordPress
 * @subpackage Classic_Theme
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<title>
	  <?php
	    if ($_SERVER["REQUEST_URI"] == '/recipes.php') {
	      echo "All Recipes &laquo;";
	    } else {
	      wp_title('&laquo;', true, 'right');
	    }
	  ?>
    &nbsp;<?php bloginfo('name'); ?>
	</title>
	<style type="text/css" media="screen">
		@import url( <?php bloginfo('stylesheet_url'); ?> );
	</style>
	<link rel="stylesheet" type="text/css" href="/js/jquery-ui-1.7.2.custom.css">
	<link rel="stylesheet" type="text/css" href="/js/jquery.autocomplete.css">
	<!--[if IE 6]><link rel="stylesheet" type="text/css" href="/js/browserStyles/ie6.css"><![endif]-->
	<!--[if IE 7]><link rel="stylesheet" type="text/css" href="/js/browserStyles/ie7.css"><![endif]-->
	<!--[if IE 8]><link rel="stylesheet" type="text/css" href="/js/browserStyles/ie8.css"><![endif]-->

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_get_archives('type=monthly&format=link'); ?>
	<?php //comments_popup_script(); // off by default ?>
	<?php wp_head(); ?>
	
	<script type="text/javascript" src="/js/jquery.js"></script>
	<script type="text/javascript" src="/js/jquery-ui-1.7.2.custom.min.js"></script>
	<script type="text/javascript" src="/js/jquery.autocomplete.js"></script>
	<script type="text/javascript" src="/js/javascript.js"></script>
</head>
<body <?php body_class(); ?>>
	<div id="centeredContent">
		<div id="headerBand1"></div>
		<div id="headerBand2"></div>
		<div id="headerBand3"></div>
		<div id="headerBand4"></div>
		<div id="header">
			<a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a>
		</div>
		<?php if ( is_user_logged_in() ) { echo '<a href="http://vegan.katherineerickson.com/wp-admin">dashboard</a> | <a href="http://vegan.katherineerickson.com/wp-admin/post-new.php">new post</a><br>'; } ?>
		<div id="content">
		<!-- end header -->
