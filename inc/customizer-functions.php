<?php
/**
 * Assemble data output based on Customizer selections.
 *
 * @package Teslata
 */

/**
 * Adding custom css to wp_head
 */
function teslata_customize_css() {
  ?>
  <style type="text/css">
		<?php
      $theme_main_color = esc_attr( get_theme_mod( 'teslata_main_color', '#03A9F4' ) );
	
      if ( get_theme_mod( 'teslata_custom_color_scheme' ) ) :
	      $theme_main_color = esc_attr( get_theme_mod( 'teslata_custom_main_color' ) );
      endif;
	  ?>
		
    a, h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6,
    .page-header .page-title, .entry-header .entry-title, h2.widget-title{
      color: <?php echo $theme_main_color; ?>;
    }

    blockquote{
      border-color: <?php echo $theme_main_color; ?>;
    }

    #totop, #masthead, #site-navigation ul .menu-item-has-children .sub-menu, #fixed, 
    .page-links a, .more-link, .entry-footer .post-edit-link, #portfolio-categories,
		.widget .tagcloud a, .contact-submit input[type='submit']{
      background-color: <?php echo $theme_main_color; ?>;
    }
		
		body.custom-background{
			background-size: cover;
			background-repeat: no-repeat;
		}
		
		<?php
	    if ( in_array( get_theme_mod( 'teslata_widget_card', 1 ), array( 1, 2 ) ) ) :
		?>
		  @media screen and (min-width: 991px) {
		  	#secondary .widget,
				#left-secondary .widget,
				#search-secondary .widget{
					background-color: #fff;
					margin-bottom: 15px;
					border-radius: 2px;
					-webkit-box-shadow: 0px 2px 2px 0px rgba(0,0,0,0.26);
						 -moz-box-shadow: 0px 2px 2px 0px rgba(0,0,0,0.26);
									box-shadow: 0px 2px 2px 0px rgba(0,0,0,0.26);
				}

				#secondary .widget .widget-title:first-child,
				#left-secondary .widget .widget-title:first-child,
				#search-secondary .widget .widget-title:first-child{
					margin-top: 20px;
				}
			}
		<?php
	    endif;

			if ( in_array( get_theme_mod( 'teslata_widget_card', 1 ), array( 1, 3 ) ) ) :
		?>
		  @media screen and (max-width: 992px) {
				#secondary .widget,
				#left-secondary .widget,
				#search-secondary .widget{
					background-color: #fff;
					margin-bottom: 15px;
					border-radius: 2px;
					-webkit-box-shadow: 0px 2px 2px 0px rgba(0,0,0,0.26);
						 -moz-box-shadow: 0px 2px 2px 0px rgba(0,0,0,0.26);
									box-shadow: 0px 2px 2px 0px rgba(0,0,0,0.26);
				}

				#secondary .widget .widget-title:first-child,
				#left-secondary .widget .widget-title:first-child,
				#search-secondary .widget .widget-title:first-child{
					margin-top: 20px;
				}
		  }
		<?php
			endif;
		?>
		
		.site-footer a, .site-footer h1, .site-footer h2, .site-footer h3, .site-footer h4,
		.site-footer h5, .site-footer h6, .site-footer .h1, .site-footer .site-footer .h2,
		.site-footer .h3, .site-footer .h4, .site-footer .h5, .site-footer .h6,
    .site-footer.site-footer  .page-header .page-title, .site-footer .entry-header .entry-title,
		.site-footer h2.widget-title, .site-footer caption{
      color: #<?php echo get_theme_mod( 'header_textcolor', 'FFFFFF' ) ?>;
    }
		
		.social-icons a img{ height: <?php echo get_theme_mod( 'teslata_social_icon_size', '32' ); ?>px; }
  </style>
  <?php
}
add_action( 'wp_head', 'teslata_customize_css');

/**
 * Header Owl Slider
 */
