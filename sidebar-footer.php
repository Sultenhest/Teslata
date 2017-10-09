<?php
/**
 * The sidebar containing the main footer area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package teslata
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}
?>

<div class="col-md-12">
	<div id="footer-secondary" class="widget-area footer-widgets row" role="complementary">
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
	</div><!-- #footer-secondary -->
</div>