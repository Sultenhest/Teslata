<?php
/**
 * The template used for displaying portfolio item content in single-jetpack-portfolio.php
 *
 * @package Teslata
 */

  if ( !is_single() ) : ?>

    <figure id="post-<?php the_ID(); ?>" <?php post_class( 'col-md-4 col-xs-6' ); ?>>
	  <?php
	    if ( has_post_thumbnail() ) : // check if the post has a Post Thumbnail assigned to it.
		    the_post_thumbnail( 'teslata_square_thumb' );
	    endif;
	    
			echo '<figcaption>';
	      the_title( '<h2>', '</h2>' );
	      echo '<a href="' . get_permalink() . '"></a>';
		  echo '</figcaption>';
	  echo '</figure>';
			
  else :?>
			
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'row' ); ?>>
			<header class="entry-header col-sm-12">
				<?php
					the_title( '<h1 class="entry-title">', '</h1>' );
				?>
			</header><!-- .entry-header -->

			<?php
				if ( 'jetpack-portfolio' === get_post_type() ) : ?>
					<div class="entry-meta col-sm-3">
						<?php teslata_posted_on(); ?>
						<?php teslata_entry_footer(); ?>
						<div class="portfolio-excerpt">
					    <?php
							  if ( has_excerpt() ) :
							    the_excerpt();
							  endif;
							?>
						</div>
					</div><!-- .entry-meta -->
				<?php
				endif;
			?>
			
			<div class="entry-content clearfix col-sm-9">
				<?php
					the_content( sprintf(
						/* translators: %s: Name of current post. */
						wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'teslata' ), array( 'span' => array( 'class' => array() ) ) ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					) );

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'teslata' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->
			
		</article><!-- #post-## -->
<?php
  endif;
?>