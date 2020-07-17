<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package sao
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function sao_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'sao_body_classes' );
/**
 * Print Site Header
 */
if ( ! function_exists( 'sao_site_header' ) ) {
    /**
     * Display site header
     */
    function sao_site_header(){
			  $sticky_header = get_theme_mod('sticky_header', false);
        ?>
        <header id="masthead" class="site-header header-top homepage <?php if($sticky_header){ echo fixed; } ?>">
            <div id="site-navigation" class="main-navigation <?php echo get_theme_mod('header_layout_settings', ''); ?>">
								<div class="site-branding">
									<?php sao_custom_logo(); ?>
  							  <a href="#" class="toggle-nav"><i class="fas fa-bars"></i></a>
								</div>
                <div class="menu-container">
                  <nav id="primary-navigation" class="primary-navigation">
                      <ul class="sao-menu">
                          <?php  wp_nav_menu( array( 'theme_location' => 'primary', 'items_wrap' => '%3$s', 'container' => '' ) ); ?>
                      </ul>
                  </nav>
                  <!-- #site-navigation -->
                </div>
            </div>
        </header><!-- #masthead -->
        <?php
    }
}
/**
 * Default Main Menu
 */
function sao_default_main_menu() {
	$html .= '<li class="menu-item menu-item-type-custom menu-item-object-custom">';
			$html .= '<a href="#" title="' . __( 'Home', 'sao' ) . '">';
				$html .= __( 'Home', 'sao' );
			$html .= '</a>';
	 $html .= '</li>';
	 $html .= '<li class="menu-item menu-item-type-custom menu-item-object-custom">';
 			$html .= '<a href="#services" title="' . __( 'Services', 'sao' ) . '">';
 				$html .= __( 'Services', 'sao' );
 			$html .= '</a>';
 	 $html .= '</li>';
	 $html .= '<li class="menu-item menu-item-type-custom menu-item-object-custom">';
 			$html .= '<a href="#services" title="' . __( 'Slider', 'sao' ) . '">';
 				$html .= __( 'Slider', 'sao' );
 			$html .= '</a>';
 	 $html .= '</li>';
	 $html .= '<li class="menu-item menu-item-type-custom menu-item-object-custom">';
 			$html .= '<a href="#team" title="' . __( 'Team', 'sao' ) . '">';
 				$html .= __( 'Team', 'sao' );
 			$html .= '</a>';
 	 $html .= '</li>';
	echo $html;
} // end sao_default_main_menu
/**
 * Default Social Menu
 */
function sao_default_social_menu() {
	$html .= '<li class="menu-item menu-item-type-custom menu-item-object-custom">';
			$html .= '<a href="#">';
				$html .= '<i class="fab fa-facebook-square"></i>';
			$html .= '</a>';
	 $html .= '</li>';
	 $html .= '<li class="menu-item menu-item-type-custom menu-item-object-custom">';
 			$html .= '<a href="#services">';
 				$html .= '<i class="fab fa-twitter-square"></i>';
 			$html .= '</a>';
 	 $html .= '</li>';
	 $html .= '<li class="menu-item menu-item-type-custom menu-item-object-custom">';
 		 $html .= '<a href="#services">';
 			 $html .= '<i class="fab fa-pinterest-square"></i>';
 		 $html .= '</a>';
 	$html .= '</li>';
	echo $html;
} // end sao_default_social_menu

/**
 * Print Front Page Site Header
 */
