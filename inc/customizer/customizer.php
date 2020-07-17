<?php
/**
 * sao Theme Customizer
 *
 * @package sao
 */
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function sao_kirki_configuration(){
	return array( 'url_path'     => get_stylesheet_directory_uri() . '/inc/kirki/' );
}
add_filter( 'kirki/config', 'sao_kirki_configuration' );

function my_customizer_controls_styles() {
  wp_enqueue_style( 'customizercss', get_template_directory_uri() . '/inc/customizer/css/customizer.css', array(), '1.0.0' );
}
add_action('customize_controls_enqueue_scripts', 'my_customizer_controls_styles');

/************************/
/****Separator Class****/
/**********************/
add_action( 'customize_register', function( $wp_customize ) {
	/**
	 * The custom control class
	 */
	class Kirki_Controls_Separator_Control extends Kirki_Control_Base {
		public $type = 'separatorsection';
		public function render_content() { ?>
			<div class="customizer-separator">
							<span class="customize-control-title"><?php echo esc_attr( $this->label ); ?></span>
			</div>
			<?php
		}
	}
	// Register our custom control with Kirki
	add_filter( 'kirki_control_types', function( $controls ) {
		$controls['separatorsection'] = 'Kirki_Controls_Separator_Control';
		return $controls;
	} );

} );

function sao_customize_register_controls($wp_customize){
	//$wp_customize->remove_panel( 'widgets' );

	$wp_customize->remove_section( 'title_tagline');
	$wp_customize->remove_section( 'static_front_page' );
	$wp_customize->remove_section( 'colors' );
	$wp_customize->remove_section( 'background_image' );
	$wp_customize->get_section('header_image')->panel = 'header_panel';


	$wp_customize->add_panel( 'general_settings', array(
    'priority'       => 1,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __('General Settings', 'sao'),
    'description'    => '',
) );

$wp_customize->add_panel( 'header_panel', array(
	'priority'       => 1,
	'capability'     => 'edit_theme_options',
	'theme_supports' => '',
	'title'          => __('Header Settings', 'sao'),
	'description' => __('This panel provides options for the header', 'sao'),
) );
$wp_customize->add_panel( 'footer_settings', array(
    'priority'       => 3,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => esc_html__('Footer Settings', 'sao'),
    'description'    => '',
) );
$wp_customize->add_section( 'title_tagline', array(
    'priority'       => 1,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => esc_html__('Site Identity', 'sao'),
    'description'    => '',
		'panel'  => 'general_settings',
) );
$wp_customize->add_section( 'static_front_page', array(
    'priority'       => 2,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => esc_html__('Static Front Page', 'sao'),
    'description'    => '',
    'panel'  => 'general_settings',
) );
$wp_customize->add_section( 'site_buttons', array(
    'priority'       => 3,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => esc_html__('Site Buttons Settings', 'sao'),
    'description'    => '',
    'panel'  => 'general_settings',
) );
$wp_customize->add_section( 'background_image', array(
    'priority'       => 4,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => esc_html__('Background Image', 'sao'),
    'description'    => '',
    'panel'  => 'general_settings',
) );
$wp_customize->add_section('menus_color_palette', array(
  'priority'       => 2,
  'title'   =>   __('Menus color palette', 'sao'),
  'panel'   => 'nav_menus',
  'capability'   =>   'edit_theme_options',
  'description'   =>   __('Select the palette of colors to use on menus', 'sao'),
));
$wp_customize->add_section('switcher_section', array(
  'priority'       => 1,
  'title'   =>   __('Sections Order and Visibility', 'sao'),
  'capability'   =>   'edit_theme_options',
  'description'   =>   __('Select which section should be visible and order them', 'sao'),
));
$wp_customize->add_section( 'blog_settings', array(
    'priority'       => 2,
    'capability'     => 'edit_theme_options',
		'panel'   => 'blog_panel',
    'title'          => esc_html__('General Settings', 'sao'),
    'description'    => 'Settings for Blog section on Front Page',
) );
}

add_action('customize_register', 'sao_customize_register_controls');


function sao_add_sections($wp_customize){

	Kirki::add_panel( 'sections_panel', array(
		'priority'       => 2,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __('Sections Settings', 'sao'),
		'description' => __('This panel provides options for the sections', 'sao'),
	) );

	$panels = array(
		'services_panel' => array(
			'title' => __('Section: Services', 'sao'),
			'panel' => 'sections_panel',
			'priority' => 8,
		),
		'slider_panel' => array(
			'title' => __('Section: Slider', 'sao'),
			'panel' => 'sections_panel',
			'priority' => 9,
		),
		'team_panel' => array(
			'title' => __('Section: Team', 'sao'),
			'panel' => 'sections_panel',
			'priority' => 10,
		),
		'testimonial_panel' => array(
			'title' => __('Section: Testimonials', 'sao'),
			'panel' => 'sections_panel',
			'priority' => 11,
		),
		'clients_panel' => array(
			'title' => __('Section: Partners', 'sao'),
			'panel' => 'sections_panel',
			'priority' => 6,
		),
		'features_panel' => array(
			'title' => __('Section: Features', 'sao'),
			'panel' => 'sections_panel',
			'priority' => 3,
		),
		'contact_panel' => array(
			'title' => __('Section: Contact', 'sao'),
			'panel' => 'sections_panel',
			'priority' => 2,
		),
		'map_panel' => array(
			'title' => __('Section: Map', 'sao'),
			'panel' => 'sections_panel',
			'priority' => 5,
		),
		'blog_panel' => array(
			'title' => __('Section: Blog', 'sao'),
			'panel' => 'sections_panel',
			'priority' => 1,
		),
		'gallery_panel' => array(
			'title' => __('Section: Gallery', 'sao'),
			'panel' => 'sections_panel',
			'priority' => 4,
		),
		'projects_panel' => array(
			'title' => __('Section: Project', 'sao'),
			'panel' => 'sections_panel',
			'priority' => 7,
		),
	);
	foreach ($panels as $name => $value) {
        Kirki::add_panel($name, $value);
    }

}

