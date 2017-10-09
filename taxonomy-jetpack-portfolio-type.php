<?php
/**
 * The template for displaying Jetpack portfolio type.
 *
 * @package Teslata
 */

get_header(); ?>

	<div id="primary" class="content-area col-md-10 col-md-offset-1">
		<main id="main" class="site-main grid" role="main">
			
			<?php if ( have_posts() ) : ?>

					<header class="entry-header">
						<?php
							the_archive_title( '<h1 class="page-title">', '</h1>' );
							the_archive_description( '<div class="taxonomy-description">', '</div>' );
						?>
					</header><!-- .page-header -->
			
					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', 'single-portfolio-jetpack' );

					endwhile;
			    ?>
			
			<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();