if ( ! function_exists( 'sao_frontpage_header' ) ) {
    /**
     * Display Front Page site header
     */
    function sao_frontpage_header(){
			  $sticky_header = get_theme_mod('sticky_header', false);
				$header_layout = get_theme_mod('header_layout_settings', 'top-menu');
        ?>
        <header id="masthead" class="site-header header-top homepage <?php if($sticky_header){ echo fixed; } ?>">
            <div id="site-navigation" class="main-navigation <?php echo get_theme_mod('header_layout_settings', 'top-menu'); ?>">
								<div class="site-branding">
									<?php sao_custom_logo(); ?>
  							  <a href="#" class="toggle-nav"><i class="fas fa-bars"></i></a>
								</div>
                <div class="menu-container">
                  <nav id="primary-navigation" class="primary-navigation">
                      <ul class="sao-menu">
                          <?php  wp_nav_menu( array( 'theme_location' => 'primary', 'items_wrap' => '%3$s', 'container' => '', 'fallback_cb'    => 'sao_default_main_menu' ) ); ?>
                      </ul>
                  </nav>
									<?php
									if($header_layout == 'top-menu'){
										?>
										<nav id="site-social-navigation" class="social-navigation">
				                 <ul class="sao-menu">
													<?php wp_nav_menu( array( 'theme_location' => 'social', 'items_wrap' => '%3$s', 'container' => '', 'fallback_cb'    => 'sao_default_social_menu' ) ); ?>
											</ul>
									</nav>
									<?php } ?>
                  <!-- #site-navigation -->
                </div>
            </div>
        </header><!-- #masthead -->
				<div class="header-homepage <?php echo (get_theme_mod('header_show_overlay', true)) ? 'color-overlay' : ''; ?>">
			     <?php the_custom_header_markup('header_content_type', 'text'); ?>

				     <div class="header-content">
							 <?php $content_type = get_theme_mod('header_content_type', 'text');
							 get_template_part('template-parts/header/header-content', $content_type );
							 ?>
				     </div><!-- #header-content -->

			    <?php	sao_header_separator(); ?>
		    </div><!-- #masthead -->
				<div id="backtotop" class="backtotop">
		 				<div class="backtotop-morph"></div>
		 		</div>
        <?php
    }
}

/**
 * Print Single Page Site Header
 */
if ( ! function_exists( 'sao_singlepage_header' ) ) {
    /**
     * Display Front Page site header
     */
    function sao_singlepage_header(){
        ?>
        <header id="masthead" class="site-header header-top homepage <?php if($sticky_header){ echo fixed; } ?>">
            <div id="site-navigation" class="main-navigation <?php echo get_theme_mod('header_layout_settings', 'top-menu'); ?>">
								<div class="site-branding">
									<?php sao_custom_logo(); ?>
  							  <a href="#" class="toggle-nav"><i class="fas fa-bars"></i></a>
								</div>
            </div>
        </header><!-- #masthead -->
        <?php
    }
}

/************************************/
/****** Print Header Content ********/
/************************************/
/* Print Header Content Title*/
function sao_print_header_content_title(){
	$title = get_theme_mod('header_content_title', wp_kses_post('You can set <span class="js-rotating">text, page, paragraph, everything </span> from the customizer', 'sao'));

	printf('<h1 class="header-content-title">%1$s</h1>', $title);
}
/* Print Header Content SubTitle*/
function sao_print_header_content_subtitle(){
	$subtitle = get_theme_mod('header_content_subtitle', 'You can Set this text from the customizer');

	printf('<p class="header-content-subtitle">%1$s</p>', $subtitle);
}
/* Print Left Header Button*/
if(! function_exists( 'sao_print_header_button_left' )){
	function sao_print_header_button_left(){
		$label = get_theme_mod('button_left_label', esc_html__('', 'sao'));
		$url = get_theme_mod('button_left_url',esc_html__('#services', 'sao'));
		$show = get_theme_mod('show_left_button', true);

		if($show){
				printf('<a class="btn big header-primary-button" href="%1$s">%2$s</a>', esc_url($url), wp_kses_post($label));
		}

	}
}
/* Print Right Header Button*/
if(! function_exists( 'sao_print_header_button_right' )){
	function sao_print_header_button_right(){
		$label = get_theme_mod('button_right_label', esc_html__('', 'sao'));
		$url = get_theme_mod('button_right_url', esc_html__('#services', 'sao'));
		$show = get_theme_mod('show_right_button', true);

		if($show){
				printf('<a class="btn big header-secondary-button" href="%1$s">%2$s</a>', esc_url($url), wp_kses_post($label));
		}
	}
}
/* Print Header Content Text And Buttons*/
if (!function_exists('sao_print_header_content_text')) {
	function sao_print_header_content_text(){
		sao_print_header_content_title();
		sao_print_header_content_subtitle();

		echo '<div class="header-content-buttons">';
			sao_print_header_button_left();
		  sao_print_header_button_right();
		echo '</div>';

	}
}

