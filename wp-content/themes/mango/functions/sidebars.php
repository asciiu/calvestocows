<?php
add_action('widgets_init', 'premitheme_register_sidebars');
function premitheme_register_sidebars() {
    register_sidebar( array(
        'name' => __( 'General Sidebar', 'premitheme' ),
        'id' => 'sidebar-1',
        'description' => __( 'Drag widgets to this sidebar to be used with blog, single post or page. Page/Post sidebars (below) will override this sidebar if any of them has any widgets. Read the theme documentation for more info.', 'premitheme' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>'
    ) );

    register_sidebar( array(
        'name' => __( 'Single Post Sidebar', 'premitheme' ),
        'id' => 'sidebar-2',
        'description' => __( 'This sidebar will be used for single post pages automatically if it has any widget. Read the theme documentation for more info.', 'premitheme' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>'
    ) );
    
    register_sidebar( array(
        'name' => __( 'Page Sidebar', 'premitheme' ),
        'id' => 'sidebar-3',
        'description' => __( 'This sidebar will be used for pages automatically if it has any widget. Read the theme documentation for more info.', 'premitheme' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>'
    ) );

    register_sidebar( array(
        'name' => __( 'Portfolio Sidebar', 'premitheme' ),
        'id' => 'sidebar-4',
        'description' => __( 'This sidebar will be used for portfolio pages automatically if it has any widget. Read the theme documentation for more info.', 'premitheme' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>'
    ) );

    register_sidebar( array(
        'name' => __( 'FAQs Sidebar', 'premitheme' ),
        'id' => 'sidebar-5',
        'description' => __( 'This sidebar will be used for FAQs pages automatically if it has any widget. Read the theme documentation for more info.', 'premitheme' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>'
    ) );

    register_sidebar( array(
        'name' => __( 'Header Area One', 'premitheme' ),
        'id' => 'sidebar-6',
        'description' => __( 'An optional widget area for your site header (sliding panel)', 'premitheme' ),
        'before_widget' => '<aside id="%1$s" class="widget header %2$s clearfix">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>'
    ) );

    register_sidebar( array(
        'name' => __( 'Header Area Two', 'premitheme' ),
        'id' => 'sidebar-7',
        'description' => __( 'An optional widget area for your site header (sliding panel)', 'premitheme' ),
        'before_widget' => '<aside id="%1$s" class="widget header %2$s clearfix">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>'
    ) );

    register_sidebar( array(
        'name' => __( 'Header Area Three', 'premitheme' ),
        'id' => 'sidebar-8',
        'description' => __( 'An optional widget area for your site header (sliding panel)', 'premitheme' ),
        'before_widget' => '<aside id="%1$s" class="widget header %2$s clearfix">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>'
    ) );
    
    register_sidebar( array(
        'name' => __( 'Header Area Four', 'premitheme' ),
        'id' => 'sidebar-9',
        'description' => __( 'An optional widget area for your site header (sliding panel)', 'premitheme' ),
        'before_widget' => '<aside id="%1$s" class="widget header %2$s clearfix">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>'
    ) );

    register_sidebar( array(
        'name' => __( 'Footer Area One', 'premitheme' ),
        'id' => 'sidebar-10',
        'description' => __( 'An optional widget area for your site footer', 'premitheme' ),
        'before_widget' => '<aside id="%1$s" class="widget footer %2$s clearfix">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>'
    ) );

    register_sidebar( array(
        'name' => __( 'Footer Area Two', 'premitheme' ),
        'id' => 'sidebar-11',
        'description' => __( 'An optional widget area for your site footer', 'premitheme' ),
        'before_widget' => '<aside id="%1$s" class="widget footer %2$s clearfix">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>'
    ) );

    register_sidebar( array(
        'name' => __( 'Footer Area Three', 'premitheme' ),
        'id' => 'sidebar-12',
        'description' => __( 'An optional widget area for your site footer', 'premitheme' ),
        'before_widget' => '<aside id="%1$s" class="widget footer %2$s clearfix">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>'
    ) );
    
    register_sidebar( array(
        'name' => __( 'Footer Area Four', 'premitheme' ),
        'id' => 'sidebar-13',
        'description' => __( 'An optional widget area for your site footer', 'premitheme' ),
        'before_widget' => '<aside id="%1$s" class="widget footer %2$s clearfix">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>'
    ) );
}


// Count the number of active footer widget areas to generate dynamic classes for the footer widgets container
function premitheme_header_sidebar_class() {
    $count = 0;
    if ( is_active_sidebar( 'sidebar-6' ) )
        $count++;

    if ( is_active_sidebar( 'sidebar-7' ) )
        $count++;

    if ( is_active_sidebar( 'sidebar-8' ) )
        $count++;
        
    if ( is_active_sidebar( 'sidebar-9' ) )
        $count++;

    $class = '';
    switch ( $count ) {
        case '1':
            $class = 'grid_12';
            break;
            
        case '2':
            $class = 'grid_6';
            break;
            
        case '3':
            $class = 'grid_4';
            break;
            
        case '4':
            $class = 'grid_3';
            break;
    }

    if ( $class )
        echo 'class="' . $class . ' columns widget-area clearfix"';
}

function premitheme_footer_sidebar_class() {
    $count = 0;
    if ( is_active_sidebar( 'sidebar-10' ) )
        $count++;

    if ( is_active_sidebar( 'sidebar-11' ) )
        $count++;

    if ( is_active_sidebar( 'sidebar-12' ) )
        $count++;
        
    if ( is_active_sidebar( 'sidebar-13' ) )
        $count++;

    $class = '';
    switch ( $count ) {
        case '1':
            $class = 'grid_12';
            break;
            
        case '2':
            $class = 'grid_6';
            break;
            
        case '3':
            $class = 'grid_4';
            break;
            
        case '4':
            $class = 'grid_3';
            break;
    }

    if ( $class )
        echo 'class="' . $class . ' columns widget-area clearfix"';
}