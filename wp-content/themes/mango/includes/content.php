<?php
$author = get_the_author();
$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
$authorAttr = sprintf( __('View all posts by %s', 'premitheme'), $author );
?>

<?php if ( has_post_thumbnail()):
    $altAttr = get_post_meta( get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true);
    $image = premitheme_image( $post->ID, '', premitheme_img_size('blog-standard'));
?>
    <!-- ENTRY IMAGE
    ====================================== -->
    <?php if( is_single() ): ?>
        <div class="blog-thumb">
    <?php else: ?>
        <a class="blog-thumb" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
    <?php endif; ?>
        <img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" title="<?php the_title_attribute(); ?>" alt="<?php echo $altAttr; ?>"/>
    <?php if( is_single() ): ?>
        </div>
    <?php else: ?>
        </a>
    <?php endif; ?>
<?php endif; ?>

<?php if( !is_single() ): ?>
    <!-- ENTRY TITLE
    ====================================== -->
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
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