<?php
/**
 * Template Name: Portfolio – Jetpack
 *
 * The template for displaying portfolio.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Teslata
 */

get_header(); ?>

	<div id="primary" class="content-area col-md-9">
		<main id="main" class="site-main grid" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>
			
			  <div class="row" id="portfolio-posts">
					<div class="col-md-12" id="portfolio-categories">
						<?php echo teslata_get_portfolio_categories(); ?>
					</div>
					
					<?php
					  $ppp = get_theme_mod( 'teslata_portfolio_posts', 6 );
					
						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						$args = array( 'post_type' => 'jetpack-portfolio', 'posts_per_page' => $ppp, 'paged' => $paged );

						$loop = new WP_Query( $args );
						if ( $loop->have_posts() ) :
					
					    echo '<div class="col-md-12"><div class="row">';
					
							while ( $loop->have_posts() ) : $loop->the_post();

							get_template_part( 'template-parts/content', 'single-portfolio-jetpack' );

							endwhile;
						
						  echo '</div></div>';
					
						endif;
					
						teslata_custom_portfolio_page_nav( $loop->max_num_pages );

						wp_reset_query();
					?>
				</div>
			
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
get_sidebar();
get_footer();