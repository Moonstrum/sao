<?php

if( ! defined( 'ABSPATH' ) ) {

	exit; 	// exit if accessed directly

}

add_action( 'tgmpa_register', 'sao_required_plugins' );

function sao_required_plugins() {
   $plugins = array(
               array(
                   'name'               => 'Behemoth Assistant',
                   'slug'               => 'behemoth-assistant',
                   'source'             => get_stylesheet_directory() . '/lib/plugins/behemot-assistant.zip',
                   'required'           => true, // this plugin is required
               ),
               array(
                   'name'     => 'Contact Form 7',
                   'slug'     => 'contact-form-7',
                   'required' => false,
               ),
							 array(
                   'name'     => 'One Click Demo Import',
                   'slug'     => 'one-click-demo-import',
                   'required' => false,
               ),
             );

   $config = array(
             'domain'       => 'sao',         // Text domain - likely want to be the same as your theme.
             'default_path' => '',                         // Default absolute path to pre-packaged plugins
             'menu'         => 'install-my-theme-plugins', // Menu slug
           );

    tgmpa( $plugins, $config );

}