/* Print Header Content Image */
if (!function_exists('sao_print_header_content_image')) {
	function sao_print_header_content_image(){

		$content_image = get_theme_mod('header_content_image', get_template_directory_uri() . '/assets/images/webdesign.png');
		if ( ! empty($content_image)) {
        printf('<img class="header-content-image" src="%1$s"/>', esc_url($content_image));
    }

	}
}
/*Print header content image alignment class*/
function sao_print_image_class(){

	$image_class = get_theme_mod('header_content_image_layout', 'img-right');

	echo $image_class;
}
/*Print header content aligner class*/
function sao_print_aligner_class(){

	$aligner_class = get_theme_mod('sao_header_content_layout', 'content-center');

	echo $aligner_class;
}

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function sao_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'sao_pingback_header' );
/*************************************************/
/******** Print Footer Columns Content ********/
/***********************************************/
if (!function_exists('sao_footer_posts_col')) {
	function sao_footer_posts_col(){
		$footer_recent_posts_title = get_theme_mod('footer_rec_posts_title', esc_html__('Recent Posts', 'sao'));
		$footer_num_of_posts = get_theme_mod('footer_num_of_posts_shown', '3');

		if($footer_recent_posts_title != ''){echo '<h4 class="foot_posts_heading">' . $footer_recent_posts_title . '</h4>';}

		$the_query = new WP_Query(array(
		'posts_per_page'   => $footer_num_of_posts,
		'post_type'        => 'post',
		'order' => 'DESC',));

		while($the_query->have_posts()) : $the_query->the_post(); ?>
		<ul class="foot-rec-posts">
			<li>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</li>
		</ul>
		 <?php endwhile; wp_reset_postdata();
	}
}

if (!function_exists('sao_footer_foolow_col_social')) {
	function sao_footer_foolow_col_social(){
		$footer_follow_col_title = get_theme_mod('footer_follow_col_title', esc_html__('Follow Us', 'sao'));

		if ( has_nav_menu( 'social' ) ) {
			if($footer_follow_col_title != ''){echo '<h4 class="foot_posts_heading">' . $footer_follow_col_title . '</h4>';}
			wp_nav_menu( array(
 			 'theme_location' => 'social',
 			 'menu_id'        => 'social-menu',
 			 'menu_class'     => 'nav-menu',
 		 ) );
     }
	}
}

if (!function_exists('sao_footer_follow_col_info')) {
	function sao_footer_follow_col_info(){
		$footer_contact_col_title = get_theme_mod('footer_contact_col_title', esc_html__('Contact Us', 'sao'));
		$follow_col_items = get_theme_mod('footer_follow_col_info_items', '');
		if($footer_contact_col_title != ''){echo '<h4 class="foot_contact_title">' . $footer_contact_col_title . '</h4>';}

		if($follow_col_items)
		{
			foreach($follow_col_items as $item) : ?>
		<p>
			<i class="<?php  echo $item['item_icon'];?>" aria-hidden="true"></i><a class="foot-info-value"> <?php echo $item['item_value']; ?></a>
		</p>
	<?php endforeach;
    } else {
			echo do_shortcode("[sao_dummy_data did='11']");
	}

	}
}

if (!function_exists('sao_footer_about_col')) {
	function sao_footer_about_col(){
		$footer_about_title = get_theme_mod('footer_about_column_title', esc_html__('About Us', 'sao'));
		$footerAboutText = get_theme_mod('footer_about_text', '');

		if($footer_about_title != ''){echo '<h4 class="foot_contact_title">' . $footer_about_title . '</h4>';}
		echo '<p>' .$footerAboutText. '</p>';

	}
}
/*************************************************/
/******** Validate uploaded header video ********/
/***********************************************/
function sao_customize_filesize_video_validation( $validity, $value ) {
	 if ( is_wp_error( $validity ) ) {$validity->remove( 'size_too_large' );	}
	 $video = get_attached_file( absint( $value ) );
	 if ( $video ) {
		 $size = filesize( $video );
		 if ( 500 < $size / pow( 1024, 2 ) ) { // Check whether the size is larger than 500MB.
			 $validity->add( 'size_too_large',
				 __( 'This video file is too large to use as a header video. Try a shorter video or optimize the compression settings and re-upload a file that is less than 500MB. Or, upload your video to YouTube and link it with the option below.', 'sao' )
			 );
		 }
	 }
	 return $validity;
 }
add_filter( 'customize_validate_header_video', 'sao_customize_filesize_video_validation', 20 ,2);

/*************************************************/
/************ Header video settings *************/
/***********************************************/
function sao_header_video_settings( $settings ) {
  $settings['minWidth'] = 680;
  $settings['minHeight'] = 400;
  return $settings;
}
add_filter( 'header_video_settings', 'sao_header_video_settings');

