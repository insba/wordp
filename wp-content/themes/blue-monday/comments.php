<?php
/**
 * The template for displaying comments.
 *
 *
 * @package blue-monday
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

<?php if ( have_comments() ) : ?>
  <div class="commentlist">
    <h3 id="comments-title"><?php comments_number( __( '<span>No</span> Comments', 'blue-monday' ), __( '<span>1</span> Comment', 'blue-monday' ), _n( '<span>%</span> Comments', '<span>%</span> Comments', get_comments_number(), 'blue-monday' ) );?></h3>
    <?php
      wp_list_comments( array(
      'style'             => 'div',
      'short_ping'        => true,
      'avatar_size'       => 100,
      'callback'          => 'blue_monday_comments',
      'type'              => 'all',
      'reply_text'        => 'Reply',
      'page'              => '',
      'per_page'          => '',
      'reverse_top_level' => null,
      'reverse_children'  => '',
      'max_depth'         => 3
      ) );
    ?>
  </div>

  <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    <nav class="navigation comment-navigation" role="navigation">
      <div class="comment-nav-prev"><?php previous_comments_link( __( '&larr; Previous Comments', 'blue-monday' ) ); ?></div>
      <div class="comment-nav-next"><?php next_comments_link( __( 'Next Comments &rarr;', 'blue-monday' ) ); ?></div>
    </nav>
  <?php endif; ?>

  <?php if ( ! comments_open() ) : ?>
  <p class="no-comments"><?php _e( 'Comments are closed.' , 'blue-monday' ); ?></p>
  <?php endif; ?>

<?php endif; ?>

<?php 
$args = array(
'title_reply'       => __( 'Leave a Comment', 'blue-monday' ),
'title_reply_to'    => __( 'Leave a Reply to %s', 'blue-monday' ),
'cancel_reply_link' => __( 'Cancel Reply', 'blue-monday' ),
'label_submit'      => __( 'Post Comment', 'blue-monday' ),
'fields' => array(
        'author' => '<div class="row"><div class="col-md-4"><p class="comment-form-author">' . '<label for="author">' . __( 'Name','blue-monday' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"/></p></div>',
        'email'  => '<div class="col-md-4"><p class="comment-form-email"><label for="email">' . __( 'Email','blue-monday' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"/></p></div>',
        'url'    => '<div class="col-md-4"><p class="comment-form-url"><label for="url">' . __( 'Website','blue-monday' ) . '</label> ' .
                    '<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" /></p></div></div>',
    ),
);

comment_form($args); ?>