<?php
if( ! defined( 'ABSPATH' ) ) {
	exit;    // exit if accessed directly
}

require_once( get_template_directory(). '/inc/widgets/widgets.php');
include_once get_parent_theme_file_path( '/inc/kirki/kirki.php' );
require_once( get_template_directory(). '/inc/customizer/customizer.php');

require_once get_parent_theme_file_path( 'inc/helpers/class-tgm-plugin-activation.php' );
require_once get_parent_theme_file_path( 'inc/helpers/template-functions.php' );
require_once get_parent_theme_file_path( 'inc/helpers/theme-setup.php' );
require_once get_parent_theme_file_path( 'inc/helpers/enqueue-handler.php' );
require_once get_parent_theme_file_path( 'inc/helpers/custom-header.php' );
require_once get_parent_theme_file_path( 'inc/helpers/jetpack.php' );
require_once get_parent_theme_file_path( 'inc/helpers/template-tags.php' );

require_once get_parent_theme_file_path( 'inc/helpers/plugins.php' );

function sao_customizer_admin_assets(){
  wp_enqueue_media();
//  wp_enqueue_script('sao-customizer-widget-script', get_template_directory(). '/inc/widgets/js/widgets.js', array( 'jquery', 'wp-color-picker' ), '', true);
}
add_action('admin_enqueue_scripts', 'sao_customizer_admin_assets');

?>