/*************************************************/
/************ Blog Page Link *************/
/***********************************************/
function sao_blog_link(){
	if (get_option('page_for_posts')) {
				return esc_url(get_permalink(get_option('page_for_posts')));
		} else {
				return esc_url(home_url('/?post_type=post'));
		}
}
/*************************************************/
/************ Custom comments Walker *************/
/***********************************************/
class comment_walker extends Walker_Comment {
	 var $tree_type = 'comment';
	 var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );

	 // constructor  wrapper for the comments list
	 function __construct() { ?>

		 <section class="comments-list">

	 <?php }

	 // start_lvl - wrapper for child comments list
	 function start_lvl( &$output, $depth = 0, $args = array() ) {
		 $GLOBALS['comment_depth'] = $depth + 2; ?>

		 <section class="child-comments comments-list">

	 <?php }

	 // end_lvl  closing wrapper for child comments list
	 function end_lvl( &$output, $depth = 10, $args = array() ) {
		 $GLOBALS['comment_depth'] = $depth + 2; ?>

		 </section>

	 <?php }

	 // start_el  HTML for comment template
	 function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
		 $depth++;
		 $GLOBALS['comment_depth'] = $depth;
		 $GLOBALS['comment'] = $comment;
		 $parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' );

		 if ( 'article' == $args['style'] ) {
			 $tag = 'article';
			 $add_below = 'comment';
		 } else {
			 $tag = 'article';
			 $add_below = 'comment';
		 } ?>

		 <article <?php comment_class(empty( $args['has_children'] ) ? '' :'parent') ?> id="comment-<?php comment_ID() ?>" itemprop="comment" itemscope itemtype="http://schema.org/Comment">
			 <div class="comment-body">
				 <div class="comment-avatar">
					 <?php echo get_avatar( $comment, 60, $default, 'Authors gravatar' ); ?>
				 </div>
				 <div class="comment-info">
					 <span class="fn">
						 <a class="comment-author-link" href="<?php comment_author_url(); ?>" itemprop="author"><?php comment_author(); ?></a>
					 </span>
					 <span class="comment-date">
						 <time class="comment-meta-item" datetime="<?php comment_date('Y-m-d') ?>T<?php comment_time('H:iP') ?>" itemprop="datePublished"><?php comment_date('jS F Y') ?><a href="#comment-<?php comment_ID() ?>" itemprop="url"></a></time>
					 </span>
					 <?php edit_comment_link('<a class="comment-meta-item">(Edit)</a>','',''); ?>
				 </div>
				 <div class="comment-area">
					 <div class="comment-content clearfix">
						 <?php comment_text() ?>
					 </div>
				 </div>
				 <div class="reply">
					 <span class="reply-container">
						 <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => 1, 'max_depth' => $args['max_depth']))) ?>
					 </span>
				 </div>
			 </div>


	 <?php }

	 // end_el closing HTML for comment template
	 function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>

		 </article>

	 <?php }

	 // destructorclosing wrapper for the comments list
	 function __destruct() { ?>

		 </section>

	 <?php }

}


function sao_svg_enable(){
	$svg_disable = get_theme_mod('sao_svg_disable');
	if( $svg_disable == '' || $svg_disable == '0'){
		$return = '<div class="svg-top-container">
		<svg width="100%" id="topBar" class="topBar" x="0" y="0">
           <rect id="btn_1" class="topBtn" x="0" y="0" height="30" width="100"/>
           <rect id="btn_2" class="topBtn" x="100" y="0" height="30" width="100"/>
      </svg>
		</div>';
		return $return;
	} else {
		return false;
	}
}

/********************************************/
/******* Enqueue Customizer styles *********/
/******************************************/
function sao_customizer_enqueue(){
	echo "<style>";
		echo sao_customizer_custom_styles();
	echo "</style>";
}
add_action('wp_head', 'sao_customizer_enqueue');


/****************************/
/******* Copyright *********/
/****************************/
function sao_create_copyright() {
$first_date = $first_post->post_date_gmt;
_e( 'Copyright &copy; ', 'sao');
if ( substr( $first_date, 0, 4 ) == date( 'Y' ) ) {
echo date( 'Y' );
} else {
echo substr( $first_date, 0, 4 ) . "  " . date( 'Y' );
}
echo ' <strong>' . get_bloginfo( 'name' ) . '</strong> ';
_e( ' - All rights reserved.', 'sao');
}

