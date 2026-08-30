<?php
/**
 * Comments template — themed to match the Rice Capital templates.
 *
 * NOTE: We pass an explicit `walker` (core \Walker_Comment) to wp_list_comments().
 * The wp-bootstrap-hooks plugin otherwise injects `new Bootstrap_Walker_Comment()`
 * from inside its own namespace, but that class is declared in the GLOBAL namespace,
 * so the unqualified reference fatals with "class not found". Supplying our own
 * walker makes the plugin skip that broken code path (its `empty($args['walker'])`
 * guard is no longer satisfied).
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Bail on password-protected posts whose password has not been entered.
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="rcf-comments">

	<?php if ( have_comments() ) : ?>
		<h2 class="rcf-comments__title">
			<?php
			$rcf_count = get_comments_number();
			printf(
				/* translators: %s: comment count */
				esc_html( _n( 'Discussion — %s comment', 'Discussion — %s comments', $rcf_count, 'pegasus-child' ) ),
				esc_html( number_format_i18n( $rcf_count ) )
			);
			?>
		</h2>

		<ol class="rcf-comment-list">
			<?php
			wp_list_comments( array(
				'walker'      => new \Walker_Comment(),
				'style'       => 'ol',
				'avatar_size' => 44,
				'short_ping'  => true,
			) );
			?>
		</ol>

		<?php
		$rcf_comment_pagination = paginate_comments_links( array(
			'echo'      => false,
			'prev_text' => '&larr;',
			'next_text' => '&rarr;',
		) );
		if ( $rcf_comment_pagination ) {
			echo '<nav class="rcf-pagination rcf-pagination--comments" aria-label="Comments">' . wp_kses_post( $rcf_comment_pagination ) . '</nav>';
		}
		?>

		<?php if ( ! comments_open() ) : ?>
			<p class="rcf-comments__closed"><?php esc_html_e( 'Comments are closed.', 'pegasus-child' ); ?></p>
		<?php endif; ?>
	<?php endif; ?>

	<?php
	comment_form( array(
		'class_form'         => 'rcf-comment-form',
		'title_reply'        => __( 'Leave a comment', 'pegasus-child' ),
		'title_reply_before' => '<h3 id="reply-title" class="rcf-comments__form-title">',
		'title_reply_after'  => '</h3>',
		'class_submit'       => 'rcf-btn rcf-btn--dark',
		'label_submit'       => __( 'Post comment', 'pegasus-child' ),
	) );
	?>

</div><!-- #comments -->
