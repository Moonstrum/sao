<?php
/*
* Template Name: Home Page
*/

?>

<?php
get_header('frontpage');
?>

    <div id="content" class="site-content">
    		<main id="main" class="site-main">
        <?php
       /**
        * Get template parts from customizer
       */
        $section_parts = get_theme_mod('frontpage_template_parts', array( 'services', 'slider', 'team' ) );
       /**
        * Display every section that is turned on if not empty or not an array
       */
        if ( ! empty( $section_parts ) && is_array( $section_parts ) ) {
            foreach ( $section_parts as $part ) {
                get_template_part( 'section-parts/' . $part );
            }
        }
        ?>
        </main><!-- #main -->
    </div><!-- #content -->

<?php get_footer(); ?>
