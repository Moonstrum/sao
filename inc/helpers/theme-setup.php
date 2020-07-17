<?php
if( ! defined( 'ABSPATH' ) ) {
	exit;  // exit if accessed directly
}

/**
 * =========================================
 * sao theme setup & widgets initialization
 * =========================================
 */

/**
 * sao content area width setup
 */
 /**
  * Set the content width in pixels, based on the theme's design and stylesheet.
  *
  * Priority 0 to make it available to lower priority callbacks.
  *
  * @global int $content_width
  */
 function sao_content_width() {
 	$GLOBALS['content_width'] = apply_filters( 'sao_content_width', 1140 );
 }
 add_action( 'after_setup_theme', 'sao_content_width', 0 );

if ( ! function_exists( 'sao_setup' ) ) {
  function sao_setup() {
    /*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on sao, use a find and replace
		 * to change 'sao' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'sao', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

    /*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

    /*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
    add_image_size( 'sao-testimonial-avatar', 120, 120, true );
    add_image_size( 'projects-image', 1350, 760, true );
    add_image_size( 'blog_post_image', 2350, 200, true );
		add_image_size( 'blog-width', 640 , 640);
		add_image_size( 'medium-width', 1024, 768 );
		add_image_size( 'full-width', 1024, 1024 );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
      'primary' => esc_html__( 'Primary', 'sao' ),
      'social'  => esc_html__( 'Social', 'sao' ),
    ) );

    /*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

    add_theme_support( 'custom-header', array(
			'default-image' => get_template_directory_uri() . "/assets/images/defbg.png",
       'video' => true,
       'flex-width'    => true,
      	'width'         => 980,
      	'flex-height'    => true,
      	'height'        => 200,
      ) );

    /**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
  // Set up the WordPress core custom background feature.
  add_theme_support( 'custom-background', apply_filters( 'sao_custom_background_args', array(
    'default-color' => 'ffffff',
    'default-image' => '',
  ) ) );

  // Add theme support for selective refresh for widgets.
  add_theme_support( 'customize-selective-refresh-widgets' );

  require_once get_parent_theme_file_path( '/inc/kirki/kirki.php' );
  Kirki::add_config('sao', array(
          'capability'  => 'edit_theme_options',
          'option_type' => 'theme_mod',
      ));

  }
  add_action( 'after_setup_theme', 'sao_setup' );
}
