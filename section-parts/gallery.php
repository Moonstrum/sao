<?php
if(shortcode_exists('sao_dummy_data')) {
$galleryset = get_theme_mod('num_of_gallery_rows', 0);
$header = get_theme_mod('sao_gallery_header', esc_html__('Gallery subheader', 'sao' ));
$subheader = get_theme_mod('sao_gallery_subheader',  esc_html__('Gallery Header', 'sao' ));
$desc = get_theme_mod('sao_gallery_desc');
 ?>
<section id="gallery" class="gallery gallery-section section-padd">
  <div class="container-full">

     <div class="section-top wow animated fadeInLeft">
       <?php if ($subheader != '') echo '<h5 class="section-subheader">' . esc_html($subheader) . '</h5>'; ?>
       <?php if ($header != '') echo '<h2 class="section-header">' . esc_html($header) . '</h2>'; ?>
       <?php if ( $desc ) {
                      echo '<div class="section-desc">' . apply_filters( 'sao_content', wp_kses_post( $desc ) ) . '</div>';
                  } ?>
     </div>

    <div class="m-p-g">
      <div class="m-p-g__thumbs" data-google-image-layout data-max-height="350">
        <?php sao_print_gallery(); ?>
      </div>

      <div class="m-p-g__fullscreen"></div>
    </div>
 </div>
</section>
<script>
	var elem = document.querySelector('.m-p-g');

	document.addEventListener('DOMContentLoaded', function() {
		var gallery = new MaterialPhotoGallery(elem);
	});
</script>

<?php } ?>
