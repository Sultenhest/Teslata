<?php
/**
 * Teslata Theme Customizer.
 *
 * @package Teslata
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function teslata_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->default   = 'FFFFFF';
	$wp_customize->get_setting( 'background_color' )->default   = 'f5f5f5';
	
	/////////////////////////////////////////////////////////////////////////////////////	
	//  =================================
	//  = 0.1 Only show logo mobile nav =
	//  =================================
	$wp_customize->add_setting( 'teslata_logo_mobile_nav', array(
			'default'           => '',
		  'sanitize_callback' => 'teslata_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 'teslata_logo_mobile_nav', array(
	    'label'       => __( 'Only display logo on mobile navigation', 'teslata' ),
	    'section'     => 'title_tagline',
		  'priority'    => '0',
	    'settings'    => 'teslata_logo_mobile_nav',
 		  'type'        => 'checkbox',
  ) );
	
	//  =============================
	//  = 1.1 Site color scheme     =
	//  =============================
	$wp_customize->add_setting( 'teslata_main_color', array(
			'default'           => '#03A9F4',
		  'transport'         => 'postMessage',
		  'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control( 'teslata_main_color', array(
	    'label'       => __( 'Select a color scheme', 'teslata' ),
	    'section'     => 'colors',
		  'priority'    => '0',
	    'settings'    => 'teslata_main_color',
 		  'type'        => 'select',
		 	'choices'     => array(
        '#F44336' => __( 'Red', 'teslata' ),
        '#E91E63' => __( 'Pink', 'teslata' ),
        '#9C27B0' => __( 'Purple', 'teslata' ),
				'#673AB7' => __( 'Deep Purple', 'teslata' ),
				'#3F51B5' => __( 'Indigo', 'teslata' ),
				'#2196F3' => __( 'Blue', 'teslata' ),
				'#03A9F4' => __( 'Light Blue', 'teslata' ),
				'#00BCD4' => __( 'Cyan', 'teslata' ),
				'#009688' => __( 'Teal', 'teslata' ),
				'#4CAF50' => __( 'Green', 'teslata' ),
				'#8BC34A' => __( 'Light Green', 'teslata' ),
				'#CDDC39' => __( 'Lime', 'teslata' ),
				'#FFEB3B' => __( 'Yellow', 'teslata' ),
				'#FFC107' => __( 'Amber', 'teslata' ),
				'#FF9800' => __( 'Orange', 'teslata' ),
				'#FF5722' => __( 'Deep Orange', 'teslata' ),
				'#795548' => __( 'Brown', 'teslata' ),
				'#9E9E9E' => __( 'Grey', 'teslata' ),
				'#607D8B' => __( 'Blue Grey', 'teslata' ),
				'#333333' => __( 'Dark Grey', 'teslata' ),
				'#000000' => __( 'Black', 'teslata' ),
      ),
  ) );
	
	//  =============================
	//  = 1.2 Site color scheme 2   =
	//  =============================
	$wp_customize->add_setting( 'teslata_custom_main_color', array(
			'default'           => get_theme_mod( 'teslata_main_color' ),
		  'transport'         => 'postMessage',
		  'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'teslata_custom_main_color', array(
	    'label'       => __( '.. or create your own color scheme', 'teslata' ),
	    'section'     => 'colors',
		  'priority'    => '0',
	    'settings'    => 'teslata_custom_main_color',
  )));
	
	//  =============================
	//  = 1.3 Use Custom Color      =
	//  =============================
	$wp_customize->add_setting( 'teslata_custom_color_scheme', array(
      'default'           => '',
		  'sanitize_callback' => 'teslata_sanitize_checkbox',
  ));
 
  $wp_customize->add_control( 'teslata_custom_color_scheme', array(
		  'label'       => __( 'Use Custom Color Scheme', 'teslata' ),
      'section'     => 'colors',
		  'priority'    => '0',
      'settings'    => 'teslata_custom_color_scheme',
      'type'        => 'checkbox',
  ));
	
	//  =============================
	//  = 2.1 Use Owl Slider        =
	//  =============================
	$wp_customize->add_setting( 'teslata_use_owl', array(
			'default'           => false,
		  'sanitize_callback' => 'teslata_sanitize_true_false',
	) );
	
	$wp_customize->add_control( 'teslata_use_owl', array(
	    'label'       => __( 'Use Owl Carousel (only applies if multiple images)', 'teslata' ),
	    'section'     => 'header_image',
	    'settings'    => 'teslata_use_owl',
 		  'type'        => 'radio',
		 	'choices'     => array(
					true   => __( 'Yes', 'teslata' ),
					false  => __( 'No', 'teslata' ),
		  ),
  ) );
	
	//  =============================
	//  = 2.2 Use Recent Portfolio  =
	//  =============================
	$wp_customize->add_setting( 'teslata_owl_use_portfolio', array(
			'default'           => false,
		  'sanitize_callback' => 'teslata_sanitize_true_false',
	) );
	
	$wp_customize->add_control( 'teslata_owl_use_portfolio', array(
	    'label'       => __( '(JetPack) Use Recent Portfolio Items instead of Header Images? (if you selected Yes above)', 'teslata' ),
	    'section'     => 'header_image',
	    'settings'    => 'teslata_owl_use_portfolio',
 		  'type'        => 'radio',
		 	'choices'     => array(
					true   => __( 'Yes', 'teslata' ),
					false  => __( 'No', 'teslata' ),
		  ),
  ) );
	
	//  =============================
	//  = 2.3 How many Port items   =
	//  =============================
	$wp_customize->add_setting( 'teslata_owl_portfolio_items', array(
			'default'           => 3,
		  'sanitize_callback' => 'teslata_sanitize_owl_carousel_items',
	) );
	
	$wp_customize->add_control( 'teslata_owl_portfolio_items', array(
	    'label'       => __( '(JetPack) Select how many of the most recent portfolio items to feature in the Owl slider (if you selected Yes above)', 'teslata' ),
	    'section'     => 'header_image',
	    'settings'    => 'teslata_owl_portfolio_items',
 		  'type'        => 'select',
		 	'choices'     => array(
					1   => __( '1', 'teslata' ),
					2   => __( '2', 'teslata' ),
					3   => __( '3', 'teslata' ),
					4   => __( '4', 'teslata' ),
					5   => __( '5', 'teslata' ),
					6   => __( '6', 'teslata' ),
					7   => __( '7', 'teslata' ),
					8   => __( '8', 'teslata' ),
					9   => __( '9', 'teslata' ),
					10  => __( '10', 'teslata' ),
		  ),
  ) );
	
	//  =============================
	//  = 3.0 Theme social options  =
	//  =============================
	$wp_customize->add_section( 'teslata_social_options', array(
			'title'       => __( 'Social Icons', 'teslata' ),
			'description' => __( 'Provide the URL to the social networks you\'d like to display.<br/><br/>
	                  It\'s highly recommended that you copy and paste the whole link like this:
										<b>https://www.facebook.com/facebook?fref=ts</b>', 'teslata' ),
			'priority'    => 200,
	));
	
	//  =============================
	//  = 3.1 Social Icon Size      =
	//  =============================
	$wp_customize->add_setting( 'teslata_social_icon_size', array(
			'default'           => '32',
		  'transport'         => 'postMessage',
		  'sanitize_callback' => 'teslata_sanitize_icon_size',
	));

	$wp_customize->add_control( 'teslata_social_icon_size', array(
		  'label'       => __( 'Social icon size', 'teslata' ),
			'section'     => 'teslata_social_options',
			'settings'    => 'teslata_social_icon_size',
		  'type'        => 'select',
			'choices'     => array(
        8   => __( '8 pixel', 'teslata' ),
        16  => __( '16 pixel', 'teslata' ),
        32  => __( '32 pixel', 'teslata' ),
				64  => __( '64 pixel', 'teslata' ),
				128 => __( '128 pixel', 'teslata' ),
      ),
	));
	
	//  =============================
	//  = 3.2 Social inputs         =
	//  =============================
	$socials = array( 'facebook', 'twitter', 'linkedin', 'pinterest', 'google_plus', 'tumblr',
										'instagram', 'flickr', 'youtube', 'dribbble', 'soundcloud', 'envato',
										'behance', 'vimeo', 'wordpress', 'deviantart', 'evernote', 'blogger' );
	
	foreach($socials as $item){
		$capitalize = ucwords( str_replace( '_', ' ', $item ) );
		
		$wp_customize->add_setting( 'teslata_' . $item, array(
		  	'default'           => '',
	  	  'sanitize_callback' => 'esc_url_raw',
  	));

		$wp_customize->add_control('teslata_' . $item, array(
			  'label'       => $capitalize,
				'section'     => 'teslata_social_options',
			 	'settings'    => 'teslata_' . $item,
		));
	}
	
	//  =============================
	//  = 4.0 Display Options       =
	//  =============================
	$wp_customize->add_section( 'teslata_display_options', array(
			'title'       => __( 'Display Options', 'teslata' ),
			'description' => __( 'Customize your site.', 'teslata' ),
	));
	
	//  =================================
	//  = 4.1 Widget Card               =
	//  =================================
	$wp_customize->add_setting( 'teslata_widget_card', array(
			'default'           => 1,
		  'sanitize_callback' => 'teslata_sanitize_post_meta_display_options',
	));
	
	$wp_customize->add_control( 'teslata_widget_card', array(
	    'label'       => __( 'Display Sidebar Widgets as Cards', 'teslata' ),
	    'section'     => 'teslata_display_options',
	    'settings'    => 'teslata_widget_card',
 		  'type'        => 'select',
			'choices'     => array(
				1 => __( 'Always', 'teslata' ),
				2 => __( 'Only on big screens', 'teslata' ),
				3 => __( 'Only on small screens', 'teslata' ),
				4 => __( 'Never', 'teslata' ),
			),
  ) );

	//  =============================
	//  = 4.2 Display Sidebar       =
	//  =============================
	$wp_customize->add_setting( 'teslata_sidebar_options', array(
			'default'           => 'col-md-9',
			'sanitize_callback' => 'teslata_sanitize_sidebar_pos',
	));

	$wp_customize->add_control( 'teslata_sidebar_options', array(
			'label'       => __( 'Select which way to display the sidebar(s)', 'teslata' ),
			'section'     => 'teslata_display_options',
			'settings'    => 'teslata_sidebar_options',
			'type'        => 'select',
		  'choices'    => array(
				'default'      => __( 'Rightside Sidebar', 'teslata' ),
				'left'         => __( 'Leftside Sidebar', 'teslata' ),
				'both'         => __( 'Both Sidebars', 'teslata' ),
				'double-right' => __( 'Double Rightside Sidebar', 'teslata' ),
				'double-left'  => __( 'Double Leftside Sidebar', 'teslata' ),
				'none'         => __( 'No Sidebars', 'teslata' ),
			),
	));

	//  =============================
	//  = 4.3 Display Social Icons  =
	//  =============================
	$wp_customize->add_setting( 'teslata_display_social_icons', array(
			'default'           => true,
			'sanitize_callback' => 'teslata_sanitize_true_false',
	));

	$wp_customize->add_control( 'teslata_display_social_icons', array(
			'label'       => __( 'Display Social Icons in Footer', 'teslata' ),
			'section'     => 'teslata_display_options',
			'settings'    => 'teslata_display_social_icons',
			'type'        => 'radio',
			'choices'     => array(
				true   => __( 'Display', 'teslata' ),
				false  => __( 'Hide', 'teslata' ),
			),
	));

	//  =============================
	//  = 4.4 Display footer info   =
	//  =============================
	$wp_customize->add_setting( 'teslata_footer_info', array(
			'default'           => true,
			'sanitize_callback' => 'teslata_sanitize_true_false',
	));

	$wp_customize->add_control( 'teslata_footer_info', array(
			'label'       => __( 'Display Theme Footer info', 'teslata' ),
			'section'     => 'teslata_display_options',
			'settings'    => 'teslata_footer_info',
			'type'        => 'radio',
			'choices'     => array(
				true   => __( 'Display', 'teslata' ),
				false  => __( 'Hide', 'teslata' ),
			),
	));
	
	//  =============================
	//  = 4.5 Portfolio Posts       =
	//  =============================
	$wp_customize->add_setting( 'teslata_portfolio_posts', array(
			'default'           => 6,
			'sanitize_callback' => 'teslata_sanitize_portfolio_posts',
	));

	$wp_customize->add_control( 'teslata_portfolio_posts', array(
			'label'       => __( '(JetPack) How many Portfolio posts to display on portfolio page', 'teslata' ),
			'section'     => 'teslata_display_options',
			'settings'    => 'teslata_portfolio_posts',
			'type'        => 'select',
			'choices'     => array(
				3   => __( '3', 'teslata' ),
				6   => __( '6', 'teslata' ),
				9   => __( '9', 'teslata' ),
				12  => __( '12', 'teslata' ),
				15  => __( '15', 'teslata' ),
				18  => __( '18', 'teslata' ),
				21  => __( '21', 'teslata' ),
				24  => __( '24', 'teslata' ),
				27  => __( '27', 'teslata' ),
				30  => __( '30', 'teslata' ),
			),
	));
	
	//  =============================
	//  = 5.0 Post Display Options  =
	//  =============================
	$wp_customize->add_section( 'teslata_post_display_options', array(
			'title'       => __( 'Post Display Options', 'teslata' ),
			'description' => __( 'Customize the way your site displays your posts.', 'teslata' ),
	));
	
	//  =============================
	//  = 5.1 Excerpt options       =
	//  =============================
	$wp_customize->add_setting('teslata_display_excerpt_always', array(
			'default'           => true,
			'sanitize_callback' => 'teslata_sanitize_true_false',
	));

	$wp_customize->add_control( 'teslata_display_excerpt_always', array(
			'label'       => __( 'Use excerpt on blog posts on the blog list', 'teslata' ),
			'section'     => 'teslata_post_display_options',
			'settings'    => 'teslata_display_excerpt_always',
			'type'        => 'radio',
			'choices'     => array(
				true   => __( 'Yes', 'teslata' ),
				false  => __( 'No', 'teslata' ),
			),
	));
	
	//  ===================================
	//  = 5.2 Post author display options =
	//  ===================================
	$wp_customize->add_setting( 'teslata_display_author', array(
		'default'           => 1,
		'sanitize_callback' => 'teslata_sanitize_post_meta_display_options',
	));

	$wp_customize->add_control( 'teslata_display_author', array(
		'label'       => __( 'Select when to display the blog post AUTHOR information', 'teslata' ),
		'section'     => 'teslata_post_display_options',
		'settings'    => 'teslata_display_author',
		'type'        => 'select',
		'choices'     => array(
			1 => __( 'Always', 'teslata' ),
			2 => __( 'Only on Posts page', 'teslata' ),
			3 => __( 'Only on individual the Posts', 'teslata' ),
			4 => __( 'Never', 'teslata' ),
		),
	));
	
	//  ===================================
	//  = 5.3 Post date display options =
	//  ===================================
	$wp_customize->add_setting( 'teslata_display_date', array(
		'default'           => 1,
		'sanitize_callback' => 'teslata_sanitize_post_meta_display_options',
	));

	$wp_customize->add_control( 'teslata_display_date', array(
		'label'       => __( 'Select when to display the blog post DATE information', 'teslata' ),
		'section'     => 'teslata_post_display_options',
		'settings'    => 'teslata_display_date',
		'type'        => 'select',
		'choices'     => array(
			1 => __( 'Always', 'teslata' ),
			2 => __( 'Only on Posts page', 'teslata' ),
			3 => __( 'Only on individual the Posts', 'teslata' ),
			4 => __( 'Never', 'teslata' ),
		),
	));
	
	//  ======================================
	//  = 5.4 Post read time display options =
	//  ======================================
	$wp_customize->add_setting( 'teslata_display_read_time', array(
		'default'           => 1,
		'sanitize_callback' => 'teslata_sanitize_post_meta_display_options',
	));

	$wp_customize->add_control( 'teslata_display_read_time', array(
		'label'       => __( 'Select when to display the blog post READ TIME information', 'teslata' ),
		'section'     => 'teslata_post_display_options',
		'settings'    => 'teslata_display_read_time',
		'type'        => 'select',
		'choices'     => array(
			1 => __( 'Always', 'teslata' ),
			2 => __( 'Only on Posts page', 'teslata' ),
			3 => __( 'Only on individual the Posts', 'teslata' ),
			4 => __( 'Never', 'teslata' ),
		),
	));
	
	//  =======================================
	//  = 5.5 Post category display options =
	//  =======================================
	$wp_customize->add_setting( 'teslata_display_categories', array(
		'default'           => 1,
		'sanitize_callback' => 'teslata_sanitize_post_meta_display_options',
	));

	$wp_customize->add_control( 'teslata_display_categories', array(
		'label'       => __( 'Select when to display the blog post CATEGORIES information', 'teslata' ),
		'section'     => 'teslata_post_display_options',
		'settings'    => 'teslata_display_categories',
		'type'        => 'select',
		'choices'     => array(
			1 => __( 'Always', 'teslata' ),
			2 => __( 'Only on Posts page', 'teslata' ),
			3 => __( 'Only on individual the Posts', 'teslata' ),
			4 => __( 'Never', 'teslata' ),
		),
	));
	
	//  ================================
	//  = 5.6 Post tag display options =
	//  ================================
	$wp_customize->add_setting( 'teslata_display_tags', array(
		'default'           => 1,
		'sanitize_callback' => 'teslata_sanitize_post_meta_display_options',
	));

	$wp_customize->add_control( 'teslata_display_tags', array(
		'label'       => __( 'Select when to display the blog post TAGS information', 'teslata' ),
		'section'     => 'teslata_post_display_options',
		'settings'    => 'teslata_display_tags',
		'type'        => 'select',
		'choices'     => array(
			1 => __( 'Always', 'teslata' ),
			2 => __( 'Only on Posts page', 'teslata' ),
			3 => __( 'Only on individual the Posts', 'teslata' ),
			4 => __( 'Never', 'teslata' ),
		),
	));
	
	//  =================================
	//  = 5.7 Comment display options   =
	//  =================================
	$wp_customize->add_setting('teslata_display_comments', array(
			'default'           => true,
			'sanitize_callback' => 'teslata_sanitize_true_false',
	));

	$wp_customize->add_control( 'teslata_display_comments', array(
			'label'       => __( 'Display the blog post COMMENTS information', 'teslata' ),
		  'description' => __( 'This only applies to the Posts page', 'teslata' ),
			'section'     => 'teslata_post_display_options',
			'settings'    => 'teslata_display_comments',
			'type'        => 'select',
			'type'        => 'radio',
			'choices'     => array(
				true   => __( 'Yes', 'teslata' ),
				false  => __( 'No', 'teslata' ),
			),
	));
}
add_action( 'customize_register', 'teslata_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function teslata_customize_preview_js() {
	wp_enqueue_script( 'teslata_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'teslata_customize_preview_js' );

/*
 * Sanitize checkbox
 */
