	<?php
	/**
	 * @package WordPress
	 * @subpackage Classic_Theme
	 */
	get_header();
	?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<?php the_date('','<h2>','</h2>'); ?>

	<div <?php post_class() ?> id="post-<?php the_ID(); ?>" class="postBy<?php the_author() ?>">
		<h3 class="storytitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
		<div class="meta"><?php the_time('F j, Y') ?> - <span class="postAuthor"><?php the_author() ?></span>.&nbsp;&nbsp;<span class="postCategory"><?php _e("Tags:"); ?> <?php the_category(',') ?></span> <?php edit_post_link(__('Edit This')); ?></div>

		<div class="storycontent">
			<?php the_content(__('(more...)')); ?>
		</div>

		<div class="feedback">
			<?php wp_link_pages(); ?>
			<?php comments_popup_link(__('Comments (0)'), __('Comments (1)'), __('Comments (%)')); ?>
		</div>

	</div>

	<?php comments_template(); // Get wp-comments.php template ?>

	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>

	<?php posts_nav_link(' &#8212; ', __('&laquo; Newer Posts'), __('Older Posts &raquo;')); ?>

	<?php get_footer(); ?>
</div><!-- closes the centeredContent div in header.php -->