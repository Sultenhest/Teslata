<?php
/**
 * The template for displaying image attachments
 *
 * @package Teslata
 */

get_header(); ?>

	<div id="primary" class="content-area <?php teslata_primary_width(); ?>">
		<main id="main" class="site-main" role="main">

			<?php
				// Start the loop.
				while ( have_posts() ) : the_post();
			?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'row' ); ?>>
					<header class="entry-header col-sm-12">
						<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
					</header><!-- .entry-header -->

					
					<div class="entry-meta col-sm-3">
						<?php
						  teslata_posted_on();
						  the_post_navigation( array(
							  'prev_text' => '<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>' . '<span class="post-title">%title</span>',
							) );
						  teslata_entry_footer();
						?>
						<?php if ( has_excerpt() ) : ?>
							<div class="portfolio-excerpt">
								<?php the_excerpt(); ?>
							</div>
						<?php endif; ?>
					</div><!-- .entry-meta -->
					
					<div class="entry-content clearfix col-sm-9">
						<div class="entry-attachment">
							<?php
								echo wp_get_attachment_image( get_the_ID(), 'large' );
							?>
						</div><!-- .entry-attachment -->

						<?php
							the_content();
							wp_link_pages( array(
								'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'teslata' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
								'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'teslata' ) . ' </span>%',
								'separator'   => '<span class="screen-reader-text">, </span>',
							) );
						?>
					</div><!-- .entry-content -->
				</article><!-- #post-## -->

				<?php teslata_custom_image_nav(); ?>
			  
				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				// End the loop.
				endwhile;
			?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php
if ( in_array( get_theme_mod( 'teslata_sidebar_options', 'default' ), array( 'both', 'left', 'double-right', 'double-left' ) ) ) :
  get_sidebar( 'left' );
endif;

if ( in_array( get_theme_mod( 'teslata_sidebar_options', 'default' ), array( 'both', 'default', 'double-right', 'double-left' ) ) ) :
  get_sidebar();
endif;

get_footer();