function sao_kirki_fields( $fields ) {
 /******Body Typography Font Selection**********/
	$fields[] = array(
        'type'        => 'select',
        'setting'     => 'body_typography',
        'label'       => __( 'Site Font Family', 'sao' ),
        'description' => __( 'Please choose a font for your site. This font-family will be applied to all text on your site.', 'sao' ),
        'section'     => 'site_typography_section',
        'default'     => 'Lato',
        'priority'    => 1,
        'choices'     => Kirki_Fonts::get_font_choices(),
        'output'      => array(
            array(
                'element'  => 'body',
                'property' => 'font-family',
            ),
        ),
        'transport'   => 'postMessage',
        'js_vars'     => array(
            array(
                'element'  => 'body',
                'function' => 'css',
                'property' => 'font-family',
            ),
        ),
    );
	/******Body Typography Font Color**********/
		$fields[] = array(
	        'type'        => 'color',
	        'setting'     => 'body_typography_color',
	        'label'       => __( 'Site Font Color', 'sao' ),
	        'description' => __( 'Please choose a color for the font of your site. This color will be applied to all text on your site.', 'sao' ),
	        'section'     => 'site_typography_section',
	        'default'     => '#000',
	        'priority'    => 2,
	        'output'      => array(
	            array(
	                'element'  => 'body',
	                'property' => 'color',
	            ),
	        ),
	        'transport'   => 'postMessage',
	        'js_vars'     => array(
	            array(
	                'element'  => 'body',

	                'function' => 'css',
	                'property' => 'color',
	            ),
	        ),
	    );
		/******Menu Background Color**********/
			$fields[] = array(
		        'type'        => 'color',
		        'setting'     => 'menu_bg_color',
		        'label'       => __( 'Menu Background Color', 'sao' ),
		        'description' => __( 'Select Menu Background Color', 'sao' ),
		        'section'     => 'menus_color_palette',
		        'default'     => '#FFF',
		        'priority'    => 1,
						'choices' => array(
							'alpha' => true,
						),
		        'output'      => array(
		            array(
		                'element'  => '.site-header',
		                'property' => 'background-color',
		            ),
		        ),
		        'transport'   => 'auto',
		        'js_vars'     => array(
		            array(
		                'element'  => '.site-header',
		                'function' => 'css',
		                'property' => 'color',
		            ),
		        ),
		    );
	/******Menu Font Color**********/
	$fields[] = array(
				'type'        => 'color',
				'setting'     => 'menu_font_color',
				'label' => __('Menu Font Color', 'sao'),
				'description' => __( 'Select Menu Font Color', 'sao' ),
				'section'     => 'menus_color_palette',
				'default'     => '#000',
				'priority'    => 1,
				'transport'   => 'auto',
				'output' => array(
			    array(
			      'element' => '.main-navigation a, social-navigation svg',
			      'property' => 'color',
			    ),
			  ),
				'js_vars' => array(
			    array(
			      'element' => '.main-navigation a, social-navigation svg',
			      'function' => 'css',
			      'property' => 'color',
			      'suffix'   => ' !important',
			    ),
			  ),
		);
		/******Fixed Menu Background Color**********/
			$fields[] = array(
						'type'        => 'color',
						'setting'     => 'fixed_menu_bg_color',
						'label' => __('Fixed Header Background Color', 'sao'),
						'description' => __( 'Select Menu Background Color', 'sao' ),
						'section'     => 'menus_color_palette',
						'default'     => '#FFF',
						'priority'    => 1,
						'output' => array(
					    array(
					      'element' => '.fixed-header',
					      'property' => 'background-color',
					    ),
							array(
					      'element' => '.nav-is-visible',
					      'property' => 'background-color',
					    ),
					  ),
						'transport'   => 'auto',
						'js_vars' => array(
					    array(
					      'element' => '.fixed-header',
					      'function' => 'css',
					      'property' => 'background-color',
					      'suffix'   => ' !important',
					    ),
					  ),
				);
	/******Site Buttons Background and Font Color Separator**********/
		$fields[] = array(
			'type' => 'separatorsection',
			'label' => __('Background and Font Color', 'sao'),
			'section' => 'site_buttons',
			'priority' => 1,
			'settings' => 'site_btn_color_sep',
		);
		/******Site Buttons Background Color**********/
		$fields[] = array(
			'type' => 'color',
		  'label' => __('Buttons Background Color', 'sao'),
		  'section' => 'site_buttons',
		  'priority' => 1,
		  'settings' => 'site_btn_bg_color',
		  'default' => '#FFF',
		  'transport' => 'auto',
		  'output' => array(
		    array(
		      'element' => '.btn, .wpcf7 [type="submit"]',
		      'property' => 'background-color',
		    ),
				array(
		      'element' => '.wpcf7 [type="submit"]',
		      'property' => 'background-color',
		    ),
		  ),
		  'js_vars' => array(
		    array(
		      'element' => '.btn, .wpcf7 [type="submit"]',
		      'function' => 'css',
		      'property' => 'background-color',
		      'suffix'   => ' !important',
		    ),
		  ),
		);
	/******Site Buttons Font Color**********/
		$fields[] = array(
			'type' => 'color',
		  'label' => __('Buttons Font Color', 'sao'),
		  'section' => 'site_buttons',
		  'priority' => 2,
		  'settings' => 'site_btn_font_color',
		  'default' => '#000',
		  'transport' => 'auto',
		  'output' => array(
		    array(
		      'element' => '.btn',
		      'property' => 'color',
		    ),
				array(
		      'element' => '.wpcf7 [type="submit"]',
		      'property' => 'color',
		    ),
				array(
		      'element' => '.mc-footer .btn',
		      'property' => 'color',
		    ),
		  ),
		  'js_vars' => array(
		    array(
		      'element' => '.btn',
		      'function' => 'css',
		      'property' => 'color',
		      'suffix'   => ' !important',
		    ),
		  ),
		);
		/******Site Buttons on Hover Settings**********/
		$fields[] = array(
			'type' => 'separatorsection',
			'label' => __('On Hover Background and Font Color', 'sao'),
			'section' => 'site_buttons',
			'priority' => 4,
			'settings' => 'site_btn_hover_sep',
		);
		/******Site Buttons on Hover Background Color**********/
		$fields[] = array(
			'type' => 'color',
		  'label' => __('On Hover Background Color', 'sao'),
		  'section' => 'site_buttons',
		  'priority' => 5,
		  'settings' => 'site_btn_hover_color',
		  'default' => '',
		  'transport' => 'auto',
		  'output' => array(
		    array(
		      'element' => '.btn:hover',
		      'property' => 'background-color',
		    ),
				array(
		      'element' => '.wpcf7 [type="submit"]:hover',
		      'property' => 'background-color',
		    ),
		  ),
		  'js_vars' => array(
		    array(
		      'element' => '.btn:hover',
		      'function' => 'css',
		      'property' => 'background-color',
		      'suffix'   => ' !important',
		    ),
		  ),
		);
		/******Site Buttons on Hover Font Color**********/
		$fields[] = array(
			'type' => 'color',
		  'label' => __('On Hover Font Color', 'sao'),
		  'section' => 'site_buttons',
		  'priority' => 5,
		  'settings' => 'site_btn_hover_font_color',
		  'default' => '',
		  'transport' => 'auto',
		  'output' => array(
		    array(
		      'element' => '.btn:hover',
		      'property' => 'color',
		    ),
				array(
		      'element' => '.wpcf7 [type="submit"]:hover',
		      'property' => 'color',
		    ),
		  ),
		  'js_vars' => array(
		    array(
		      'element' => '.btn:hover',
		      'function' => 'css',
		      'property' => 'color',
		      'suffix'   => ' !important',
		    ),
		  ),
		);
		/******Back to Top Button Color Settings**********/
		$fields[] = array(
			'type' => 'separatorsection',
			'label' => __('Back to Top Button Color', 'sao'),
			'section' => 'site_buttons',
			'priority' => 5,
			'settings' => 'back_to_top_btn_sep',
		);
		$fields[] = array(
			'type' => 'color',
		  'label' => __('Back to Top Button Color', 'sao'),
		  'section' => 'site_buttons',
		  'priority' => 5,
		  'settings' => 'back_to_top_btn_color',
		  'default' => '',
		  'transport' => 'auto',
		  'output' => array(
		    array(
		      'element' => '.backtotop:before',
		      'property' => 'background-color',
		    ),
				array(
		      'element' => '.backtotop:after',
		      'property' => 'background-color',
		    ),
				array(
		      'element' => '.backtotop:hover::after',
		      'property' => 'background-color',
		    ),
				array(
		      'element' => '.backtotop:hover::before',
		      'property' => 'background-color',
		    ),
		  ),
		  'js_vars' => array(
		    array(
		      'element' => '.backtotop:before, .backtotop:after',
		      'function' => 'css',
		      'property' => 'background-color',
		      'suffix'   => ' !important',
		    ),
		  ),
		);
	/******Gallery Section Background Controls**********/
		$fields[] = array(
			'type' => 'color',
		  'label' => __('Section Background Color', 'sao'),
		  'section' => 'gallery_general_settings',
		  'priority' => 1,
		  'settings' => 'gallery_section_bg_color',
		  'default' => '#FFF',
		  'transport' => 'auto',
		  'output' => array(
		    array(
		      'element' => '.gallery-section',
		      'property' => 'background-color',
		    ),
		  ),
		  'js_vars' => array(
		    array(
		      'element' => '.gallery-section',
		      'function' => 'css',
		      'property' => 'background-color',
		      'suffix'   => ' !important',
		    ),
		  ),
		);
		/******Team Section Background Controls**********/
			$fields[] = array(
				'type' => 'color',
			  'label' => __('Section Background Color', 'sao'),
			  'section' => 'team_settings',
			  'priority' => 1,
			  'settings' => 'team_gb_color',
			  'default' => '#FFF',
			  'transport' => 'auto',
			  'output' => array(
			    array(
						'element' => '#team',
						'property' => 'background-color',
			    ),
			  ),
			  'js_vars' => array(
			    array(
			      'element' => '#team',
			      'function' => 'css',
			      'property' => 'background-color',
			      'suffix'   => '!important',
			    ),
			  ),
			);
		/******Testimonials Section Background Controls**********/
			$fields[] = array(
				'type' => 'color',
			  'label' => __('Section Background Color', 'sao'),
			  'section' => 'testimonial_settings',
			  'priority' => 1,
			  'settings' => 'testimonials_section_bg_color',
			  'default' => '#FFF',
			  'transport' => 'auto',
			  'output' => array(
			    array(
			      'element' => '.testimonials-section',
			      'property' => 'background-color',
			    ),
			  ),
			  'js_vars' => array(
			    array(
			      'element' => '.testimonials-section',
			      'function' => 'css',
			      'property' => 'background-color',
			      'suffix'   => '!important',
			    ),
			  ),
			);
		//Overlay Color and opacity
		$fields[] = array(
			'type' => 'color',
		  'label' => __('Testimonials Overlay Color', 'sao'),
			'description' => __('Works only if background image is used as section background', 'sao'),
		  'section' => 'testimonial_settings',
		  'priority' => 1,
		  'settings' => 'testimonials_overlay_color',
		  'default' => 'rgba(0,0,0,0.82)',
		  'transport' => 'auto',
			'priority' => 7,
			'choices'     => array(
				'alpha' => true,
			),
		  'output' => array(
		    array(
		      'element' => '.testimonials-section',
		      'property' => 'background-color',
		    ),
		  ),
		  'js_vars' => array(
		    array(
		      'element' => '.testimonials-section',
		      'function' => 'css',
		      'property' => 'background-color',
		      'suffix'   => ' !important',
		    ),
		  ),
			'required' => array(
		    array(
		    'setting'  => 'sao_bg_image_control',
		    'operator' => '==',
		    'value'    => true,
		  )
		  ),
		);
	/******Features Section Background Controls**********/
		$fields[] = array(
			'type' => 'color',
		  'label' => __('Section Background Color', 'sao'),
		  'section' => 'features_section_settings',
		  'priority' => 1,
		  'settings' => 'features_section_bg_color',
		  'default' => '#FFF',
		  'transport' => 'auto',
		  'output' => array(
		    array(
		      'element' => '.features-section',
		      'property' => 'background-color',
		    ),
		  ),
		  'js_vars' => array(
		    array(
		      'element' => '.features-section',
		      'function' => 'css',
		      'property' => 'background-color',
		      'suffix'   => ' !important',
		    ),
		  ),
		);
	/******Map Section Background Controls**********/
		$fields[] = array(
			'type' => 'color',
		  'label' => __('Section Background Color', 'sao'),
		  'section' => 'map_general_settings',
		  'priority' => 1,
		  'settings' => 'map_section_bg_color',
		  'default' => '#FFF',
		  'transport' => 'auto',
		  'output' => array(
		    array(
		      'element' => '.map-section',
		      'property' => 'background-color',
		    ),
		  ),
		  'js_vars' => array(
		    array(
		      'element' => '.map-section',
		      'function' => 'css',
		      'property' => 'background-color',
		      'suffix'   => ' !important',
		    ),
		  ),
		);
		//Info section icons and font color
		$fields[] = array(
			'type' => 'color',
		  'label' => __('Info Section Font and Icons Color', 'sao'),
		  'section' => 'google_map_settings',
		  'priority' => 11,
		  'settings' => 'map_section_font_color',
		  'default' => '',
		  'transport' => 'auto',
		  'output' => array(
		    array(
		      'element' => '.contact-us-items',
		      'property' => 'color',
		    ),
		  ),
		  'js_vars' => array(
		    array(
		      'element' => '.contact-us-items',
		      'function' => 'css',
		      'property' => 'color',
		      'suffix'   => ' !important',
		    ),
		  ),
		);
	/******Header Separator Background Controls**********/
		$fields[] = array(
			'type' => 'color',
		  'label' => __('Header Separator Background Color', 'sao'),
		  'section' => 'header_options',
		  'priority' => 8,
		  'settings' => 'svg_bg_color',
		  'default' => '#FFF',
		  'transport' => 'auto',
		  'output' => array(
		    array(
		      'element' => '.svg-bottom-container',
		      'property' => 'fill',
		    ),
		  ),
		  'js_vars' => array(
		    array(
		      'element' => '.svg-bottom-container',
		      'function' => 'css',
		      'property' => 'fill',
		      'suffix'   => ' !important',
		    ),
		  ),
		);
		/******Header Content Image Control Separator**********/
		$fields[] = array(
			'type' => 'separatorsection',
			'label'    => __('Header Content Image Control', 'sao'),
			'section'  => 'header_content_section',
			'priority' => 2,
			'settings' => 'sao_header_image_sep',
		);
		$fields[] = array(
			'type'        => 'image',
			'label'       => esc_attr__( 'Set the image to be displayed beside text in header', 'sao' ),
			'description' => esc_attr__( 'Content Image', 'sao' ),
			'section'  => 'header_content_section',
			'priority' => 2,
			'settings'    => 'header_content_image',
			'default'     => get_template_directory_uri() .'/assets/images/webdesign.png',
			'partial_refresh' => array(
							'header_content_image' => array(
								'selector' => ".header-content .header-content-image",
								'render_callback' => "sao_partial_render_callback",
							),
						),
						'required' => array(
			 		 	array(
			 		 	'setting'  => 'header_content_type',
			 		 	'operator' => '==',
			 		 	'value'    => 'image',
			 		 )
			 		 ),
		);

		/******Header Content Text Control Separator**********/
		$fields[] = array(
			'type' => 'separatorsection',
			'label'    => __('Header Text Options', 'sao'),
			'section'  => 'header_content_section',
			'priority' => 3,
			'settings' => 'sao_header_text_sep',
		);
		/******Header Content Font Control**********/
		$fields[] = array(
			'type' => 'color',
		  'label'       => __( 'Header Content Font Color', 'sao' ),
		  'section' => 'header_content_section',
		  'priority' => 3,
		  'setting'     => 'header_content_font_color',
		  'default' => '#000',
		  'transport'   => 'postMessage',
		  'output' => array(
				array(
						'element'  => '.header-content h1',
						'property' => 'color',
				),
				array(
						'element'  => '.header-content p',
						'property' => 'color',
				),
		  ),
		  'js_vars' => array(
				array(
						'element'  => '.header-content h1',
						'function' => 'css',
						'property' => 'color',
				),
				array(
						'element'  => '.header-content p',
						'function' => 'css',
						'property' => 'color',
				),
		  ),
		);
	/******Contact Section Background Controls**********/
		$fields[] = array(
			'type' => 'color',
		  'label' => __('Section Background Color', 'sao'),
		  'section' => 'contact_general_settings',
		  'priority' => 1,
		  'settings' => 'contact_section_bg_color',
		  'default' => '#FFF',
		  'transport' => 'auto',
		  'output' => array(
		    array(
		      'element' => '.contact-section',
		      'property' => 'background-color',
		    ),
		  ),
		  'js_vars' => array(
		    array(
		      'element' => '.contact-section',
		      'function' => 'css',
		      'property' => 'background-color',
		      'suffix'   => '!important',
		    ),
		  ),
		);
		//Overlay Color and opacity
		$fields[] = array(
			'type' => 'color',
		  'label' => __('Contact Overlay Color', 'sao'),
		  'section' => 'contact_general_settings',
		  'priority' => 1,
		  'settings' => 'contact_overlay_color',
		  'default' => 'rgba(0,0,0,0.82)',
		  'transport' => 'auto',
			'priority' => 9,
			'choices'     => array(
				'alpha' => true,
			),
		  'output' => array(
		    array(
		      'element' => '.contact-section',
		      'property' => 'background-color',
		    ),
		  ),
		  'js_vars' => array(
		    array(
		      'element' => '.contact-section',
		      'function' => 'css',
		      'property' => 'background-color',
		      'suffix'   => '!important',
		    ),
		  ),
			'required' => array(
		    array(
		    'setting'  => 'sao_contact_usebg',
		    'operator' => '==',
		    'value'    => true,
		  )
		  ),
		);

	/******Partners Section Background Controls**********/
		$fields[] = array(
			'type' => 'color',
		  'label' => __('Section Background Color', 'sao'),
		  'section' => 'partners_section',
		  'priority' => 1,
		  'settings' => 'partners_section_bg_color',
		  'default' => '#FFF',
		  'transport' => 'auto',
		  'output' => array(
		    array(
		      'element' => '.partners-section',
		      'property' => 'background-color',
		    ),
				array(
		      'element' => '.partners-section .bx-wrapper',
		      'property' => 'background-color',
		    ),
		  ),
		  'js_vars' => array(
		    array(
		      'element' => '.partners-section',
		      'function' => 'css',
		      'property' => 'background-color',
		      'suffix'   => ' !important',
		    ),
		  ),
		);
	/******Projects Section Background Controls**********/
		$fields[] = array(
			'type' => 'color',
		  'label' => __('Section Background Color', 'sao'),
		  'section' => 'projects_general_settings',
		  'priority' => 1,
		  'settings' => 'projects_section_bg_color',
		  'default' => '#FFF',
		  'transport' => 'auto',
		  'output' => array(
		    array(
		      'element' => '.projects-section',
		      'property' => 'background-color',
		    ),
		  ),
		  'js_vars' => array(
		    array(
		      'element' => '.projects-section',
		      'function' => 'css',
		      'property' => 'background-color',
		      'suffix'   => ' !important',
		    ),
		  ),
		);
		/******Projects Section Widget Color**********/
		$fields[] = array(
			'type' => 'color',
		  'label' => __('Widget Color', 'sao'),
		  'section' => 'projects_general_settings',
		  'priority' => 1,
		  'settings' => 'project_theme_color',
		  'default' => 'rgba(0, 0, 0, 0.45)',
		  'transport' => 'auto',
			'choices'     => array(
				'alpha' => true,
			),
			'output' => array(
				array(
					'element' => '.project-block .project-wrap .material-card h2',
					'property' => 'background',
				),
				array(
					'element' => '.project-block .project-wrap .material-card .mc-btn-action',
					'property' => 'background',
				),
				array(
					'element' => '.project-block .project-wrap .material-card .mc-footer',
					'property' => 'background',
				),
			),
		);
		/******Services Section Background Controls**********/
			$fields[] = array(
				'type' => 'color',
			  'label' => __('Section Background Color', 'sao'),
			  'section' => 'services_section',
			  'priority' => 1,
			  'settings' => 'services_background_color',
			  'default' => '#FFF',
			  'transport' => 'auto',
			  'output' => array(
					array(
						'element' => '#services',
						'property' => 'background-color',
					),
			  ),
			  'js_vars' => array(
			    array(
						'element' => '#services',
						'function' => 'css',
						'property' => 'background-color',
						'suffix'   => ' !important',
			    ),
			  ),
			);
	/******Blog Section Background Controls**********/
		$fields[] = array(
			'type' => 'color',
		  'label' => __('Section Background Color', 'sao'),
		  'section' => 'blog_settings',
		  'priority' => 1,
		  'settings' => 'blog_section_bg_color',
		  'default' => '#FFF',
		  'transport' => 'auto',
		  'output' => array(
		    array(
		      'element' => '.blog-section',
		      'property' => 'background-color',
		    ),
		  ),
		  'js_vars' => array(
		    array(
		      'element' => '.blog-section',
		      'function' => 'css',
		      'property' => 'background-color',
		      'suffix'   => ' !important',
		    ),
		  ),
		);
	/******Footer Social Menu Font Color**********/
		$fields[] = array(
			'type' => 'color',
		  'label' => __('Social Icons Color', 'sao'),
		  'section' => 'footer_general_settings',
		  'priority' => 7,
		  'settings' => 'footer_social_icons_color',
		  'default' => '#000',
		  'transport' => 'auto',
		  'output' => array(
		    array(
		      'element' => '.follow-col .nav-menu a',
		      'property' => 'color',
		    ),
		  ),
		  'js_vars' => array(
		    array(
		      'element' => '.follow-col .nav-menu a',
		      'function' => 'css',
		      'property' => 'color',
		      'suffix'   => ' !important',
		    ),
		  ),
		);
		//Footer Font Color
		$fields[] = array(
			'type' => 'color',
		  'label' => __('Footer Section Font Color', 'sao'),
		  'section' => 'footer_general_settings',
		  'priority' => 6,
		  'settings' => 'footer_font_color',
		  'default' => '',
		  'transport' => 'auto',
		  'output' => array(
		    array(
		      'element' => '.footer-container',
		      'property' => 'color',
		    ),
				array(
		      'element' => '.footer-copyright',
		      'property' => 'color',
		    ),
		  ),
		  'js_vars' => array(
		    array(
		      'element' => '.footer-container',
		      'function' => 'css',
		      'property' => 'color',
		      'suffix'   => ' !important',
		    ),
				array(
		      'element' => '.footer-copyright',
		      'function' => 'css',
		      'property' => 'color',
		      'suffix'   => ' !important',
		    ),
		  ),
		);
	/******Slider Overlay Controls**********/
		//Overlay Color
		$fields[] = array(
			'type' => 'color',
		  'label' => __('Slider Overlay Color', 'sao'),
		  'section' => 'slider_settings',
		  'priority' => 1,
		  'settings' => 'slider_overlay_color',
		  'default' => '#000',
		  'transport' => 'auto',
		  'output' => array(
		    array(
		      'element' => '.slider--el-bg .part::after',
		      'property' => 'background',
		    ),
		  ),
		  'js_vars' => array(
		    array(
		      'element' => '.slider--el-bg .part::after',
		      'function' => 'css',
		      'property' => 'background',
		      'suffix'   => ' !important',
		    ),
		  ),
		);
		//Overlay Opacity
		$fields[] = array(
			'type' => 'slider',
		  'label' => __('Slider Overlay Opacity', 'sao'),
		  'section' => 'slider_settings',
		  'priority' => 2,
		  'settings' => 'slider_overlay_opacity',
		  'default' => 0.4,
		  'transport' => 'auto',
			'choices' => array(
				'min' => '0',
				'max' => '1',
				'step' => '0.01',
			),
		  'output' => array(
		    array(
		      'element' => '.slider--el-bg .part::after',
		      'property' => 'opacity',
		    ),
		  ),
		  'js_vars' => array(
		    array(
		      'element' => '.slider--el-bg .part::after',
		      'function' => 'css',
		      'property' => 'opacity',
		      'suffix'   => ' !important',
		    ),
		  ),
		);

    return $fields;

}
add_filter( 'kirki/fields', 'sao_kirki_fields' );

