<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package sao
 */

$footer_template = get_theme_mod('sao_footer_template', 'simple');
?>
	<footer id="colophon" class="site-footer footer-wrapper">
		<div class="container-three-fourths">
			<?php
			if ($footer_template == 'simple' || is_single()) {
				get_template_part( 'template-parts/footer/footer', 'single' );
			}  else {
				get_template_part( 'template-parts/footer/footer', 'columns' );
			} ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	</div>
<?php wp_footer(); ?>
</body>
</html>
