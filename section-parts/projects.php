<?php
if(shortcode_exists('sao_dummy_data')) {
$header = get_theme_mod('sao_projects_header', esc_html__('Projects', 'sao' ));
$subheader = get_theme_mod('sao_projects_subheader',  esc_html__('We work hard so it is a special joy to present you our', 'sao' ));
$desc = get_theme_mod('sao_projects_desc');
$btn_text =  get_theme_mod('sao_projects_button_text', esc_html__('Read More', 'sao' ));
$num_of_projects_shown = get_theme_mod('num_of_projects_shown', 3);
?>
<section id="projects" class="projects-section projects-posts section-padd">
  <div class="container-three-fourths">
    <div class="section-top wow animated fadeInLeft">
     <?php if ($subheader != '') echo '<h5 class="section-subheader">' . esc_html($subheader) . '</h5>'; ?>
     <?php if ($header != '') echo '<h2 class="section-header">' . esc_html($header) . '</h2>'; ?>
     <?php if ( $desc ) {
                    echo '<div class="section-desc">' . apply_filters( 'sao_content', wp_kses_post( $desc ) ) . '</div>';
                } ?>
   </div>
          <?php
          $args = array(
            'posts_per_page'   => $num_of_projects_shown,
            'post_type'        => 'project',
          );
          $projects = new WP_query($args);
            ?>
            <div class="project-block wow fadeInRight">
            <?php
          if ( $projects->have_posts() ) {
            while ($projects->have_posts()) : $projects->the_post();
               ?>
               <div class="project-wrap wow animated fadeInRight">
                 <article class="material-card">
                    <h2>
                        <span><?php the_title(); ?></span>
                    </h2>
                    <div class="mc-content">
                        <div class="img-container">
                            <img class="img-responsive" src="<?php echo get_the_post_thumbnail_url( $post_id, 'blog-width' );?>">
                        </div>
                        <div class="mc-description"><?php echo esc_attr( get_post_meta( $post->ID, '_project-desc', true )); ?></div>
                    </div>
                    <a class="mc-btn-action">
                        <i class="fas fa-bars"></i>
                    </a>
                    <div class="mc-footer">
                      <a class="btn project-btn" target="_blank" href="<?php the_permalink(); ?>"><?php echo  esc_html($btn_text) ?></a>
                    </div>
                </article>
              </div>
            <?php
              endwhile;
              wp_reset_postdata();
            } else {
              echo do_shortcode("[sao_dummy_data did='9']");
            }
            ?>
      </div>
  </div>
</section>
<?php } ?>
