<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Teslata
 */

?>
    </div><!-- .row -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<div class="row">
				
				<?php get_sidebar('footer'); ?>
				
				<div class="col-md-12 text-center">
				  <?php wp_nav_menu( array('theme_location' => 'footer_menu', 'depth' => 1, 'menu_class' => 'footer-menu', 'fallback_cb' => false) ); ?>
				</div>
				
				<?php 
				  if ( get_theme_mod( 'teslata_display_social_icons', true ) ) :
				    teslata_social_icons();
				  endif;
				?>
				
				<?php teslata_footer_site_info(); ?>
				
			</div>
	  </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
