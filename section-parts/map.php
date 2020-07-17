<?php
if(shortcode_exists('sao_dummy_data')) {
$header = get_theme_mod('sao_map_header', esc_html__('Map Section Header', 'sao' ));
$subheader = get_theme_mod('sao_map_subheader', esc_html__('Map Section subheader', 'sao' ));
$desc = get_theme_mod('sao_map_desc');
$temp_part = get_theme_mod('contact_template', 'contact-form');
?>

  <section id="map" class="map map-section section-padd">
    <div class="container-full">
      <div class="section-top">
       <?php if ($subheader != '') echo '<h5 class="section-subheader">' . esc_html($subheader) . '</h5>'; ?>
       <?php if ($header != '') echo '<h2 class="section-header">' . esc_html($header) . '</h2>'; ?>
       <?php if ( $desc ) {
                      echo '<div class="section-desc">' . apply_filters( 'sao_content', wp_kses_post( $desc ) ) . '</div>';
                  } ?>
     </div>
      <?php sao_print_map(); ?>
    </div>
  </section>
<?php } ?>
