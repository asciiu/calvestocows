<?php
/* The template for displaying home grid showcase thumbnails */

if( has_post_thumbnail() ):
    $altAttr = get_post_meta( get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true);
    $image = premitheme_image( $post->ID, '', premitheme_img_size('grid-sowcase'));
?>
    <div class="folio-thumb">
        <img src="<?php echo $image[0]; ?>" alt="<?php echo $altAttr; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" title="<?php the_title_attribute(); ?>"/>
    </div>
<?php else: ?>
    <div class="folio-thumb">
        <img src="<?php echo get_template_directory_uri();?>/images/no-image/392x300.jpg" alt="No Image"/>
    </div>
<?php endif; ?> 