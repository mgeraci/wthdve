<?php
	/**
	* @package WordPress
	* @subpackage Classic_Theme
	*/
?>
<!-- begin sidebar -->
<div id="menu">
	<ul>
		<?php /* Widgetized sidebar, if you have the plugin installed. */
			if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
			<li>
				<ul>
					<li class="bottomLinks"><a href="/about">about/contact</a></li>
					<li>&nbsp;</li>
					<li class="bottomLinks"><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS'); ?>"><img class="rssImage" src="/images/rss.png" width="16" height="16"> subscribe with rss</a></li>
				</ul>
			</li>
			<li id="recentRecipes">recent recipes:
				<ul>
					<?php include('recipesRecent.php'); ?>
					<li>&nbsp;</li>
					<li><a href="/recipes.php">view all recipes</a></li>
				</ul>
			</li>
			<?php wp_list_categories('title_li=' . __('tags:')); ?>
			<li id="search">
				<label for="s"><?php _e('Search:'); ?></label>
				<form id="searchform" method="get" action="<?php bloginfo('home'); ?>">
					<div>
						<input type="text" name="s" id="s" size="15" /><br />
						<input id="searchSubmit" type="submit" value="<?php esc_attr_e('Search'); ?>" />
					</div>
				</form>
			</li>
			<li>authors:
				<ul id="sidebarAuthors">
					<?php wp_list_authors('show_fullname=0&optioncount=0&exclude_admin=1'); ?>
				</ul>
			</li>
			<li id="archives"><?php _e('Archives:'); ?>
				<ul>
					<?php wp_get_archives('type=monthly'); ?>
				</ul>
			</li>
		<?php endif; ?>
	</ul>
</div>
<!-- end sidebar -->