add_action('customize_register', 'sao_add_sections');

//Adding Content Section Controls
function sao_add_content_controls($wp_customize){
//Slider Repeater
Kirki::add_section('slider_settings', array(
	'title' => __('Slider Settings', 'sao'),
	'priority' => 1,
	'panel' => 'slider_panel',
));

Kirki::add_field('sao', array(
	'type' => 'checkbox',
	'settings' => 'show_slider_button',
	'label' => __('Show Slider Button', 'sao'),
	'section' => 'slider_settings',
	'priority' => 2,
	'default' => true,
));

Kirki::add_field( 'sao', array(
	'type'        => 'repeater',
	'label'       => esc_attr__( 'Slider Control', 'sao' ),
	'section'     => 'slider_settings',
	'priority'    => 10,
	'transport'  => 'postMessage',
	'row_label' => array(
		'type'  => 'field',
		'value' => esc_attr__('Slide', 'sao' ),
		'field' => 'link_text',
	),
	'settings'    => 'slider-row-settings',
	'fields' => array(
		'slider_image' => array(
			'type'        => 'image',
			'label'       => esc_attr__( 'Slider Image', 'sao' ),
			'description' => esc_attr__( 'For best experience, we recommend that you use 1280px x 768px images', 'sao' ),
			'default'     => '',
		),
		'slider_header' => array(
			'type'        => 'text',
			'label'       => esc_attr__( 'Slider Header', 'sao' ),
			'description' => esc_attr__( 'This will be the header of the slider image', 'sao' ),
			'default'     => '',
		),
		'slider_text' => array(
			'type'        => 'textarea',
			'label'       => esc_attr__( 'Slider Text', 'sao' ),
			'description' => esc_attr__( 'This will be the description of the slider image', 'sao' ),
			'default'     => '',
		),
		'slider_button_text' => array(
			'type'        => 'text',
			'label'       => esc_attr__( 'Button Text', 'sao' ),
			'description' => esc_attr__( 'This will be text inside the button', 'sao' ),
			'default'     => '',
		),
		'button_url' => array(
			'type'        => 'text',
			'label'       => esc_attr__( 'Link URL', 'sao' ),
			'description' => esc_attr__( 'This will be the button link URL', 'sao' ),
			'default'     => '',
		),
	),
	'partial_refresh' => array(
				'slider-row-settings' => array(
					'selector' => ".slider--el-content-inner",
					'render_callback' => "sao_partial_render_callback",
				),
			),
) );
}
add_action('customize_register', 'sao_add_content_controls');

