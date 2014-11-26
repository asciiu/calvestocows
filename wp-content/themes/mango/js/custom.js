jQuery(document).ready(function($){

    $('body').delay('1').animate({ scrollTop: '0px' }, 'slow');

    /*  SUPERFISH MENU
    ======================================================*/
    $(".main-menu").supersubs({
        minWidth:    12,   // minimum width of submenus in em units
        maxWidth:    27,   // maximum width of submenus in em units
        extraWidth:  1     // extra width can ensure lines don't sometimes turn over
                           // due to slight rounding differences and font-family
    }).superfish({
        delay: 400,
        hoverClass: 'hover-menu-item',
        autoArrows: false,
        animation: { opacity:'show', height:'show' },
        speed: 200
    });

    $(".main-menu a").click(function(){
        if( $(this).attr('href') == '#' ){
            return false;
        }
    });


    /*  DROPDOWN NAVIGATION
    ======================================================*/
    $("nav select option").each(function() {
        if( $(this).val() == window.location ){
            $(this).attr('selected', 'selected');
        }
    });
    $("nav select").change(function() {
        window.location = $(this).find("option:selected").val();
    });


    /*  FLUID VIDEOS
    ======================================================*/
    // FITVIDS
    function fluidVideos() {
        $(".entry-media.remotely-hosted, .widget-video-wrapper").fitVids();
    }
    fluidVideos();

    // UNFITVIDS
    function unFluidVideos( selector ) {
        $(selector).children(".fluid-width-video-wrapper").children("iframe").unwrap();
    }

    // GET ORIGINAL SIZE OF SHORTCODE VIDS
    $('.pt-video.url-video').each(function(){
        var videoOrigWidth = $(this).children("iframe").width(),
            videoOrigHeight = $(this).children("iframe").height();

        $(this).children("iframe").attr("data-orig-width", videoOrigWidth);
        $(this).children("iframe").attr("data-orig-height", videoOrigHeight);
    });

    // RESIZE SHORTCODE VIDS
    $(window).resize(function(){
        $('.pt-video.url-video').each(function(){
            var winWidth = $(window).width(),
                videoAlignment = $(this).attr('data-align'),
                videoWidth = $(this).children("iframe").attr("data-orig-width"),
                videoHeight = $(this).children("iframe").attr("data-orig-height");

            if (videoAlignment){
                if (winWidth <= 767){
                    $(this).removeClass(videoAlignment).addClass("remotely-hosted");
                    fluidVideos();
                } else {
                    $(this).removeClass("remotely-hosted").addClass(videoAlignment);
                    unFluidVideos($(this));
                    $(this).children("iframe").attr("width", videoWidth);
                    $(this).children("iframe").attr("height", videoHeight);
                }
            }
        });
    });


    /*  RESPONSIVE VIDEO HEIGHT FIX FOR JPLAYER
    ======================================================*/
    function fixVideoHeight() {
        if($().jPlayer && $('.jp-video-wrapper .jp-jplayer').length){
            $(window).resize(function(){
                $('.jp-video-wrapper .jp-jplayer').each(function(){
                    var videoElement = $(this),
                        vidioOriginalWidth = videoElement.attr('data-orig-width'),
                        vidioOriginalHeight = videoElement.attr('data-orig-height'),
                        videoFinalHeight = vidioOriginalHeight,
                        videoRatio = vidioOriginalHeight / vidioOriginalWidth,
                        winWidth = $(window).width(),
                        videoWrapperWidth = $(this).closest(".entry-media").width();

                    if (winWidth <= 479){
                        videoFinalHeight = Math.round(videoRatio * videoWrapperWidth);
                    } else if (winWidth <= 767){
                        videoFinalHeight = Math.round(videoRatio * videoWrapperWidth);
                    } else if (winWidth <= 999){
                        videoFinalHeight = Math.round(videoRatio * videoWrapperWidth);
                    }

                    videoElement.jPlayer('option', 'size', { height: videoFinalHeight });
                });
            });
        }
    }
    fixVideoHeight();


    /*  SMOOTH BACK TO TOP / BACK TO TP BUTTON
    ======================================================*/
    $('#to-top, a[href=#main-wrapper]').click(function(){
            $('html, body').animate({ scrollTop:0 }, { duration: 500, easing: 'easeOutExpo' });
        return false;
    });

    $(window).scroll(function() {
        if( $(window).scrollTop() > 400 ) {
            $("#to-top").addClass("show");
        } else {
            $("#to-top").removeClass("show");
        }
    });


    /*  HOVERS & OVERLAYS
    ======================================================*/
    // BLOG THUMBS OVERLAY
    $(document).on({
        mouseenter: function(){
            $(this).stop().addClass('blog-hover');
            $(this).find("img").stop().css({ opacity: 1 }).animate({ opacity: 0.5 }, 250);
        },
        mouseleave: function(){
            $(this).find("img").stop().animate({ opacity: 1 }, 250);
        }
    }, ".no-touch a.blog-thumb");


    // RELATED THUMBS OVERLAY
    $(document).on({
        mouseenter: function(){
            $(this).find(".related-thumb").stop().addClass('blog-hover');
            $(this).find("img").stop().css({ opacity: 1 }).animate({ opacity: 0.5 }, 200);
        },
        mouseleave: function(){
            $(this).find("img").stop().animate({ opacity: 1 }, 200);
        }
    }, ".related-entry");


    // PORTFOLIO WIDGET OVERLAY
    $(document).on({
        mouseenter: function(){
            $(this).find("img").css({ opacity: 1 }).stop().animate({ opacity: 0.5 }, { duration: 250, queue: false });
        },
        mouseleave: function(){
            $(this).find("img").stop().animate({ opacity: 1 }, { duration: 250, queue: false });
        }
    }, ".touch .flexslider-folio-wid li");

    $(document).on({
        mouseenter: function(){
            $(this).find("img").css({ opacity: 1 }).stop().animate({ opacity: 0.5 }, { duration: 250, queue: false });
            $(this).find(".folio-wid-overlay").css({ opacity: 0 }).stop().animate({ opacity: 1 }, { duration: 250, queue: false });
        },
        mouseleave: function(){
            $(this).find("img").stop().animate({ opacity: 1 }, { duration: 250, queue: false });
            $(this).find(".folio-wid-overlay").stop().animate({ opacity: 0 }, { duration: 250, queue: false });
        }
    }, ".no-touch .flexslider-folio-wid li");


    // PORTFOLIO THUMBS OVERLAY
    $(document).on({
        mouseenter: function(){
            $(this).find(".folio-thumb").stop().addClass('folio-hover');
            $(this).find("img").stop().css({ opacity: 1 }).animate({ opacity: 0.5 }, 250);
        },
        mouseleave: function(){
            $(this).find("img").stop().animate({ opacity: 1 }, 250);
        }
    }, ".touch .folio-item");

    $(document).on({
        mouseenter: function(){
            $(this).find(".folio-thumb").stop().addClass('folio-hover');
            $(this).find(".folio-title").stop().css({ marginTop: "-25px" }).animate({ marginTop: "0" }, 250);
            $(this).find(".more-hover").stop().css({ bottom: "-48px" }).animate({ bottom: "0" }, 250);
            $(this).find(".folio-overlay").stop().css({ opacity: 0 }).animate({ opacity: 1 }, 250);
        },
        mouseleave: function(){
            $(this).find(".folio-title").stop().animate({ marginTop: "-25px" }, 250);
            $(this).find(".more-hover").stop().animate({ bottom: "-48px" }, 250);
            $(this).find(".folio-overlay").stop().animate({ opacity: 0 }, 250);
        }
    }, ".no-touch .folio-item");

    $(document).on({
        mouseenter: function(){
            $(this).find("img").stop().css({ opacity: 1 }).animate({ opacity: 0.5 }, 250);
        },
        mouseleave: function(){
            $(this).find("img").stop().animate({ opacity: 1 }, 250);
        }
    }, ".folio-single .entry-thumb.image-list");


    /*  EQUAL HEIGHT COLUMNS
    ======================================================*/
    function equalHeight(selector) {
        var maxHeight = 0,
            column = $(selector);

        column.each(function() {
            if($(this).height() > maxHeight) {
                maxHeight = $(this).height();
            }
        });

        column.height(maxHeight);
    }

    $(window).resize(function() {
        setTimeout(function() {
            $('#work-team .team-member-wrapper, .recent-post-content').removeAttr('style');
            equalHeight('#work-team .team-member-wrapper');
            equalHeight('.recent-post-content');
        }, 300);
    });

    /*  CLEAR FORM FIELDS ON FOCUS
    ======================================================*/
    $(function() {
        $('input:text, textarea').each(function() {
            var field = $(this),
                default_value = field.val();

            field.focus(function() {
                if (field.val() === default_value) {
                    field.val('');
                }
            });

            field.blur(function() {
                if (field.val() === '') {
                    field.val(default_value);
                }
            });
        });
    });


    /*  INITIAL TRIGGERS
    ======================================================*/
    $(window).trigger('resize'); // inital resize
    $(window).trigger('scroll'); // inital scroll

}); /* <<<<< END DOCUMENT READY >>>>> */