function sao_add_async_defer($tag, $handle){
  if('googlemaps' !== $handle){
    return $tag;
  }
  return str_replace(' src', 'async="async" defer="defer" src', $tag);
}
add_action('script_loader_tag', 'sao_add_async_defer', 10, 2);

/***************************************/
/******* Custom Logo Function *********/
/*************************************/
if ( ! function_exists( 'sao_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
function sao_custom_logo() {
    if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
        the_custom_logo();
    } else {
			printf('<a class="text-logo" href="%1$s">%2$s</a>', esc_url(home_url('/')), get_bloginfo('name'));
		}
}
endif;

function sao_header_separator(){
	$show_separator = get_theme_mod('header_show_separator', true);
	if ($show_separator) {
		$separator = get_theme_mod('header_separator', 'triangle-asymmetrical-negative');
		$reverse = strpos($separator, "-negative") === false ? "header-separator-reverse" : "";
		echo '<div class="header-separator header-separator-bottom ' . $reverse . '">';
			ob_start();
			require get_template_directory(). "/assets/separators/" . $separator . ".svg";
			$content = ob_get_clean();
			echo $content;
		echo '</div>';
	}
}

//Print Gallery
function sao_print_gallery(){
  $gallery_images = get_theme_mod('gallery_repeater', $defaults);
	if($gallery_images){
	foreach ( $gallery_images as $gallery_image ) :
		if($gallery_image['gallery_image'] != ''){?>
		<img src="<?php echo wp_get_attachment_url(esc_attr($gallery_image['gallery_image'])); ?>" data-full="<?php echo wp_get_attachment_url($gallery_image['gallery_image']); ?>" class="m-p-g__thumbs-img wow animated fadeInRight" data-height="300" data-width="300"/>
	<?php }
   endforeach;
 } else {
	 echo do_shortcode("[sao_dummy_data did='8']");
 }
}


function sao_print_content_section(){
  $settings = get_theme_mod('features_row_settings', array());
  $i = 0;
  foreach( $settings as $setting ) :
		 $class = ( $setting !== end( $settings ) ) ? "content-section-with-arrow" : "content-section-no-arrow";
		?>


	<div class="content-section <?php echo esc_attr($class); ?>" style="background-color:<?php echo $setting['row_color'];?>">
    <div class="content-container <?php if($i % 2 == 0){echo imgright;} else {echo imgleft;} ?>">
        <div class="content-image-imgcol wow animated fadeInRight">
          <img src="<?php echo wp_get_attachment_url(esc_attr($setting['row_image'])); ?>">
        </div>
        <div class="content-image-textcol wow animated fadeInRight">
            <h2><?php echo esc_html($setting['row_header']); ?></h2>
            <p><?php echo esc_html($setting['row_text']); ?></p>
        </div>
    </div>
	</div>
    <?php
		$i++;
  	endforeach; ?>
	<?php
}

//Contact Form
function sao_print_contact_form(){
	$shortcode = get_theme_mod('contact_form_shortcode');
	?>
	<div class="container" id="contact-container">
		<div class="contact-form-col">
				<?php echo do_shortcode( "[sao_contact_form]" ); ?>
		</div>
	</div>
	<?php
}

function sao_print_post_thumbnail(){
	if (has_post_thumbnail() ) {
		$image_arr = wp_get_attachment_image_src(get_post_thumbnail_id($post_array->ID), 'medium-width');
		$image_url = $image_arr[0];
		echo 'style="background-image:url('.esc_url($image_url).');"' ;
	} else {
		echo 'style="background-image:url('.esc_url($image_url).');"' ;
	}
}

/**
 * Print Map Info Items
 */
function sao_contact_map_items (){
	$items = get_theme_mod('contactus-item-settings', '');

	foreach( $items as $item ) : ?>
		<div class="contact-us-item item-<?php echo esc_html($item['title']);?>">
			<i class="item-icon <?php echo esc_html($item['icon']);?>"></i>
			<p class="<?php echo esc_attr__($item['description'], 'sao');?>"><?php echo esc_html($item['description']); ?></p>
		</div>
	<?php
endforeach; ?>
<?php
}
/**
 * Print Map container and Map Info Items
 */
function sao_print_map(){
 $apiKey = get_theme_mod('map_api_key', '');
 $info_items = get_theme_mod('contactus-item-settings');
 ?>
 <div class="contact-map-container">
	 <div class="contact-content-left map">
		 <div id="map_container" class="contact-right-bg">
			 <?php if($apiKey == ''){
				 echo '<p class="missing-api-key">' . __('Your Google Map will be displayed here. To activate it you need to obtain and upload your API KEY in MAP API KEY Field in Customizer.', 'sao') . '</p>';
			 } ?>
		 </div>
		 <div id="textid" class="contact-content-right wow animated fadeInLeft">
			 <div class="contact-us-items">
				 <?php if( $info_items ){
					 sao_contact_map_items();
				 } else {
					 echo do_shortcode("[sao_dummy_data did='6']");
				 } ?>
			 </div>
		 </div>
	 </div>
 </div>
 <?php
}

//Gallery Meta Box
add_action( 'add_meta_boxes', 'sao_add_meta_box' );

if ( ! function_exists( 'sao_add_meta_box' ) ) {
	/**
	 * Add meta box to page screen
	 *
	 * This function handles the addition of variuos meta boxes to your page or post screens.
	 * You can add as many meta boxes as you want, but as a rule of thumb it's better to add
	 * only what you need. If you can logically fit everything in a single metabox then add
	 * it in a single meta box, rather than putting each control in a separate meta box.
	 *
	 * @since 1.0.0
	 */
	function sao_add_meta_box() {
		add_meta_box( 'additional-page-metabox-options', esc_html__( 'Metabox Controls', 'sao' ), 'sao_metabox_controls', 'project', 'normal', 'low' );
	}
}

if ( ! function_exists( 'sao_metabox_controls' ) ) {
	/**
	 * Meta box render function
	 *
	 * @param  object $post Post object.
	 * @since  1.0.0
	 */
	function sao_metabox_controls( $post ) {
		$meta = get_post_meta( $post->ID );

    $sao_gallery = ( isset( $meta['sao_gallery'][0] ) ) ? $meta['sao_gallery'][0] : '';

		wp_nonce_field( 'sao_control_meta_box', 'sao_control_meta_box_nonce' ); // Always add nonce to your meta boxes!
		?>
		<style type="text/css">
			.post_meta_extras p{margin: 20px;}
			.post_meta_extras label{display:block; margin-bottom: 10px;}
			.post_meta_extras .left_part{display: inline-block;width: 45%;margin-right: 30px; vertical-align: top;}
			.post_meta_extras .right_part{display: inline-block; width: 46%; vertical-align: top;}
			.uploaded_image{display: block; width: 200px;}
			.uploaded_image img{width: 150px; height: auto;}
			.featured_image_upload{display: block; margin-bottom: 10px;}
			.post_meta_extras .gallery_buttons input{position: relative; display: inline-block; vertical-align: top; width: auto;}
.post_meta_extras .title{font-size: 14px; padding: 8px 12px 8px 0; margin: 0; line-height: 1.4; font-weight: 600;}
.post_meta_extras .gallery-item{position: relative; display: inline-block; vertical-align: top; margin-right: 10px; margin-bottom: 10px;}
.post_meta_extras .gallery-item img{width: 150px; height: auto;display: inline-block; vertical-align: top;}
.post_meta_extras .gallery-item .remove{position: absolute; top: 5px; right: 5px; width: 20px; height: 20px; background: #000; border-radius: 50%; border: 1px solid #fff; color: #fff; text-align: center; font-weight: 600;
line-height: 18px; cursor: pointer; display: none;}
.post_meta_extras .gallery-item:hover .remove{display: block;}
		</style>
		<div class="post_meta_extras">
			<div class="right_part">
				<p>
					<label for="sao_gallery"><?php esc_html_e( 'Project Gallery', 'sao' ); ?></label>
					<div class="separator gallery_images">
						<?php
						$img_array = ( isset( $sao_gallery ) && '' !== $sao_gallery ) ? explode( ',', $sao_gallery ) : '';
						if ( '' !== $img_array ) {
							foreach ( $img_array as $img ) {
								echo '<div class="gallery-item" data-id="' . esc_attr( $img ) . '"><div class="remove">x</div>' . wp_get_attachment_image( esc_url($img) ) . '</div>';
							}
						}
						?>
					</div>
					<p class="separator gallery_buttons">
						<input id="sao_gallery_input" type="hidden" name="sao_gallery" value="<?php echo esc_attr( $sao_gallery ); ?>" />
						<input id="manage_gallery" title="<?php esc_html_e( 'Manage gallery', 'sao' ); ?>" type="button" class="button" value="<?php esc_html_e( 'Manage gallery', 'sao' ); ?>" />
						<input id="empty_gallery" title="<?php esc_html_e( 'Empty gallery', 'sao' ); ?>" type="button" class="button" value="<?php esc_html_e( 'Empty gallery', 'sao' ); ?>" />
					</p>
				</p>
			</div>
		</div>
		<?php
	}
}

add_action( 'save_post', 'sao_save_metaboxes' );

if ( ! function_exists( 'sao_save_metaboxes' ) ) {
	/**
	 * Save controls from the meta boxes
	 *
	 * @param  int $post_id Current post id.
	 * @since 1.0.0
	 */
	function sao_save_metaboxes( $post_id ) {
		/*
		 * We need to verify this came from the our screen and with proper authorization,
		 * because save_post can be triggered at other times. Add as many nonces, as you
		 * have metaboxes.
		 */
		if ( ! isset( $_POST['sao_control_meta_box_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['sao_control_meta_box_nonce'] ), 'sao_control_meta_box' ) ) { // Input var okay.
			return $post_id;
		}

		// Check the user's permissions.
		if ( isset( $_POST['post_type'] ) && 'page' === $_POST['post_type'] ) { // Input var okay.
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return $post_id;
			}
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return $post_id;
			}
		}

		/*
		 * If this is an autosave, our form has not been submitted,
		 * so we don't want to do anything.
		 */
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		/* Ok to save */
		if ( isset( $_POST['sao_gallery'] ) ) { // Input var okay.
			update_post_meta( $post_id, 'sao_gallery', sanitize_text_field( wp_unslash( $_POST['sao_gallery'] ) ) ); // Input var okay.
		}

	}
}

if ( ! function_exists( 'sao_print_meta_gallery' ) ) {
  function sao_print_meta_gallery(){
    $gallery = ( isset( $custom['sao_gallery'][0] ) && '' !== $custom['sao_gallery'][0] ) ? explode( ',', $custom['sao_gallery'][0] ) : '';
    foreach ( $gallery as $key => $value ) {
$image_url = wp_get_attachment_url( $value );
$background = ( isset( $image_url ) && '' !== $image_url ) ? 'style="background:url( ' . esc_url( $image_url ) . ' ); -webkit-background-size: cover; background-size: cover; background-repeat: no-repeat; ' . $bg_pos . '"' : '';

return $background;
  }
}
}

/**
 * Register meta box(es).
 */
 function project_desc_meta_box() {

     add_meta_box(
         'project-desc',
         __( 'Project Description', 'sao' ),
         'sao_project_desc_callback',
         'project'
     );
 }

 add_action( 'add_meta_boxes', 'project_desc_meta_box' );

 function sao_project_desc_callback( $post ) {

    // Add a nonce field so we can check for it later.
    wp_nonce_field( 'project_desc_nonce', 'project_desc_nonce' );

    $value = get_post_meta( $post->ID, '_project-desc', true );

    echo '<textarea style="width:100%" id="project-desc" name="project-desc">' . esc_attr( $value ) . '</textarea>';
}

function sao_partial_render_callback($partial){
	return get_theme_mod($partial->settings[0]);
}

/* Automatically set the image Title, Alt-Text, Caption & Description upon upload
--------------------------------------------------------------------------------------*/
function sao_image_meta_upon_image_upload( $post_ID ) {

	// Check if uploaded file is an image, else do nothing

	if ( wp_attachment_is_image( $post_ID ) ) {

		$my_image_title = get_post( $post_ID )->post_title;

		// Sanitize the title:  remove hyphens, underscores & extra spaces:
		$my_image_title = preg_replace( '%\s*[-_\s]+\s*%', ' ',  $my_image_title );

		// Sanitize the title:  capitalize first letter of every word (other letters lower case):
		$my_image_title = ucwords( strtolower( $my_image_title ) );

		// Create an array with the image meta (Title, Caption, Description) to be updated
		// Note:  comment out the Excerpt/Caption or Content/Description lines if not needed
		$my_image_meta = array(
			'ID'		=> $post_ID,			// Specify the image (ID) to be updated
			'post_title'	=> $my_image_title,		// Set image Title to sanitized title
			'post_excerpt'	=> $my_image_title,		// Set image Caption (Excerpt) to sanitized title
			'post_content'	=> $my_image_title,		// Set image Description (Content) to sanitized title
		);

		// Set the image Alt-Text
		update_post_meta( $post_ID, '_wp_attachment_image_alt', $my_image_title );

		// Set the image meta (e.g. Title, Excerpt, Content)
		wp_update_post( $my_image_meta );

	}
}

add_action( 'add_attachment', 'sao_image_meta_upon_image_upload' );

/* Save project description Field Data
--------------------------------------------------------------------------------------*/
function sao_save_project_desc_meta_box_data( $post_id ) {

    // Check if our nonce is set.
    if ( ! isset( $_POST['project_desc_nonce'] ) ) {
        return;
    }

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['project_desc_nonce'], 'project_desc_nonce' ) ) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check the user's permissions.
    if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }

    }
    else {

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }

    /* OK, it's safe for us to save the data now. */

    // Make sure that it is set.
    if ( ! isset( $_POST['project-desc'] ) ) {
        return;
    }

    // Sanitize user input.
    $my_data = sanitize_text_field( $_POST['project-desc'] );

    // Update the meta field in the database.
    update_post_meta( $post_id, '_project-desc', $my_data );
}

