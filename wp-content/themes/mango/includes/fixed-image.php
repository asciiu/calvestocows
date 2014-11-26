<?php
/* The template for displaying fixed image content section */

global $pt_section_i;
$imgUrl =  get_post_meta($post->ID, 'fixed_img_url', TRUE);
$imgHeight =  get_post_meta($post->ID, 'fixed_img_height', TRUE);
$imgLink =  get_post_meta($post->ID, 'fixed_img_link', TRUE);
$imgTitleAttr =  get_post_meta($post->ID, 'fixed_img_titleAttr', TRUE);

if( !$imgHeight[$pt_section_i] ) $imgHeight[$pt_section_i] = '300';

if ( $imgUrl[$pt_section_i] ): 
    $src = $imgUrl[$pt_section_i];

    $imgID = premitheme_get_attachment_id_by_src($src);
    $altAttr = get_post_meta( $imgID, '_wp_attachment_image_alt', true);

    $width = 960;
    $height = $imgHeight[$pt_section_i];

    $image = premitheme_image('', $src, array($width, $height));
?>
    <!-- FIXED IMAGE BANNER
    ====================================== -->
    <div class="fixed-image-banner entry-thumb">
        <?php if($imgLink[$pt_section_i]) echo '<a href="'.$imgLink[$pt_section_i].'" title="'.$imgTitleAttr[$pt_section_i].'">'; ?>
            <?php if ( isset($image[0]) ): ?>
                <img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" alt="<?php echo $altAttr; ?>" title="<?php echo $imgTitleAttr[$pt_section_i]; ?>"/>
            <?php else: ?>
                <img src="<?php echo get_template_directory_uri();?>/images/no-image/960x300.jpg" alt="No Image"/>
            <?php endif; ?>
        <?php if($imgLink[$pt_section_i]) echo '</a>'; ?>
    </div>
<?php
endif;