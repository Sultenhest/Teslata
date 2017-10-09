<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Teslata
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'row' ); ?>>
	<?php
	  if ( has_post_thumbnail() && is_single() ) : // check if the post has a Post Thumbnail assigned to it.
		  the_post_thumbnail();
	  elseif ( has_post_thumbnail() ) :
	    echo '<a href="' . esc_url( get_permalink() ) . '">';
	      the_post_thumbnail( 'teslata_blog_thumb' );
	    echo '</a>';
	  endif;
	?>
	
	<header class="entry-header col-sm-12">
		<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"> ' . teslata_add_tick_to_sticky() . ' <a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;
		?>
	</header><!-- .entry-header -->

	<?php
		if ( 'post' === get_post_type() ) : ?>
		  <div class="entry-meta <?php echo teslata_get_post_meta_width(); ?>">
			  <?php teslata_posted_on(); ?>
				<?php teslata_entry_footer(); ?>
		  </div><!-- .entry-meta -->
		<?php
		endif; 
	?>
	
	<div class="entry-content clearfix <?php echo teslata_get_list_content_width(); ?>">
		<?php
		  if ( ! is_single() && get_theme_mod( 'teslata_display_excerpt_always', 0 ) ) :
		    the_excerpt();
      else :
			 the_content( sprintf(
				  wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'teslata' ),
            array( 'span' => array() ) ),
				  the_title( '<span class="screen-reader-text">"', '"</span>', false )
			  ) );
		  endif;
		
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'teslata' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	
	<?php if ( get_edit_post_link() && is_single() ) : ?>
		<footer class="entry-footer col-md-12">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'teslata' ),
						the_title( '<span>"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
	
</article><!-- #post-## -->