function teslata_sanitize_checkbox( $value ) {
	if ( ! in_array( $value, array( '', 1 ) ) )
    $value = '';
 
  return $value;
}

/**
 * Sanitize Social Icon Size
 */
function teslata_sanitize_icon_size( $value ) {
	if ( ! in_array( $value, array( 8, 16, 32, 64, 128) ) )
		$value = 32;
	
  return $value;
}

/**
 * Sanitize True or False
 */
function teslata_sanitize_true_false( $value ) {
	if ( ! in_array( $value, array( true, false ) ) )
		$value = true;
	
  return $value;
}

/**
 * Sanitize portfolio items to use in owl carousel
 */
function teslata_sanitize_owl_carousel_items( $value ) {
	if ( ! in_array( $value, array( 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ) ) )
		$value = 5;
	
  return $value;
}

/**
 * Sanitize portfolio items on portfolio page
 */
function teslata_sanitize_portfolio_posts( $value ) {
	if ( ! in_array( $value, array( 3, 6, 9, 12, 15, 18, 21, 24, 27, 30 ) ) )
		$value = 6;
	
  return $value;
}

/**
 * Sanitize sidebar position
 */
function teslata_sanitize_sidebar_pos( $value ){
	if ( ! in_array( $value, array( 'default', 'left', 'both', 'double-right', 'double-left', 'none' ) ) )
		$value = 'default';
	
  return $value;
}

/**
 * Sanitize post meta display options
 */
function teslata_sanitize_post_meta_display_options( $value ){
	if ( ! in_array( $value, array( 1, 2, 3, 4 ) ) )
		$value = 1;
	
  return $value;
}