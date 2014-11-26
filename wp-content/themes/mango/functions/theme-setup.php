<?php
add_action( 'after_setup_theme', 'premitheme_theme_setup' );
if ( ! function_exists( 'premitheme_theme_setup' ) ):
    function premitheme_theme_setup() {
        // Translation text domain
        load_theme_textdomain( 'premitheme', get_template_directory() . '/languages' );
        $locale = get_locale();
        $locale_file = get_template_directory() . "/languages/$locale.php";
        if ( is_readable($locale_file) )
            require_once($locale_file);
        
        // Featured Images (post thumbnail)
        add_theme_support( 'post-thumbnails', array('post', 'page', 'portfolio', 'slides', 'team') );
        
        // Add default posts and comments RSS feed links to <head> section
        add_theme_support( 'automatic-feed-links' );
        
        // WP menus
        register_nav_menu( 'header', __( 'Main Navigation', 'premitheme' ) );
        register_nav_menu( 'footer', __( 'Footer Navigation', 'premitheme' ) );
        
        // Post Formats
        add_theme_support( 'post-formats', array( 'link', 'video', 'audio', 'quote', 'gallery', 'aside', 'status' ) );

        // WooCommerce
        add_theme_support( 'woocommerce' );
        
        // Sets the post excerpt length
        function premitheme_excerpt_length( $length ) {
            return 35;
        }
        add_filter( 'excerpt_length', 'premitheme_excerpt_length' );
        
        // "Read more" link
        function premitheme_post_more_link() {
            return '<br /><a class="more-link" href="'. esc_url( get_permalink() ) . '">' . __( 'Read more +', 'premitheme' ) . '</a>';
        }
        function premitheme_portfolio_more_link() {
            return '<br /><a class="more-link" href="'. esc_url( get_permalink() ) . '">' . __( 'Details +', 'premitheme' ) . '</a>';
        }
        
        // Replaces "[...]" with just "..."
        function premitheme_excerpt_more_link( $more ) {
            if( get_post_type() == 'portfolio' ){
                return ' &hellip; '.premitheme_portfolio_more_link();
            } else {
                return ' &hellip; '.premitheme_post_more_link();
            }
        }
        add_filter( 'excerpt_more', 'premitheme_excerpt_more_link' );
    }
endif;


/* REWRITE FLUSH AFTER THEME SWITCH
===============================================================*/
add_action( 'after_switch_theme', 'premitheme_rewrite_flush' );
function premitheme_rewrite_flush() {
    flush_rewrite_rules();
}