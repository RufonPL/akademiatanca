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

	<?php
	// Arguments to edit the comment form
	
	$args = array(
		'id_form'           => 'comments-form',
		'id_submit'         => 'comments-submit',
		'title_reply'       => 'Komentarze',
		'title_reply_to'    => 'Odpowiedz na %s',
		'cancel_reply_link' => '<span class="btn btn-danger pull-right">Anuluj</span>',
		'label_submit'      => 'dodaj komentarz',
	
		'comment_field' =>  '<div class="form-group"><textarea id="comment" class="form-control form-textarea" name="comment">' .
		'</textarea></div>',
	
		'must_log_in' => '<p class="must-log-in">' .
		sprintf(
			__('Musisz być <a href="%s">zalogowany</a>, aby komentować.'),
			wp_login_url( apply_filters('the_permalink', get_permalink()))
		).'</p>',
	
		'logged_in_as' => '<p class="logged-in-as">' .
		sprintf(
			__('Zalogowano jako <strong>%2$s</strong>. <a href="%3$s" class="btn btn-info">Wyloguj się</a>' ),
			admin_url( 'profile.php' ),
			$user_identity,
			wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
		) . '</p>',
	
		'comment_notes_before' => '<p class="comment-notes">' .
		__( 'Twój e-mail nie zostanie opublikowany' ) . ( $req ? $required_text : '' ) .
		'</p>',
	
		'comment_notes_after' => '',
	
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

	<?php if(have_comments()) : ?>
		<ul class="comments-list list-unstyled">
			<?php wp_list_comments(array('callback' => 'rfswp_comments')); ?>
		</ul><!-- .comment-list -->
        
        <?php if(get_comment_pages_count() > 1 && get_option( 'page_comments')) : ?>
		<div id="comments-nav" class="comments-navigation">
			<div class="comments-nav-prev">
				<?php previous_comments_link('<i class="fa fa-long-arrow-left"></i> Starsze komentarze'); ?>
            </div>
            <div class="comments-nav-next">
				<?php next_comments_link('Nowsze Komentarze <i class="fa fa-long-arrow-right"></i>'); ?>
            </div>
		</div><!--end comment-nav-above-->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

</div><!-- #comments -->
