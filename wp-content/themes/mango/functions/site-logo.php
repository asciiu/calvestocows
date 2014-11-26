<?php
function premitheme_site_logo(){
    global $pt_retina;
    
    if( of_get_option('site_logo') || of_get_option('site_logo_retina') ){
        $class = '';

        if( $pt_retina && of_get_option('site_logo_retina') ){
            $logoPath = premitheme_multisite_image_path( of_get_option('site_logo_retina') );
            $attachment_id = premitheme_get_attachment_id_by_src($logoPath);
            list($src, $origWidth, $origHeight) = wp_get_attachment_image_src( $attachment_id, 'full' );
            $width = $origWidth / 2;
            $height = $origHeight / 2;
        } elseif( of_get_option('site_logo') ){
            $logoPath = premitheme_multisite_image_path( of_get_option('site_logo') );
            $attachment_id = premitheme_get_attachment_id_by_src($logoPath);
            list($src, $width, $height) = wp_get_attachment_image_src( $attachment_id, 'full' );
        }

        $logo = '<img src="'.$src.'" width="'.$width.'" height="'.$height.'" alt="'.esc_attr( get_bloginfo('name') ).__(' logo', 'premitheme').'"/>';
    } else {
        $class = ' class="logo-ph"';
        $logo  = get_bloginfo('name', 'display');
    }

    $output  = '<div id="logo"'.$class.'>';
    $output .= '<h1>';
    $output .= '<a href="'.home_url( '/' ).'" title="'.esc_attr( get_bloginfo('name', 'display').' | '.get_bloginfo('description', 'display') ).'">';
    $output .= $logo;
    $output .= '<span class="visually-hidden">'.get_bloginfo('name', 'display').'</span>';
    $output .= '</a>';
    $output .= '</h1>';
    $output .= '</div>';

    return $output;
}