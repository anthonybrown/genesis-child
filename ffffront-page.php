<?php
/**
 * Tony's Child Theme Genesis Child.
 *
 * @package      EAGenesisChild
 * @since        1.0.0
 * @copyright    Copyright (c) 2014, Contributors to EA Genesis Child project
 * @license      GPL-2.0+
 */


function be_home_rotator() {
	$slides = get_post_meta( get_the_ID(), 'be_slide', true );
	if( $slides ) {
		echo '<div class="home-rotator"><div class="wrap"><div class="flexslider"><ul class="slides">';
		for( $i = 0; $i < $slides; $i++ ) {
			$image = wp_get_attachment_image( get_post_meta( get_the_ID(), 'be_slide_' . $i . '_image', true ), 'be_slide' );
			$title = esc_attr( get_post_meta( get_the_ID(), 'be_slide_' . $i . '_title', true ) );
			$button_link = esc_url( get_post_meta( get_the_ID(), 'be_slide_' . $i . '_button_link', true ) );
			if( $title ) {
				if( $button_link )
					$title = '<a href="' . $button_link . '">' . $title . '</a>';
				$title = '<h2>' . $title . '</h2>';
			}
			$content = get_post_meta( get_the_ID(), 'be_slide_' . $i . '_content', true );
			$button_text = esc_attr( get_post_meta( get_the_ID(), 'be_slide_' . $i . '_button_text', true ) );
			$button = $button_text && $button_link ? '<p><a href="' . $button_link . '" class="button">' . $button_text . '</a></p>' : '';
			$bg = get_post_meta( get_the_ID(), 'be_slide_' . $i . '_bg', true );
			$class = $bg ? 'slide-caption white-bg' : 'slide-caption';

			echo '<li>' . $image . '<span class="caption-wrapper"><span class="' . $class . '">' . $title . wpautop( $content ) . $button . '</span></span></li>';
		}
		echo '</ul></div></div></div>';
	}

}
add_action( 'be_content_area', 'be_home_rotator' );

// Remove 'site-inner' from structural wrap
add_theme_support( 'genesis-structural-wraps', array( 'header', 'footer-widgets', 'footer' ) );

// Build the page
get_header();
do_action( 'be_content_area' );
get_footer();
