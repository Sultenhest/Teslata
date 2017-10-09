<?php
/**
 * A file dedicated to the excerpt handling
 *
 * @package Teslata
 */

/**
 * Create more link
 */
function teslata_excerpt_more( $more ) {
  global $post;
  return '<a href="'. get_permalink($post->ID) . '" class="more-link" rel="bookmark">' . __( 'Continue Reading', 'teslata' ) . '</a>';
}
add_filter( 'the_content_more_link', 'teslata_excerpt_more', 100 );

/**
 * Allow tags & length
 */
function teslata_wpse_allowedtags() {
  return '<a>, <audio>, <br>, <em>, <h1>, <h2>, <h3>, <h4>, <h5>, <h6>, <i>, <img>, <li>, <ol>, <p>, <script>, <style>, <ul>, <video>'; 
}

if ( ! function_exists( 'teslata_wpse_custom_wp_trim_excerpt' ) ) :
  function teslata_wpse_custom_wp_trim_excerpt( $wpse_excerpt ) {
  $raw_excerpt = $wpse_excerpt;
  if ( '' == $wpse_excerpt ) {

    $wpse_excerpt = get_the_content('');
    $wpse_excerpt = strip_shortcodes( $wpse_excerpt );
    $wpse_excerpt = apply_filters( 'the_content', $wpse_excerpt );
    $wpse_excerpt = str_replace( ']]>', ']]&gt;', $wpse_excerpt );
    $wpse_excerpt = strip_tags( $wpse_excerpt, teslata_wpse_allowedtags() ); /*IF you need to allow just certain tags. Delete if all tags are allowed */

    //Set the excerpt word count and only break after sentence is complete.
    $excerpt_word_count = 75;
    $excerpt_length = apply_filters( 'excerpt_length', $excerpt_word_count ); 
    $tokens = array();
    $excerptOutput = '';
    $count = 0;

    // Divide the string into tokens; HTML tags, or words, followed by any whitespace
    preg_match_all( '/(<[^>]+>|[^<>\s]+)\s*/u', $wpse_excerpt, $tokens );

      foreach ( $tokens[0] as $token ) { 

        if ( $count >= $excerpt_length && preg_match('/[\,\;\?\.\!]\s*$/uS', $token ) ) { 
          // Limit reached, continue until , ; ? . or ! occur at the end
          $excerptOutput .= trim( $token );
          break;
        }

        // Add words to complete sentence
        $count++;

        // Append what's left of the token
        $excerptOutput .= $token;
      }

      $wpse_excerpt = trim( force_balance_tags( $excerptOutput ) );

      $excerpt_end = '<a href="' . esc_url( get_permalink() ) . '" class="more-link pull-right" rel="bookmark">' . __( 'Continue Reading', 'teslata' ) . '</a>';
      $excerpt_more = apply_filters( 'excerpt_more', ' ' . $excerpt_end ); 

      $wpse_excerpt .= $excerpt_more;

      return $wpse_excerpt;   

    }
  return apply_filters( 'teslata_wpse_custom_wp_trim_excerpt', $wpse_excerpt, $raw_excerpt );
 }
endif; 

remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );
add_filter( 'get_the_excerpt', 'teslata_wpse_custom_wp_trim_excerpt' ); 