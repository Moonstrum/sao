<?php
if(shortcode_exists('sao_dummy_data')) {
$header = get_theme_mod('sao_services_header', esc_html__('Our Services', 'sao' ));
$subheader = get_theme_mod('sao_services_subheader',  esc_html__('Section subheader', 'sao' ));
$desc = get_theme_mod('sao_services_desc');
 ?>
     <section id="services" class="services-section section-padd">
      <div class="container-three-fourths">
        <div class="section-top wow animated fadeInRight">
         <?php if ($subheader != '') echo '<h5 class="section-subheader">' . esc_html($subheader) . '</h5>'; ?>
         <?php if ($header != '') echo '<h2 class="section-header">' . esc_html($header) . '</h2>'; ?>
         <?php if ( $desc ) {
                        echo '<div class="section-desc">' . apply_filters( 'sao_content', wp_kses_post( $desc ) ) . '</div>';
                    } ?>
       </div>
        <ul class="services-block service-grid wow animated fadeInLeft" data-wow-delay="0s">
           <?php
            if (is_active_sidebar('multi-service-widget')){
              dynamic_sidebar('multi-service-widget');
            } else {
              echo do_shortcode("[sao_dummy_data did='1']");
            }
            ?>
         </ul>
       </div>
     </section>
<?php } ?>
