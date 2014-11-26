<?php
add_action('wp_enqueue_scripts', 'premitheme_enqueue_styles');
add_action('wp_enqueue_scripts', 'premitheme_enqueue_scripts');

function premitheme_enqueue_styles() {
    if( of_get_option('cus_font_stylesheet') ){
        $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
        $cusFontTag = of_get_option('cus_font_stylesheet');
        preg_match($reg_exUrl, $cusFontTag, $href);
        $cusFontHref = $href[0];
    }

    if( !is_admin() ){
        wp_register_style('main_style', get_stylesheet_uri() );
        wp_register_style('social', get_template_directory_uri() . '/css/social.css' );
        wp_register_style('awesome', get_template_directory_uri() . '/css/font-awesome.css' );
        wp_register_style('vegas', get_template_directory_uri() . '/css/jquery.vegas.css' );

        if( of_get_option('cus_font_stylesheet') && of_get_option('cus_font_family') ){
            wp_enqueue_style('cus_font', $cusFontHref );
        } else {
            wp_enqueue_style('cus_font', '//fonts.googleapis.com/css?family=Oswald:400,300,700' );
        }

        wp_enqueue_style( 'main_style' );
        wp_enqueue_style( 'social' );
        wp_enqueue_style( 'awesome' );

        if( is_page_template('home-video.php') || is_page_template('home-slideshow.php') || premitheme_fullscreenBgImage() || of_get_option('bg_img') ){
            wp_enqueue_style( 'vegas' );
        }

        if( of_get_option('skin_color') == 'dark' ){
            wp_enqueue_style('theme-style', get_template_directory_uri() . '/css/dark.css' );
        } else {
            wp_enqueue_style('theme-style', get_template_directory_uri() . '/css/light.css' );
        }
    }
}

