<?php
/**
 * Custom functions for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Teslata
 */

function teslata_left_sidebar_position() {
	if ( get_page_template_slug() != '' || is_single() || is_page() ) {
		//Single blog posts or pages
		if ( get_page_template_slug() == 'template-parts/content-bothside-sidebar-page.php' ||
			   get_page_template_slug() == 'template-parts/content-double-left-sidebar-page.php' ) {
			return 'col-md-pull-6';
		}

		if ( get_page_template_slug() == 'template-parts/content-left-page.php' ) {
			return 'col-md-pull-9';
		}
		
		if ( get_page_template_slug() == '' && is_single() ) {
			return teslata_left_sidebar_pull();
		}

		return '';
	} elseif ( is_front_page() && is_home() || is_archive() || is_search() ) {
		//If blogpage is frontpage or archive/search page
		return teslata_left_sidebar_pull();
	} elseif ( is_front_page() ) {
		return '';
	} elseif ( is_home() || is_archive() || is_search() ) {
		//If blogpage is not frontpage or archive/search page
		return teslata_left_sidebar_pull();
	} else {
		return '';
	}
}

function teslata_left_sidebar_pull() {
	if ( get_theme_mod( 'teslata_sidebar_options', 'default' ) == 'both' ||
			 get_theme_mod( 'teslata_sidebar_options', 'default' ) == 'double-left' ) {
		return 'col-md-pull-6';
	}

	if ( get_theme_mod( 'teslata_sidebar_options', 'default' ) == 'left' ) {
		return 'col-md-pull-9';
	}
	
	return '';
}

function teslata_right_sidebar_position() {
	if ( is_front_page() && is_home() || is_archive() || is_search() ) {
		if ( get_theme_mod( 'teslata_sidebar_options', 'default' ) == 'double-left' ) {
			return 'col-md-pull-6';
		}
	} else if ( is_home() || is_archive() || is_search() ) {
		if ( get_theme_mod( 'teslata_sidebar_options', 'default' ) == 'double-left' ) {
			return 'col-md-pull-6';
		}
	} else if ( is_singular() && 
						  get_page_template_slug() == 'template-parts/content-double-left-sidebar-page.php' ) {
		return 'col-md-pull-6';
	} else if ( get_page_template_slug() == '' && is_single() && 
						  get_theme_mod( 'teslata_sidebar_options', 'default' ) == 'double-left' ) {
		return 'col-md-pull-6';
	}
	return '';
}

function teslata_add_tick_to_sticky() {
	if ( is_sticky() ) :
	  return '<span class="glyphicon glyphicon-pushpin"></span>';
	endif;
	
	return '';
}

function teslata_time_to_read( $post_id ) {
	$content = get_post_field( 'post_content', $post_id );
	$word_count = str_word_count( strip_tags( $content ) );
	
	return ceil( $word_count / 200 );
}