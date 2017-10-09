<?php
/**
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Teslata
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<a href="#" id="totop">
  <span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span>
</a>

<div id="page" class="site">
	<header id="masthead" class="site-header" role="banner">
		<div class="container">
			<div class="site-branding row">
				<div class="col-md-12">
					<?php if ( get_theme_mod( 'custom_logo' ) && get_theme_mod( 'teslata_logo_mobile_nav' ) != 1 ) :
					  the_custom_logo();
					endif; ?>
					
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					
          <?php
						$description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) : ?>
							<p class="site-description"><?php echo $description; ?></p>
					<?php
					endif; ?>
				</div>
			</div><!-- .site-branding -->
		</div>
	</header><!-- #masthead -->
	
	<div id="affix-fix" class="top-menu">
		<div id="fixed" data-spy="affix" data-offset-top="260">
			<div class="container">
				<nav id="site-navigation" class="main-navigation row" role="navigation">

					<div id="mobile-site-title" class="hidden-sm hidden-md hidden-lg">
						<?php
							if ( get_theme_mod( 'custom_logo' ) ) :
								$image = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ) );
								echo '<a href="' . esc_url( home_url( '/' ) ) . '" rel="home">';
									echo '<img src="' . $image[0] . '" height="44px" class="img-responsive">';
								echo '</a>';
							else :
								?>
								<h2>
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
								</h2>
								<?php
							endif;
						?>
					</div>

					<button class="mobile-nav hidden-sm hidden-md hidden-lg">
						<span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
					</button>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => 'col-md-12 hidden-xs' ) ); ?>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'mobile-menu', 'menu_class' => 'col-sx-12 hidden-sm hidden-md hidden-lg' ) ); ?>
				</nav><!-- #site-navigation -->
			</div>
		</div>
	</div>
	
	<div id="content" class="site-content container">
		<div class="row">
			<?php teslata_header_owl_slider(); ?>
