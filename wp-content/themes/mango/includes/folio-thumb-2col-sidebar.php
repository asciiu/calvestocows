<?php
/* The template for displaying portfolio 2 thumbnails columns with sidebar */

global $pt_folio_thumbs_style_option;

if( has_post_thumbnail() ):
    $altAttr = get_post_meta( get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true);

    if( $pt_folio_thumbs_style_option == 'masonry' ){
        $image = premitheme_image( $post->ID, '', premitheme_img_size('folio-masonry-2col-sidebar'));
    } else {
        $image = premitheme_image( $post->ID, '', premitheme_img_size('folio-2col-sidebar'));
    }
?>
    <div class="folio-thumb">
        <img src="<?php echo $image[0]; ?>" alt="<?php echo $altAttr; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" title="<?php the_title_attribute(); ?>"/>
    </div>
<?php else: ?>
    <div class="folio-thumb">
        <img src="<?php echo get_template_directory_uri();?>/images/no-image/450x250.jpg" alt="No Image"/>
    </div>
<?php endif; ?>