<?php
/* FUNCTION TO CHECK IF POST HAS SPECIFIC SHORTCODE
===============================================================*/
function premitheme_has_shortcode($shortcode = '') {
    if ( have_posts() ){
        $postID = get_the_ID();
        $post_to_check = get_post($postID);
        $found = false;

        if (!$shortcode) {
            return $found;
        }

        if ( !is_search() && stripos($post_to_check->post_content, '[' . $shortcode) !== false ) {
            // we have found the short code
            $found = true;
        }

        return $found;
    }
}


/* GET ATTACHMENT ID ACCORDING TO ITS SRC
===============================================================*/
function premitheme_get_attachment_id_by_src( $attachment_url = '' ) {
    global $wpdb;
    $attachment_id = false;
 
    if ( '' == $attachment_url )
        return;
 
    $upload_dir_paths = wp_upload_dir();
 
    if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
        $attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
        $attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
        $attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
    }

    return $attachment_id;
}


/* GET IMAGE PATH WITH MULTISITE SUPPORT
===============================================================*/
function premitheme_multisite_image_path($imgPath) {
    $theImageSrc = $imgPath;
    global $blog_id;
    if (isset($blog_id) && $blog_id > 0) {
        $imageParts = explode('/files/', $theImageSrc);
        if (isset($imageParts[1])) {
            $theImageSrc = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
        }
    }
    return $theImageSrc;
}


/* TRUNCATE LONG TEXT STRINGS ( LIKE LONG TITLES )
===============================================================*/
function premitheme_truncate_text($string, $count, $ellipsis = TRUE){
    $words = explode(' ', $string);
    if (count($words) > $count){
        array_splice($words, $count);
        $string = implode(' ', $words);
        $string = htmlspecialchars_decode($string);
        $string = strip_tags($string);
        if (is_string($ellipsis)){
            $string .= $ellipsis;
        }
        elseif ($ellipsis){
            $string .= ' &hellip;';
        }
    }
    return $string;
}


/* FULLSCREEN BACKGROUND
===============================================================*/
function premitheme_fullscreenBgImage() {
    $fullBgImage = '';
    
    if( is_singular() ){
        global $wp_query;
        $postid = $wp_query->post->ID;
        $singularBgImg = get_post_meta($postid, 'singular_bg_img', TRUE);
    }

    if( is_singular() && $singularBgImg ) {
        $bgImgPath = $singularBgImg;
        $fullBgImage = premitheme_multisite_image_path( $bgImgPath );
    } elseif ( of_get_option("bg_img") && of_get_option("use_full_bg") ) {
        $bgImgPath = of_get_option("bg_img");
        $fullBgImage = premitheme_multisite_image_path( $bgImgPath );
    }

    return $fullBgImage;
}

function premitheme_backgroundColor() {
    $bgColor = '';
    
    if( is_singular() ){
        global $wp_query;
        $postid = $wp_query->post->ID;
        $singularBgColor = get_post_meta($postid, 'singular_bg_color', TRUE);
    }

    if( is_singular() && $singularBgColor ) {
        $bgColor = $singularBgColor;
    } elseif( of_get_option('global_bg_color') ) {
        $bgColor = of_get_option('global_bg_color');
    }

    return $bgColor;
}

function premitheme_onBackgroundColor() {
    $onBgColor = '';
    
    if( is_singular() ){
        global $wp_query;
        $postid = $wp_query->post->ID;
        $singularOnBgColor = get_post_meta($postid, 'singular_on_bg_color', TRUE);
    }

    if( is_singular() && $singularOnBgColor ) {
        $onBgColor = $singularOnBgColor;
    } elseif( of_get_option('global_on_bg_color') ) {
        $onBgColor = of_get_option('global_on_bg_color');
    }

    return $onBgColor;
}