function premitheme_enqueue_scripts() {
    wp_register_script('modernizr', get_template_directory_uri() . '/js/modernizr.js', array('jquery'), '2.7.1', FALSE );
    wp_register_script('easing', get_template_directory_uri() . '/js/jquery.easing.min.js', array('jquery'), '1.3', TRUE );
    wp_register_script('supersubs', get_template_directory_uri() . '/js/supersubs.js', array('jquery'), '0.3b', TRUE );
    wp_register_script('superfish', get_template_directory_uri() . '/js/superfish.min.js', array('jquery'), '1.7.4', TRUE );
    wp_register_script('fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array('jquery'), '1.1', TRUE );
    wp_register_script('prettyphoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array('jquery'), '3.1.5', TRUE );
    wp_register_script('prettysocial', get_template_directory_uri() . '/js/jquery.prettySocial.min.js', array('jquery'), '1.1.0', TRUE );
    wp_register_script('jplayer', get_template_directory_uri() . '/js/jquery.jplayer.min.js', array('jquery'), '2.6.0', TRUE );
    wp_register_script('flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array('jquery'), '2.1', TRUE );
    wp_register_script('isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array('jquery'), '1.5.26', TRUE );
    wp_register_script('validate', '//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js', array('jquery'), '1.11.1', TRUE);
    wp_register_script('gmap_api', '//maps.google.com/maps/api/js?sensor=false', array('jquery'), '1.0', FALSE );
    wp_register_script('gmap', get_template_directory_uri() . '/js/jquery.gmap.min.js', array('jquery'), '2.1.5', TRUE );
    wp_register_script('skrollr', get_template_directory_uri() . '/js/skrollr.min.js', array(), '0.6.22', TRUE );
    wp_register_script('reveal', get_template_directory_uri() . '/js/jquery.reveal.js', array('jquery'), '1.0', TRUE );
    wp_register_script('ytplayer', get_template_directory_uri() . '/js/jquery.mb.YTPlayer.js', array('jquery'), '2.6.4', TRUE );
    wp_register_script('vegas', get_template_directory_uri() . '/js/jquery.vegas.min.js', array('jquery'), '1.3.4', TRUE );
    wp_register_script('pt-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), '1.0', TRUE );

    wp_enqueue_script('modernizr');
    wp_enqueue_script('easing');
    wp_enqueue_script('supersubs');
    wp_enqueue_script('superfish');
    wp_enqueue_script('fitvids');
    wp_enqueue_script('prettyphoto');
    wp_enqueue_script('skrollr');

    /* SHARRRE
    =====================*/
    if( ( is_single() && get_post_type() == 'post' && of_get_option('sharing_on') ) ||
        ( is_single() && get_post_type() == 'portfolio' && of_get_option('folio_sharing') )
    ){
        wp_enqueue_script( 'prettysocial' );
    }

    /* FULLSCREEN BG
    =====================*/
    if( premitheme_fullscreenBgImage() || of_get_option('bg_img') ){
        wp_enqueue_script( 'vegas' );
    }

    /* FLEXSLIDER
    =====================*/
    if( premitheme_has_shortcode('pt_slider') ||
        is_page_template('home-corp.php') ||
        is_page_template('home-video.php') ||
        is_page_template('home-slideshow.php') ||
        is_home() ||
        is_archive() ||
        is_search() ||
        ( is_single() && get_post_format() == 'gallery' ) ||
        ( is_single() && get_post_type() == 'portfolio' ) ||
        is_page_template('blog.php') ||
        is_page_template('blog-2col.php') ||
        is_active_widget(false, false, 'portfolio-widget')
    ){
        wp_enqueue_script( 'flexslider' );
    }

    /* JPLAYER
    =====================*/
    if( premitheme_has_shortcode('pt_audio') ||
        is_home() ||
        is_archive() ||
        is_search() ||
        ( is_single() && get_post_format() == 'audio' ) ||
        ( is_single() && get_post_format() == 'video' ) ||
        is_page_template('blog.php') ||
        is_page_template('blog-2col.php') ||
        ( is_single() && get_post_type() == 'portfolio' ) ||
        is_page_template('home-corp.php') ||
        is_page_template('home-video.php') ||
        is_page_template('home-slideshow.php')
    ){
        wp_enqueue_script( 'jplayer' );
    }

    /* TABS
    =====================*/
    if( premitheme_has_shortcode('pt_tabs') ){
        wp_enqueue_script('jquery-ui-tabs');
    }

    /* ACCORDION
    =====================*/
    if( premitheme_has_shortcode('pt_accordion') ){
        wp_enqueue_script( 'jquery-ui-accordion' );
    }

    /* REVEAL
    =====================*/
    if( premitheme_has_shortcode('pt_popup') ){
        wp_enqueue_script( 'reveal' );
    }

    /* GMAP & VALIDATE
    =====================*/
    if( is_page_template('contact.php') ){
        wp_enqueue_script( 'validate' );
        wp_enqueue_script( 'gmap_api' );
        wp_enqueue_script( 'gmap' );
    }

    /* ISOTOPE
    =====================*/
    if( is_page_template('portfolio.php') ||
        is_tax('portfolio_cats') ||
        is_tax('portfolio_skills') ||
        is_page_template('blog-2col.php')
    ){
        wp_enqueue_script( 'isotope' );
    }

    /* YTPlayer
    =====================*/
    if( is_page_template('home-video.php') ){
        wp_enqueue_script('ytplayer');
        wp_enqueue_script('vegas');
    }

    /* HOME FULLSCREEN SLIDESHOW
    =====================*/
    if( is_page_template('home-slideshow.php') ){
        wp_enqueue_script('vegas');
    }

    /* COMMENT REPLY
    =====================*/
    if( is_singular() && get_option( 'thread_comments' ) ){
        wp_enqueue_script( 'comment-reply' );
    }

    /* CUSTOM SCRIPTS
    =====================*/
    wp_enqueue_script('pt-custom');
}