function sao_settings($wp_customize){
	Kirki::add_config( 'sao', array(
		'capability' => 'edit_theme_options',
		'option_type' => 'theme_mod',
	));

//General TYPOGRAPHY
Kirki::add_section('site_typography_section', array(
	'title' => __('Site Typography', 'sao'),
	'description' => __('Set typography settings for whole site', 'sao'),
	'panel' => 'general_settings',
	'priority' => 1,
	'capability' => 'edit_theme_options',
));

//Site Buttons Options


//Menu Color Setting
Kirki::add_field('sao', array(
  'type' => 'color',
  'label' => __('Active Section Font Color', 'sao'),
  'section' => 'menus_color_palette',
  'priority' => 1,
  'settings' => 'menu_current_section_color',
  'default' => '#000',
  'transport' => 'auto',
  'choices' => array(
    'alpha' => true,
  ),
  'output' => array(
    array(
      'element' => '.main-menu-container > ul > li > a.active:after',
      'property' => 'color',
    ),
  ),
  'js_vars' => array(
    array(
      'element' => '.main-menu-container > ul > li > a.active:after',
      'function' => 'css',
      'property' => 'color',
      'suffix'   => ' !important',
    ),
  ),
));
//Header Section
	Kirki::add_section('header_content_section', array(
		'title' => __('Header Content Options', 'sao'),
		'description' => __('Header Content Options', 'sao'),
		'panel' => 'header_panel',
		'priority' => 1,
		'capability' => 'edit_theme_options',
	));

	Kirki::add_field( 'sao', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'header_content_type',
	'label'       => __( 'Select Content Type For the Header', 'sao' ),
	'section'     => 'header_content_section',
	'default'     => 'text',
	'priority'    => 1,
	'choices'     => array(
		'text'   => esc_attr__( 'Text Only', 'sao' ),
		'image' => esc_attr__( 'Text And Image', 'sao' ),
	),
) );


	Kirki::add_field('sao', array(
        'type'     => 'radio-buttonset',
        'settings' => 'sao_header_content_layout',
        'label'    => esc_html__('Text Container Layouts', 'sao'),
        'section'  => 'header_content_section',
				'priority' => 1,
        'default'  => 'centered-content',
        'choices'  => array(
            'content-center' => __('Text container positioned in the middle', 'sao'),
            'content-left'  => __('Text container positioned on the left', 'sao'),
            'content-right'   => __('Text container positioned on the right', 'sao'),
        ),
				'active_callback' => array(
					array(
						'setting' => 'header_content_type',
						'operator' => '==',
						'value' => 'text',
					),
				),
    ));

		Kirki::add_field( 'sao', array(
		'type'        => 'radio-buttonset',
		'settings'    => 'header_content_image_layout',
		'label'       => esc_attr__( 'Select Layout for Image', 'sao' ),
		'section'     => 'header_content_section',
		'default'     => 'img-right',
		'priority'    => 1,
		'choices'     => array(
			'img-right'   => esc_attr__( 'Text Left, Image Right', 'sao' ),
			'img-left' => esc_attr__( 'Image Left, Text Right', 'sao' ),
		),
		'active_callback' => array(
			array(
				'setting' => 'header_content_type',
				'operator' => '==',
				'value' => 'image',
			),
		),
	) );
	Kirki::add_field( 'sao', array(
	'type'        => 'image',
	'settings'    => 'header_content_image',
	'label'       => esc_attr__( 'Set the image to be displayed beside Text in header', 'sao' ),
	'description' => esc_attr__( 'Content Image', 'sao' ),
	'section'     => 'header_content_section',
	'default'     => get_template_directory_uri().'/assets/images/webdesign.png',
	'priority'    => 2,
	'required' => array(
		array(
		'setting'  => 'header_content_type',
		'operator' => '==',
		'value'    => 'image',
	)
	),
	) );
	Kirki::add_field(
		'sao', array(
			'type' => 'text',
			'settings' => 'header_content_title',
			'label' => __('Header Main Text', 'sao'),
			'section' => 'header_content_section',
			'default' => "You can set this title from the customizer",
			'sanitize_callback' => 'sao_sanitize_text',
			'transport' => 'postMessage',
			'priority' => 3,
			'js_vars' => array(
				array(
				'element' => ".header-content h1",
				'function' => 'html',
				),
			),
			'partial_refresh' => array(
				'header_content_title' => array(
					'selector' => ".header-content h1",
					'render_callback' => "sao_partial_render_callback",
				),
			),
		)
	);
	Kirki::add_field('sao', array(
		'type' => 'checkbox',
		'settings' => 'animated_header_title',
		'label' => __('Use Animated Header', 'sao'),
		'section' => 'header_content_section',
		'priority' => 3,
		'default' => true,
	));

	$animations = 'bounce flash pulse rubberBand shake headShake swing tada wobble jello bounceIn bounceInDown bounceInLeft bounceInRight bounceInUp bounceOut bounceOutDown bounceOutLeft bounceOutRight bounceOutUp fadeIn fadeInDown fadeInDownBig fadeInLeft fadeInLeftBig fadeInRight fadeInRightBig fadeInUp fadeInUpBig fadeOut fadeOutDown fadeOutDownBig fadeOutLeft fadeOutLeftBig fadeOutRight fadeOutRightBig fadeOutUp fadeOutUpBig flipInX flipInY flipOutX flipOutY lightSpeedIn lightSpeedOut rotateIn rotateInDownLeft rotateInDownRight rotateInUpLeft rotateInUpRight rotateOut rotateOutDownLeft rotateOutDownRight rotateOutUpLeft rotateOutUpRight hinge rollIn rollOut zoomIn zoomInDown zoomInLeft zoomInRight zoomInUp zoomOut zoomOutDown zoomOutLeft zoomOutRight zoomOutUp slideInDown slideInLeft slideInRight slideInUp slideOutDown slideOutLeft slideOutRight slideOutUp';

	$animations = explode(' ', $animations);
	$animations_array = array();
	foreach($animations as $an){
			$an = trim($an);
			if($an){
        $animations_array[ $an ]= $an;
			}
	}

	Kirki::add_field( 'sao', array(
	'type'        => 'select',
	'settings'    => 'header_title_animation_type',
	'label'       => __( 'Select animation', 'sao' ),
	'section'     => 'header_content_section',
	'default'     => 'bounce',
	'priority'    => 3,
	'multiple'    => 1,
	'choices'     => $animations_array,
	'required' => array(
		array(
		'setting'  => 'animated_header_title',
		'operator' => '==',
		'value'    => true,
	)
	),
) );
	Kirki::add_field( 'sao', array(
		'type'        => 'number',
		'settings'    => 'header_title_animation speed',
		'label'       => esc_attr__( 'Set Animation Speed', 'sao' ),
		'description' => esc_attr__('in miliseconds', 'sao'),
		'section'     => 'header_content_section',
		'default'     => 2000,
		'priority' => 3,
		'choices'     => array(
			'min'  => 1000,
			'max'  => 10000,
			'step' => 1000,
		),
		'required' => array(
			array(
			'setting'  => 'animated_header_title',
			'operator' => '==',
			'value'    => true,
		)
		),
	) );
	Kirki::add_field(
		'sao', array(
			'type' => 'text',
			'settings' => 'header_content_subtitle',
			'label' => __('Subheader', 'sao'),
			'section' => 'header_content_section',
			'default' => "You can set this title from the customizer",
			'sanitize_callback' => 'sao_sanitize_text',
			'transport' => 'postMessage',
			'priority' => 3,
			'js_vars' => array(
				array(
				'element' => ".header-content p",
				'function' => 'html',
				),
			),
			'partial_refresh' => array(
				'selector' => ".header-content p",
				'render_callback' => "sao_partial_render_callback",
			),
		)
	);
	Kirki::add_field( 'sao', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'header_content_text_aligner',
	'label'       => __( 'Align Text', 'sao' ),
	'section'     => 'header_content_section',
	'default'     => 'center',
	'priority'    => 3,
	'choices'     => array(
		'left'   => esc_attr__( 'Left', 'sao' ),
		'center' => esc_attr__( 'Center', 'sao' ),
		'right' => esc_attr__( 'Right', 'sao' ),
	),
) );
Kirki::add_field('sao', array(
			'type'     => 'separatorsection',
			'label'    => __('Header Buttons Options', 'sao'),
			'section'  => 'header_content_section',
			'settings' => 'sao_header_buttons_sep',
			'priority'    => 4,
	));
	Kirki::add_field('sao', array(
		'type' => 'checkbox',
		'settings' => 'show_left_button',
		'label' => __('Show Left Button', 'sao'),
		'section' => 'header_content_section',
		'priority' => 4,
		'default' => true,
	));

	Kirki::add_field(
		'sao', array(
			'type' => 'text',
			'settings' => 'button_left_label',
			'label' => __('Left Button Label', 'sao'),
			'section' => 'header_content_section',
			'default' => "Button 1",
			'sanitize_callback' => 'sao_sanitize_text',
			'transport' => 'postMessage',
			'priority' => 4,
			'js_vars' => array(
				array(
				'element' => ".header-primary-button",
				'function' => 'html',
				),
			),
			'partial_refresh' => array(
				'selector' => ".header-primary-button",
				'render_callback' => "sao_partial_render_callback",
			),
		)
	);
	Kirki::add_field('sao', array(
		'type' => 'url',
		'settings' => 'button_left_url',
		'label' => __('Left Button URL', 'sao'),
		'section' => 'header_content_section',
		'default' => "#",
		'transport' => 'postMessage',
		'priority' => 4,
	));
	Kirki::add_field('sao', array(
		'type' => 'checkbox',
		'settings' => 'show_right_button',
		'label' => __('Show Right Button', 'sao'),
		'section' => 'header_content_section',
		'priority' => 4,
		'default' => true,
	));
	Kirki::add_field(
		'sao', array(
			'type' => 'text',
			'settings' => 'button_right_label',
			'label' => __('Right Button Label', 'sao'),
			'section' => 'header_content_section',
			'default' => "Button 2",
			'sanitize_callback' => 'sao_sanitize_text',
			'transport' => 'postMessage',
			'priority' => 4,
			'js_vars' => array(
				array(
				'element' => ".header-secondary-button",
				'function' => 'html',
				),
			),
			'partial_refresh' => array(
				'selector' => ".header-secondary-button",
				'render_callback' => "sao_partial_render_callback",
			),
		)
	);
	Kirki::add_field('sao', array(
		'type' => 'url',
		'settings' => 'button_right_url',
		'label' => __('Button Right URL', 'sao'),
		'section' => 'header_content_section',
		'default' => "#",
		'transport' => 'postMessage',
		'priority' => 4,
	));

	Kirki::add_field( 'sao', array(
		'type'        => 'number',
		'settings'    => 'sao_logo_height',
		'label'       => esc_attr__( 'Logo Max Height', 'sao' ),
		'section'     => 'title_tagline',
		'default'     => 80,
		'choices'     => array(
			'min'  => 60,
			'max'  => 140,
			'step' => 10,
		),
	) );



	Kirki::add_section('header_layouts', array(
		'title' => __('Menu and Logo Options', 'sao'),
		'panel'   => 'nav_menus',
		'priority' => 1,
		'capability' => 'edit_theme_options',
	));
	Kirki::add_section('header_options', array(
		'title' => __('Header Hero Options', 'sao'),
		'panel' => 'header_panel',
		'priority' => 2,
		'capability' => 'edit_theme_options',
	));
	Kirki::add_field('sao', array(
        'type'     => 'separatorsection',
        'label'    => __('Menu and Logo Layouts', 'sao'),
        'section'  => 'header_layouts',
        'settings' => 'sao_menu_layout_sep',
				'priority'    => 3,
    ));
	Kirki::add_field('layouts', array(
		'type' => 'radio-image',
		'settings' => 'header_layout_settings',
		'label' => __('Choose Header Layout', 'sao'),
		'section' => 'header_layouts',
		'priority' => 3,
		'default'     => 'top-menu',
		'choices' => array(
			'centered-menu'  =>  get_template_directory_uri() . '/assets/images/menu-logo-top.png',
			'top-menu'  =>  get_template_directory_uri() . '/assets/images/menu-soc.png',
			'top-menu-ns'  =>  get_template_directory_uri() . '/assets/images/menu-no-soc.png',
		)
	));
	Kirki::add_field('sao', array(
        'type'     => 'separatorsection',
        'label'    => __('Menu Options', 'sao'),
        'section'  => 'header_layouts',
        'settings' => 'sao_menu_options_sep',
				'priority'    => 1,
    ));

	Kirki::add_field('sao', array(
		'type' => 'checkbox',
		'settings' => 'sticky_header',
		'label' => __('Use sticky header', 'sao'),
		'section' => 'header_layouts',
		'priority' => 2,
		'default' => false,
	));

	//Overlay Control
	Kirki::add_field('sao', array(
	        'type'     => 'separatorsection',
	        'label'    => __('Header Overlay Options', 'sao'),
	        'section'  => 'header_options',
	        'settings' => 'sao_overlay_sep',
					'priority'    => 1,
	    ));
	Kirki::add_field('sao', array(
		'type' => 'checkbox',
		'settings' => 'header_show_overlay',
		'label' => __('Show Overlay', 'sao'),
		'section' => 'header_options',
		'priority' => 1,
		'default' => true,
	));
	Kirki::add_field('sao', array(
		'type' => 'color',
		'label' => __('Overlay Color', 'sao'),
		'section' => 'header_options',
		'priority' => 2,
		'settings' => 'header_overlay_color',
		'default' => '',
		'transport'  => 'postMessage',
		'choices' => array(
			'alpha' => true,
		),
		'output' => array(
			array(
				'element' => '.color-overlay:before',
				'property' => 'background-color',
			),
		),
		'js_vars' => array(
			array(
				'element' => '.color-overlay:before',
				'function' => 'css',
				'property' => 'background-color',
				'suffix'   => ' !important',
			),
		),
		'active_callback' => array(
			array(
				'setting' => 'header_show_overlay',
				'operator' => '==',
				'value' => true,
			),
		),
 	));

	Kirki::add_field('sao', array(
		'type' => 'slider',
		'label' => __('Overlay Opacity', 'sao'),
		'section' => 'header_options',
		'priority' => 3,
		'settings' => 'header_overlay_opacity',
		'default' => 0.4,
		'choices' => array(
			'min' => '0',
			'max' => '1',
			'step' => '0.01',
		),
		"output" => array(
			array(
				'element' => '.color-overlay:before',
				'property' => 'opacity',
				'transport' => 'postMessage',
			),
		),
		'js-vars' => array(
			array(
				'element' => '.color-overlay:before',
				'function' => 'css',
				'property' => 'opacity',
				'suffix' => ' !important'
			),
		),
		'active_callback' => array(
			array(
				'setting' => 'header_show_overlay',
				'operator' => '==',
				'value' => true,
			),
		),
	));

