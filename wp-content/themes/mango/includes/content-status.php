<?php
$author = get_the_author();
$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
$authorAttr = sprintf( __('View all posts by %s', 'premitheme'), $author );
?>

<!-- ENTRY META
====================================== -->
<div class="entry-meta upper clearfix">
    <div class="entry-author"><?php printf( __('By %s', 'premitheme'), '<a href="'.$author_url.'" title="'.esc_attr($authorAttr).'">'.$author.'</a>' );?></div>

    <?php if( of_get_option('posts_comments') && comments_open() ): ?>
        <div class="entry-comments"><i class="fa fa-comment"></i> <?php comments_popup_link( __( 'Comment', 'premitheme' ), __( '1', 'premitheme' ), __('%', 'premitheme'), 'comments-link' ); ?></div>
    <?php endif; ?>
</div>

<!-- ENTRY AVATAR
====================================== -->
<div class="status-avatar">
    <a href="<?php echo $author_url; ?>" title="<?php echo $titleAtt; ?>">
        <?php echo get_avatar( get_the_author_meta( 'user_email' ), 80); ?>
    </a>
</div>

<!-- ENTRY CONTENT
====================================== -->
<div class="entry-content">
    <?php the_content(); ?>

    <?php if( is_single() ): ?>
        <?php wp_link_pages( array( 'before' => '<p><span><strong>' . __( 'Pages: ', 'premitheme' ) . '</strong></span>', 'after' => '</p>' ) ); ?>
        <?php edit_post_link( __( 'Edit', 'premitheme'), '<div class="entry-meta edit-link">', '</div>' ); ?>
    <?php endif; ?>
</div>
<div class="clear"></div>