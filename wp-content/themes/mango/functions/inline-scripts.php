<?php
add_action('wp_footer', 'premitheme_theme_inline_scripts');
function premitheme_theme_inline_scripts() {
?>
    <script type="text/javascript">
        (function($) {
            $(document).ready(function() {

                <?php if( of_get_option("use_loading_animation") ): ?>
                    /* PAGE LOADING ANIMATION
                    ============================================ */
                    if (jQuery.browser.msie && ( jQuery.browser.version == '6.0' || jQuery.browser.version == '7.0' || jQuery.browser.version == '8.0' ) ) {
                        // DO NOTHING
                    } else {
                        if(!Modernizr.touch){
                            $("#page-loading #progress-bar").animate({ width: "70%" }, 600);
                            $(window).on('load', function() {
                                $("#page-loading #progress-bar")
                                    .animate({ width: "100%" }, 400)
                                    .queue(function() {
                                        $("#page-loading").fadeOut('slow');
                                    });
                            });
                        }
                    }
                <?php endif; ?>


                <?php if( of_get_option("use_floating_navigation") ): ?>
                    /* FLOATING NAVIGATION
                    ============================================ */
                    $(window).scroll(function() {
                        if( $(window).scrollTop() > 300 ) {
                            $("#floating-navigation").fadeIn('fast').addClass("show");
                        } else {
                            $("#floating-navigation").removeClass("show").fadeOut('fast');
                        }
                    });
                <?php endif; ?>


                <?php if (class_exists('WooCommerce')):
                  global $woocommerce;
                ?>
                    /* SHOPPING CART COUNT LABEL
                    ============================================ */
                    var cartCount = $(".cart-contents a").attr('data-count');
                    $(".cart-contents a").append('<div class="cart-count-label">'+cartCount+'</div>');
                <?php endif; ?>


                /* FIRE SKROLLR
                ============================================ */
                var s = skrollr.init({ forceHeight: true, smoothScrolling: true });

                // DISABLE SKROLLR FOR TOUCH DEVICES FOR SMOOTHER USAGE
                if ( Modernizr.touch ){
                    s.destroy();
                }


                /* BOUNCING EFFECT FUNCTION
                ============================================ */
                function arrowBounce() {
                    $('#bouncing-arrow').animate({'bottom':5}, 800, 'easeInQuad', function() {
                        $('#bouncing-arrow').animate({'bottom':15}, 800, 'easeOutQuad', function() {
                            arrowBounce();
                        });
                    });
                }


                $('body').prepend('<div class="bg-layer"></div>');


                <?php if( of_get_option("ie_warning") ): ?>
                    /* OLD BROWSER MESSAGE
                    ============================================ */
                    if ($.browser.msie && ( $.browser.version == '6.0' || $.browser.version == '7.0' || $.browser.version == '8.0' ) ) {
                        <?php if( isset($_COOKIE['ie_warning']) ): ?>
                            $('#ie-warning').hide();
                        <?php else: ?>
                            $('#ie-warning').show();
                        <?php endif; ?>
                        
                        $('#ie-close').click(function(){
                            $(this).parent("#ie-warning").fadeOut();

                            var ie_warning = 'ie_warning=hide;'+ ie_warning;
                            document.cookie = ie_warning;
                        });
                    }
                <?php endif; ?>


                /* FIRE PRETTY-PHOTO LIGHTBOX PLUGIN
                ============================================ */
                <?php // ADD PRETTYPHOTO REL ATTRIBUTE TO ANY IMAGE IN THE CONTENT
                if( of_get_option("use_lightbox") ):
                ?>
                    var items = jQuery('.entry-content a').filter(function() {
                        if (jQuery(this).attr('href')) return jQuery(this).attr('href').match(/\.(jpg|png|gif|JPG|GIF|PNG|Jpg|Gif|Png|JPEG|Jpeg)/);
                    });
                    items.attr('rel','prettyPhoto[slides]');
                    items.attr('title','');
                <?php endif; ?>

                $("a[rel^='prettyPhoto']").prettyPhoto({
                    theme: 'pp_premitheme',
                    slideshow: false,
                    show_title: false,
                    horizontal_padding: 0,
                    opacity: 0.8,
                    default_width: 500,
                    autoplay: true,
                    modal: false,
                    deeplinking: true,
                    social_tools: false,
                    markup: '<div class="pp_pic_holder"> \
                                <div class="ppt">&nbsp;</div> \
                                <div class="pp_content_container"> \
                                    <div class="pp_content"> \
                                        <div class="pp_loaderIcon"></div> \
                                        <div class="pp_fade"> \
                                            <a class="pp_close" href="#" title="Close">Close</a> \
                                            <a href="#" class="pp_expand" title="Expand the image">Expand</a> \
                                            <div class="pp_hoverContainer"> \
                                                <a class="pp_next" href="#">next</a> \
                                                <a class="pp_previous" href="#">previous</a> \
                                            </div> \
                                            <div id="pp_full_res"></div> \
                                            <div class="pp_details"> \
                                                <div class="pp_nav"> \
                                                    <p class="currentTextHolder">0/0</p> \
                                                </div> \
                                                <p class="pp_description"></p> \
                                                <div class="pp_social">{pp_social}</div> \
                                            </div> \
                                        </div> \
                                    </div> \
                                </div> \
                            </div> \
                            <div class="pp_overlay"></div>'
                });


                <?php if( premitheme_has_shortcode('pt_tabs') ): ?>
                    /* FIRE TABS PLUGIN
                    ============================================ */
                    $( ".tabs" ).tabs({ show: true, hide: true });
                <?php endif; ?>


                <?php if( premitheme_has_shortcode('pt_accordion') ): ?>
                    /* FIRE ACCORDION PLUGIN
                    ============================================ */
                    $( ".accordion" ).accordion({ collapsible: true, heightStyle: "content" });
                <?php endif; ?>


                <?php if( is_page_template('faqs.php') ):
                    global $wp_query;
                    $postid = $wp_query->post->ID;
                    $faqs_style = get_post_meta($postid, 'faqs_style', TRUE);
                ?>
                    <?php if ( $faqs_style == 'accordion'): ?>
                        /* FIRE ACCORDION FOR FAQs PAGE
                        ============================================ */
                        $('.faq-accordion .accHead').click(function() {
                            $(this).toggleClass('active').next().slideToggle();
                            return false;
                        }).next().hide();
                    <?php endif; ?>
                <?php endif; ?>


                <?php if( is_page_template('contact.php') ): ?>
                    /* FIRE FORM VALIDATION PLUGIN
                    ============================================ */
                    $("#contact-f").validate({
                        errorElement: "p",
                        errorPlacement: function(error, element) { error.appendTo( element.parent() ); }
                    });
                <?php endif; ?>


                <?php if( is_page_template('home-video.php') ):
                    global $wp_query;
                    $postid = $wp_query->post->ID;
                    $homeVideoFallback = get_post_meta($postid, 'home_video_fallback', TRUE);
                    $homeVideoOverlay = get_post_meta($postid, 'home_video_overlay', TRUE);
                    if(is_admin_bar_showing()){
                        $adminHeight = 28;
                    } else {
                        $adminHeight = 0;
                    }
                ?>
                    /* FIRE YT BAKGROUND PLUGIN
                    ============================================ */
                    if (Modernizr.touch){
                        <?php if($homeVideoFallback): ?>
                            $.vegas({
                                src:"<?php echo $homeVideoFallback; ?>"
                            });

                            if (Modernizr.touch){
                                $(window).scroll(function() {
                                    $(window).trigger('resize');
                                });
                            }
                        <?php endif; ?>
                    } else {
                        <?php if($homeVideoOverlay): ?>
                            $.vegas('overlay');
                        <?php endif; ?>
                        $("#bg-video").mb_YTPlayer();
                    }
                    

                    /* CAPTION VARIABLE HEIGHT
                    ============================================ */
                    $(window).resize(function() {
                        var winHeight = $(window).height(),
                            headerHeight = $("#header-container").height() + 50,
                            finalHeihgt = winHeight - headerHeight - <?php echo $adminHeight; ?>;
                        $("#video-screen").css({ height: finalHeihgt });
                    });

                    // FIRE BOUNCING ARROW
                    arrowBounce();
                <?php endif; ?>


                <?php if( is_page_template('home-slideshow.php') ):
                    global $wp_query;
                    $postid = $wp_query->post->ID;
                    $homeSlideshowImgs = get_post_meta($postid, 'home_slideshow_imgs', TRUE);
                    $homeSlideshowDelay = get_post_meta($postid, 'home_slideshow_delay', TRUE);
                    $homeSlideshowOverlay = get_post_meta($postid, 'home_slideshow_overlay', TRUE);
                    if(is_admin_bar_showing()){
                        $adminHeight = 28;
                    } else {
                        $adminHeight = 0;
                    }
                ?>
                    /* FIRE SLIDESHOW BAKGROUND PLUGIN
                    ============================================ */
                    <?php if($homeSlideshowOverlay): ?>
                        if (!Modernizr.touch){
                            $.vegas('overlay');
                        }
                    <?php endif; ?>

                    <?php if($homeSlideshowImgs): ?>
                        $.vegas('slideshow', {
                            delay: <?php echo $homeSlideshowDelay; ?>,
                            backgrounds:[
                                <?php foreach( $homeSlideshowImgs as $img ): ?>
                                    { src: '<?php echo $img; ?>', fade: 1500 },
                                <?php endforeach; ?>
                            ]
                        });

                        if (Modernizr.touch){
                            $(window).scroll(function() {
                                $(window).trigger('resize');
                            });
                        }
                    <?php endif; ?>

                    /* CAPTION VARIABLE HEIGHT
                    ============================================ */
                    $(window).resize(function() {
                        var winHeight = $(window).height(),
                            headerHeight = $("#header-container").height() + 50,
                            finalHeihgt = winHeight - headerHeight - <?php echo $adminHeight; ?>;
                        $("#slideshow-screen").css({ height: finalHeihgt });
                    });

                    // FIRE BOUNCING ARROW
                    arrowBounce();
                <?php endif; ?>


                <?php if( !is_page_template('home-video.php') && !is_page_template('home-slideshow.php') ):?>
                    <?php if( premitheme_fullscreenBgImage() || of_get_option('bg_img') ):?>
                        /* FULLSCREEN BG
                        ============================================ */
                        <?php if( premitheme_backgroundOverlay() == '1' ): ?>
                            if (!Modernizr.touch){
                                $.vegas('overlay');
                            }
                        <?php endif; ?>

                        <?php if( premitheme_fullscreenBgImage() ): ?>
                            $.vegas({
                                src:"<?php echo premitheme_fullscreenBgImage(); ?>"
                            });
                        <?php endif; ?>

                        if (Modernizr.touch){
                            $(window).scroll(function() {
                                $(window).trigger('resize');
                            });
                        }
                    <?php endif; ?>
                <?php endif; ?>


                <?php if ( is_page_template('portfolio.php') || is_tax('portfolio_cats') || is_tax('portfolio_skills') ): ?>
                    /* INITIALIZE ISOTOPE FOR PORTFOLIO
                    ============================================ */
                    var $container = $('#folio-items');
                    $container.isotope({
                        // resizesContainer: false,
                        itemSelector: '.folio-item',
                        animationEngine: 'best-available',
                        animationOptions: { duration: 500, queue: false },
                        layoutMode: 'masonry'
                    });

                    $(window).resize(function(){
                        setTimeout(function() {
                            $container.isotope('reLayout');
                        }, 600);
                    });

                    $(window).load(function(){
                        setTimeout(function() {
                            $container.isotope('reLayout');
                        }, 600);
                    });

                    $(document).load(function(){
                        setTimeout(function() {
                            $container.isotope('reLayout');
                        }, 600);
                    });
                <?php endif; ?>


                <?php if ( is_page_template('blog-2col.php') ): ?>
                    /* INITIALIZE ISOTOPE FOR BLOG
                    ============================================ */
                    var $container = $('#main > ul');
                    $container.isotope({
                        itemSelector : '.entry-wrapper',
                        animationEngine: 'best-available',
                        animationOptions: { duration: 500, queue: false },
                        layoutMode: 'masonry'
                    });

                    $(window).resize(function(){
                        setTimeout(function() {
                            $container.isotope('reLayout');
                        }, 600);
                    });

                    $(window).load(function(){
                        setTimeout(function() {
                            $container.isotope('reLayout');
                        }, 600);
                    });

                    $(document).load(function(){
                        setTimeout(function() {
                            $container.isotope('reLayout');
                        }, 600);
                    });
                <?php endif; ?>


                <?php if ( is_page_template('portfolio.php') ): 
                    global $wp_query;
                    $postid = $wp_query->post->ID;
                    $folio_filtering_option = get_post_meta($postid, 'folio_filtering', TRUE);
                ?>
                    <?php if ( $folio_filtering_option == 'fancy' ): ?>
                        /* SLIDING ANIMATION FOR FILTERS MENU
                        ============================================ */
                        $('#filtering-links').click(function(){
                            $(this).find('ul')
                            .slideToggle(250)
                            .animate({ opacity: 1 },{ queue: false, duration: 250 });
                            return false;
                        });

                        /* FIRE ISOTOPE
                        ============================================ */
                        $('#filtering-links li.filter').click(function(){
                            var selector = $(this).attr('data-filter');
                            $container.isotope({
                                filter: selector
                            });

                            var filterText = $(this).find('a').text();

                            $(this).parent().parent().children('a').html('<i class="fa fa-bars"></i> ' + filterText);

                            $(this).parent()
                            .slideToggle(250)
                            .animate({ opacity: 0 },{ queue: false, duration: 250 });

                            $('#filtering-links li.filter').removeClass('current-cat');
                            $(this).addClass('current-cat');

                            return false;
                        });
                    <?php else: ?>
                        /* SLIDING ANIMATION FOR FILTERS MENU
                        ============================================ */
                        $('#filtering-links .all').click(function(){
                            $(this).next('ul')
                            .slideToggle(250)
                            .animate({ opacity: 1 },{ queue: false, duration: 250 });
                        });

                        $('#filtering-links li.filter').click(function(){
                            $(this).parent()
                            .slideToggle(250)
                            .animate({ opacity: 0 },{ queue: false, duration: 250 });
                        });
                    <?php endif; ?>
                <?php endif; ?>


                <?php if ( is_tax('portfolio_cats') || is_tax('portfolio_skills') ): ?>
                    /* SLIDING ANIMATION FOR FILTERS MENU
                    ============================================ */
                    $('#filtering-links .all').click(function(){
                        $(this).next('ul')
                        .slideToggle(250)
                        .animate({ opacity: 1 },{ queue: false, duration: 250 });
                    });

                    $('#filtering-links li.filter').click(function(){
                        $(this).parent()
                        .slideToggle(250)
                        .animate({ opacity: 0 },{ queue: false, duration: 250 });
                    });
                <?php endif; ?>


                <?php if( is_active_sidebar( 'sidebar-6' ) ||
                          is_active_sidebar( 'sidebar-7' ) ||
                          is_active_sidebar( 'sidebar-8' ) ||
                          is_active_sidebar( 'sidebar-9' )
                        ):
                ?>
                    /* WIDGETS SLIDING PANEL
                    ============================================ */
                    $('#main-container').prepend('<div id="header-widgets-trigger"><i class="fa fa-search" style="font-size: 20px"></i></div>');

                    $('.no-touch #header-widgets-trigger').click(function(){
                        $(this).find('i').toggleClass('fa-search');
                        $(this).find('i').toggleClass('fa-search-minus');
                        $('#header-widgets').slideToggle({
                            duration: 1000,
                            easing: "easeInOutExpo",
                            start: function(){
                                $(window).trigger('resize');
                            },
                            complete: function(){
                                s.refresh();
                            }
                        });
                    });

                    $('.touch #header-widgets-trigger').click(function(){
                        $(this).find('i').toggleClass('fa-search');
                        $(this).find('i').toggleClass('fa-search-minus');
                        $('#header-widgets').slideToggle({
                            duration: 1000,
                            easing: "easeInOutExpo",
                            complete: function(){
                                $(window).trigger('resize');
                            }
                        });
                    });
                <?php endif; ?>


                <?php if( ( is_single() && get_post_type() == 'post' && of_get_option('sharing_on') ) ||
                          ( is_single() && get_post_type() == 'portfolio' && of_get_option('folio_sharing') )
                        ):
                ?>
                    $('.prettySocial').prettySocial();

                    <?php if( is_single() && get_post_type() == 'post' && of_get_option('sharing_on') ): ?>
                        /* FLOATING VERTICAL SHARING BUTTONS
                        ============================================ */
                        var containerHeight = $('#main').outerHeight();
                        var sharingHeight = $('#sharing-btns-ver').outerHeight();
                        var topMargin = containerHeight - sharingHeight - 100;

                        $(document).on('scroll', function() {
                            var y = $(this).scrollTop();
                            var top = $('#main').offset().top + 24;

                            if (y >= top && y < topMargin) {
                                $('#sharing-btns-ver').addClass('fixed-sharing').fadeIn().css({ top: 42 });
                            } else if (y >= topMargin) {
                                $('#sharing-btns-ver').fadeOut();
                            } else {
                                $('#sharing-btns-ver').removeClass('fixed-sharing').fadeIn();
                            }
                        });
                    <?php endif; ?>
                <?php endif; ?>

                $(window).load(function(){
                    s.refresh();
                });
            }); 
            /* ================================ */
            /* >>>>>> DOCUMENT READY END <<<<<< */
            /* ================================ */


            <?php if ( is_active_widget(false, false, 'portfolio-widget') ): ?>
                /* FIRE PORTFOLIO WIDGET SLIDER PLUGIN
                ============================================ */
                $(window).load(function(){
                    $('.flexslider-folio-wid').flexslider({
                        selector: ".slides > li",
                        animation: "slide",   // "fade" or "slide"
                        easing: "easeInOutExpo",
                        direction: "horizontal",
                        reverse: false,
                        animationLoop: true,
                        smoothHeight: false,
                        slideshow: false,
                        animationSpeed: 700,
                        pauseOnAction: true,
                        useCSS: false,
                        touch: true,
                        video: false,
                        controlNav: false,
                        directionNav: true,
                        keyboard: false,
                        prevText: "&#xf104;",
                        nextText: "&#xf105;"
                    });
                });
            <?php endif; ?>


            <?php if( is_page_template('contact.php') ):
                global $wp_query;
                $postID = $wp_query->post->ID;
                
                if( get_post_meta($postID, 'google_lat', TRUE) && get_post_meta($postID, 'google_lng', TRUE) ):
            ?>
                /* FIRE GOOGLE MAP PLUGIN
                ============================================ */
                $(function() {
                    $("#contact-map").gMap({
                        controls: {
                            panControl: false,
                            zoomControl: true,
                            mapTypeControl: true,
                            scaleControl: true,
                            streetViewControl: true,
                            overviewMapControl: true
                        },
                        markers: [{
                            <?php if( get_post_meta($postID, 'google_map_balloon', TRUE) ):
                                $balloonText = get_post_meta($postID, 'google_map_balloon', TRUE);
                                $balloonText = nl2br($balloonText);
                                $balloonText = str_replace(array("\n", "\r"), '', $balloonText);  
                            ?>
                                html: '<?php echo $balloonText; ?>',
                                popup: true,
                            <?php endif; ?>
                            latitude: <?php echo get_post_meta($postID, 'google_lat', TRUE); ?>,
                            longitude: <?php echo get_post_meta($postID, 'google_lng', TRUE); ?>
                        }],
                        zoom: <?php if ( get_post_meta($postID, 'map_zoom', TRUE) ) echo get_post_meta($postID, 'map_zoom', TRUE); else echo '14'; ?>,
                        maptype: '<?php if ( get_post_meta($postID, "map_type", TRUE) ) echo get_post_meta($postID, "map_type", TRUE); else echo "ROADMAP"; ?>',
                        scrollwheel: false
                    });
                });

                $(window).resize(function(){
                    $('#contact-map').gMap('centerAt', {
                        latitude: <?php echo get_post_meta($postID, 'google_lat', TRUE); ?>,
                        longitude: <?php echo get_post_meta($postID, 'google_lng', TRUE); ?>,
                        zoom: <?php if ( get_post_meta($postID, 'map_zoom', TRUE) ) echo get_post_meta($postID, 'map_zoom', TRUE); else echo '14'; ?>
                    });
                });
            <?php endif;
            endif;
            ?>


            <?php if( premitheme_has_shortcode('pt_slider') ): ?>
                /* FIRE SLIDER SHORTCODE SCRIPT
                ============================================ */
                $(window).load(function() {
                    $('.flexslider-shortcode').flexslider({
                        animation: 'slide',
                        easing: "easeInOutExpo",
                        smoothHeight: true,
                        slideshow: true,
                        slideshowSpeed: 3500,
                        animationSpeed: 700,
                        pauseOnAction: true,
                        pauseOnHover: true,
                        useCSS: false,
                        controlNav: true,
                        directionNav: false,
                        keyboard: false
                    });
                });
            <?php endif; ?>

        })(jQuery);
    </script>
<?php }


