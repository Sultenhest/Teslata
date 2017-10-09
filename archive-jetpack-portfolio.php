<?php
/**
 * The template for displaying archive projects by Jetpack Portfolio.
 *
 * @package Teslata
 */

get_header(); ?>

	<div id="primary" class="content-area <?php teslata_primary_width(); ?>">
		<main id="main" class="site-main grid" role="main">
			
		  <header class="page-header">
				<h1 class="page-title"><?php echo __('Portfolio Archive', 'teslata'); ?></h1>
			</header>
			
			<div class="row" id="portfolio-posts">
			
			<?php if ( have_posts() ) : ?>
					
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'template-parts/content', 'single-portfolio-jetpack' ); ?>

					<?php endwhile; ?>
					
			<?php endif; ?>
      </div><!-- .row -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
if ( in_array( get_theme_mod( 'teslata_sidebar_options', 'default' ), array( 'both', 'left', 'double-right', 'double-left' ) ) ) :
  get_sidebar( 'left' );
endif;

if ( in_array( get_theme_mod( 'teslata_sidebar_options', 'default' ), array( 'both', 'default', 'double-right', 'double-left' ) ) ) :
  get_sidebar();
endif;

get_footer();