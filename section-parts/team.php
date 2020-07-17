<?php
if(shortcode_exists('sao_dummy_data')) {
$header = get_theme_mod('sao_team_header', esc_html__('Our Team', 'sao' ));
$subheader = get_theme_mod('sao_team_subheader', esc_html__('Meet Our Experts', 'sao' ));
$desc = get_theme_mod('sao_team_desc');
 ?>
  <section id="team" class="team-section  section-padd" data-center="background-position: 50% 0px;" data-top-bottom="background-position: 50% -100px; ">
    <div class="container-three-fourths">
      <div class="section-top wow animated fadeInLeft">
       <?php if ($subheader != '') echo '<h5 class="section-subheader">' . esc_html($subheader) . '</h5>'; ?>
       <?php if ($header != '') echo '<h2 class="section-header">' . esc_html($header) . '</h2>'; ?>
       <?php if ( $desc ) {
                      echo '<div class="section-desc">' . apply_filters( 'sao_content', wp_kses_post( $desc ) ) . '</div>';
                  } ?>
     </div>
        <ul class="team-block team-grid wow fadeInRight" data-wow-delay="0s">
          <?php if ( is_active_sidebar( 'multi-team-widget' )){
            dynamic_sidebar( 'multi-team-widget' );
          } else {
            echo do_shortcode( "[sao_dummy_data did='2']" );
          } ?>
        </ul>
    </div>
  </section>
<div class="clearfix"></div>
<?php } ?>
