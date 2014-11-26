<?php
$author = get_the_author();
$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
$authorAttr = sprintf( __('View all posts by %s', 'premitheme'), $author );
$gallImages = get_post_meta($post->ID, 'galleryformat_imgs', TRUE);
$galleryNav =  get_post_meta($post->ID, 'galleryformat_imgs_nav', TRUE);
$galleryEffect =  get_post_meta($post->ID, 'galleryformat_imgs_effect', TRUE);
$galleryHeight =  get_post_meta($post->ID, 'galleryformat_imgs_height', TRUE);

if($galleryNav == 'thumbnails'){
    $galleryNavOption = '"thumbnails"';
} else {
    $galleryNavOption = true;
}

if($galleryEffect == 'fade'){
    $galleryEffectOption = '"fade"';
} else {
    $galleryEffectOption = '"slide"';
}
?>

<!-- ENTRY GALLERY
====================================== -->
<?php if ($gallImages && $galleryHeight): ?>

    <script>
        jQuery(window).load(function() {
            jQuery('.flexslider-<?php the_ID(); ?>').flexslider({
                animation: <?php echo $galleryEffectOption; ?>,
                easing: "easeInOutExpo",
                smoothHeight: false,
                slideshow: true,
                slideshowSpeed: 3500,
                animationSpeed: 700,
                pauseOnAction: true,
                pauseOnHover: true,
                useCSS: false,
                controlNav: <?php echo $galleryNavOption; ?>,
                directionNav: false,
                keyboard: false,
                start: function() { jQuery('.flexslider-<?php the_ID(); ?>').removeAttr("style"); }
            });
        });
    </script>

    <div class="entry-thumb flexslider blog-flexslider flexslider-<?php the_ID(); ?>" style="height: <?php echo $galleryHeight; ?>px;">
        <ul class="slides">
            <?php foreach ($gallImages as $imgPath): ?>
                <?php if ($imgPath != ''):
                    $imgLink = premitheme_multisite_image_path($imgPath);
                    $image = premitheme_image('', $imgPath, array(600, $galleryHeight));
                ?>
                    <li data-thumb="<?php echo $image[0]; ?>">
                        <a href="<?php echo $imgLink; ?>" rel="prettyPhoto[group-<?php the_ID(); ?>]" title="<?php the_title_attribute(); ?>">
                            <img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>"/>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>

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