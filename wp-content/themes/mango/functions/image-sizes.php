<?php
// RETURN RESIZED IMAGE PATH
function premitheme_image($id, $src, $args){
    // DEFAUL ARGS
    $width = isset($args[0]) ? $args[0] : '';
    $height = isset($args[1]) ? $args[1] : '';

    // RETINA SIZE
    $pt_width = has_filter('pt_resize_width') ? apply_filters( 'pt_resize_width', $width) : $width;
    $pt_height = has_filter('pt_resize_height') ? apply_filters( 'pt_resize_height', $height) : $height;

    if( !$src && $id ){
        // GET FEATURED IMAGE PATH
        $thumbnail_id = get_post_meta( $id, '_thumbnail_id', true );
        list($src) = wp_get_attachment_image_src( $thumbnail_id, 'full' );
    }

    // RESIZE IMAGE
    $image = aq_resize($src, $pt_width, $pt_height, $crop = true, $single = false, $upsize = true);

    // GET WIDTH & HEIGHT ATTRIBUTES
    $width_attr = has_filter('pt_resize_width') ? round($image[1] / 2) : $image[1];
    $height_attr = has_filter('pt_resize_height') ? round($image[2] / 2) : $image[2];

    // RETURN RESIZED IMAGE PATH
    return array($image[0], $width_attr, $height_attr);
}

// DEFAULT IMAGE SIZES
function premitheme_img_size($size){
    if( $size == 'blog-standard' ) return array(600, '');
    if( $size == 'page-standard' ) return array(960, 200);
    if( $size == 'related-standard' ) return array(380, 200);
    if( $size == 'folio-3col' ) return array(392, 300);
    if( $size == 'folio-masonry-3col' ) return array(392, '');
    if( $size == 'folio-2col' ) return array(450, 250);
    if( $size == 'folio-masonry-2col' ) return array(450, '');
    if( $size == 'folio-2col-sidebar' ) return array(392, 280);
    if( $size == 'folio-masonry-2col-sidebar' ) return array(392, '');
    if( $size == 'recent-posts' ) return array(392, 164);
    if( $size == 'grid-sowcase' ) return array(232, 180);
    if( $size == 'client-thumb' ) return array(232, '');
    if( $size == 'post-wid-thumb' ) return array(50, 50);
    if( $size == 'folio-wid-thumb' ) return array(392, 270);
    if( $size == '100x100' ) return array(100, 100);
}