add_action( 'save_post', 'sao_save_project_desc_meta_box_data' );

/* Print Value of a project description field
--------------------------------------------------------------------------------------*/
if ( ! function_exists( 'sao_print_project_desc_meta' ) ) {
  function sao_print_project_desc_meta(){
		global $post;
    $project_desc = esc_attr( get_post_meta( $post->ID, '_project-desc', true ));

    return $project_desc;
 }
}

add_filter( 'image_size_names_choose', 'sao_custom_sizes' );
function sao_custom_sizes( $sizes ) {
		$custom_sizes = array(
				'blog-width' => 'My custom size 1',
				'medium-width' => 'My custom size 2'
		);
		return array_merge( $sizes, $custom_sizes );
}

/**
 * WP Title filter
 */
if( ! function_exists( 'sao_wp_title' ) ) {
	function sao_wp_title( $title, $sep ) {
		global $paged, $page;

		if ( is_feed() )
			return $title;

		$title .= get_bloginfo( 'name' );

		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			$title = "$title $sep $site_description";

		if ( $paged >= 2 || $page >= 2 )
			$title = "$title $sep " . sprintf( esc_html__( 'Page %s', 'sao' ), max( $paged, $page ) );

		return $title;
	}
	add_filter( 'wp_title', 'sao_wp_title', 10, 2 );

}

