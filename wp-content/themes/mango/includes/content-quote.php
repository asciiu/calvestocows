<?php
$author = get_the_author();
$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
$authorAttr = sprintf( __('View all posts by %s', 'premitheme'), $author );
$quoteText = get_post_meta($post->ID, 'quoteformat_text', TRUE);
$quoteAuthor = get_post_meta($post->ID, 'quoteformat_author', TRUE);
?>

<!-- ENTRY LINK
====================================== -->
<?php if ( $quoteText && $quoteAuthor ): ?>
    <div class="entry-quote">
        <hgroup>
            <h2><?php echo '&ldquo; '. $quoteText .' &rdquo;'; ?></h2>
            <h3><?php echo '&mdash; '.$quoteAuthor.' &mdash;'; ?></h3>
        </hgroup>
    </div>
<?php endif; ?>

<!-- ENTRY META
====================================== -->
<div class="entry-meta upper clearfix">
    <div class="entry-author"><?php printf( __('By %s', 'premitheme'), '<a href="'.$author_url.'" title="'.esc_attr($authorAttr).'">'.$author.'</a>' );?></div>

    <?php if( of_get_option('posts_comments') && comments_open() ): ?>
        <div class="entry-comments"><i class="fa fa-comment"></i> <?php comments_popup_link( __( 'Comment', 'premitheme' ), __( '1', 'premitheme' ), __('%', 'premitheme'), 'comments-link' ); ?></div>
    <?php endif; ?>
</div>

<!-- ENTRY CONTENT
====================================== -->
<div class="entry-content">
    <?php if( is_single() || of_get_option('blog_content') ): ?>
        <?php the_content(); ?>
    <?php else: ?>
        <?php the_excerpt(); ?>
    <?php endif; ?>

    <?php if( is_single() ): ?>
        <?php wp_link_pages( array( 'before' => '<p><span><strong>' . __( 'Pages: ', 'premitheme' ) . '</strong></span>', 'after' => '</p>' ) ); ?>
        <?php edit_post_link( __( 'Edit', 'premitheme'), '<div class="entry-meta edit-link">', '</div>' ); ?>
    <?php endif; ?>
</div>