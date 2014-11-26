<?php
add_filter( 'body_class', 'premitheme_body_classes' );
function premitheme_body_classes( $classes ) {
    if( is_active_sidebar( 'sidebar-6' ) ||
        is_active_sidebar( 'sidebar-7' ) ||
        is_active_sidebar( 'sidebar-8' ) ||
        is_active_sidebar( 'sidebar-9' )
    )
        $classes[] = 'header-widgets-active';

    if( is_page_template('blog.php') || is_home() )
        $classes[] = 'blog blog-main';

    if( is_page_template('blog-2col.php') )
        $classes[] = 'blog col_2 blog-main';

    if( is_category() )
        $classes[] = 'blog category';

    if( is_archive() )
        $classes[] = 'blog archive';

    if( is_search() )
        $classes[] = 'blog search';

    if( is_page_template('portfolio.php') ||
        is_tax('portfolio_cats') ||
        is_tax('portfolio_skills')
    )
        $classes[] = 'folio-page';

    if( is_page_template('home-video.php') )
        $classes[] = 'home-page home-video-page';

    if( is_page_template('home-slideshow.php') )
        $classes[] = 'home-page home-slideshow-page';

    if( is_page_template('home-corp.php') )
        $classes[] = 'home-page';

    if( is_page_template('about.php') )
        $classes[] = 'about-page';

    if( is_page_template('archives.php') )
        $classes[] = 'archives-page';

    if( is_page_template('faqs.php') )
        $classes[] = 'faqs-page';

    if( is_page_template('contact.php') )
        $classes[] = 'contact-page';

    if( (is_single() && get_post_type() == 'post') || is_attachment() )
        $classes[] = 'blog blog-single';

    if( is_single() && get_post_type() == 'portfolio' )
        $classes[] = 'folio-page folio-single';

    if( of_get_option('sidebar_position') == 'left' )
        $classes[] = 'left-sidebar';

    if( of_get_option('skin_color') == 'dark' )
        $classes[] = 'dark-skin';

    return $classes;
}