/**
 *
 *  Force http/s for images in WordPress
 *
 *  Source:
 *  https://core.trac.wordpress.org/ticket/15928#comment:63
 *
 *  @param $url
 *  @param $post_id
 *
 *  @return string
 */
function ssl_post_thumbnail_urls( $url, $post_id ) {

	//Skip file attachments
	if ( ! wp_attachment_is_image( $post_id ) ) {
		return $url;
	}

	//Correct protocol for https connections
	list( $protocol, $uri ) = explode( '://', $url, 2 );

	if ( is_ssl() ) {
		if ( 'http' == $protocol ) {
			$protocol = 'https';
		}
	} else {
		if ( 'https' == $protocol ) {
			$protocol = 'http';
		}
	}

	return $protocol . '://' . $uri;
}

add_filter( 'wp_get_attachment_url', 'ssl_post_thumbnail_urls', 10, 2 );

/*************************************************/
/*************** Import Theme Demo **************/
/***********************************************/
function sao_import_files() {
  return array(
    array(
      'import_file_name'           => 'Demo Import',
      'categories'                 => array( 'Main Demo'),
			'import_file_url'            => 'http://behemoth-themes.com/ocdi/sao-demo-content.xml',
      'import_widget_file_url'     => 'http://behemoth-themes.com/ocdi/sao-demo-widgets.wie',
      'import_customizer_file_url' => 'http://behemoth-themes.com/ocdi/sao-demo-customizer.dat',
      'import_preview_image_url'   => 'http://behemoth-themes.com/ocdi/thumbnail.png',
      'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'sao' ),
      'preview_url'                => 'http://behemoth-themes.com/demo/',
    ),
  );
}
add_filter( 'pt-ocdi/import_files', 'sao_import_files' );
