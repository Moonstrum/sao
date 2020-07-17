<?php
if(shortcode_exists('sao_dummy_data')) {
$header = get_theme_mod('sao_features_header', esc_html__('Missions', 'sao' ));
$subheader = get_theme_mod('sao_features_subheader',  esc_html__('See our', 'sao' ));
$desc = get_theme_mod('sao_features_desc');

$content = get_theme_mod('features_row_settings', $defaults);
 ?>
<section id="features" class="features features-section section-padd">
  <div class="container-full">
    <div class="section-top wow animated fadeInRight">
     <?php if ($subheader != '') echo '<h5 class="section-subheader">' . esc_html($subheader) . '</h5>'; ?>
     <?php if ($header != '') echo '<h2 class="section-header">' . esc_html($header) . '</h2>'; ?>
     <?php if ( $desc ) {
                    echo '<div class="section-desc">' . apply_filters( 'sao_content', wp_kses_post( $desc ) ) . '</div>';
                } ?>
   </div>
		    <?php if($content){
        sao_print_content_section();
      } else {
        echo do_shortcode("[sao_dummy_data did='7']");
      } ?>
  </div>
</section>
<?php } ?>
