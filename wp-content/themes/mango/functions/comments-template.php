<?php
if ( ! function_exists( 'premitheme_comment_template' ) ):
    function premitheme_comment_template( $comment, $args, $depth ) {
        $GLOBALS['comment'] = $comment;
        switch ( $comment->comment_type ):
            case 'pingback' :
            case 'trackback' :
        ?>

            <li class="pingback">
                <p>
                    <?php _e( '<span>Pingback:</span> ', 'premitheme' ); ?>
                    <?php comment_author_link(); ?>
                    <?php edit_comment_link( __( 'Edit', 'premitheme' ), '<span class="edit-link">', '</span>' ); ?>
                </p>
          
        <?php break;
        default :
        ?>
        
            <li id="comment-<?php comment_ID(); ?>" <?php comment_class('comment-wrapper'); ?>>
                <header class="comment-meta clearfix">
                    <div class="comment-avatar">
                        <?php echo get_avatar( $comment, 50 ); ?>
                    </div>
                    <div class="comment-author-name"><?php comment_author_link(); ?></div>
                    <?php printf( __( '<div class="comment-date"><a href="%1$s" title="%2$s">%3$s</a></div>', 'premitheme' ), esc_url( get_comment_link( $comment->comment_ID ) ), get_comment_time(), get_comment_date() );
                    ?>
                </header><!-- .comment-meta -->
                
                <div class="comment-content">
                    <?php comment_text(); ?>
                    
                    <?php if ( $comment->comment_approved == '0' ) : ?>
                        <p><em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'premitheme'); ?></em></p>
                    <?php endif; ?>
                </div><!-- .comment-content -->

                <footer class="comment-meta lower clearfix">
                    <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'premitheme'), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                    <?php edit_comment_link( __('Edit', 'premitheme' ), '', '' ); ?>
                </footer><!-- .comment-meta -->

        <?php break;
        endswitch;
    }
endif;