Kirki::add_field('sao', array(
        'type'     => 'separatorsection',
        'label'    => __('Header Separator Options', 'sao'),
        'section'  => 'header_options',
        'settings' => 'sao_show_separtor_sep',
				'priority'    => 4,
    ));

	Kirki::add_field('sao', array(
		'type'         => 'checkbox',
		'settings'     => 'header_show_separator',
		'label'        => __('Show header separator', 'sao'),
		'section'      => 'header_options',
		'priority'     => 5,
		'default'      => true,
	));

	Kirki::add_field('sao', array(
		'type'            => 'select',
		'settings'        => 'header_separator',
		'label'           => __('Type of separator', 'sao'),
		'section'         => 'header_options',
		'priority'        => 6,
		'default'         => 'triangle-asymmetrical-negative',
		'choices'         => sao_separators_list(),
		'active_callback' => array(
				array(
					'setting'  => 'header_show_separator',
					'operator' => '==',
					'value'    => true,
				),
		),
	));

	Kirki::add_field('sao', array(
		'type' => 'slider',
		'label'           => __('Separator Height', 'sao'),
    'section'         => 'header_options',
		'priority'        => 7,
		'settings'        => 'header_separator_height',
		'default'         => 90,
        'transport'       => 'postMessage',
        'choices'         => array(
            'min'  => '0',
            'max'  => '200',
            'step' => '1',
        ),
		"output"          => array(
	          array(
	              "element"  => ".header-separator svg",
	              'property' => 'height',
	              'suffix'   => '!important',
	              'units'    => 'px',
	          ),
	      ),
	      'js_vars'         => array(
	          array(
	              'element'  => ".header-separator svg",
	              'function' => 'css',
	              'property' => 'height',
	              'units'    => "px",
	              'suffix'   => '!important',
	          ),
	      ),
	      'active_callback' => array(
	          array(
	              'setting'  => 'header_show_separator',
	              'operator' => '==',
	              'value'    => true,
	          ),
	      ),
	));
	// SECTION TYPOGRAPHY
	Kirki::add_section('services_section', array(
		'title' => __('General Settings', 'sao'),
		'description' => __('Services General Section', 'sao'),
		'panel' => 'services_panel',
		'priority' => 1,
		'capability' => 'edit_theme_options',
	));
	Kirki::add_field(
		'sao', array(
			'type' => 'text',
			'settings' => 'sao_services_header',
			'label' => __('Services Section Header', 'sao'),
			'section' => 'services_section',
			'default' => "Services",
			'sanitize_callback' => 'wp_kses_post',
			'transport' => 'postMessage',
			'priority' => 3,
			'js_vars' => array(
				array(
				'element' => ".services-section .section-header",
				'function' => 'html',
				),
			),
			'partial_refresh' => array(
				'services_panel' => array(
					'selector' => ".services-section .section-header",
					'render_callback' => "sao_partial_render_callback",
				),
			),
		)
	);
	Kirki::add_field(
		'sao', array(
			'type' => 'text',
			'settings' => 'sao_services_subheader',
			'label' => __('Services Section Text', 'sao'),
			'section' => 'services_section',
			'default' => "Section Subtitle",
			'sanitize_callback' => 'sao_sanitize_text',
			'transport' => 'postMessage',
			'priority' => 3,
			'js_vars' => array(
				array(
				'element' => ".services-section .section-subheader",
				'function' => 'html',
				),
			),
			'partial_refresh' => array(
				'selector' => ".services-section .section-subheader",
				'render_callback' => "sao_partial_render_callback",
			),
		)
	);
	Kirki::add_field(
		'sao', array(
			'type' => 'textarea',
			'settings' => 'sao_services_desc',
			'label' => __('Services Section Text', 'sao'),
			'section' => 'services_section',
			'default' => "Donec at tristique leo. Pellentesque aliquet felis ut leo molestie,
			sit amet laoreet purus pellentesque. Ut id ex sodales, feugiat libero ac,
			consequat metus.",
			'sanitize_callback' => 'sao_sanitize_textarea',
			'transport' => 'postMessage',
			'priority' => 3,
			'js_vars' => array(
				array(
				'element' => ".services-section .section-desc",
				'function' => 'html',
				),
			),
			'partial_refresh' => array(
				'selector' => ".services-section .section-desc",
				'render_callback' => "sao_partial_render_callback",
			),
		)
	);

	//TEAM SECTION BG COLOR
	Kirki::add_section('team_settings', array(
		'title' => __('General Settings', 'sao'),
		'description' => __('Team Section General Settings', 'sao'),
		'panel' => 'team_panel',
		'priority' => 1,
		'capability' => 'edit_theme_options',
	));
	Kirki::add_field('sao', array(
		'type' => 'color',
		'settings' => 'team_theme_color',
		'label' => __('Widget Color', 'sao'),
		'section' => 'team_settings',
		'priority' => 1,
		'transport' => 'auto',
		'output' => array(
			array(
				'element' => '.team-wrap .material-card h2',
				'property' => 'background',
			),
			array(
				'element' => '.team-wrap .material-card .mc-btn-action',
				'property' => 'background',
			),
			array(
				'element' => '.team-wrap .material-card .mc-footer',
				'property' => 'background',
			),
		),
	));
	Kirki::add_field(
		'sao', array(
			'type' => 'text',
			'settings' => 'sao_team_header',
			'label' => __('Team Header', 'sao'),
			'section' => 'team_settings',
			'default' => "Team Section Header",
			'sanitize_callback' => 'wp_kses_post',
			'transport' => 'postMessage',
			'priority' => 2,
			'js_vars' => array(
				array(
				'element' => ".team-section .section-header",
				'function' => 'html',
				),
			),
			'partial_refresh' => array(
				'sao_team_header' => array(
					'selector' => ".team-section .section-header",
					'render_callback' => "sao_partial_render_callback",
				),
			),
		)
	);
	Kirki::add_field(
		'sao', array(
			'type' => 'text',
			'settings' => 'sao_team_subheader',
			'label' => __('Team SubHeader', 'sao'),
			'section' => 'team_settings',
			'default' => "Team Subheader",
			'sanitize_callback' => 'wp_kses_post',
			'transport' => 'postMessage',
			'priority' => 2,
			'js_vars' => array(
				array(
				'element' => ".team-section .section-subheader",
				'function' => 'html',
				),
			),
			'partial_refresh' => array(
				'selector' => ".team-section .section-subheader",
				'render_callback' => "sao_partial_render_callback",
			),
		)
	);
	Kirki::add_field(
		'sao', array(
			'type' => 'textarea',
			'settings' => 'sao_team_desc',
			'label' => __('Team Section Description', 'sao'),
			'section' => 'team_settings',
			'default' => "Donec at tristique leo. Pellentesque aliquet felis ut leo molestie,
			sit amet laoreet purus pellentesque. Ut id ex sodales, feugiat libero ac,
			consequat metus.",
			'sanitize_callback' => 'sao_sanitize_textarea',
			'transport' => 'postMessage',
			'priority' => 2,
			'js_vars' => array(
				array(
				'element' => ".team-section .section-desc",
				'function' => 'html',
				),
			),
			'partial_refresh' => array(
				'selector' => ".team-section .section-desc",
				'render_callback' => "sao_partial_render_callback",
			),
		)
	);

	/*
	* Testimonials
	* Section
	* Customizer
	*/
	Kirki::add_section('testimonial_settings', array(
	'title' => __('General Settings', 'sao'),
	'description' => __('Testimonials Section', 'sao'),
	'panel' => 'testimonial_panel',
	'priority' => 1,
	'capability' => 'edit_theme_options',
	));
  Kirki::add_field( 'sao', array(
	'type'        => 'checkbox',
	'settings'    => 'sao_bg_image_control',
	'label'       => esc_attr__( 'BG Image Control', 'sao' ),
	'description' => esc_attr__( 'Check if you want image set as background for this section', 'sao' ),
	'section'     => 'testimonial_settings',
	'priority' => 5,
	'default'     => false,
) );
  Kirki::add_field( 'sao', array(
	'type'        => 'image',
	'settings'    => 'sao_testimonials_bg_img',
	'label'       => esc_attr__( 'Set the image to be displayed as section background', 'sao' ),
	'description' => esc_attr__( 'Image to be displayed as section background', 'sao' ),
	'section'     => 'testimonial_settings',
	'default'     => '',
	'priority' => 6,
  'required' => array(
    array(
    'setting'  => 'sao_bg_image_control',
    'operator' => '==',
    'value'    => 1,
  )
  ),
) );
	Kirki::add_field(
		'sao', array(
			'type' => 'text',
			'settings' => 'sao_testimonial_header',
			'label' => __('Testimonials Header', 'sao'),
			'section' => 'testimonial_settings',
			'default' => "Default Text",
			'sanitize_callback' => 'wp_kses_post',
			'transport' => 'postMessage',
			'priority' => 2,
			'js_vars' => array(
				array(
				'element' => ".testimonials .section-header",
				'function' => 'html',
				),
			),
			'partial_refresh' => array(
				'sao_testimonial_header' => array(
					'selector' => ".testimonials .section-header",
					'render_callback' => "sao_partial_render_callback",
				),
			),
		)
	);
	Kirki::add_field(
		'sao', array(
			'type' => 'text',
			'settings' => 'sao_testimonial_subheader',
			'label' => __('Testimonials SubHeader', 'sao'),
			'section' => 'testimonial_settings',
			'default' => "Default Text",
			'sanitize_callback' => 'wp_kses_post',
			'transport' => 'postMessage',
			'priority' => 2,
			'js_vars' => array(
				array(
				'element' => ".testimonials .section-subheader",
				'function' => 'html',
				),
			),
			'partial_refresh' => array(
				'selector' => ".testimonials .section-subheader",
				'render_callback' => "sao_partial_render_callback",
			),
		)
	);
	Kirki::add_field(
		'sao', array(
			'type' => 'textarea',
			'settings' => 'sao_testimonials_desc',
			'label' => __('Testimonials Section Description', 'sao'),
			'section' => 'testimonial_settings',
			'default' => "Donec at tristique leo. Pellentesque aliquet felis ut leo molestie,
			sit amet laoreet purus pellentesque. Ut id ex sodales, feugiat libero ac,
			consequat metus.",
			'sanitize_callback' => 'sao_sanitize_textarea',
			'transport' => 'postMessage',
			'priority' => 4,
			'js_vars' => array(
				array(
				'element' => ".testimonials .section-desc",
				'function' => 'html',
				),
			),
			'partial_refresh' => array(
				'selector' => ".testimonials .section-desc",
				'render_callback' => "sao_partial_render_callback",
			),
		)
	);
	Kirki::add_field('sao', array(
	  'type' => 'color',
	  'label' => __('Testimonials Section Font Color', 'sao'),
	  'section' => 'testimonial_settings',
	  'priority' => 1,
	  'settings' => 'testimonials_section_font_color',
		'default' => '#000',
	  'transport' => 'auto',
	  'choices' => array(
	    'alpha' => true,
	  ),
	  'output' => array(
	    array(
	      'element' => '.testimonials-section .section-top, .testimonials-section .section-header , .testimonials-section .section-subheader',
	      'property' => 'color',
	    ),
	  ),
	  'js_vars' => array(
	    array(
	      'element' => '.testimonials-section .section-top, .testimonials-section .section-header , .testimonials-section .section-subheader',
	      'function' => 'color',
	      'suffix'   => ' !important',
	    ),
	  ),
	));
	Kirki::add_field('sao', array(
		'type'        => 'slider',
	'settings'    => 'testimonial_slider_speed',
	'label'       => esc_attr__( 'Set Slider speed', 'sao' ),
	'section'     => 'testimonial_settings',
	'default'     => 3000,
	'choices'     => array(
		'min'  => '0',
		'max'  => '10000',
		'step' => '500',
	),
	));
	/*
	* Clients
	* Section
	* Customizer
	*/
	Kirki::add_section('partners_section', array(
	'title' => __('Partners Section', 'sao'),
	'description' => __('Partners Section', 'sao'),
	'panel' => 'clients_panel',
	'priority' => 1,
	'capability' => 'edit_theme_options',
	));
	//Header and Text Settings
	Kirki::add_field(
		'sao', array(
			'type' => 'text',
			'settings' => 'sao_partners_header',
			'label' => __('Partners Header', 'sao'),
			'section' => 'partners_section',
			'default' => "Our Partners",
			'sanitize_callback' => 'wp_kses_post',
			'transport' => 'postMessage',
			'priority' => 2,
			'js_vars' => array(
				array(
				'element' => ".partners .section-header",
				'function' => 'html',
				),
			),
			'partial_refresh' => array(
				'sao_clients_header' => array(
					'selector' => ".partners-section .section-header",
					'render_callback' => "sao_partial_render_callback",
				),
			),
		)
	);
	Kirki::add_field(
		'sao', array(
			'type' => 'text',
			'settings' => 'sao_partners_subheader',
			'label' => __('Partners SubHeader', 'sao'),
			'section' => 'partners_section',
			'default' => "Meet our partners",
			'sanitize_callback' => 'wp_kses_post',
			'transport' => 'postMessage',
			'priority' => 2,
			'js_vars' => array(
				array(
				'element' => ".partners .section-subheader",
				'function' => 'html',
				),
			),
			'partial_refresh' => array(
				'selector' => ".partners .section-subheader",
				'render_callback' => "sao_partial_render_callback",
			),
		)
	);
	Kirki::add_field(
		'sao', array(
			'type' => 'textarea',
			'settings' => 'sao_partners_desc',
			'label' => __('Partners Section Description', 'sao'),
			'section' => 'partners_section',
			'default' => "Donec at tristique leo. Pellentesque aliquet felis ut leo molestie,
			sit amet laoreet purus pellentesque. Ut id ex sodales, feugiat libero ac,
			consequat metus.",
			'sanitize_callback' => 'sao_sanitize_textarea',
			'transport' => 'postMessage',
			'priority' => 2,
			'js_vars' => array(
				array(
				'element' => ".partners .section-desc",
				'function' => 'html',
				),
			),
			'partial_refresh' => array(
				'selector' => ".partners .section-desc",
				'render_callback' => "sao_partial_render_callback",
			),
		)
	);
	/*
	* Gallery
	* Section
	* Customizer
	*/
	Kirki::add_section('gallery_general_settings', array(
	'title' => __('General Settings', 'sao'),
	'description' => __('General Gallery Settings', 'sao'),
	'panel' => 'gallery_panel',
	'priority' => 1,
	'capability' => 'edit_theme_options',
	));
	Kirki::add_section('gallery_content_section', array(
	'title' => __('Gallery Content Settings', 'sao'),
	'description' => __('Gallery Content Settings', 'sao'),
	'panel' => 'gallery_panel',
	'priority' => 1,
	'capability' => 'edit_theme_options',
	));
	Kirki::add_field(
		'sao', array(
			'type' => 'text',
			'settings' => 'sao_gallery_header',
			'label' => __('Gallery Header', 'sao'),
			'section' => 'gallery_general_settings',
			'default' => "Gallery header",
			'sanitize_callback' => 'wp_kses_post',
			'transport' => 'postMessage',
			'priority' => 2,
			'js_vars' => array(
				array(
				'element' => ".gallery .section-header",
				'function' => 'html',
				),
			),
			'partial_refresh' => array(
				'sao_gallery_header' => array(
					'selector' => ".gallery .section-header",
					'render_callback' => "sao_partial_render_callback",
				),
			),
		)
	);
	Kirki::add_field(
		'sao', array(
			'type' => 'text',
			'settings' => 'sao_gallery_subheader',
			'label' => __('Gallery subheader', 'sao'),
			'section' => 'gallery_general_settings',
			'default' => "Gallery subheader",
			'sanitize_callback' => 'wp_kses_post',
			'transport' => 'postMessage',
			'priority' => 2,
			'js_vars' => array(
				array(
				'element' => ".gallery .section-subheader",
				'function' => 'html',
				),
			),
		)
	);
	Kirki::add_field(
		'sao', array(
			'type' => 'textarea',
			'settings' => 'sao_gallery_desc',
			'label' => __('Gallery Section Description', 'sao'),
			'section' => 'gallery_general_settings',
			'default' => "Donec at tristique leo. Pellentesque aliquet felis ut leo molestie,
			sit amet laoreet purus pellentesque. Ut id ex sodales, feugiat libero ac,
			consequat metus.",
			'sanitize_callback' => 'sao_sanitize_textarea',
			'transport' => 'postMessage',
			'priority' => 4,
			'js_vars' => array(
				array(
				'element' => ".gallery .section-desc",
				'function' => 'html',
				),
			),
			'partial_refresh' => array(
				'selector' => ".gallery .section-desc",
				'render_callback' => "sao_partial_render_callback",
			),
		)
	);
