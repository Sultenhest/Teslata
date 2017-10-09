<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Teslata
 */

get_header(); ?>

	<div id="primary" class="content-area <?php teslata_primary_width(); ?>">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();
			
			get_template_part( 'template-parts/content', get_post_format() );
		
	    teslata_custom_post_nav();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

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
