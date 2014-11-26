<!DOCTYPE html>
<!--[if IE 8]>
<html class="no-js ie8" <?php language_attributes();?>>
<![endif]-->
<!--[if IE 9]>
<html class="no-js ie9" <?php language_attributes();?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html class="no-js" <?php language_attributes();?>>
<!--<![endif]-->

<head>
    <?php 
    global $pt_retina;
    if ( !isset( $_COOKIE['pt_retina'] ) ) {
    ?>
        <!-- SET COOKIE FOR SCREEN PIXLE RATIO
        ====================================== -->
        <script>
            var pathname = window.location.pathname;
            var pathnameCheck = pathname.indexOf("wp-admin");
            var retina = 'pt_retina='+ window.devicePixelRatio +';'+ retina;
            document.cookie = retina;
            if ( document.cookie.length !== 0 && pathnameCheck == -1 ) { document.location.reload(true); }
        </script>
    <?php } ?>

    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- FACEBOOK SHARE INFO
    ====================================== -->
    <?php if ( !is_404() ): ?>
        <meta property="og:site_name" content="<?php bloginfo('name'); ?>"/>
        <meta property="og:title" content="<?php echo premitheme_site_title(); ?>" />
        <?php if ( have_posts() ): the_post(); ?>
            <?php if ( is_front_page() ) { ?>
                <meta property="og:type" content="website" />
                <meta property="og:url" content="<?php echo home_url( '/' ); ?>" />
                <meta property="og:description" content="<?php echo premitheme_site_title(); ?>" />
            <?php } elseif ( is_singular() ) { ?>
                <meta property="og:type" content="article" />
                <meta property="og:url" content="<?php the_permalink(); ?>" />
                <meta property="og:description" content="<?php echo wp_strip_all_tags(get_the_excerpt(), true); ?>" />
            <?php } else { ?>
                <meta property="og:type" content="article" />
                <meta property="og:url" content="<?php the_permalink(); ?>" />
                <meta property="og:description" content="<?php echo wp_strip_all_tags(get_the_excerpt(), true); ?>" />
            <?php } ?>
            <?php if ( has_post_thumbnail() ): ?>
                <meta property="og:image" content="<?php $post_thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'fb'); echo $post_thumbnail[0]; ?>" />
            <?php endif; ?>
            <?php preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches); if( isset($matches [1] [0]) ): ?>
                <meta property="og:image" content="<?php echo $matches[1][0]; ?>" />
            <?php endif; ?>
        <?php endif; rewind_posts(); ?>
        <?php if ( of_get_option('site_logo') ): ?>
            <meta property="og:image" content="<?php echo of_get_option('site_logo'); ?>" />
        <?php endif; ?>
    <?php endif; ?>

    <!-- SITE TITLE
    ====================================== -->
    <title><?php echo premitheme_site_title(); ?></title>

    <!-- FAVICON
    ====================================== -->
    <?php if ( $pt_retina && of_get_option('favicon_retina') ): ?>
        <link rel="shortcut icon" href="<?php echo of_get_option('favicon_retina');?>" type="image/x-icon" />
    <?php elseif ( of_get_option('favicon') ): ?>
        <link rel="shortcut icon" href="<?php echo of_get_option('favicon');?>" type="image/x-icon" />
    <?php endif; ?>

    <!-- APPLE TOUCH DEVICE ICON
    ====================================== -->
    <?php if ( of_get_option('apple_icon') ): ?>
        <link rel="apple-touch-icon" href="<?php echo of_get_option('apple_icon');?>"/>
    <?php endif; ?>
    <?php if ( of_get_option('apple_icon_72') ): ?>
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo of_get_option('apple_icon_72');?>" />
    <?php endif; ?>
    <?php if ( of_get_option('apple_icon_114') ): ?>
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo of_get_option('apple_icon_114');?>" />
    <?php endif; ?>
    <?php if ( of_get_option('apple_icon_144') ): ?>
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo of_get_option('apple_icon_144');?>" />
    <?php endif; ?>

    <!-- BINGBACK
    ====================================== -->
    <link rel="pingback" href="<?php bloginfo('pingback_url');?>" />

    <!-- WP HEAD
    ====================================== -->
    <?php wp_head();?>
</head>

<body id="skrollr-body" <?php body_class(); ?> data-stellar-background-ratio="0.05">
    <?php if(of_get_option('use_loading_animation')): ?>
        <div id="page-loading">
            <div id="progress-container">
                <div id="progress-bar"></div>
            </div>
        </div>
    <?php endif; ?>

    <?php get_sidebar('header');
    
    if( is_page_template('home-video.php') || is_page_template('home-slideshow.php') ){
        if( premitheme_home_has_sections() ){
            $containerPadding = ' padding-bottom';
        } else {
            $containerPadding = '';
        }
    } else {
        $containerPadding = ' padding-bottom';
    }
    ?>

    <div id="main-container" class="fullwidth-container<?php echo $containerPadding; ?>">
        <div id="header-container" class="fullwidth-container">
            <header id="branding" class="container alpha omega">
                <div id="fixed-navigation" class="clearfix">
                    <!-- FIXED SITE LOGO
                    ====================================== -->
                    <?php echo premitheme_site_logo(); ?>

                    <?php if (class_exists('WooCommerce')):
                      global $woocommerce;
                    ?>
                        <!-- FIXED CART BUTTON
                        ====================================== -->
                        <div class="cart-contents">
                            <a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'premitheme'); ?>" data-count="<?php echo esc_attr( $woocommerce->cart->cart_contents_count ); ?>">
                                <i class="fa fa-shopping-cart"></i>
                            </a>
                        </div>
                    <?php endif; ?>

                    <!-- FIXED NAVIGATION MENU
                    ====================================== -->
                    <nav class="main-navigation">
                        <?php premitheme_navigation('header'); ?>
                    </nav>
                </div>

                <div id="floating-navigation" class="clearfix">
                    <!-- FLOATING SITE LOGO
                    ====================================== -->
                    <?php echo premitheme_site_logo(); ?>

                    <?php if (class_exists('WooCommerce')):
                      global $woocommerce;
                    ?>
                        <!-- FLOATING CART BUTTON
                        ====================================== -->
                        <div class="cart-contents">
                            <a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'premitheme'); ?>" data-count="<?php echo esc_attr( $woocommerce->cart->cart_contents_count ); ?>">
                                <i class="fa fa-shopping-cart"></i>
                            </a>
                        </div>
                    <?php endif; ?>

                    <!-- FLOATING NAVIGATION MENU
                    ====================================== -->
                    <nav class="main-navigation">
                        <?php premitheme_navigation('header'); ?>
                    </nav>
                </div>
            </header>
        </div><!-- #header-container -->