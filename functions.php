<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Genesis Sample Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/' );
define( 'CHILD_THEME_VERSION', '2.1.2' );

//* Enqueue Google Fonts
add_action( 'wp_enqueue_scripts', 'genesis_sample_google_fonts' );

function genesis_sample_google_fonts()
{
  wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:700|Raleway:300,700', array(), CHILD_THEME_VERSION );
}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* add superfish menu
#add_filter( 'genesis_superfish_enabled', '__return_true' );

//* remove post meta from footer
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

//* add post meta under the post meta header info
add_action( 'genesis_entry_header', 'genesis_post_meta', 13 );

// Filter the comments
add_filter('genesis_title_comments', 'my_title_comments');

// function to filter the comments
function my_title_comments()
{
  $title='<h3>Check out the comments!</h3>';
  return $title;
}

remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

# resize attachment page image to large
add_filter('prepend_attachment', 'ag_prepend_attachment');
function ag_prepend_attachment($p) {
    return '<p class="attachment">'.wp_get_attachment_link(0, 'large', false).'</p>';
}

// Enqueue home.js script
//add_action( 'wp_enqueue_scripts', 'home' );
//function home()
//{
//  wp_enqueue_script( 'home', get_stylesheet_directory_uri() . '/js/home.js', array( 'jquery' ), '1.0', true );
//}


// Enqueue To Top script
add_action( 'wp_enqueue_scripts', 'to_top_script' );
function to_top_script()
{
  wp_enqueue_script( 'to-top', get_stylesheet_directory_uri() . '/js/to-top.js', array( 'jquery' ), '1.0', true );
}

// Add To Top button
add_action( 'genesis_before', 'genesis_to_top');

function genesis_to_top()
{
    echo '<a href="#0" class="to-top" title="Back To Top">Top</a>';
}


/**
 * Portfolio Template for Taxonomies
 *
 */
function be_portfolio_template( $template ) {
  if( is_tax( array( 'portfolio_category', 'portfolio_tag' ) ) )
    $template = get_query_template( 'archive-portfolio' );
  return $template;
}
add_filter( 'template_include', 'be_portfolio_template' );

/**
 * Add 'page-attributes' to Portfolio Post Type
 *
 * @param array $args, arguments passed to register_post_type
 * @return array $args
 */
function be_portfolio_post_type_args( $args ) {
	$args['supports'][] = 'page-attributes';
	return $args;
}
add_filter( 'portfolioposttype_args', 'be_portfolio_post_type_args' );

/**
 * Sort projects by menu order
 *
 */
function be_portfolio_query( $query ) {
  if( $query->is_main_query() && !is_admin() && ( is_post_type_archive( 'portfolio' ) || is_tax( array( 'portfolio_category', 'portfolio_tag' ) ) ) ) {
    $query->set( 'orderby', 'menu_order' );
    $query->set( 'order', 'ASC' );
  }
}
add_action( 'pre_get_posts', 'be_portfolio_query' );

/**
 * Remove Genesis widgets.
 *
 * @since 1.0.0
 */
function ea_remove_genesis_widgets() {
    unregister_widget( 'Genesis_Featured_Page' );
    unregister_widget( 'Genesis_Featured_Post' );
    unregister_widget( 'Genesis_User_Profile_Widget' );
}
add_action( 'widgets_init', 'ea_remove_genesis_widgets', 20 );

//* Customize the entire footer
remove_action( 'genesis_footer', 'genesis_do_footer' );

add_action( 'genesis_footer', 'sp_custom_footer' );
function sp_custom_footer() {
	echo '<p>Pro Audio Distribution. All rights reserverd Copyright &copy; 2014</p>';
}
