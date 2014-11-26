<?php
/* IF CURRENT POST IS PROTECTED WITH PASSWORD
RETURN EARLY WITHOUT LOADING THE COMMENTS */
if ( post_password_required() )
    return;
?>
<!-- COMMENTS
====================================== -->
<div id="comments">
    <?php if ( have_comments() ): ?>
        <h3 class="section-heading">
            <span>
                <?php printf( _n( '1 Comment', '%1$s Comments', get_comments_number(), 'premitheme' ), number_format_i18n( get_comments_number() ) ); ?>
            </span>
        </h3>

        <ul id="comment-list">
            <?php wp_list_comments( array( 'callback' => 'premitheme_comment_template' ) ); 
            // To modify pt_comment go to premitheme_comment_template() in functions/comments-template.php 
            ?>
        </ul>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
            <div id="comment_nav_below" class="clearfix">
                <div class="nav-previous"><?php previous_comments_link( __( '<i class="fa fa-arrow-left"></i> Older Comments', 'premitheme' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments <i class="fa fa-arrow-right"></i>', 'premitheme' ) ); ?></div>
            </div>
        <?php endif; ?>
        
        <?php if ( !comments_open() ) : ?>
            <p class="no-comments"><?php _e( 'Comments are closed.', 'premitheme' ); ?></p>
        <?php endif; ?>
    <?php endif; ?>

    <?php comment_form( array( 'title_reply' => __('Leave a comment', 'premitheme') ) ); ?>
</div><!-- #comments -->
