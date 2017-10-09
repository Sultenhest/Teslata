<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Teslata
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area col-md-12">

	<?php
	if ( have_comments() ) : ?>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-above" class="navigation comment-navigation row" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'teslata' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous col-sm-6"><?php previous_comments_link( __( '<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Older Comments', 'teslata' ) ); ?></div>
				<div class="nav-next col-sm-6"><?php next_comments_link( __( 'Newer Comments <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>', 'teslata' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
	  <hr>
		<?php endif; // Check for comment navigation. ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	  <hr>
		<nav id="comment-nav-below" class="navigation comment-navigation row" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'teslata' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous col-sm-6"><?php previous_comments_link( __( '<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Older Comments', 'teslata' ) ); ?></div>
				<div class="nav-next col-sm-6"><?php next_comments_link( __( 'Newer Comments <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>', 'teslata' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
	  <hr>
		<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'teslata' ); ?></p>
	<?php
	endif;

	comment_form();
	?>

</div><!-- #comments -->