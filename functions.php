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
  wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:700|Raleway:300', array(), CHILD_THEME_VERSION );
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

#remove_action('genesis_entry_header', 'genesis_post_info', 12);
#add_action('genesis_entry_header', 'my_custom_function', 9);

#function my_custom_function ()
#{
#  echo 'Howdy!';
#}

//* remove post meta from footer
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

//* add post meta under the post meta header info
add_action( 'genesis_entry_header', 'genesis_post_meta', 13 );


# this places our info above the title because it has a lower priority of 9, default is 10
#add_action('genesis_entry_header', 'genesis_post_info', 9);

#remove_action('genesis_entry_header', 'genesis_do_post_title');

// Remove the site description
#remove_action ( 'genesis_site_description', 'genesis_seo_site_description' );


// Filter the comments
add_filter('genesis_title_comments', 'my_title_comments');

// function to filter the comments
function my_title_comments()
{
  $title='<h3>Check out the comments!</h3>';
  return $title;
}

remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );




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

//* Customize the entire footer
remove_action( 'genesis_footer', 'genesis_do_footer' );

add_action( 'genesis_footer', 'sp_custom_footer' );
function sp_custom_footer() {
	echo '<p>Pro Audio Distribution. All rights reserverd Copyright &copy; 2014</p>';
}

