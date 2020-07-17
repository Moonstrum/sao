
<?php
$header = get_theme_mod('sao_blog_header', esc_html__('News', 'sao' ));
$subheader = get_theme_mod('sao_blog_subheader',  esc_html__('Dont miss latest', 'sao' ));
$desc = get_theme_mod('sao_blog_desc');
$blog_button_text = get_theme_mod('sao_blog_btn_text',  esc_html__('See All Posts', 'sao' ));
$blog_section_num_of_posts = get_theme_mod('blog_num_of_posts_shown', '3');
 ?>
<section id="blog" class="blog-section blog-posts section-padd">
  <div class="container-three-fourths">
    <div class="section-top wow animated fadeInLeft">
     <?php if ($subheader != '') echo '<h5 class="section-subheader">' . esc_html($subheader) . '</h5>'; ?>
     <?php if ($header != '') echo '<h2 class="section-header">' . esc_html($header) . '</h2>'; ?>
     <?php if ( $desc ) {
                    echo '<div class="section-desc">' . apply_filters( 'sao_content', wp_kses_post( $desc ) ) . '</div>';
                } ?>
   </div>
    <div class="recent-posts wow animated fadeInRight">
      <div class="flex-row posts-items">
            <?php
            $the_query = new WP_Query(array(
              'posts_per_page'   => $blog_section_num_of_posts,
              'post_type'        => 'post',
              'order' => 'DESC',
            ));
            if ( $the_query->have_posts() ) :?>

              <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                <?php
									/*
									 * Include the Post-Format-specific template for the content.
									 * If you want to override this in a child theme, then include a file
									 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
									 */
									get_template_part( 'template-parts/content', 'list' );
								?>
              <?php
                wp_link_pages();
                endwhile;
                wp_reset_postdata();
              ?>
            <?php else : ?>
              <?php get_template_part( 'template-parts/content', 'none' ); ?>
            <?php endif; ?>
      </div>
      <?php if ($blog_section_num_of_posts > 4){ ?>
        <a class="btn btn-primary blog-btn" href="<?php echo sao_blog_link(); ?>" target="_blank"><?php echo esc_html($blog_button_text); ?></a>
    <?php } ?>
    </div>
    </div>
</section>
