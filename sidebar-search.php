<?php
/**
 * The sidebar containing the main footer area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package teslata
 */

if ( ! is_active_sidebar( 'sidebar-4' ) ) {
	return;
}
?>

<aside id="search-secondary" class="widget-area col-md-3 <?php echo teslata_right_sidebar_position(); ?> col-sm-12" role="complementary">
		<?php dynamic_sidebar( 'sidebar-4' ); ?>
</aside><!-- #search-secondary -->