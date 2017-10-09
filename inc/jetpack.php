<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.com/
 *
 * @package Teslata
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 */
function teslata_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'teslata_infinite_scroll_render',
		'footer'    => 'page',
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );
	// Add theme support for Portfolio
	add_theme_support( 'jetpack-portfolio' );
}
add_action( 'after_setup_theme', 'teslata_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function teslata_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
		    get_template_part( 'template-parts/content', 'search' );
		else :
		    get_template_part( 'template-parts/content', get_post_format() );
		endif;
	}
}

/**
 * Adds excerpts to Jetpack Portfolio.
 */
function teslata_jetpack_portfolio_excerpts() {
	if ( post_type_exists( 'jetpack-portfolio' ) ) {
		add_post_type_support( 'jetpack-portfolio', 'excerpt' );
	}
}
add_action( 'init', 'teslata_jetpack_portfolio_excerpts' );
