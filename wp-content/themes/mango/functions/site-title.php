<?php
function premitheme_site_title() {
    global $page, $paged, $post, $posts;
    $site_name = get_bloginfo( 'name', 'display' );
    $site_description = get_bloginfo( 'description', 'display' );
    if ( is_front_page() ):
        if ( $site_description ):
            $pt_site_title = $site_name.' | '.$site_description;
        else:
            $pt_site_title = $site_name;
        endif;
    else:
        $pt_site_title = wp_title( '|', false, 'right' ).' '.$site_name;
    endif;

    return $pt_site_title;
}