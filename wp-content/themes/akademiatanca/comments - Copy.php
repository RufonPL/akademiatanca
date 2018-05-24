<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to rfswp_comment() which is
 * located in the inc/template-tags.php file.
 *
 * @author Rafał Puczel
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */

if ( post_password_required() )
	return;
?>

	<div id="comments" class="comments-area col-md-12">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h4 class="comments-title">
			<?php
				printf( _nx( '1 komentarz', 'Komentarzy: %1$s', get_comments_number(), 'comments title', 'rfswp' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h4>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Nawigacja', 'rfswp' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Starsze Komentarze', 'rfswp' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Nowsze Komentarze &rarr;', 'rsfwp' ) ); ?></div>
		</nav><!--end comment-nav-above-->
		<?php endif; // check for comment navigation ?>

		<ol class="comment-list list-unstyled">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use rfswp_comment() to format the comments.
				 * If you want to override this in a child theme, then you can
				 * define rfswp_comment() and that will be used instead.
				 * See rfswp_comment() in inc/template-tags.php for more.
				 */
				wp_list_comments( array( 'callback' => 'rfswp_comment' ) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'rfswp' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Starsze Komentarze', 'rfswp' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Nowsze Komentarze &rarr;', 'rfswp' ) ); ?></div>
		</nav><!--end comment-nav-below-->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( '', 'rfswp' ); ?></p>
	<?php endif; ?>
	
	<?php
	// Arguments to edit the comment form
	
	$args = array(
		'id_form'           => 'commentform',
		'id_submit'         => 'submit',
		'title_reply'       => __( 'Napisz komentarz' ),
		'title_reply_to'    => __( 'Odpowiedz na %s' ),
		'cancel_reply_link' => __( '<div class="btn btn-danger pull-right">Anuluj</div>' ),
		'label_submit'      => __( 'Wystaw Komentarz' ),
	
		'comment_field' =>  '<div class="form-group comment-form-comment"><label for="comment">' . _x( 'Komentarz', 'noun' ) .
		'</label><textarea id="comment" class="form-control" name="comment" cols="45" rows="8" aria-required="true">' .
		'</textarea></div>',
	
		'must_log_in' => '<p class="must-log-in">' .
		sprintf(
			__( 'Musisz być <a href="%s">zalogowany</a>, aby komentować.' ),
			wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
		) . '</p>',
	
		'logged_in_as' => '<p class="logged-in-as">' .
		sprintf(
			__( 'Zalogowano jako <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account" class="btn btn-default">Wyloguj się</a>' ),
			admin_url( 'profile.php' ),
			$user_identity,
			wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
		) . '</p>',
	
		'comment_notes_before' => '<p class="comment-notes">' .
		__( 'Twój e-mail nie zostanie opublikowany' ) . ( $req ? $required_text : '' ) .
		'</p>',
	
		'comment_notes_after' => '
		
		<button class="btn btn-primary" type="submit">' . __( 'Wystaw komentarz' ) . '</button>',
	
		'fields' => apply_filters( 'comment_form_default_fields', array(
	
				'author' =>
				'<div class="form-group comment-form-author">' .
				'<label for="author">' . __( 'Imię i nazwisko', 'domainreference' ) . '</label> ' .
				( $req ? '<span class="required">*</span>' : '' ) .
				'<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
				'" size="30"' . $aria_req . ' /></div>',
	
				'email' =>
				'<div class="form-group comment-form-email"><label for="email">' . __( 'Email', 'domainreference' ) . '</label> ' .
				( $req ? '<span class="required">*</span>' : '' ) .
				'<input id="email" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
				'" size="30"' . $aria_req . ' /></div>'
			)
		),
	);
	
	comment_form($args); ?>

</div><!-- #comments -->
