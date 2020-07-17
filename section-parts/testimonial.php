<?php
if(shortcode_exists('sao_dummy_data')) {
$usebg = get_theme_mod('sao_bg_image_control', 'false');
$bg_img = get_theme_mod('sao_testimonials_bg_img', ''.get_template_directory_uri().'/images/wintry.jpg');
$header = get_theme_mod('sao_testimonial_header', esc_html__('Testimonials subheader', 'sao' ));
$subheader = get_theme_mod('sao_testimonial_subheader', esc_html__('See what are clients have to say about us', 'sao' ));
$desc = get_theme_mod('sao_testimonials_desc');
 ?>

<input type="hidden" id="slider_spead" value="<?php if( get_theme_mod('testimonial_slider_speed', '') != ''){ echo esc_attr(get_theme_mod('testimonial_slider_speed')); } else {?> 6000 <?php } ?>"/>
<section class="testimonials testimonials-section section-padd" id="testimonials">
    <div class="container-three-fourths">
        <div class="section-top wow animated fadeInLeft">
         <?php if ($subheader != '') echo '<h5 class="section-subheader">' . esc_html($subheader) . '</h5>'; ?>
         <?php if ($header != '') echo '<h2 class="section-header">' . esc_html($header) . '</h2>'; ?>
         <?php if ( $desc ) {
                        echo '<div class="section-desc">' . apply_filters( 'sao_content', wp_kses_post( $desc ) ) . '</div>';
                    } ?>
       </div>
        <div class="testimonials-block">
          <ul class="testimonials-slider wow animated fadeInRight" data-wow-delay=".5s">
            <?php
              if(is_active_sidebar('multi-testimonial-widget')){
                dynamic_sidebar('multi-testimonial-widget');
              } else {
                echo do_shortcode( "[sao_dummy_data did='4']" );
              }
             ?>
          </ul>
        </div>
      </div>
  </section>
<div class="clearfix"></div>
<?php } ?>