function premitheme_backgroundOverlay() {
    $bgOverlay = '';
    
    if( is_singular() ){
        global $wp_query;
        $postid = $wp_query->post->ID;
        $singularBgOverlay = get_post_meta($postid, 'singular_bg_overlay', TRUE);
    }

    if( is_singular() ) {
        $bgOverlay = $singularBgOverlay;
    } elseif( of_get_option('use_bg_overlay') ) {
        $bgOverlay = of_get_option('use_bg_overlay');
    }

    return $bgOverlay;
}


/* INCLUDE PORTFOLIO ITEMS IN MAIN RSS FEEDS
===============================================================*/
if( of_get_option('folio_rss') ):
    add_filter('request', 'premitheme_feed_request');
    function premitheme_feed_request($qv) {
        if (isset($qv['feed']) && !isset($qv['post_type']))
            $qv['post_type'] = array('post', 'portfolio');
        return $qv;
    }
endif;


/* ADD LIGHTBOX SUPPORT FOR WP GALLERIES & LIKED ATTACHMENTS
===============================================================*/
function premitheme_gallery_prettyPhoto ($content) {
    return str_replace("<a", "<a rel=\"prettyPhoto[slides]\"", $content);
}

if( of_get_option("use_lightbox") ):
    add_filter( 'wp_get_attachment_link', 'premitheme_gallery_prettyPhoto');
endif;


/* ALLWAYS ALLOW IMAGE INSERTION
===============================================================*/
add_filter('get_media_item_args', 'premitheme_allow_img_insertion');
function premitheme_allow_img_insertion($vars) {
    $vars['send'] = true; // 'send' as in "Send to Editor"
    return($vars);
}


/* EDIT PORTFOLIO ARCHIVES QUERY
===============================================================*/
add_filter('pre_get_posts', 'premitheme_folio_archive_posts');
function premitheme_folio_archive_posts( $query ) {
    if ( !is_admin() && $query->is_main_query() ) {
        if( is_tax( 'portfolio_cats' ) || is_tax( 'portfolio_skills' )) {

            if( of_get_option('folio_perpage') )
                $perPage = of_get_option('folio_perpage');
            else
                $perPage = '-1';

            if( of_get_option('global_folio_orderby') )
                $folio_tax_orderby_option = of_get_option('global_folio_orderby');
            else
                $folio_tax_orderby_option = 'date';

            if( of_get_option('global_folio_order') )
                $folio_tax_order_option = of_get_option('global_folio_order');
            else
                $folio_tax_order_option = 'DESC';

            $query->set('posts_per_page', $perPage);
            $query->set('orderby', $folio_tax_orderby_option);
            $query->set('order', $folio_tax_order_option);
        }
    }
    
    return $query;
}


/* CUSTOMIZE wp_list_categoories CLASSES
===============================================================*/
add_filter('wp_list_categories', 'premitheme_add_class_wp_list_categories');
function premitheme_add_class_wp_list_categories($list) {
    $args = array(
        'taxonomy' => 'portfolio_cats'
    );

    $cats  = get_categories($args);
    foreach($cats as $cat) {
        $find = 'cat-item-' . $cat->term_id . ' ';
        $replace = 'cat-item-' . $cat->term_id . ' filter ';
        $list = str_replace( $find, $replace, $list );

        $find = 'cat-item-' . $cat->term_id . '"';
        $replace = 'cat-item-' . $cat->term_id . ' filter"';
        $list = str_replace( $find, $replace, $list );
    }

    return $list;
}



/* CHECK CONTENT SECTIONS
===============================================================*/
function premitheme_home_has_sections() {
    $contentSections = '';

    if( is_page_template('home-video.php') || is_page_template('home-slideshow.php') ){
        global $wp_query;
        $postID = $wp_query->post->ID;
        $sections = get_post_meta($postID, "section_select", true);

        if( !empty($sections) ){
            if ( count($sections) == '1' && $sections[0] == '0' ){
                $contentSections = '';
            } elseif ( count($sections) == '1' && $sections[0] != '0' ){
                $contentSections = '1';
            } elseif ( count($sections) > 1 ){
                $contentSections = '1';
            }
        }
    } else {
        $contentSections = '1';
    }

    return $contentSections;
}