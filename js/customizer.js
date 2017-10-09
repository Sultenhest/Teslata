/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
				$( '.site-footer a, .site-footer h1, .site-footer h2, .site-footer h3, .site-footer h4, .site-footer h5, .site-footer h6, .site-footer .h1, .site-footer .site-footer .h2, .site-footer .h3, .site-footer .h4, .site-footer .h5, .site-footer .h6, .site-footer.site-footer  .page-header .page-title, .site-footer .entry-header .entry-title, .site-footer h2.widget-title, .site-footer caption' ).css( {
					'color': to
				} );
			}
		} );
	} );

	// Main color scheme
	wp.customize( 'teslata_main_color', function( value ) {
		value.bind( function( to ) {
			$( '#content a, #content h1, #content h2, #content h3, #content h4, #content h5, #content h6, .h1, .h2, .h3, .h4, .h5, .h6, .page-header .page-title, .entry-header .entry-title, h2.widget-title' ).css( {
				'color': to
			} );
			
			$( 'blockquote' ).css( {
				'border-left': '5px solid ' + to
			} );
			
			$( '#totop, #masthead, #site-navigation ul .menu-item-has-children .sub-menu, #fixed, .page-links a, .more-link, .entry-footer .post-edit-link, #portfolio-categories, .widget .tagcloud a' ).css( {
				'background-color': to
			} );
		} );
	} );
	
	wp.customize( 'teslata_custom_main_color', function( value ) {
		value.bind( function( to ) {
			$( '#content a, #content h1, #content h2, #content h3, #content h4, #content h5, #content h6, .h1, .h2, .h3, .h4, .h5, .h6, .page-header .page-title, .entry-header .entry-title, h2.widget-title' ).css( {
				'color': to
			} );
			
			$( 'blockquote' ).css( {
				'border-left': '5px solid ' + to
			} );
			
			$( '#totop, #masthead, #site-navigation ul .menu-item-has-children .sub-menu, #fixed, .page-links a, .more-link, #portfolio-categories, .grid figcaption, .widget .tagcloud a' ).css( {
				'background-color': to
			} );
		} );
	} );
	
	// Social Icon Sizes
	wp.customize( 'teslata_social_icon_size', function( value ) {
		value.bind( function( to ) {
			$( '.social-icons a img' ).height( to );
		} );
	} );
} )( jQuery );
