<?php
add_action('wp_head', 'premitheme_theme_inline_styles', 10);
function premitheme_theme_inline_styles() {
    $accent_color = of_get_option('cus_accent_color');
    $on_accent_color = of_get_option('on_accent_color');
    $fullBgImage = premitheme_fullscreenBgImage();
    $on_bg_color = premitheme_onBackgroundColor();
    $bg_color = premitheme_backgroundColor();
    $logo_bg_color = of_get_option('logo_bg_color');
    $centerContent = of_get_option('center_content');
    
    if(
        $on_bg_color ||
        $logo_bg_color ||
        is_page_template('home-video.php') ||
        is_page_template('home-slideshow.php') ||
        ( !$fullBgImage && of_get_option('bg_img') ) ||
        $accent_color ||
        $on_accent_color ||
        ( of_get_option('cus_font_stylesheet') && of_get_option('cus_font_family') ) ||
        of_get_option('custom_css') ||
        $centerContent
    ):
    ?>
        <style type="text/css">
            <?php if( $centerContent ): ?>
                #header-widgets > .container,
                #page-title.container,
                #content-container > .container,
                #footer-container > .container {
                    margin: 0 auto;
                }

                .bg-layer { background: none !important; }
            <?php endif; ?>

            <?php if( $on_bg_color ): ?>
                .main-navigation > ul > li > a,
                #page-title {
                    color: <?php echo $on_bg_color ?>;
                }
            <?php endif; ?>

            <?php if( $logo_bg_color ): ?>
                #logo {
                    background: <?php echo $logo_bg_color ?>;
                }
            <?php endif; ?>

            <?php if( is_page_template('home-video.php') ):
                global $wp_query;
                $postid = $wp_query->post->ID;
                $homeVideoBG = get_post_meta($postid, 'home_video_bg_color', TRUE);
                $homeVideoTextColor = get_post_meta($postid, 'home_video_text_color', TRUE);
                $homeVideoTextShadow = get_post_meta($postid, 'home_video_text_shadow', TRUE);
            ?>
                <?php if($homeVideoBG): ?>
                    body { background: <?php echo $homeVideoBG; ?>; }
                <?php endif; ?>

                <?php if($homeVideoTextColor): ?>
                    .main-navigation > ul > li > a,
                    #video-screen h1,
                    #video-screen .social-wrapper .social-link a,
                    #bouncing-arrow {
                        color: <?php echo $homeVideoTextColor; ?>;
                    }

                    .social-sep {
                        border-top: 1px solid <?php echo $homeVideoTextColor; ?>;
                    }
                <?php endif; ?>

                <?php if($homeVideoTextShadow == '1'): ?>
                    #video-screen h1,
                    #video-screen .social-wrapper .social-link a,
                    #bouncing-arrow {
                        -webkit-text-shadow: 1px 1px 10px rgba(0,0,0,0.3);
                        -moz-text-shadow:    1px 1px 10px rgba(0,0,0,0.3);
                        text-shadow:         1px 1px 10px rgba(0,0,0,0.3);
                    }
                <?php endif; ?>
            <?php elseif( is_page_template('home-slideshow.php') ):
                global $wp_query;
                $postid = $wp_query->post->ID;
                $homeSlideshowBG = get_post_meta($postid, 'home_slideshow_bg_color', TRUE);
                $homeSlideshowTextColor = get_post_meta($postid, 'home_slideshow_text_color', TRUE);
                $homeSlideshowTextShadow = get_post_meta($postid, 'home_slideshow_text_shadow', TRUE);
            ?>
                <?php if($homeSlideshowBG): ?>
                    body { background: <?php echo $homeSlideshowBG; ?>; }
                <?php endif; ?>

                <?php if($homeSlideshowTextColor): ?>
                    .main-navigation > ul > li > a,
                    #slideshow-screen h1,
                    #slideshow-screen .social-wrapper .social-link a,
                    #bouncing-arrow {
                        color: <?php echo $homeSlideshowTextColor; ?>;
                    }

                    .social-sep {
                        border-top: 1px solid <?php echo $homeSlideshowTextColor; ?>;
                    }
                <?php endif; ?>

                <?php if($homeSlideshowTextShadow == '1'): ?>
                    #slideshow-screen h1,
                    #slideshow-screen .social-wrapper .social-link a,
                    #bouncing-arrow {
                        -webkit-text-shadow: 1px 1px 10px rgba(0,0,0,0.3);
                        -moz-text-shadow:    1px 1px 10px rgba(0,0,0,0.3);
                        text-shadow:         1px 1px 10px rgba(0,0,0,0.3);
                    }
                <?php endif; ?>
            <?php else: ?>
                <?php if( !$fullBgImage && of_get_option('bg_img') ): ?>
                    body { background-image: url(<?php echo of_get_option('bg_img'); ?>); }
                <?php endif; ?>

                <?php if( of_get_option('bg_x_pos') && of_get_option('bg_y_pos') ): ?>
                    body { background-position: <?php echo of_get_option('bg_x_pos'); ?> <?php echo of_get_option('bg_y_pos'); ?>; }
                <?php endif; ?>

                <?php if( of_get_option('bg_att') != '0' ): ?>
                    body { background-attachment: <?php echo of_get_option('bg_att'); ?>; }
                <?php endif; ?>

                <?php if( of_get_option('bg_repeat') != '0' ): ?>
                    body { background-repeat: <?php echo of_get_option('bg_repeat'); ?>; }
                <?php endif; ?>

                <?php if( $bg_color ): ?>
                    body { background-color: <?php echo $bg_color; ?>; }
                <?php endif; ?>
            <?php endif; ?>

            <?php if( $accent_color ): ?>
                .js #page-loading #progress-container #progress-bar,
                #logo,
                .main-navigation a:hover,
                .main-navigation > ul > .hover-menu-item,
                .main-navigation ul ul .current-menu-item > a,
                .main-navigation ul ul .current-menu-ancestor > a,
                .main-navigation #dropdown-nav,
                #header-widgets,
                #header-widgets-trigger,
                .jp-play-bar,
                .jp-volume-bar-value,
                #filtering-links ul li a:hover,
                .folio-content .folio-meta .live-btn,
                .home-page .recent-posts-row .recent-post-wrapper .recent-post .recent-post-meta,
                .home-page .last-tweet,
                .blog .entry-date,
                #pagination .page-numbers.current,
                .faqs-page .faq-titles h2 span,
                .faqs-page .faq-answers a.top:hover,
                .faqs-page .faq-accordion .accHead h2 span,
                .archives-page .archives-section.by-tag a:hover,
                .highlighted-text,
                .dropcap,
                .price-label.price-featured .label-title,
                .price-label.price-featured .label-price,
                .pt-graph ul li div,
                input[type="submit"]:hover,
                button:hover,
                #comments #respond input[type="submit"]:hover,
                .folio-navigation > div a:hover {
                    background: <?php echo $accent_color; ?>;
                }

                .gallery a:hover {
                    background-color: <?php echo $accent_color; ?>;
                }

                .post-edit-link:hover,
                #comments .comment-reply-link:hover,
                #comments .comment-reply-login:hover,
                #comments .comment-edit-link:hover,
                #comments #comment_nav_below a:hover,
                #comments #respond #cancel-comment-reply-link:hover {
                    background: <?php echo $accent_color; ?> !important;
                }

                @media only screen and (max-width: 479px) {
                    .home-page .home-flexslider .flex-control-nav {
                        background: <?php echo $accent_color; ?>;
                    }
                }

                a:hover,
                #comments .comment-author-name a:hover,
                #comments .comment-date a:hover,
                #comments #respond a:hover,
                .no-touch .folio-item .folio-overlay h3,
                .folio-content .folio-meta .live-btn:hover,
                .home-page .recent-posts-row .recent-post-wrapper .recent-post .recent-post-content h2.entry-title a:hover,
                .blog .entry-link a:hover,
                .blog .entry-quote a:hover,
                .blog h2.entry-title a:hover,
                .blog #author-info .author-content h3 a:hover,
                #header-widgets aside.widget.widget_tag_cloud .tagcloud > a:hover,
                #header-widgets #wp-calendar #today,
                #header-widgets #wp-calendar #today a,
                #header-widgets #wp-calendar #today a:hover {
                    color: <?php echo $accent_color; ?>;
                }

                input[type="submit"]:hover,
                button:hover,
                .gallery a:hover,
                #comments #respond input[type="submit"]:hover,
                .folio-navigation > div a:hover,
                .main-navigation > ul > .hover-menu-item > a,
                .main-navigation ul ul,
                .main-navigation > ul > .current-menu-item > a,
                .main-navigation > ul > .current-menu-ancestor > a,
                h3.section-heading span,
                h3.home-section-heading span,
                input[type="text"]:focus,
                input[type="email"]:focus,
                input[type="url"]:focus,
                input[type="password"]:focus,
                textarea:focus,
                #comments li.comment-wrapper.bypostauthor .comment-avatar img,
                #comments #respond,
                #comments #respond input[type="text"]:focus,
                #comments #respond textarea:focus,
                #related-posts .related-entry:hover .related-thumb,
                .touch .folio-item:hover .folio-overlay,
                .home-page .recent-posts-row .recent-post-wrapper .recent-post .recent-post-content a.more-link:hover,
                .blog .status-avatar img,
                .blog a.more-link:hover,
                .blog #author-info .author-avatar img,
                .about-page #work-team > ul .team-member-wrapper .team-member-photo,
                .faqs-page .faq-answers .faq-group,
                .contact-page #contact-form,
                .archives-page .archives-section,
                aside.widget h3.widget-title > span,
                .touch aside.widget.widget-portfolio .flex-viewport:hover,
                aside.widget.widget-flickr #flickr_badge_wrapper .flickr_badge_image a:hover,
                aside.widget.widget-instagram .instagram-wrapper .instagram-thumb a:hover,
                aside.widget.widget-posts-thumbs a:hover .wid-thumb,
                #header-widgets aside.widget.widget-twitter ul li,
                .pt-service:hover .pt-icon {
                    border-color: <?php echo $accent_color; ?>;
                }

                .home-page .callout-message {
                    border-top: 10px solid <?php echo $accent_color; ?>;
                }

                .boxshadow .pt-service:hover .pt-icon {
                    -webkit-box-shadow: inset 0 0 0 0 rgba(0, 0, 0, 0.2), 0 0 0 6px <?php echo $accent_color; ?>;
                    -moz-box-shadow: inset 0 0 0 0 rgba(0, 0, 0, 0.2), 0 0 0 6px <?php echo $accent_color; ?>;
                    box-shadow: inset 0 0 0 0 rgba(0, 0, 0, 0.2), 0 0 0 6px <?php echo $accent_color; ?>;
                }
            <?php endif; ?>

            <?php if( $on_accent_color ):; ?>
                #logo.logo-ph a,
                .main-navigation > ul > li.hover-menu-item > a,
                .main-navigation > ul > li > a:hover,
                .main-navigation ul ul .current-menu-item > a,
                .main-navigation ul ul .current-menu-ancestor > a,
                .main-navigation #dropdown-nav,
                #header-widgets-trigger,
                .post-edit-link:hover,
                input[type="submit"]:hover,
                button:hover,
                #comments #respond input[type="submit"]:hover,
                #comments .comment-reply-link:hover,
                #comments .comment-reply-login:hover,
                #comments .comment-edit-link:hover,
                #comments #comment_nav_below a:hover,
                #comments #respond #cancel-comment-reply-link:hover,
                #filtering-links ul li a:hover,
                .folio-navigation > div a:hover,
                .folio-content .folio-meta .live-btn,
                .home-page .recent-posts-row .recent-post-wrapper .recent-post .recent-post-meta,
                .home-page .recent-posts-row .recent-post-wrapper .recent-post .recent-post-meta .recent-entry-comments a,
                .home-page .last-tweet .tweet-container,
                .blog .entry-date,
                #pagination .page-numbers.current,
                .faqs-page .faq-titles h2 span,
                .faqs-page .faq-answers a.top:hover,
                .faqs-page .faq-accordion .accHead h2 span,
                .archives-page .archives-section.by-tag a:hover,
                #header-widgets aside.widget,
                #header-widgets aside.widget a,
                #header-widgets aside.widget ul li:before,
                #header-widgets aside.widget.widget-posts-thumbs a h2,
                #header-widgets aside.widget.widget-posts-thumbs li .wid-post-meta,
                #header-widgets aside.widget.widget_search input[type="submit"],
                #header-widgets #wp-calendar,
                .highlighted-text,
                .dropcap,
                .price-label.price-featured .label-price,
                .pt-graph ul li div,
                .home-page .last-tweet .tweet-container a,
                #header-widgets aside.widget input[type="text"],
                #header-widgets aside.widget input[type="email"],
                #header-widgets aside.widget input[type="url"],
                #header-widgets aside.widget input[type="password"],
                #header-widgets aside.widget textarea,
                .price-label.price-featured .label-title,
                #floating-navigation .main-navigation > ul > li.hover-menu-item > a,
                #floating-navigation .main-navigation > ul > li > a:hover {
                    color: <?php echo $on_accent_color; ?>;
                }

                .folio-content .folio-meta .live-btn:hover,
                #header-widgets aside.widget.widget_tag_cloud .tagcloud > a:hover,
                #header-widgets aside.widget.widget-twitter ul li.twitter-bg,
                #header-widgets #wp-calendar #today,
                #header-widgets #wp-calendar #today a,
                #header-widgets #wp-calendar #today a:hover {
                    background: <?php echo $on_accent_color; ?>;
                }

                @media only screen and (max-width: 479px) {
                    .home-page .home-flexslider .flex-control-nav li a {
                        background: <?php echo $on_accent_color; ?>;
                    }
                }

                #header-widgets aside.widget h3.widget-title,
                #header-widgets aside.widget h3.widget-title > span,
                #header-widgets aside.widget.widget_tag_cloud .tagcloud > a,
                #header-widgets aside.widget.widget-twitter ul,
                #header-widgets aside.widget.widget-twitter ul li a,
                #header-widgets aside.widget.widget-portfolio .flex-viewport,
                #header-widgets aside.widget.widget-portfolio .flexslider-folio-wid .flex-direction-nav a,
                #header-widgets aside.widget.widget-flickr #flickr_badge_wrapper .flickr_badge_image a,
                #header-widgets aside.widget.widget-flickr #flickr_badge_wrapper .flickr_badge_image a:hover,
                #header-widgets aside.widget.widget-instagram .instagram-wrapper .instagram-thumb a,
                #header-widgets aside.widget.widget-instagram .instagram-wrapper .instagram-thumb a:hover,
                #header-widgets aside.widget.widget-posts-thumbs a .wid-thumb,
                #header-widgets aside.widget.widget-posts-thumbs a:hover .wid-thumb,
                #header-widgets #wp-calendar caption,
                #header-widgets #wp-calendar th,
                #header-widgets #wp-calendar tfoot,
                .home-page .last-tweet .tweet-container a,
                .price-label.price-featured .label-title,
                #header-widgets aside.widget input[type="text"],
                #header-widgets aside.widget input[type="email"],
                #header-widgets aside.widget input[type="url"],
                #header-widgets aside.widget input[type="password"],
                #header-widgets aside.widget textarea {
                    border-color: <?php echo $on_accent_color; ?>;
                }

                #header-widgets aside.widget.widget-twitter .follow-link:before {
                    border-color: <?php echo $on_accent_color; ?> transparent;
                }

                .home-page .last-tweet .tweet-avatar-link:hover {
                    -webkit-box-shadow: 0 0 0 7px <?php echo $on_accent_color; ?>;
                    -moz-box-shadow: 0 0 0 7px <?php echo $on_accent_color; ?>;
                    box-shadow: 0 0 0 7px <?php echo $on_accent_color; ?>;
                }
            <?php endif; ?>
    
            <?php if( of_get_option('cus_font_stylesheet') && of_get_option('cus_font_family') ): ?>
                h1,
                h2,
                h3,
                h4,
                h5,
                .folio-content .folio-meta .folio-date,
                .home-page .recent-posts-row .recent-post-wrapper .recent-post .recent-post-meta .entry-date,
                .blog .entry-date,
                aside.widget.widget-portfolio li.folio-wid-wrapper .folio-wid-overlay h6,
                #logo.logo-ph a,
                .label-title,
                .label-price {
                    <?php echo of_get_option('cus_font_family'); ?>
                }
            <?php endif; ?>
            
            <?php if( of_get_option('custom_css') ){
                echo of_get_option('custom_css');
            } ?>
        </style>
    <?php endif; ?>
<?php } ?>