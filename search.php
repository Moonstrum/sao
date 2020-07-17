<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package sao
 */

get_header('single'); ?>

<section class="search-page-content blog-posts">
	<div id="search-ft-img" class="search-ft-img">
		<div class="archive-title">
			<h1><?php printf( esc_html__( 'Search Results for : %s', 'sao' ), get_search_query() ); ?></h1>
		</div>
	</div>
	<div class="container-three-fourths">
		<div class="blog-page-search">
			<?php get_search_form();  ?>
		</div>
		<div class="search-result flex-row posts-items">
		<?php if (have_posts()) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php
							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part( 'template-parts/content', 'search' );
					?>
		<?php endwhile; ?>
	<?php else : ?>
      <?php get_template_part( 'template-parts/content', 'none' ); ?>
  <?php	endif; ?>
	</div>
</div>
</section><!-- .wrap -->

<?php
get_footer();
