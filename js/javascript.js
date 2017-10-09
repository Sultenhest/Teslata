$j = jQuery.noConflict();
	
( function( $j ) {
  ( function() {
		// Fix embeds if JetPack is installed but embed is not active
		$j( '.youtube-player' ).parent( 'p' ).addClass( 'youtube-player-parent' );
		$j( 'iframe' ).parent( 'p' ).addClass( 'youtube-player-parent' );
		
    // Fixed menu on
    var mastheadHeight = $j( '#masthead' ).height();
    $j( '#fixed' ).data( 'offset-top', mastheadHeight );
	
    // Smooth Scroll to Top button
    $j( '#totop' ).click( function() {
		  $j( 'html, body' ).animate( { scrollTop : 0 }, 450 );
      return false;
    });
		
		// Hover Drop Down
    $j( '#primary-menu .menu-item-has-children' ).hover( function() {
        $j( this ).children( '.sub-menu' ).slideToggle( 200 );
      },
      function() {
        $j( this ).children( '.sub-menu' ).slideUp( 200 );
    });
	
	  // Mobile Menu
	  $j( '.mobile-nav' ).click( function() {
      $j( 'body' ).toggleClass( 'overflow-hidden' );
      $j( '#site-navigation #mobile-menu' ).slideToggle( 300 );
      $j( this ).find( 'span' ).toggleClass( 'glyphicon-menu-hamburger' ).toggleClass( 'glyphicon-remove' );
      $j( '.mobile-nav' ).toggleClass( 'pull-to-top-corner' );
    });
		
    // Mobile Menu & Widget Menu
    var dropdownToggle = '<button class="drop-down-button"><span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span></button>';
    $j( '#mobile-menu'     ).find( '.menu-item-has-children > a' ).after( dropdownToggle );
    $j( '.widget_nav_menu' ).find( '.menu-item-has-children > a' ).after( dropdownToggle );
    $j( '.widget_pages'    ).find( '.page_item_has_children > a' ).after( dropdownToggle );
		
    // Toggle Menu Arrows
    $j( '.drop-down-button' ).click( function() {
      $j( this ).find( 'span' ).toggleClass( 'glyphicon-menu-down' ).toggleClass( 'glyphicon-menu-up' );
      $j( this ).siblings( '.sub-menu, .children' ).toggle();
    });
	} )();
	
  $j( document ).ready( function() {
    // Owl Carousel
    $j( '.owl-carousel' ).owlCarousel( {
      items: 1,
      loop: true,
      nav: true,
      navText:[ '<span class="glyphicon glyphicon-menu-left"></span>' ,
                '<span class="glyphicon glyphicon-menu-right"></span>' ]
    } );
  } );
	
  $j( document ).scroll( function() {
    // Mobile navigation title
    if ( $j( '#fixed' ).hasClass( 'affix' ) ) {
      $j( '#mobile-site-title' ).show();
    } else {
      $j( '#mobile-site-title' ).hide();
    }
	
    // Fade To Top button in
    if ( $j( this ).scrollTop() > $j( '#masthead' ).height()  ) {
      $j( '#totop' ).fadeIn();
    } else {
      $j( '#totop' ).fadeOut();
    }
  } );
} )( jQuery );