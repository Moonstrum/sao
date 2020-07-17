<?php
if( shortcode_exists( 'sao_dummy_data' ) ) {
  $header = get_theme_mod('sao_slider_header', esc_html__('Slider Section', 'sao' ));
  $subheader = get_theme_mod('sao_slider_subheader',  esc_html__('Section subheader', 'sao' ));
  $desc = get_theme_mod('sao_slider_desc');
  $show_button = get_theme_mod('show_slider_button', true);
 ?>

 <section id="slider" class="slider slider-section section-padd">
   <div class="container-full">
   <?php
    $slider_settings = get_theme_mod('slider-row-settings', '');
    $i = 1;
    if($slider_settings){
    foreach ( $slider_settings as $setting) :
    ?>
    <div <?php if($i == 1) { echo 'id="slider--el-1"';} ?> class="img-responsive slider--el slider--el-<?php echo $i; ?> anim-4parts <?php if($i == 1) { echo active;} ?>">
      <div class="slider--el-bg">
        <div class="part top left"></div>
        <div class="part top right"></div>
        <div class="part bot left"></div>
        <div class="part bot right"></div>
      </div>
      <div class="slider--el-content">
        <div class="slider--el-content-inner">
          <h2 class="slider--el-heading first-slider-header"><?php  echo esc_html($setting['slider_header']); ?></h2>
          <p class="slider--el-paragraph first-slider-text">
            <?php  echo esc_attr($setting['slider_text']); ?>
          </p>
          <?php
          if($show_button){ ?>
            <a class="btn slider-button first-slider-button" href="<?php echo esc_url($setting['button_url']); ?>"><?php  echo esc_attr($setting['slider_button_text']); ?></a>
            <?php
          }
          ?>
        </div>
      </div>
    </div>
    <?php
    $i++;
    endforeach;
 ?>
   <span class="slider--control left"></span>
   <span class="slider--control right"></span>
 <?php } else {
   echo do_shortcode("[sao_dummy_data did='3']");
 } ?>
</div>
 </section>
<?php } ?>
