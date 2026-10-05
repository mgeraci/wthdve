<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>
	<div id="noJS" style="display: none;"></div>
	<div id="content" role="main">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
		<h2 style="text-align: left;"><?php the_title(); ?></h2><?php edit_post_link('Edit this entry.'); ?>
			<div class="entry">
				<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

			</div>
		</div>
		<?php endwhile; endif; ?>
	
	<?php comments_template(); ?>

</div>
</div>
<?php get_sidebar(); ?>
<div>
<?php get_footer(); ?>
