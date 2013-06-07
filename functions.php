<?php

$curr_theme = get_theme_data(TEMPLATEPATH . '/style.css');
$theme_version = trim($curr_theme['Version']);
if(!$theme_version) $theme_version = "1.0";

//Define constants:
define('THEME_FUNCTIONS', TEMPLATEPATH . '/functions/');
define('THEME_WIDGETS', TEMPLATEPATH . '/widgets/');
define('THEME_INCLUDES', TEMPLATEPATH . '/includes/');
define('THEME', 'Pixelhaven');
define('THEME_CDN', 'http://pixelhavenllc.s3.amazonaws.com');
//define('THEME_DIR', 'http://pixelhavenllc.s3.amazonaws.com/wp-content/themes/pixelhaven');
define('THEME_DIR', get_bloginfo('template_directory'));
define('THEME_DOCS', THEME_DIR.'/functions/docs/docs.pdf');
define('THEME_LOGO', THEME_DIR.'/functions/img/logo.png');
define('THEME_MAINMENU_NAME', 'general-options');
define('THEME_VERSION', $theme_version);

//Load widgets
	require_once (THEME_WIDGETS . 'contact-form.php');
	require_once (THEME_WIDGETS . 'latest-portfolio.php');

//Load WP3 features:
	require_once (THEME_FUNCTIONS . 'register-wp3.php');
	
//Load all-purpose functions:
	require_once (THEME_FUNCTIONS . 'custom-functions.php');

//Register widget areas:
	require_once (THEME_FUNCTIONS . 'register-widgets.php');

	
//Load admin specific files:
if (is_admin()) :
	require_once (THEME_FUNCTIONS . 'admin-helper.php');
	require_once (THEME_FUNCTIONS . 'ajax-image.php');
	require_once (THEME_FUNCTIONS . 'generate-meta-box.php');
	require_once (THEME_FUNCTIONS . 'generate-options.php');
	require_once (THEME_FUNCTIONS . 'generate-slider.php');
	require_once (THEME_FUNCTIONS . 'include-options.php');
	require_once (THEME_FUNCTIONS . 'include-meta-boxes.php');
endif;


//Add admin styles/scripts:
add_action('admin_head', 'theme_admin_head');

//Add scripts to header
if ( !is_admin() ) {
          wp_enqueue_script('modernizr', THEME_DIR.'/assets/js/modernizr.custom.85112.js');
          wp_enqueue_script( 'comment-reply' );
}


//Add support for WP 3.0 features, thumbnails etc
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'menus' );
	add_theme_support( 'automatic-feed-links' );

//Post thumbnail sizes
	add_image_size( 'theme_thumb', 270, 170, true );
  add_image_size( 'footer_thumb', 260, 120, true );
  add_image_size( 'portfolio_thumb', 199, 137, true );
	
//Add translation support
	load_theme_textdomain( 'latest', TEMPLATEPATH . '/language' );

// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Top navigation', 'latest' ) );

// Add support for a variety of post formats
	add_theme_support( 'post-formats', array( 'video', 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );


//Register Widgets
add_action( 'widgets_init', 'theme_load_widgets' );
function theme_load_widgets() {
	register_widget( 'Theme_Contact' );
	register_widget( 'Theme_Latest_Portfolio' );
}



//Remove shortcodes from excerpt and excerpt-RSS
function theme_remove_shortcodes($content) {
	$content = strip_shortcodes( $content );
	return $content;
}
add_filter('the_excerpt_rss', 'theme_remove_shortcodes');
add_filter('the_excerpt', 'theme_remove_shortcodes');

// Custom excerpt "more"
function theme_auto_excerpt_more( $more ) {
	return '&hellip;</p><p><a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyten' ) . '</a></p>';
}

add_filter( 'excerpt_more', 'theme_auto_excerpt_more' );

function custom_excerpt_length( $length ) {
	return 18;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

//Add shortcode support to Widgets
add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');

//Remove WordPress Versio Metatag
remove_action('wp_head', 'wp_generator');