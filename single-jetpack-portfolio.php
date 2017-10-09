<?php
/**
 * The template for displaying all single portfolio posts by Jetpack.
 *
 * @package Teslata
 */

get_header(); ?>

  <div id="primary" class="content-area col-md-10 col-md-offset-1">
		<main id="main" class="site-main" role="main">
		
		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'single-portfolio-jetpack' );
			
			teslata_custom_project_nav();
			
			if ( comments_open() || get_comments_number() ) :
			  comments_template();
			endif;

		endwhile;
		?>
	
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
