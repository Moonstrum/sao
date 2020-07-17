<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package sao
 */

?>
<?php

get_header(); ?>
	<div class="post-content-single">

		<?php
		while ( have_posts() ) : the_post();
    ?>

		<?php	get_template_part( 'template-parts/content', 'single' ); ?>

   <?php endwhile; // End of the loop. ?>

	</div><!-- #primary -->

<?php
get_footer('single'); ?>
