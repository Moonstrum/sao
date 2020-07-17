<?php
if(shortcode_exists('sao_dummy_data')) {
$header = get_theme_mod('sao_partners_header', esc_html__('Partners', 'sao' ));
$subheader = get_theme_mod('sao_partners_subheader', esc_html__('We are proud to present you our', 'sao' ));
$desc = get_theme_mod('sao_partners_desc');
 ?>

 <input type="hidden" id="partners_slider_speed" value="<?php if(get_theme_mod('partners_slider_speed', '') != ''){ echo stripslashes(get_theme_mod('partners_slider_speed')); } else {?> 5 <?php } ?>;?>"/>
   <section id="partners" class="partners partners-section section-padd" data-center="background-position=50% 0px;" data-top-bottom="background-position=50% -100px;">
     <div class="container-three-fourths">
       <div class="section-top wow animated fadeInLeft">
        <?php if ($subheader != '') echo '<h5 class="section-subheader">' . esc_html($subheader) . '</h5>'; ?>
        <?php if ($header != '') echo '<h2 class="section-header">' . esc_html($header) . '</h2>'; ?>
        <?php if ( $desc ) {
                       echo '<div class="section-desc">' . apply_filters( 'sao_content', wp_kses_post( $desc ) ) . '</div>';
                   } ?>
      </div>
       <div class="partners-block">
           <ul class="partners-slider" data-wow-delay=".5s">
             <?php
               if(is_active_sidebar('multi-partners-widget')){
                 dynamic_sidebar('multi-partners-widget');
               } else {
                   echo do_shortcode("[sao_dummy_data did='5']");
               }
              ?>
           </ul>
         </div>
     </div>
   </section>
 <div class="clearfix"></div>
<?php } ?>
