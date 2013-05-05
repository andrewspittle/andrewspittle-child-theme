<?php
/**
 * Andrew Spittle functions and definitions
 *
 * @package Andrew Spittle
 * @since Andrew Spittle 1.0
 */
 
if ( ! function_exists( 'andrewspittle_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Andrew Spittle 1.0
 */
function andrewspittle_setup() {
	/**
	 * Register custom image size for book covers
	 */
	add_image_size( 'book-cover', 9999, 250 ); //200 pixels wide, 150 pixels tall, cropped
}
endif; // andrewspittle_setup
add_action( 'after_setup_theme', 'andrewspittle_setup' );
 
/**
 * Enqueue scripts and styles
 */
function andrewspittle_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri(), '', '20130505-1' );
}
add_action( 'wp_enqueue_scripts', 'andrewspittle_scripts' );

if ( ! function_exists( 'andrewspittle_posted_on' ) ) :
/**
 * Custom posted_on function to include on single book pages.
 */
function andrewspittle_posted_on() {
	printf( __( '<time class="entry-date" datetime="%1$s" pubdate>%2$s</time>', 'andrewspittle' ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
}
endif;

?>