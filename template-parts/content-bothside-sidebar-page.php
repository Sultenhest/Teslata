<?php
/**
 * Template Name: Both Left & Right Sidebar
 * Template Post Type: page, post
 *
 * The template for displaying pages and posts with sidebar
 * on each side of the content.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Teslata
 */

get_header(); ?>

	<div id="primary" class="content-area col-md-6 col-md-push-3">
		<main id="main" class="site-main" role="main">
			
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar( 'left' );
get_sidebar();
get_footer();