/***********Testing repater within repeater***************/
Kirki::add_field( 'sao', array(
	'type'        => 'repeater',
	'label'       => esc_attr__( 'Gallery Images Control', 'sao' ),
	'section'     => 'gallery_content_section',
	'priority'    => 10,
	'transport' => 'postMessage',
	'row_label' => array(
		'type'  => 'field',
		'value' => esc_attr__('Image', 'sao' ),
		'field' => 'link_text',
	),
	'settings'    => 'gallery_repeater',
	'fields' => array(
		'gallery_image' => array(
			'type'        => 'image',
			'label'       => esc_attr__( 'Gallery Image', 'sao' ),
			'description' => esc_attr__( 'Here you can upload the image that is going to be displayed in gallery section', 'sao' ),
			'default'     => '',
			'transport' => 'postMessage',
		),
	)
) );


	//SLIDER SETTTINGS
	//slider panel
	$wp_customize->add_panel('slider_panel', array(
		'priority'   => 2,
		'title'      => __('Slider Section', 'sao'),
	));

    /*
    * Content
    * Section
    * Customizer
    */
    Kirki::add_section('features_section_settings', array(
      'title' => __('General Settings', 'sao'),
      'priority' => 1,
      'panel' => 'features_panel',
    ));
		Kirki::add_section('content_row_settings', array(
      'title' => __('Content Settings', 'sao'),
      'priority' => 2,
      'panel' => 'features_panel',
    ));
		Kirki::add_field(
			'sao', array(
				'type' => 'text',
				'settings' => 'sao_features_header',
				'label' => __('Features Section Header', 'sao'),
				'section' => 'features_section_settings',
				'default' => "Missions",
				'sanitize_callback' => 'wp_kses_post',
				'transport' => 'postMessage',
				'priority' => 2,
				'js_vars' => array(
					array(
					'element' => ".features-section .section-header",
					'function' => 'html',
					),
				),
				'partial_refresh' => array(
				'features_panel' => array(
					'selector' => ".features-section .section-header",
					'render_callback' => "sao_partial_render_callback",
				),
			),
			)
		);
		Kirki::add_field(
			'sao', array(
				'type' => 'text',
				'settings' => 'sao_features_subheader',
				'label' => __('Features Section Subheader', 'sao'),
				'section' => 'features_section_settings',
				'default' => "Content Section Subtitle",
				'sanitize_callback' => 'sao_sanitize_text',
				'transport' => 'postMessage',
				'priority' => 2,
				'js_vars' => array(
					array(
					'element' => ".features-section .section-subheader",
					'function' => 'html',
					),
				),
				'partial_refresh' => array(
					'selector' => ".features-section .section-subheader",
					'render_callback' => "sao_partial_render_callback",
				),
			)
		);
		Kirki::add_field(
			'sao', array(
				'type' => 'textarea',
				'settings' => 'sao_features_desc',
				'label' => __('Features Section Description', 'sao'),
				'section' => 'features_section_settings',
				'default' => "Donec at tristique leo. Pellentesque aliquet felis ut leo molestie,
				sit amet laoreet purus pellentesque. Ut id ex sodales, feugiat libero ac,
				consequat metus.",
				'sanitize_callback' => 'sao_sanitize_textarea',
				'transport' => 'postMessage',
				'priority' => 2,
				'js_vars' => array(
					array(
					'element' => ".features-section .section-desc",
					'function' => 'html',
					),
				),
				'partial_refresh' => array(
					'selector' => ".features-section .section-desc",
					'render_callback' => "sao_partial_render_callback",
				),
			)
		);
		Kirki::add_field( 'sao', array(
			'type'        => 'repeater',
			'label'       => esc_attr__( 'Features Rows Control', 'sao' ),
			'section'     => 'features_section_settings',
			'priority'    => 10,
			'row_label' => array(
				'type'  => 'field',
				'value' => esc_attr__('Row', 'sao' ),
				'field' => 'link_text',
			),
			'settings'    => 'features_row_settings',
			'fields' => array(
				'row_image' => array(
					'type'        => 'image',
					'label'       => esc_attr__( 'Row Image', 'sao' ),
					'description' => esc_attr__( 'Row Image', 'sao' ),
					'default'     => '',
				),
				'row_header' => array(
					'type'        => 'text',
					'label'       => esc_attr__( 'Row Header', 'sao' ),
					'description' => esc_attr__( 'This will be the header of the section', 'sao' ),
					'default'     => '',
				),
				'row_text' => array(
					'type'        => 'textarea',
					'label'       => esc_attr__( 'Row Text', 'sao' ),
					'description' => esc_attr__( 'This will be the description of the section', 'sao' ),
					'default'     => '',
				),
				'row_color' => array(
					'type'        => 'color',
					'label'       => esc_attr__( 'Row Text', 'sao' ),
					'description' => esc_attr__( 'This will be the background color of the section', 'sao' ),
					'default'     => '#FFFFFF',
					'transport'   => 'auto',
					'output' =>
					array(
						'element' => '.content-section1',
						'property' => 'background-color',
					),
				),
			)
		) );
    /*
  	* Contact Us
  	* Section
  	* Customizer
  	*/
    Kirki::add_section('contact_us_settings', array(
      'title' => __('Contact Form Settings', 'sao'),
      'priority' => 2,
      'panel' => 'contact_panel',
    ));
		Kirki::add_section('contact_general_settings', array(
      'title' => __('General Settings', 'sao'),
      'priority' => 1,
      'panel' => 'contact_panel',
    ));
		//Contact BG Image from template with form
		Kirki::add_field( 'sao', array(
			'type'        => 'checkbox',
			'settings'    => 'sao_contact_usebg',
			'label'       => esc_attr__( 'Use image as background for section', 'sao' ),
			'description' => esc_attr__( 'Check this field if you want to use an image as a background for Contact Section', 'sao' ),
			'section'     => 'contact_general_settings',
			'priority' => 7,
			'default'     => false,
 ) );
		Kirki::add_field( 'sao', array(
		'type'        => 'image',
		'settings'    => 'contact_us_background_image',
		'label'       => esc_attr__( 'Set the image to be displayed as section background', 'sao' ),
		'description' => esc_attr__( 'Image to be displayed as section background', 'sao' ),
		'section'     => 'contact_general_settings',
		'default'     => '',
		'priority' => 8,
		'required' => array(
	    array(
	    'setting'  => 'sao_contact_usebg',
	    'operator' => '==',
	    'value'    => true,
	  )
	  ),
	) );
	Kirki::add_field('sao', array(
		'type' => 'text',
		'settings' => 'sao_contact_header',
		'label' => __('Contact Section Header', 'sao'),
		'section' => 'contact_general_settings',
		'default' => "Section Header",
		'sanitize_callback' => 'wp_kses_post',
		'transport' => 'auto',
		'priority' => 2,
		'js_vars' => array(
			array(
			'element' => ".contact-section .section-header",
			'function' => 'html',
			),
		),
		'partial_refresh' => array(
			'contact_panel' => array(
			'selector' => ".contact-section .section-header",
			'render_callback' => "sao_partial_render_callback",
			),
		),
	));
	Kirki::add_field('sao', array(
		'type' => 'text',
		'settings' => 'sao_contact_subheader',
		'label' => __('Contact Section Subheader', 'sao'),
		'section' => 'contact_general_settings',
		'default' => "Section Subheader",
		'sanitize_callback' => 'wp_kses_post',
		'transport' => 'auto',
		'priority' => 3,
		'js_vars' => array(
			array(
			'element' => ".contact-section .section-subheader",
			'function' => 'html',
			),
		),
		'partial_refresh' => array(
			'contact_us_address' => array(
			'selector' => ".contact-section .section-subheader",
			'render_callback' => "sao_partial_render_callback",
			),
		),
	));
	Kirki::add_field(
		'sao', array(
			'type' => 'textarea',
			'settings' => 'sao_contact_desc',
			'label' => __('Contact Section Description', 'sao'),
			'section' => 'contact_general_settings',
			'default' => "Donec at tristique leo. Pellentesque aliquet felis ut leo molestie,
			sit amet laoreet purus pellentesque. Ut id ex sodales, feugiat libero ac,
			consequat metus.",
			'sanitize_callback' => 'wp_kses_post',
			'transport' => 'postMessage',
			'priority' => 4,
			'js_vars' => array(
				array(
				'element' => ".contact-section .section-desc",
				'function' => 'html',
				),
			),
			'partial_refresh' => array(
				'selector' => ".contact-section .section-desc",
				'render_callback' => "sao_partial_render_callback",
			),
		)
	);
	Kirki::add_field('sao', array(
	  'type' => 'color',
	  'label' => __('Contact Form Font Color', 'sao'),
	  'section' => 'contact_general_settings',
	  'priority' => 1,
	  'settings' => 'contact_section_font_color',
	  'transport' => 'auto',
		'default' => '#000',
	  'choices' => array(
	    'alpha' => true,
	  ),
	  'output' => array(
	    array(
	      'element' => '.contact .section-top, .contact .section-header , .contact .section-subheader, .wpcf7 label',
        'property' => 'color',
	    ),
	  ),
	  'js_vars' => array(
	    array(
	      'element' => '.contact .section-top, .contact .section-header , .contact .section-subheader',
	      'function' => 'color',
	      'suffix'   => ' !important',
	    ),
	  ),
	));
	Kirki::add_field('sao', array(
		'type' => 'text',
		'settings' => 'contact_form_shortcode',
		'label' => __('Contact Form Shortcode', 'sao'),
		'section' => 'contact_us_settings',
		'default' => "",
		'sanitize_callback' => 'wp_kses_post',
		'transport' => 'auto',
		'priority' => 1,
	));
		//Settings for map contact template
		Kirki::add_section('map_general_settings', array(
      'title' => __('General Settings', 'sao'),
      'priority' => 1,
      'panel' => 'map_panel',
    ));
		Kirki::add_section('google_map_settings', array(
      'title' => __('Google Map Settings', 'sao'),
      'priority' => 1,
      'panel' => 'map_panel',
    ));
		Kirki::add_field('sao', array(
			'type' => 'text',
			'settings' => 'sao_map_header',
			'label' => __('Map Section Header', 'sao'),
			'section' => 'map_general_settings',
			'default' => "Section Header",
			'sanitize_callback' => 'wp_kses_post',
			'transport' => 'auto',
			'priority' => 2,
			'js_vars' => array(
				array(
				'element' => ".map-section  .section-header",
				'function' => 'html',
				),
			),
			'partial_refresh' => array(
				'contact_us_address' => array(
				'selector' => ".map-section  .section-header",
				'render_callback' => "sao_partial_render_callback",
				),
			),
		));
		Kirki::add_field('sao', array(
			'type' => 'text',
			'settings' => 'sao_map_subheader',
			'label' => __('Map Section Subheader', 'sao'),
			'section' => 'map_general_settings',
			'default' => "Section Subheader",
			'sanitize_callback' => 'wp_kses_post',
			'transport' => 'auto',
			'priority' => 3,
			'js_vars' => array(
				array(
				'element' => ".map-section .section-subheader",
				'function' => 'html',
				),
			),
			'partial_refresh' => array(
				'contact_us_address' => array(
				'selector' => ".map-section  .section-subheader",
				'render_callback' => "sao_partial_render_callback",
				),
			),
		));
		Kirki::add_field(
			'sao', array(
				'type' => 'textarea',
				'settings' => 'sao_map_desc',
				'label' => __('Map Section Description', 'sao'),
				'section' => 'map_general_settings',
				'default' => "Donec at tristique leo. Pellentesque aliquet felis ut leo molestie,
				sit amet laoreet purus pellentesque. Ut id ex sodales, feugiat libero ac,
				consequat metus.",
				'sanitize_callback' => 'sao_sanitize_textarea',
				'transport' => 'postMessage',
				'priority' => 4,
				'js_vars' => array(
					array(
					'element' => ".map-section  .section-desc",
					'function' => 'html',
					),
				),
				'partial_refresh' => array(
					'selector' => ".map-section  .section-desc",
					'render_callback' => "sao_partial_render_callback",
				),
			)
		);
		Kirki::add_field('sao', array(
			'type' => 'text',
			'settings' => 'sao_map_api_key',
			'label' => __('Google Map Api Key', 'sao'),
			'description' => __('Paste your API key here in order to see a map in the Contact Section', 'sao'),
			'section' => 'google_map_settings',
			'default' => "",
			'sanitize_callback' => 'wp_kses_post',
			'transport' => 'auto',
			'priority' => 4,
		));
    Kirki::add_field( 'sao', array(
    	'type'        => 'text',
    	'settings'    => 'latitude',
    	'label'       => esc_attr__( 'Latitude', 'sao' ),
    	'section'     => 'google_map_settings',
    	'default'     => '120.3333',
    ) );
		Kirki::add_field( 'sao', array(
			'type'        => 'text',
			'settings'    => 'longitude',
			'label'       => esc_attr__( 'Longitude', 'sao' ),
			'section'     => 'google_map_settings',
			'default'     => '40.123',
		) );
		Kirki::add_field( 'sao', array(
			'type'        => 'repeater',
			'label'       => esc_attr__( 'Contact Us Items Control', 'sao' ),
			'section'     => 'google_map_settings',
			'priority'    => 10,
			'row_label' => array(
				'type'  => 'field',
				'value' => esc_attr__('Item', 'sao' ),
				'field' => 'link_text',
			),
			'settings'    => 'contactus-item-settings',
			'fields' => array(
				'icon' => array(
					'type'        => 'text',
					'label'       => esc_attr__( 'Item Icon Image', 'sao' ),
					'description' => esc_attr__( 'Just paste font-awesome icon code', 'sao' ),
					'default'     => 'fas fa-location-arrow',
				),
				'description' => array(
					'type'        => 'text',
					'label'       => esc_attr__( 'Item description', 'sao' ),
					'description' => esc_attr__( 'This will be the value of item ex. phone bumber or email address', 'sao' ),
					'default'     => '',
				),
			),
		) );
		/*****************************************/
		/******Projects Section Settings**********/
		/****************************************/
		Kirki::add_section('projects_general_settings', array(
			'title' => __('General Settings', 'sao'),
			'description' => __('Projects General Section', 'sao'),
			'panel' => 'projects_panel',
			'priority' => 1,
			'capability' => 'edit_theme_options',
		));
		Kirki::add_field(
			'sao', array(
				'type' => 'text',
				'settings' => 'sao_projects_header',
				'label' => __('Projects Section Header', 'sao'),
				'section' => 'projects_general_settings',
				'default' => 'Projects',
				'sanitize_callback' => 'sao_sanitize_text',
				'transport' => 'auto',
				'priority' => 1,
				'js_vars' => array(
					array(
					'element' => ".projects-section .section-header",
					'function' => 'html',
					),
				),
				'partial_refresh' => array(
					'projects_panel' => array(
						'selector' => ".projects-section .section-header",
						'render_callback' => "sao_partial_render_callback",
					),
				),
			)
		);
		Kirki::add_field(
			'sao', array(
				'type' => 'text',
				'settings' => 'sao_projects_subheader',
				'label' => __('Projects Section Subheader', 'sao'),
				'section' => 'projects_general_settings',
				'default' => 'Projects Section Subtitle',
				'sanitize_callback' => 'sao_sanitize_text',
				'transport' => 'postMessage',
				'priority' => 2,
				'js_vars' => array(
					array(
					'element' => ".projects-section .section-subheader",
					'function' => 'html',
					),
				),
				'partial_refresh' => array(
					'selector' => ".projects-section .section-subheader",
					'render_callback' => "sao_partial_render_callback",
				),
			)
		);
		Kirki::add_field(
			'sao', array(
				'type' => 'textarea',
				'settings' => 'sao_projects_desc',
				'label' => __('Projects Section Description', 'sao'),
				'section' => 'projects_general_settings',
				'default' => 'Donec at tristique leo. Pellentesque aliquet felis ut leo molestie,
				sit amet laoreet purus pellentesque. Ut id ex sodales, feugiat libero ac,
				consequat metus.',
				'sanitize_callback' => 'sao_sanitize_textarea',
				'transport' => 'postMessage',
				'priority' => 2,
				'js_vars' => array(
					array(
					'element' => ".projects-section .section-desc",
					'function' => 'html',
					),
				),
				'partial_refresh' => array(
					'selector' => ".projects-section .section-desc",
					'render_callback' => "sao_partial_render_callback",
				),
			)
		);
		Kirki::add_field(
			'sao', array(
				'type' => 'text',
				'settings' => 'sao_projects_button_text',
				'label' => __('Projects Button Text', 'sao'),
				'section' => 'projects_general_settings',
				'default' => 'Read more',
				'sanitize_callback' => 'sao_sanitize_text',
				'transport' => 'auto',
				'priority' => 3,
				'js_vars' => array(
					array(
					'element' => ".project-btn",
					'function' => 'html',
					),
				),
				'partial_refresh' => array(
					'projects_general_settings' => array(
						'selector' => ".project-btn",
						'render_callback' => "sao_partial_render_callback",
					),
				),
			)
		);
		Kirki::add_field( 'sao', array(
		'type'        => 'number',
		'settings'    => 'num_of_projects_shown',
		'label'       => esc_attr__( 'Number of projects to show in the projects section on the front page', 'sao' ),
		'section'     => 'projects_general_settings',
		'default'     => 4,
		'choices'     => array(
		'min'  => 1,
		'max'  => wp_count_posts('project')->publish,
		'step' => 1,
	),
		'sanitize_callback' => 'sao_sanitize_int',
	) );

		/*******************************************************************/
		/****************** Blog Section Settings ****************/
		/*****************************************************************/

		Kirki::add_field(
			'sao', array(
				'type' => 'text',
				'settings' => 'sao_blog_header',
				'label' => __('Blog Section Header', 'sao'),
				'section' => 'blog_settings',
				'default' => "Latest News",
				'sanitize_callback' => 'wp_kses_post',
				'transport' => 'postMessage',
				'priority' => 2,
				'js_vars' => array(
					array(
					'element' => ".blog-section .section-header",
					'function' => 'html',
					),
				),
				'partial_refresh' => array(
					'sao_blog_header' => array(
						'selector' => ".blog-section .section-header",
						'render_callback' => "sao_partial_render_callback",
					),
				),
			)
		);
		Kirki::add_field(
			'sao', array(
				'type' => 'text',
				'settings' => 'sao_blog_subheader',
				'label' => __('Blog Section Subheader', 'sao'),
				'section' => 'blog_settings',
				'default' => "Blog Section Subtitle",
				'sanitize_callback' => 'sao_sanitize_text',
				'transport' => 'postMessage',
				'priority' => 2,
				'js_vars' => array(
					array(
					'element' => ".blog-section .section-subheader",
					'function' => 'html',
					),
				),
				'partial_refresh' => array(
					'selector' => ".blog-section .section-subheader",
					'render_callback' => "sao_partial_render_callback",
				),
			)
		);
		Kirki::add_field(
			'sao', array(
				'type' => 'textarea',
				'settings' => 'sao_blog_desc',
				'label' => __('Blog Section Description', 'sao'),
				'section' => 'blog_settings',
				'default' => "Donec at tristique leo. Pellentesque aliquet felis ut leo molestie,
				sit amet laoreet purus pellentesque. Ut id ex sodales, feugiat libero ac,
				consequat metus.",
				'sanitize_callback' => 'sao_sanitize_textarea',
				'transport' => 'postMessage',
				'priority' => 2,
				'js_vars' => array(
					array(
					'element' => ".blog-section .section-desc",
					'function' => 'html',
					),
				),
				'partial_refresh' => array(
					'selector' => ".blog-section .section-desc",
					'render_callback' => "sao_partial_render_callback",
				),
			)
		);
		//Num of posts to be shonw on front page
		Kirki::add_field( 'sao', array(
		'type'        => 'number',
		'settings'    => 'blog_num_of_posts_shown',
		'label'       => esc_attr__( 'Number of posts to show in the blog section on the front page', 'sao' ),
		'section'     => 'blog_settings',
		'default'     => 3,
		'choices'     => array(
		'min'  => 1,
		'max'  => wp_count_posts()->publish,
		'step' => 1,
	),
		'sanitize_callback' => 'sao_sanitize_int',
	) );
		//Blog Btn Text
		Kirki::add_field(
			'sao', array(
				'type' => 'text',
				'settings' => 'sao_blog_btn_text',
				'label' => __('Blog Button Text', 'sao'),
				'section' => 'blog_settings',
				'default' => "See All Posts",
				'sanitize_callback' => 'wp_kses_post',
				'transport' => 'postMessage',
				'priority' => 3,
				'js_vars' => array(
					array(
					'element' => ".blog-btn",
					'function' => 'html',
					),
				),
				'partial_refresh' => array(
					'selector' => ".blog-btn",
					'render_callback' => "sao_partial_render_callback",
				),
			)
		);

		/*******************************/
   /******Footer Settings**********/
  /*******************************/
	//About column section
	Kirki::add_section('footer_general_settings', array(
		'title' => __('Footer General Settings', 'sao'),
		'description' => __('General Settings for Site Footer', 'sao'),
		'panel' => 'footer_settings',
		'priority' => 1,
		'capability' => 'edit_theme_options',
	));
	Kirki::add_field('sao', array(
        'type'     => 'select',
        'settings' => 'sao_footer_template',
        'label'    => esc_html__('Footer Layout', 'sao'),
        'section'  => 'footer_general_settings',
        'default'  => 'simple',
				'priority' => 1,
        'choices'  => array(
            "simple"        => __("Simple", "sao"),
            "footer-columns" => __("Footer Columns", "sao"),
        ),
    ));

	//General
	Kirki::add_field('sao', array(
 	 'type' => 'color',
 	 'label' => __('Footer Background Color', 'sao'),
 	 'section' => 'footer_general_settings',
 	 'priority' => 1,
 	 'settings' => 'site_footer_bg_color',
 	 'transport' => 'auto',
	 'default'  => '#FFF',
 	 'choices' => array(
 		 'alpha' => true,
 	 ),
 	 'output' => array(
 		 array(
 			 'element' => '.site-footer',
 			 'property' => 'background-color',
 		 ),
 	 ),
 	 'js_vars' => array(
 		 array(
 			 'element' => '.site-footer',
 			 'function' => 'background-color',
 			 'suffix'   => ' !important',
 		 ),
 	 ),
  ));
	//About Column Text
	Kirki::add_field('sao', array(
        'type'     => 'separatorsection',
        'label'    => __('About Column Options', 'sao'),
        'section'  => 'footer_general_settings',
        'settings' => 'sao_footer_aboutcol_sep',
				'priority'    => 3,
				'required' => array(
					array(
					'setting'  => 'sao_footer_template',
					'operator' => '==',
					'value'    => 'footer-columns',
				)
				),
    ));
	Kirki::add_field(
		'sao', array(
			'type' => 'text',
			'settings' => 'footer_about_title',
			'label' => __('About column header', 'sao'),
			'section' => 'footer_general_settings',
			'default' => esc_html__( 'About Us', 'sao' ),
			'sanitize_callback' => 'sao_sanitize_text',
			'transport' => 'auto',
			'priority' => 3,
			'js_vars' => array(
				array(
				'element' => ".about-col h4",
				'function' => 'html',
				),
			),
			'partial_refresh' => array(
				'footer_email' => array(
				'selector' => ".about-col h4",
				'render_callback' => "sao_partial_render_callback",
				),
			),
			'required' => array(
				array(
				'setting'  => 'sao_footer_template',
				'operator' => '==',
				'value'    => 'footer-columns',
			)
			),
		)
	);
	Kirki::add_field(
		'sao', array(
			'type' => 'textarea',
			'settings' => 'footer_about_text',
			'label' => __('About Us text', 'sao'),
			'section' => 'footer_general_settings',
			'default' => "Some Example Text",
			'sanitize_callback' => 'wp_kses_post',
			'transport' => 'auto',
			'priority' => 3,
			'js_vars' => array(
				array(
				'element' => ".about-col p",
				'function' => 'html',
				),
			),
			'partial_refresh' => array(
				'footer_about_text' => array(
				'selector' => ".about-col p",
				'render_callback' => "sao_partial_render_callback",
			 ),
			),
			'required' => array(
				array(
				'setting'  => 'sao_footer_template',
				'operator' => '==',
				'value'    => 'footer-columns',
			)
			),
		)
	);
	Kirki::add_field('sao', array(
        'type'     => 'separatorsection',
        'label'    => __('Recent Posts Column Options', 'sao'),
        'section'  => 'footer_general_settings',
        'settings' => 'sao_footer_recentcol_sep',
				'priority'    => 4,
				'required' => array(
					array(
					'setting'  => 'sao_footer_template',
					'operator' => '==',
					'value'    => 'footer-columns',
				)
				),
    ));
	Kirki::add_field(
		'sao', array(
			'type' => 'text',
			'settings' => 'footer_rec_posts_title',
			'label' => __('Recent Posts Column header', 'sao'),
			'section' => 'footer_general_settings',
			'default' => esc_html__( 'Recent Posts', 'sao' ),
			'sanitize_callback' => 'sao_sanitize_text',
			'transport' => 'auto',
			'priority' => 4,
			'js_vars' => array(
				array(
				'element' => ".rec-posts-col h4",
				'function' => 'html',
				),
			),
			'partial_refresh' => array(
				'footer_email' => array(
				'selector' => ".rec-posts-col h4",
				'render_callback' => "sao_partial_render_callback",
				),
			),
			'required' => array(
				array(
				'setting'  => 'sao_footer_template',
				'operator' => '==',
				'value'    => 'footer-columns',
			)
			),
		)
	);
	Kirki::add_field( 'sao', array(
	'type'        => 'number',
	'settings'    => 'footer_num_of_posts_shown',
	'label'       => esc_attr__( 'Number of posts to show in the column', 'sao' ),
	'section'     => 'footer_general_settings',
	'default'     => 3,
	'priority' => 4,
	'sanitize_callback' => 'sao_sanitize_int',
	'required' => array(
		array(
		'setting'  => 'sao_footer_template',
		'operator' => '==',
		'value'    => 'footer-columns',
	)
	),
) );
	//Follow Us Column Email and Phone Settings
	Kirki::add_field('sao', array(
				'type'     => 'separatorsection',
				'label'    => __('Contact/Soc Column Options', 'sao'),
				'section'  => 'footer_general_settings',
				'settings' => 'sao_footer_contactsoc_sep',
				'priority'    => 5,
				'required' => array(
					array(
					'setting'  => 'sao_footer_template',
					'operator' => '==',
					'value'    => 'footer-columns',
				)
				),
		));
	Kirki::add_field(
		'sao', array(
			'type' => 'text',
			'settings' => 'footer_contact_col_title',
			'label' => __('Contact Us Column Title', 'sao'),
			'section' => 'footer_general_settings',
			'default' => "",
			'sanitize_callback' => 'sao_sanitize_text',
			'transport' => 'auto',
			'priority' => 5,
			'js_vars' => array(
				array(
				'element' => ".follow-col-info h4",
				'function' => 'html',
				),
			),
			'partial_refresh' => array(
				'footer_email' => array(
				'selector' => ".follow-col-info h4",
				'render_callback' => "sao_partial_render_callback",
				),
			),
			'required' => array(
				array(
				'setting'  => 'sao_footer_template',
				'operator' => '==',
				'value'    => 'footer-columns',
			)
			),
		)
	);
	Kirki::add_field( 'sao', array(
		'type'        => 'repeater',
		'label'       => esc_attr__( 'Footer Info Control', 'sao' ),
		'section'     => 'footer_general_settings',
		'priority'    => 5,
		'row_label' => array(
			'type'  => 'field',
			'value' => esc_attr__('Item', 'sao' ),
			'field' => 'link_text',
		),
		'settings'    => 'footer_follow_col_info_items',
		'fields' => array(
			'item_icon' => array(
				'type'        => 'text',
				'label'       => esc_attr__( 'Item Icon Code', 'sao' ),
				'description' => esc_attr__( 'Slider Image', 'sao' ),
				'default'     => '',
			),
			'item_value' => array(
				'type'        => 'text',
				'label'       => esc_attr__( 'Item Value', 'sao' ),
				'description' => esc_attr__( 'This will be the Value of the item', 'sao' ),
				'default'     => '',
			),
		),
		'required' => array(
			array(
			'setting'  => 'sao_footer_template',
			'operator' => '==',
			'value'    => 'footer-columns',
		)
		),
	) );
	Kirki::add_field(
		'sao', array(
			'type' => 'text',
			'settings' => 'footer_follow_col_title',
			'label' => __('Follow Us Section title', 'sao'),
			'section' => 'footer_general_settings',
			'default' => "",
			'sanitize_callback' => 'sao_sanitize_text',
			'transport' => 'auto',
			'priority' => 5,
			'js_vars' => array(
				array(
				'element' => ".follow-col-social h4",
				'function' => 'html',
				),
			),
			'partial_refresh' => array(
				'footer_email' => array(
				'selector' => ".follow-col-social h4",
				'render_callback' => "sao_partial_render_callback",
				),
			),
			'required' => array(
				array(
				'setting'  => 'sao_footer_template',
				'operator' => '==',
				'value'    => 'footer-columns',
			)
			),
		)
	);

		/*******************************************************************/
		/******* Sortable and Dragable Menu for sections ordering *********/
		/*****************************************************************/
    Kirki::add_field('sao', array(
      'type' => 'sortable',
      'settings' => 'frontpage_template_parts',
      'label'       => __( 'Template parts for Front Page', 'sao' ),
      'description' => __( 'You can enable/disable sections that interest you below and reorder them to your liking.', 'sao' ),
      'section' => 'switcher_section',
			'priority' => 1,
      'default' => array(
        'services',
        'slider',
        'team'
      ),
      'choices'   => array(
				'blog'      => __( 'Blog Section',      'sao' ),
				'contact'     => __( 'Contact Section',     'sao' ),
				'features'       => __( 'Features Section',       'sao' ),
				'gallery'     => __( 'Gallery Section',     'sao' ),
				'map' => __( 'Map Section', 'sao' ),
				'clients' => __( 'Partners Section', 'sao' ),
				'projects' => __( 'Projects Section', 'sao' ),
				'services' => __( 'Services Section', 'sao' ),
				'slider' => __( 'Slider Section', 'sao' ),
				'team' => __( 'Team Section', 'sao' ),
				'testimonial' => __( 'Testimonials Section', 'sao' ),
      ),
    ));

		/*******************************************************************/
		/****************** SVG and Sliders Speed Settings ****************/
		/*****************************************************************/
		Kirki::add_field( 'sao', array(
			'type'        => 'slider',
			'settings'    => 'testimonial_slider_speed',
			'label'       => esc_attr__( 'Testimonials Slider speed', 'sao' ),
			'section'     => 'testimonial_settings',
			'default'     => 3000,
			'sanitize_callback' => 'sao_sanitize_textarea',
			'choices'     => array(
				'min'  => '1000',
				'max'  => '6000',
				'step' => '500',
			),
		) );
		Kirki::add_field( 'sao', array(
			'type'        => 'slider',
			'settings'    => 'clients_slider_speed',
			'label'       => esc_attr__( 'Clients Slider speed', 'sao' ),
			'section'     => 'clients_settings',
			'default'     => 3000,
			'sanitize_callback' => 'sao_sanitize_textarea',
			'choices'     => array(
				'min'  => '1000',
				'max'  => '6000',
				'step' => '500',
			),
		) );
		//svg
		Kirki::add_field( 'sao', array(
			'type'        => 'checkbox',
			'settings'    => 'sao_svg_disable',
			'label'       => esc_attr__( 'Disable SVG ?', 'sao' ),
			'description' => esc_attr__( 'checkbox for enabling or disabling svg on theme', 'sao' ),
			'section'     => 'sao-options',
			'default'     => true,
		) );
		//Dummy section for sections_panel
		Kirki::add_section('dummy_section', array(
		'title' => __('Dummy Section', 'sao'),
		'description' => __('Dummy Section', 'sao'),
		'panel' => 'sections_panel',
		'priority' => 9,
		'capability' => 'edit_theme_options',
		));
		Kirki::add_field( 'sao', array(
			'type'        => 'checkbox',
			'settings'    => 'dummy_checkbox',
			'label'       => esc_attr__( 'Dummy ?', 'sao' ),
			'description' => esc_attr__( 'checkbox for enabling nested panels appear in sections panel', 'sao' ),
			'section'     => 'dummy_section',
			'default'     => true,
		) );

}

