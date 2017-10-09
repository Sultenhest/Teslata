<?php
/**
 * Template Name: Right Sidebar
 * Template Post Type: post
 *
 * The template for displaying posts with only
 * the right sidebar.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Teslata
 */

get_header(); ?>

	<div id="primary" class="content-area col-md-9">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
