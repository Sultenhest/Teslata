<?php
/**
 * Teslata functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Teslata
 */

if ( ! function_exists( 'teslata_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function teslata_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Teslata, use a find and replace
	 * to change 'teslata' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'teslata', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	 /*
	 * Enable support for custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 200,
		'width'       => 200,
		'flex-width'  => true,
	) );
	
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'teslata_blog_thumb', 1170, 450, true );
	add_image_size( 'teslata_square_thumb', 600, 600, true );
	add_image_size( 'teslata_small_square_thumb', 350, 350, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'teslata' ),
		'footer_menu' => esc_html__( 'Footer Menu', 'teslata' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'teslata_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'teslata_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function teslata_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'teslata_content_width', 1000 );
}
add_action( 'after_setup_theme', 'teslata_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function teslata_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'teslata' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'teslata' ),
		'before_widget' => '<section id="%1$s" class="widget col-xs-12 %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer widgets', 'teslata' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'teslata' ),
		'before_widget' => '<section id="%1$s" class="widget col-sm-3 %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'teslata' ),
		'id'            => 'sidebar-3',
		'description'   => esc_html__( 'Add widgets here.', 'teslata' ),
		'before_widget' => '<section id="%1$s" class="widget col-xs-12 %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Search Page Sidebar', 'teslata' ),
		'id'            => 'sidebar-4',
		'description'   => esc_html__( 'Add widgets here to be displayed on 404.php.', 'teslata' ),
		'before_widget' => '<section id="%1$s" class="widget col-xs-12 %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'teslata_widgets_init' );

/**
 * Hides the custom post template for pages on WordPress 4.6 and older
 *
 * @param array $post_templates Array of page templates. Keys are filenames, values are translated names.
 * @return array Filtered array of page templates.
 */
function teslata_exclude_page_templates( $post_templates ) {
    if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
        unset( $post_templates['templates/my-full-width-post-template.php'] );
    }
 
    return $post_templates;
}
 
add_filter( 'theme_page_templates', 'teslata_exclude_page_templates' );

/**
 * Enqueue scripts and styles.
 */
function teslata_scripts() {
	/* Loading CSS in header */
	wp_enqueue_style( 'normalize', get_template_directory_uri() . '/css/normalize.css', false, NULL, 'all' );
	
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', false, NULL, 'all' );
	
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css', false, NULL, 'all' );
	
	wp_enqueue_style( 'teslata-style', get_stylesheet_uri() );

	/* Loading Javascript in footer */
	wp_enqueue_script( 'teslata-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', array('jquery'), NULL, true );
	
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), NULL, true );
	
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), NULL, true );
	
	wp_enqueue_script( 'teslata-javascript', get_template_directory_uri() . '/js/javascript.js', array('jquery'), NULL, true );
	
	/**
	 * HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries.
	 */
	wp_enqueue_script( 'respond', get_template_directory_uri() . '/js/respond.min.js', array('jquery'), NULL, true );
	
	wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/js/html5shiv.min.js', array('jquery'), NULL, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'teslata_scripts' );

/**
 * Getting The Excerpt changes.
 */
require get_template_directory() . '/inc/the-excerpt-functions.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Assemble data output based on Customizer selections.
 */
require get_template_directory() . '/inc/customizer-functions.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Getting form styling.
 */
require get_template_directory() . '/inc/theme-form-styling.php';

/**
 * Custom portfolio widget.
 */
require get_template_directory() . '/widgets/teslata-widget-recent-portfolio.php';

/**
 * Custom functions for this theme.
 */
require get_template_directory() . '/inc/theme-functions.php';