add_action('customize_register', 'sao_settings');

function sao_customizer_custom_styles(){

$lohoHeight = get_theme_mod('sao_logo_height', 150);
$menu_bg_color = get_theme_mod('menu_bg_color', '#FFF');
$menu_font_color = get_theme_mod('menu_font_color', '#000');
$menu_current_section_color = get_theme_mod('menu_current_section_color', '#000');
$fixed_header_bg_color = get_theme_mod('fixed_menu_bg_color');
$custom_css .= ".header-top,  .mobile-menu a, #site-navigation. .nav-is-visible{background-color:{$menu_bg_color};}
.fixed-header .primary-navigation ul li a.active{color:{$menu_current_section_color};}";

$header_overlay_color = get_theme_mod('header_overlay_color', '');
$header_overlay_opacity =  get_theme_mod('header_overlay_opacity');
$separator_height = get_theme_mod('header_separator_height');
$separator_bg_color = get_theme_mod('svg_bg_color', '#FFF');
$custom_css .= ".color-overlay:before{background-color:{$header_overlay_color};}
.color-overlay:before{opacity:{$header_overlay_opacity};}
.header-separator svg{height:{$separator_height}px!important;}
.header-separator .svg-white-bg { fill: {$separator_bg_color};}";

$header_content_text_align =  get_theme_mod('header_content_text_aligner', 'center');
$custom_css .= ".header-content .aligner{text-align:{$header_content_text_align};}";

$service_background_color   = get_theme_mod('services_background_color','#fff');
$service_header_color   = get_theme_mod('services_header_color','#111');
$service_subheader_color = get_theme_mod('services_subheader_color','#7D7D7D');
$image_text_color = get_theme_mod('image_text_color', '#FFF');
$custom_css .= "#services{ background-color:{$service_background_color};}
#services .main-header{color:{$service_header_color};}
#services .sub-header{color:{$service_subheader_color};}
.services-top-image p{color:{$image_text_color};}";

$team_bg_color = get_theme_mod('team_gb_color', '#FFF');
$team_header_color = get_theme_mod('team_header_color', '#000');
$team_subheader_color = get_theme_mod('team_subheader_color', '#000');
$team_theme_color = get_theme_mod('team_theme_color', 'rgba(0, 0, 0, 0.45)');
$custom_css .= "#team .main-header{color:{$team_header_color};}
#team .sub-header{color:{$team_subheader_color};}
.team-wrap .material-card h2, .team-wrap .material-card .mc-btn-action,
.team-wrap .material-card .mc-footer{background:{$team_theme_color};}";

$slider_settings = get_theme_mod('slider-row-settings', '');
$i = 1;
foreach ( $slider_settings as $setting) :
 $bg_image =wp_get_attachment_url($setting['slider_image']);
 $custom_css .= ".slider--el-".$i." .part:before{background-image:linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0)), url($bg_image); background-size:cover; background-position: center; }";
 $i++;
endforeach;

$testimonials_font_color = get_theme_mod('testimonials_section_font_color', '#000');
$custom_css .= ".testimonials-section .section-top, .testimonials-section .section-header , .testimonials-section .section-subheader{color:{$testimonials_font_color};}" ;

$contact_section_font_color = get_theme_mod('contact_section_font_color', '#000');
$custom_css .= ".contact .section-top, .contact .section-header , .contact .section-subheader, .wpcf7 label{color:{$contact_section_font_color};}";

$footer_bg_color = get_theme_mod('site_footer_bg_color', '#FFF');
$custom_css .= ".site-footer{background-color:{$footer_bg_color};}";

return $custom_css;
}


