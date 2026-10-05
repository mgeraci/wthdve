<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>
<div style="display: none;" id="searchPage"></div>
<?php if (have_posts()) : ?>

	<h2 class="pagetitle">Search Result for <?php /* Search Count */ $allsearch = &new WP_Query("s=$s&showposts=-1"); $key = wp_specialchars($s, 1); $count = $allsearch->post_count; _e(''); _e('<span class="search-terms">'); echo $key; _e('</span>'); _e(' &mdash; '); echo $count . ' '; _e('articles'); wp_reset_query(); ?></h2>

	<div class="navigation">
		<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
		<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
	</div>
	<br>

	<?php while (have_posts()) : the_post(); ?>

		<div <?php post_class() ?> style="margin-bottom: 15px;">
			<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

			<div class="meta"><?php the_time('F j, Y') ?> - <span class="postAuthor"><?php the_author() ?></span>.&nbsp;&nbsp;<span class="postCategory"><?php _e("Tags:"); ?> <?php the_category(',') ?></span> <?php edit_post_link(__('Edit This')); ?></div>

		</div>

	<?php endwhile; ?>

	<div class="navigation">
		<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
		<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
	</div>

<?php else : ?>
	<h2 class="pagetitle">Search Result for <?php /* Search Count */ $allsearch = &new WP_Query("s=$s&showposts=-1"); $key = wp_specialchars($s, 1); $count = $allsearch->post_count; _e(''); _e('<span class="search-terms">'); echo $key; _e('</span>'); wp_reset_query(); ?></h2>
	<br><img src="/images/puppy.jpg" alt="Sad Puppy" width="626" height="475">

<?php endif; ?>
</div>
<?php get_sidebar(); ?>
<div>
<?php get_footer(); ?>