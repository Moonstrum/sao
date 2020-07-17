<?php
if( ! defined( 'ABSPATH' ) ) {
	exit; // exit if accessed directly
}

/**
 * sao ::: remove Type Attributes
 */
add_filter('style_loader_tag', 'sao_remove_type_attr', 10, 2);
add_filter('script_loader_tag', 'sao_remove_type_attr', 10, 2);

function sao_remove_type_attr($tag, $handle) {
	return preg_replace( "/type=['\"]text\/(javascript|css)['\"]/", '', $tag );
}

/**
 * Register & enqueue styles
 */
 if( ! function_exists( 'sao_enqueue_styles' ) ) {
   function sao_enqueue_styles() {
   	$api_key = get_theme_mod('sao_map_api_key', '');

   	wp_enqueue_style(
      'sao-local-fonts',
       get_stylesheet_directory_uri() . '/fonts/custom-fonts.css');

   	wp_enqueue_style(
      'normalize',
       get_template_directory_uri() . '/css/normalize.css',
       array(),
       '7.0.0' );

   	wp_enqueue_style(
      'sao-font-awesome',
      'https://use.fontawesome.com/releases/v5.0.13/css/all.css',
      array(),
      '5.0.13' );

   	wp_enqueue_style(
      'bx-slider',
      get_template_directory_uri() . '/css/jquery.bxslider.css',
      array(),
      '1.0.0' );

   	wp_enqueue_style(
      'slickcss',
      get_template_directory_uri() . '/assets/slick/slick.css',
      array(),
      '1.0.0');

     wp_enqueue_style(
       'colorboxcss',
       get_template_directory_uri() . '/css/colorbox.css');

     wp_enqueue_style(
       'jquerycss',
       get_template_directory_uri() . '/css/jquery-ui.css',
       array(),
       '1.12.1');

   	wp_enqueue_style(
      'material-cards-css',
      get_template_directory_uri() . '/css/material-cards.css');

   	wp_enqueue_style(
      'animate-css',
      get_template_directory_uri() . '/css/animate.css');

   	wp_enqueue_style(
      'morphext-css',
      get_template_directory_uri() . '/css/morphext.css');

   	wp_enqueue_style(
      'sao-style',
      get_stylesheet_uri() );

			$use_testimonials_imgbg = get_theme_mod('sao_bg_image_control', 'false');
			$testimonials_bg_image = 	get_theme_mod('sao_testimonials_bg_img', ''.get_template_directory_uri().'/assets/images/defbg.png');
			$testimonials_overlay_color = get_theme_mod('testimonials_overlay_color');
			$testimonials_bg_img_css .= '.testimonials-section { background:linear-gradient('. $testimonials_overlay_color .','. $testimonials_overlay_color .'),url('.$testimonials_bg_image.'); }';
			if($use_testimonials_imgbg){
				wp_add_inline_style( 'sao-style', $testimonials_bg_img_css );
			}

			$use_contact_imgbg = get_theme_mod('sao_contact_usebg', false);
			$contact_bg_image = get_theme_mod('contact_us_background_image', ''.get_template_directory_uri().'/assets/images/defbg.png');
			$contact_overlay_color = get_theme_mod('contact_overlay_color');
			$contact_bg_img_css .= '.contact-section { background:linear-gradient('. $contact_overlay_color .','. $contact_overlay_color .'),url('.$contact_bg_image.'); }';
			if($use_contact_imgbg){
				wp_add_inline_style( 'sao-style', $contact_bg_img_css );
			}

			$fixed_header = get_theme_mod('sticky_header');
			$fixed_header_css .= '.fixed {position: fixed}';
			if($fixed_header == true){
           wp_add_inline_style( 'sao-style', $fixed_header_css );
			}


			$height = get_theme_mod('sao_logo_height', 70);
			wp_add_inline_style('sao-style',
			sprintf('img.custom-logo{height:%1$s;}',$height . "px") );

   	wp_localize_script( 'sao-navigation', 'screenReaderText', array(
   		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'sao' ) . '</span>',
   		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'sao' ) . '</span>',
   	) );


   	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
   		wp_enqueue_script( 'comment-reply' );
   	}

   }
   add_action( 'wp_enqueue_scripts', 'sao_enqueue_styles' );
 }

  if( ! function_exists( 'sao_enqueue_scripts' ) ) {
    function sao_enqueue_scripts(){
      $api_key = get_theme_mod('sao_map_api_key', '');

      wp_enqueue_script(
        'jquery',
        get_theme_file_uri( '/js/jquery-3.2.1.min.js' ),
        array(),
        '3.2.1',
        true
      );

      wp_enqueue_script(
        'galleryjs',
        get_theme_file_uri( '/js/gallery.js' ),
        array(),
        '',
        true
      );

      wp_enqueue_script(
        'modernizr',
        get_theme_file_uri( '/js/modernizr.js' ),
        array( 'jquery' ),
        '2.8.3',
        true
      );

      wp_enqueue_script(
        'sao-navigation',
        get_template_directory_uri() . '/js/navigation.js',
        array( 'jquery' ),
        '20151215',
        true
      );

      wp_enqueue_script(
        'jquery-bx-slider',
        get_template_directory_uri() . '/js/jquery.bxslider.js',
        array( 'jquery' ),
        '',
        true
      );

      wp_enqueue_script(
        'classie',
        get_template_directory_uri() . '/js/classie.js',
        array( 'jquery' ),
        '1.0.1',
        true
      );

      wp_enqueue_script(
        'slick-slider',
        get_template_directory_uri() . '/assets/slick/slick.min.js',
        array( 'jquery' ),
        '',
        true
      );

      wp_enqueue_script(
        'wowjs',
        get_template_directory_uri() . '/js/wow.js',
        array( 'jquery' ),
        '',
        true
      );

      wp_enqueue_script(
        'colorboxjs',
        get_template_directory_uri() . '/js/jquery.colorbox-min.js',
        array( 'jquery' ),
        '',
        true
      );

      wp_enqueue_script(
        'material-photo-gallery-js',
        get_template_directory_uri() . '/js/material-photo-gallery.min.js',
        array( 'jquery' ),
        '',
        true
      );

      wp_enqueue_script(
        'material-cards-js',
        get_template_directory_uri() . '/js/jquery.material-cards.min.js',
        array( 'jquery' ),
        '',
        true
      );

      wp_enqueue_script(
        'jqueryui',
        get_template_directory_uri() . '/js/jquery-ui.min.js',
        array( 'jquery' ),
        '1.12.1',
        true
      );

      wp_enqueue_script(
        'morphext-js',
        get_template_directory_uri() . '/js/morphext.min.js',
        array( 'jquery' ),
        null
      );

      if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    		wp_enqueue_script( 'comment-reply' );
    	}

			wp_enqueue_script(
        'sao-global',
        get_theme_file_uri( '/js/main.js' ),
        array( 'jquery' ),
        '1.0',
        true
      );

			if ($api_key){
    		wp_enqueue_script('googlemaps',
        'https://maps.googleapis.com/maps/api/js?key='.$api_key.'&callback=initMap',
        array(),
        '',
        true
      );
    	}
    }
    add_action( 'wp_enqueue_scripts', 'sao_enqueue_scripts' );
  }

  /**
   * sao ::: localize scripts
   */
  if( ! function_exists( 'sao_localize_scripts' ) ) {
      function sao_localize_scripts(){
        wp_localize_script( 'sao-navigation', 'screenReaderText', array(
      		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'sao' ) . '</span>',
      		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'sao' ) . '</span>',
      	) );


        $sao_js_vars = array(
                'sao_header_animation'        => get_theme_mod( 'animated_header_title', true ),
                'header_title_animation'   		 => get_theme_mod( 'header_title_animation_type', 'bounceIn' ),
                'header_title_animation_speed' => intval( get_theme_mod( 'header_title_animation speed', 3000 ) ),
        				'google_maps_latitude'   			 => get_theme_mod('latitude', 42),
        				'google_maps_longitude'   		 => get_theme_mod('longitude', 120),
        				'testimonial_slider_speed'   	 => get_theme_mod('testimonial_slider_speed', 2000),
            );
        wp_localize_script( 'jquery', 'sao_js_vars', $sao_js_vars );
      }
      add_action( 'wp_enqueue_scripts', 'sao_localize_scripts' );
  }

  /**
   * sao admin script enqueue
   */
   if( ! function_exists( 'sao_admin_enqueue_styles_scripts' ) ) {
   	function sao_admin_enqueue_styles_scripts( $hook ) {
      if ( 'post.php' === $hook || 'post-new.php' === $hook ) {
    		wp_enqueue_script( 'admin_js', get_template_directory_uri() . '/js/admin.js',  array( 'jquery') );
    	}
      wp_enqueue_media();
      wp_enqueue_script('widgetsjs', get_template_directory_uri(). '/inc/widgets/js/widgets.js', array( 'jquery', 'wp-color-picker' ), '', true);
   	}
   	add_action( 'admin_enqueue_scripts', 'sao_admin_enqueue_styles_scripts' );
   }

 /**
  * sao enqueue customizer resources
  */
   if( ! function_exists( 'sao_customizer_enqueue_styles_scripts' ) ) {
     function sao_customizer_enqueue_styles_scripts(){
       $cssUrl = get_template_directory_uri() . "/inc/customizer/css/";
       $jsUrl  = get_template_directory_uri() . "/inc/customizer/js/";

       wp_enqueue_script('sao-customizer-js', $jsUrl . "/customizer.js", array('jquery'));
       wp_enqueue_style('sao-customizer-css', $cssUrl . '/customizer.css');
     }
     add_action( 'customize_controls_enqueue_scripts', 'sao_customizer_enqueue_styles_scripts' );
   }

	//Adding Google Fonts
 if( ! function_exists( 'custom_add_google_fonts' ) ) {
	 function custom_add_google_fonts() {
	  wp_enqueue_style( 'open-sans-google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700', false );
	  wp_enqueue_style( 'open-sans-condensed-google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700', false );
	  wp_enqueue_style( 'raleway-google-fonts', 'https://fonts.googleapis.com/css?family=Raleway:300,400,700', false );
	  wp_enqueue_style( 'montserrat-google-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:300,400,700', false );
	  wp_enqueue_style( 'amatic-google-fonts', 'https://fonts.googleapis.com/css?family=Amatic+SC:400,700', false );
	  wp_enqueue_style( 'walter-turncoat', 'https://fonts.googleapis.com/css?family=Walter+Turncoat', false );
	  }
	  add_action( 'wp_enqueue_scripts', 'custom_add_google_fonts' );
 }
