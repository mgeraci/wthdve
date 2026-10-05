<?php
/*
	Plugin Name: TinyMCE Custom
	Plugin URI: http://rapiddg.com
	Description: TinyMCE Custom Buttons
	Version: 1.0
	Author: Michael Bopp (Rapid Development Group LLC)
	Author URI: http://rapiddg.com
*/
 
	function tcustom_addbuttons() {
	   // Don't bother doing this stuff if the current user lacks permissions
	   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
	     return;
 
	   // Add only in Rich Editor mode
	   if ( get_user_option('rich_editing') == 'true') {
	     add_filter("mce_external_plugins", "add_tcustom_tinymce_plugin");
	     add_filter('mce_buttons', 'register_tcustom_button');
	   }
	}
 
	function register_tcustom_button($buttons) {
	   array_push($buttons, "|", "highlight");
	   return $buttons;
	}
 
	function add_tcustom_tinymce_plugin($plugin_array) {
	   $plugin_array['highlight'] = 'http://vegan.katherineerickson.com/wp-content/plugins/tinymce-custom/mce/highlight/editor_plugin.js';
	   return $plugin_array;
	}
 
	// init process for button control
	add_action('init', 'tcustom_addbuttons');
?>