<?php
/**
 * The template used for displaying portfolio item content in portfolio-jetpack.php
 *
 * @package Teslata
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'project' ); ?>>

	<header class="project-header">

		<?php the_title( sprintf( '<h1 class="project-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
		
	</header><!-- .project-header -->
	
</article><!-- #post-## -->
