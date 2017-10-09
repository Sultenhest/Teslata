<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Teslata
 */

if ( ! function_exists( 'teslata_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function teslata_posted_on() {
	if ( 'post' === get_post_type() && teslata_display_meta( get_theme_mod( 'teslata_display_author', 1 ) ) ) :
		$byline = sprintf(
			get_avatar( get_the_author_meta( 'ID' ) ) . ' %s',
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);
	
	  echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
	endif;
	
	if ( 'post' === get_post_type() && teslata_display_meta( get_theme_mod( 'teslata_display_date', 1 ) ) ) :
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time> | <time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			_x( '<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> %s', 'post date', 'teslata' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
	endif;

	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) :
	  if ( teslata_display_meta( get_theme_mod( 'teslata_display_read_time', 1 ) ) ) :
	  	printf( '<span class="read-time">' . __( '<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> %1$s', 'teslata' ) . '</span>', '<p>' . teslata_time_to_read( get_the_ID() ) . ' minute read</p>' );
	  endif;
	
	  if ( teslata_display_meta( get_theme_mod( 'teslata_display_categories', 1 ) ) ) :
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'teslata' ) );
			if ( $categories_list && teslata_categorized_blog() ) {
				printf( '<span class="cat-links">' . __( '<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> %1$s', 'teslata' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}
	  endif;
		
	  if ( teslata_display_meta( get_theme_mod( 'teslata_display_tags', 1 ) ) ) :
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'teslata' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">' . __( '<span class="glyphicon glyphicon-tags" aria-hidden="true"></span> %1$s', 'teslata' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
	  endif;
	endif;
	
	if ( 'jetpack-portfolio' === get_post_type() ) :
	  $categories_list = get_the_term_list( get_the_ID(), 'jetpack-portfolio-type', '', ', ', '' );
		if ( $categories_list && teslata_categorized_blog() ) {
			printf( '<span class="cat-links">' . __( '<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> %1$s', 'teslata' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}
	
	  $tags_list = get_the_term_list( get_the_ID(), 'jetpack-portfolio-tag', '', ', ', '' );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . __( '<span class="glyphicon glyphicon-tags" aria-hidden="true"></span> %1$s', 'teslata' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	endif;
}
endif;

if ( ! function_exists( 'teslata_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the comments.
 */
function teslata_entry_footer() {
	if ( get_theme_mod( 'teslata_display_comments', true ) ) :
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
			echo '<span class="comments-link"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> ';
			/* translators: %s: post title */
			comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'teslata' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
			echo '</span>';
		endif;
	endif;
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function teslata_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'teslata_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'teslata_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so teslata_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so teslata_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in teslata_categorized_blog.
 */
function teslata_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'teslata_categories' );
}
add_action( 'edit_category', 'teslata_category_transient_flusher' );
add_action( 'save_post',     'teslata_category_transient_flusher' );

/**
 * Post Navigation
 */
function teslata_custom_post_nav(){
	$navigation = '';
	$previous   = get_previous_post_link( '<div class="row clearfix"><div class="nav-previous col-sm-6">%link</div>', '<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>%title', true );
	$next       = get_next_post_link( '<div class="nav-next col-sm-6">%link</div></div>', '%title<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>', true );

	if ( $previous || $next ) :
		$navigation = _navigation_markup( $previous . $next, 'post-navigation' );
	endif;
	
	echo $navigation;
}

function teslata_custom_post_page_nav(){
	$prev_link = get_previous_posts_link( __( 'Newer posts', 'teslata' ) . '<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>' );
	$next_link = get_next_posts_link( __( '<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Older posts', 'teslata' ) );
	
	if ( $prev_link || $next_link ) :
		echo '<div class="row clearfix post-navigation">';
			echo '<div class="nav-previous col-sm-6">';
				echo $next_link;
			echo '</div>';
			echo'<div class="nav-next col-sm-6">';
				echo $prev_link;
			echo '</div>';
		echo '</div>';
  endif;
}

/**
 * image.php Navigation
 */
function teslata_custom_image_nav(){
	echo '<nav id="image-navigation" class="navigation post-navigation" role="navigation">';
		echo '<div class="nav-links">';
	    echo '<div class="row clearfix">';
				echo '<div class="nav-previous col-sm-6">';
	        echo previous_image_link( false, '<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>' . __( 'Previous Image', 'teslata' ) );
        echo '</div>';

				echo '<div class="nav-next col-sm-6">';
	        echo next_image_link( false, __( 'Next Image', 'teslata' ) . '<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>' );
				echo '</div>';
	    echo '</div>';
	  echo '</div><!-- .nav-links -->';
	echo '</nav><!-- .image-navigation -->';
}

/**
 * Portfolio Navigation
 */
function teslata_custom_project_nav(){
	$prev = '';
	$next = '';

	$prev_post = get_adjacent_post( false, '', false );
	$next_post = get_adjacent_post( false, '', true );

	if ( get_permalink() != get_permalink( $prev_post ) ) :
		$prev = sprintf(
			'<div class="row clearfix"><div class="nav-previous col-sm-6"><a href="%s" class="prev page-numbers">%s</a></div>',
			esc_url( get_permalink( $prev_post->ID ) ),
			'<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> ' . get_the_title( $prev_post->ID )
		);
	else :
	  $prev = '<div class="row clearfix"><div class="nav-previous col-sm-6"></div>';
	endif;
	
	if ( get_permalink() != get_permalink( $next_post ) ) :
		$next = sprintf(
			'<div class="nav-next col-sm-6"><a href="%s" class="next page-numbers">%s</a></div></div>',
			esc_url( get_permalink( $next_post->ID ) ),
			get_the_title( $next_post->ID ) . '<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>'
		);
	else :
	  $next = '<div class="nav-next col-sm-6"></div></div>';
	endif;
	
	if ( $prev || $next ) :
		echo _navigation_markup( $prev . $next, 'post-navigation' ); // WPCS: XSS OK.
	endif;
}

function teslata_custom_portfolio_page_nav( $max_num_pages ){
	$prev_link = get_previous_posts_link( __( 'Newer projects', 'teslata' ) . '<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>', $max_num_pages );
	$next_link = get_next_posts_link( '<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>' . __( 'Older projects', 'teslata' ), $max_num_pages );
	
	if ( $prev_link || $next_link ) :
		echo '<div id="portfolio-nav" class="col-md-12"><div class="row clearfix post-navigation">';
			echo '<div class="nav-previous col-sm-6">';
				echo $next_link;
			echo '</div>';
			echo'<div class="nav-next col-sm-6">';
				echo $prev_link;
			echo '</div>';
		echo '</div></div>';
  endif;
}

function teslata_get_portfolio_categories(){
	$return = '';
	$terms = get_terms( 'jetpack-portfolio-type' );

	foreach ( $terms as $term ) {
		$term_link = get_term_link( $term );

		// If there was an error, continue to the next term.
		if ( is_wp_error( $term_link ) ) :
			continue;
		endif;

		$return .= '<a href="' . esc_url( $term_link ) . '">' . $term->name . '</a>';
	}

	return $return;
}