function sao_separators_list(){
	$all_separators = array(
		'tilt'                  => array(
            'title'       => _x('Tilt', 'Shapes', 'sao'),
            'has_flip'    => true,
            'height_only' => true,
        ),
		'clouds' => array(
		         'title'        => _x('Clouds', 'Shapes', 'sao'),
		         'has_flip'     => true,
		         'height_only'  => true,
		     ),
	 'big-half-circle-negative' => array(
		         'title'        => _x('Big Half Circle', 'Shapes', 'sao'),
		         'height_only'  => true,
						 'has_flip'     => false,
		     ),
	 'triangle-asymmetrical' => array(
      'title'        => _x('Triangle Asymmetrical', 'Shapes', 'sao'),
      'has_negative' => true,
      'has_flip'     => true,
  ),
	);
 $separators = array();
 foreach ($all_separators as $key => $value){
	 $separators[$key] = $value['title'];
	 if (isset($value['has_negative'])) {
            $separators["$key-negative"] = $value['title'] . " Negative";
        }
 }

 return $separators;
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function sao_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function sao_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Sanitization of textarea
 */
 function sao_sanitize_textarea( $input ){
	 global $allowedposttags;
	 $output = wp_kses( $input , $allowedposttags );
	 return $output;
 }

 /**
  * Sanitization of filepaths
  */
function sao_sanitize_upload( $upload ){
	$return = '';
	$file_type = wp_check_filetype( $upload );
	if ( $file_type["ext"]){
		$return = esc_url_raw( $upload );
	}

	return $return;
}
/**
 * Text sanitization
 */
function sao_sanitize_text( $string ){
	return wp_kses_post(balanceTags( $string ));
}

/**
 * Checkbox sanitization
 */
 function sao_sanitize_checkbox( $input ){
	 if ( $input == 1 ){
			 return 1;
	 }else{
			 return 0;
	 }
 }

 /**
  * Number sanitization
  */
 function sao_sanitize_int( $input ){
	 $return = absint( $input );
	 return $return;
 }


 /**
  * Layout sanitization
  */
 function sao_sanitize_layout( $value ){
	 if( !in_array ( $value, array( 'centered-menu' , 'top-menu' , 'ns-menu' ) ) ) {
		 $value = 'centered-menu';
	 }
	 return $value;
 }


 ?>