////////////////////////////////////////////////////////////////
//-------- OPTIONS FRAMEWORK EXPAND/COLLAPSE SETTINGS --------//
////////////////////////////////////////////////////////////////

add_action('optionsframework_custom_scripts', 'premitheme_of_custom_scripts');
function premitheme_of_custom_scripts() {
?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            
            $('#show_social').click(function() {
                $('#section-header_social').slideToggle(400);
                $('#section-footer_social').slideToggle(400);

                $('#section-social_twitter').slideToggle(400);
                $('#section-social_facebook').slideToggle(400);
                $('#section-social_myspace').slideToggle(400);
                $('#section-social_deviant').slideToggle(400);
                $('#section-social_flickr').slideToggle(400);
                $('#section-social_linkedin').slideToggle(400);
                $('#section-social_vimeo').slideToggle(400);
                $('#section-social_youtube').slideToggle(400);
                $('#section-social_rss').slideToggle(400);
                $('#section-social_skype').slideToggle(400);
                $('#section-social_aim').slideToggle(400);
                $('#section-social_yahoo').slideToggle(400);
                $('#section-social_gtalk').slideToggle(400);
                $('#section-social_gplus').slideToggle(400);
                $('#section-social_dribbble').slideToggle(400);
                $('#section-social_digg').slideToggle(400);
                $('#section-social_delicious').slideToggle(400);
                $('#section-social_forrst').slideToggle(400);
                $('#section-social_orkut').slideToggle(400);
                $('#section-social_tumblr').slideToggle(400);
                $('#section-social_wp').slideToggle(400);
                $('#section-social_lastfm').slideToggle(400);
                $('#section-social_reddit').slideToggle(400);
                $('#section-social_behance').slideToggle(400);
                $('#section-social_pinterest').slideToggle(400);
                $('#section-social_soundcloud').slideToggle(400);
                $('#section-social_imdb').slideToggle(400);
                $('#section-social_instagram').slideToggle(400);
                $('#section-social_github').slideToggle(400);
                $('#section-social_paypal').slideToggle(400);
            });
            if ($('#show_social:checked').val() !== undefined) {
                $('#section-header_social').show();
                $('#section-footer_social').show();

                $('#section-social_twitter').show();
                $('#section-social_facebook').show();
                $('#section-social_myspace').show();
                $('#section-social_deviant').show();
                $('#section-social_flickr').show();
                $('#section-social_linkedin').show();
                $('#section-social_vimeo').show();
                $('#section-social_youtube').show();
                $('#section-social_rss').show();
                $('#section-social_skype').show();
                $('#section-social_aim').show();
                $('#section-social_yahoo').show();
                $('#section-social_gtalk').show();
                $('#section-social_gplus').show();
                $('#section-social_dribbble').show();
                $('#section-social_digg').show();
                $('#section-social_delicious').show();
                $('#section-social_forrst').show();
                $('#section-social_orkut').show();
                $('#section-social_tumblr').show();
                $('#section-social_wp').show();
                $('#section-social_lastfm').show();
                $('#section-social_reddit').show();
                $('#section-social_behance').show();
                $('#section-social_pinterest').show();
                $('#section-social_soundcloud').show();
                $('#section-social_imdb').show();
                $('#section-social_instagram').show();
                $('#section-social_github').show();
                $('#section-social_paypal').show();
            }


            $('#show_description').click(function() {
                $('#section-site_description').slideToggle(400);
            });
            if ($('#show_description:checked').val() !== undefined) {
                $('#section-site_description').show();
            }


            $('#recent_posts').click(function() {
                $("#section-recent_posts_label").slideToggle(400);
            });
            if ($('#recent_posts:checked').val() !== undefined) {
                $("#section-recent_posts_label").show();
            }


            $('#use_security').click(function() {
                $("#section-security_question").slideToggle(400);
                $("#section-security_answer").slideToggle(400);
            });
            if ($('#use_security:checked').val() !== undefined) {
                $("#section-security_question").show();
                $("#section-security_answer").show();
            }


            $('#use_full_bg').click(function() {
                $("#section-bg_x_pos").slideToggle(400);
                $("#section-bg_y_pos").slideToggle(400);
                $("#section-bg_repeat").slideToggle(400);
                $("#section-bg_att").slideToggle(400);
                // $("#section-use_bg_overlay").slideToggle(400);
            });
            if ($('#use_full_bg:checked').val() == undefined) {
                $("#section-bg_x_pos").show();
                $("#section-bg_y_pos").show();
                $("#section-bg_repeat").show();
                $("#section-bg_att").show();
                // $("#section-use_bg_overlay").hide();
            }


            $('#use_contact_form').click(function() {
                $("#section-contact_email").slideToggle(400);
                $("#section-contact_subject").slideToggle(400);
                $("#section-use_security").slideToggle(400);
                $("#section-security_question").slideToggle(400);
                $("#section-security_answer").slideToggle(400);
            });
            if ($('#use_security:checked').val() !== undefined) {
                $("#section-contact_email").show();
                $("#section-contact_subject").show();
                $("#section-use_security").show();
                $("#section-security_question").show();
                $("#section-security_answer").show();
            }

        });
    </script>
<?php }


add_action('wp_footer', 'premitheme_theme_tracking_code', 20);
function premitheme_theme_tracking_code() {
    if( of_get_option('tracking_code') ){ echo of_get_option('tracking_code'); }
}