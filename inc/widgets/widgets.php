<?php

function sao_widgets_init() {


	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'sao' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'sao' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar(array(
    'name' => __('Service Widget', 'sao'),
    'id' => 'multi-service-widget',
    'description' => __('Add Service Widget','sao'),
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',
    ));

	register_sidebar(array(
		'name' => __('Team Widget', 'sao'),
    'id' => 'multi-team-widget',
    'description' => __('Add Team Widget','sao'),
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',
	));

	register_sidebar(array(
		'name' => __('Testimonial Widget', 'sao'),
    'id' => 'multi-testimonial-widget',
    'description' => __('Add Testimonial Widget','sao'),
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',
	));

	register_sidebar(array(
		'name' => __('Partners Widget', 'sao'),
    'id' => 'multi-partners-widget',
    'description' => __('Add Partners Widget','sao'),
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',
	));
}
add_action( 'widgets_init', 'sao_widgets_init' );