function teslata_header_owl_slider() {
	if ( is_front_page() ) :
	  
	  $images = array();
	
		foreach ( get_uploaded_header_images() as $image_array ) :
			$images[] = $image_array['url'];
		endforeach;
	
	  if ( get_theme_mod( 'teslata_use_owl' ) ) :
	    echo '<div class="owl-carousel col-md-12">';
	
	      if ( get_theme_mod( 'teslata_owl_use_portfolio' ) ) :
	
					$r = new WP_Query( apply_filters( 'widget_posts_args', array(
						'post_type'           => 'jetpack-portfolio', 
						'posts_per_page'      => get_theme_mod( 'teslata_owl_portfolio_items' ),
						'no_found_rows'       => true,
						'post_status'         => 'publish',
						'ignore_sticky_posts' => true,
						'meta_query'          => array( array( 'key' => '_thumbnail_id' ) )
					) ) );

					if ($r->have_posts()) :
						while ( $r->have_posts() ) : $r->the_post();
							echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
								the_post_thumbnail( 'teslata_blog_thumb', array( 'class' => 'img-responsive' ) );
							echo '</a>';
						endwhile;

						wp_reset_postdata();
					endif;
	      
	      else :
	
	        if ( count( $images ) > 1 ) :
	          foreach ( $images as $image ) :
							echo '<img src="' . $image . '" class="img-responsive" alt="' . get_bloginfo( 'title' ) . '">';
						endforeach;
	        endif;
	
	      endif;
	    echo '</div>';
	  else :
	    if ( get_header_image() ) :
	      echo '<img src="' . get_header_image() . '" alt="' .  get_bloginfo( 'title' ) . '" class="col-sm-12 img-responsive header-img">';
	    endif;
	  endif;
	
	endif;
}

/**
 * Determinating #primary width depending on sidebar position chosen in the customizer
 */
function teslata_primary_width() {
  switch ( get_theme_mod( 'teslata_sidebar_options', 'default' ) ) {
		case 'left':
			echo 'col-md-9 col-md-push-3';    break;
		case 'both':
			echo 'col-md-6 col-md-push-3';    break;
		case 'double-right':
			echo 'col-md-6';                  break;
		case 'double-left':
			echo 'col-md-6 col-md-push-6';    break;
		case 'none':
			echo 'col-md-10 col-md-offset-1'; break;
		default:
			echo 'col-md-9';
	}	
}

/**
 * Display Post Meta
 */
function teslata_display_meta( $option ) { 
	if( $option == 2 ) :
		return ! is_single();
	endif;
	
	if( $option == 3 ) :
		return is_single();
	endif;
	
	if( $option == 4 ) :
		return false;
	endif;
	
	return true;
}

/**
 * Blog post entry-meta width
 */
function teslata_get_post_meta_width() {
	$teslata_metas = array( 'author', 'date', 'read_time', 'categories', 'tags' );
	
	if ( is_single() ) :
	  foreach( $teslata_metas as $meta ) :
	    if ( in_array( get_theme_mod( 'teslata_display_' . $meta , 1 ), array( 1, 3 ) ) ) :
	      return 'col-sm-3';
	    endif;
	  endforeach;
	
	  return 'hidden';
	endif;
	
	if ( get_theme_mod( 'teslata_display_comments', true ) && get_comments_number() != 0 ) :
	  return 'col-sm-3';
	endif; 
	
	foreach( $teslata_metas as $meta ) :
		if ( in_array( get_theme_mod( 'teslata_display_' . $meta , 1 ), array( 1, 2 ) ) ) :
			return 'col-sm-3';
		endif;
	endforeach;

	return 'hidden';
}

/**
 * Get blog post or page width
 */
function teslata_get_list_content_width() {
	if ( get_post_type() == 'page' ) :
		return 'col-sm-12';
	else :
	  if ( teslata_get_post_meta_width() == 'col-sm-3' ) :
		  return 'col-sm-9';
	  endif;
	    return 'col-sm-12';
	endif;
}

/**
 * Loop through social icons
 */
function teslata_social_icons() {
	$socials = array( 'facebook', 'twitter', 'linkedin', 'pinterest', 'google_plus', 'tumblr',
										'instagram', 'flickr', 'youtube', 'dribbble', 'soundcloud', 'envato',
										'behance', 'vimeo', 'wordpress', 'deviantart', 'evernote', 'blogger' );

	echo '<div class="social-icons col-md-12 text-center">';

		foreach ( $socials as $item ) {
			if ( get_theme_mod( 'teslata_' . $item ) ) :
				$capitalize = ucwords( str_replace( '_', ' ', $item ) );

				echo '<a href="' . esc_url( get_theme_mod( 'teslata_' . $item ) ) . '" target="_blank" title="' . $capitalize . '">';
					echo '<img src="' . esc_url( get_template_directory_uri() ) . '/images/social/' . $item . '.png" alt="' . $capitalize . '" title="' . $capitalize . '">';
				echo '</a>';
			endif;
		}

	echo '</div>';
}

/**
 * Display Footer Info Or Not
 */
function teslata_footer_site_info() {
	if ( get_theme_mod( 'teslata_footer_info' ) ) : ?>
		<div class="site-info col-md-12 text-center">
			<?php printf( esc_html__( 'Theme %1$s by %2$s', 'teslata' ), '<a href="https://wordpress.org/themes/teslata/" rel="theme">Teslata</a>', '<a href="https://www.sultenhest.dk" rel="author">Sultenhest</a>' ); ?>
		</div><!-- .site-info -->
  <?php
	endif;
}