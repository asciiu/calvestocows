<?php
//==============================================//
// remove p tags around certain html tags generated wpautop
//==============================================//
add_filter('the_content', 'premitheme_fix_autop');
add_filter('the_excerpt', 'premitheme_fix_autop');
function premitheme_fix_autop($content) {
    $html = trim($content);
    if ( $html === '' ) {
        return '';  
    }
    $blocktags = 'address|article|aside|audio|blockquote|canvas|caption|center|col|del|dd|div|dl|fieldset|figcaption|figure|footer|form|frame|frameset|h1|h2|h3|h4|h5|h6|header|hgroup|iframe|ins|li|nav|noframes|noscript|object|ol|output|pre|script|section|table|tbody|td|tfoot|thead|th|tr|ul|video';
    $html = preg_replace('~<p>\s*<('.$blocktags.')\b~i', '<$1', $html);
    $html = preg_replace('~</('.$blocktags.')>\s*</p>~i', '</$1>', $html);
    return $html;
}



//==============================================//
// pre process shortcodes
//==============================================//
add_filter('the_content', 'premitheme_pre_process_shortcode', 7);
function premitheme_pre_process_shortcode($content) {
    global $shortcode_tags;

    // Backup current registered shortcodes and clear them all out
    $orig_shortcode_tags = $shortcode_tags;
    $shortcode_tags = array();

    add_shortcode("pt_fullwidth", "pt_fullwidth");
    add_shortcode("pt_one_half", "pt_one_half");
    add_shortcode("pt_one_half_last", "pt_one_half_last");
    add_shortcode("pt_one_third", "pt_one_third");
    add_shortcode("pt_one_third_last", "pt_one_third_last");
    add_shortcode("pt_one_fourth", "pt_one_fourth");
    add_shortcode("pt_one_fourth_last", "pt_one_fourth_last");
    add_shortcode("pt_one_fifth", "pt_one_fifth");
    add_shortcode("pt_one_fifth_last", "pt_one_fifth_last");
    add_shortcode("pt_one_sixth", "pt_one_sixth");
    add_shortcode("pt_one_sixth_last", "pt_one_sixth_last");
    add_shortcode("pt_three_fourth", "pt_three_fourth");
    add_shortcode("pt_three_fourth_last", "pt_three_fourth_last");
    add_shortcode("pt_two_third", "pt_two_third");
    add_shortcode("pt_two_third_last", "pt_two_third_last");
    add_shortcode("pt_pullquote_r", "pt_pullquote_r");
    add_shortcode("pt_pullquote_l", "pt_pullquote_l");
    add_shortcode("pt_blockquote", "pt_blockquote");
    add_shortcode("pt_highlighted", "pt_htext");
    add_shortcode("pt_dropcap", "pt_dropcap");
    add_shortcode("pt_button", "pt_button");
    add_shortcode("pt_divider", "pt_divider");
    add_shortcode("pt_divider_top", "pt_divider_top");
    add_shortcode("pt_hspace", "pt_hspace");
    add_shortcode("pt_list", "pt_list");
    add_shortcode("pt_item", "pt_list_item");
    add_shortcode("pt_accordion", "pt_acc");
    add_shortcode("pt_panel", "pt_panel");
    add_shortcode('pt_tabs', 'pt_tabs');
    add_shortcode('pt_tab', 'pt_tab');
    add_shortcode("pt_testimonial", "pt_testimonial");
    add_shortcode("pt_box", "pt_box");
    add_shortcode("pt_service", "pt_service");
    add_shortcode("pt_price_label", "pt_price_label");
    add_shortcode("pt_image", "pt_img");
    add_shortcode("pt_popup", "pt_popup");
    add_shortcode("pt_slider", "pt_slider");
    add_shortcode("pt_slide", "pt_slide");
    add_shortcode("pt_audio", "pt_audio");
    add_shortcode("pt_video", "pt_video");
    add_shortcode("pt_video_embed", "pt_video_embed");
    add_shortcode("pt_graph", "pt_graph");
    add_shortcode("pt_graph_item", "pt_graph_item");

    // Do the shortcode
    $content = do_shortcode($content);

    // Put the original shortcodes back
    $shortcode_tags = $orig_shortcode_tags;

    return $content;
}



//==============================================//
// LAYOUT COLUMNS SHORTCODES
//==============================================//
function pt_fullwidth($atts, $content = null) {
    extract(shortcode_atts(array(
        "content_align" => ''
    ), $atts));

    return '<div class="fullwidth-col lay-col clearfix content-'.$content_align.'">'. wpautop( do_shortcode( $content ) ) .'</div><div class="clear"></div>';
}

/////////////////////////////////////////////////////

function pt_one_half($atts, $content = null) {
    extract(shortcode_atts(array(
        "content_align" => ''
    ), $atts));

    return '<div class="one-half lay-col clearfix content-'.$content_align.'">'. wpautop( do_shortcode( $content ) ) .'</div>';
}

function pt_one_half_last($atts, $content = null) {
    extract(shortcode_atts(array(
        "content_align" => ''
    ), $atts));

    return '<div class="one-half last-col lay-col clearfix content-'.$content_align.'">'. wpautop( do_shortcode( $content ) ) .'</div><div class="clear"></div>';
}

/////////////////////////////////////////////////////

function pt_one_third($atts, $content = null) {
    extract(shortcode_atts(array(
        "content_align" => ''
    ), $atts));

    return '<div class="one-third lay-col clearfix content-'.$content_align.'">'. wpautop( do_shortcode( $content ) ) .'</div>';
}

function pt_one_third_last($atts, $content = null) {
    extract(shortcode_atts(array(
        "content_align" => ''
    ), $atts));

    return '<div class="one-third last-col lay-col clearfix content-'.$content_align.'">'. wpautop( do_shortcode( $content ) ) .'</div><div class="clear"></div>';
}

/////////////////////////////////////////////////////

function pt_one_fourth($atts, $content = null) {
    extract(shortcode_atts(array(
        "content_align" => ''
    ), $atts));

    return '<div class="one-fourth lay-col clearfix content-'.$content_align.'">'. wpautop( do_shortcode( $content ) ) .'</div>';
}

function pt_one_fourth_last($atts, $content = null) {
    extract(shortcode_atts(array(
        "content_align" => ''
    ), $atts));

    return '<div class="one-fourth last-col lay-col clearfix content-'.$content_align.'">'. wpautop( do_shortcode( $content ) ) .'</div><div class="clear"></div>';
}

/////////////////////////////////////////////////////

function pt_one_fifth($atts, $content = null) {
    extract(shortcode_atts(array(
        "content_align" => ''
    ), $atts));

    return '<div class="one-fifth lay-col clearfix content-'.$content_align.'">'. wpautop( do_shortcode( $content ) ) .'</div>';
}

function pt_one_fifth_last($atts, $content = null) {
    extract(shortcode_atts(array(
        "content_align" => ''
    ), $atts));

    return '<div class="one-fifth last-col lay-col clearfix content-'.$content_align.'">'. wpautop( do_shortcode( $content ) ) .'</div><div class="clear"></div>';
}

/////////////////////////////////////////////////////

function pt_one_sixth($atts, $content = null) {
    extract(shortcode_atts(array(
        "content_align" => ''
    ), $atts));

    return '<div class="one-sixth lay-col clearfix content-'.$content_align.'">'. wpautop( do_shortcode( $content ) ) .'</div>';
}

function pt_one_sixth_last($atts, $content = null) {
    extract(shortcode_atts(array(
        "content_align" => ''
    ), $atts));

    return '<div class="one-sixth last-col lay-col clearfix content-'.$content_align.'">'. wpautop( do_shortcode( $content ) ) .'</div><div class="clear"></div>';
}

/////////////////////////////////////////////////////

function pt_three_fourth($atts, $content = null) {
    extract(shortcode_atts(array(
        "content_align" => ''
    ), $atts));

    return '<div class="three-fourth lay-col clearfix content-'.$content_align.'">'. wpautop( do_shortcode( $content ) ) .'</div>';
}

function pt_three_fourth_last($atts, $content = null) {
    extract(shortcode_atts(array(
        "content_align" => '',
    ), $atts));

    return '<div class="three-fourth last-col lay-col clearfix content-'.$content_align.'">'. wpautop( do_shortcode( $content ) ) .'</div><div class="clear"></div>';
}

/////////////////////////////////////////////////////

function pt_two_third($atts, $content = null) {
    extract(shortcode_atts(array(
        "content_align" => ''
    ), $atts));

    return '<div class="two-third lay-col clearfix content-'.$content_align.'">'. wpautop( do_shortcode( $content ) ) .'</div>';
}

function pt_two_third_last($atts, $content = null) {
    extract(shortcode_atts(array(
        "content_align" => ''
    ), $atts));

    return '<div class="two-third last-col lay-col clearfix content-'.$content_align.'">'. wpautop( do_shortcode( $content ) ) .'</div><div class="clear"></div>';
}



//==============================================//
// TYPOGRAPHY SHORTCODES
//==============================================//
function pt_pullquote_r($atts, $content = null) {
    extract(shortcode_atts(array(
        "align" => ''
    ), $atts));

    return '<blockquote class="pullquote alignright"><i class="fa fa-quote-left"></i>'. do_shortcode($content) .'</blockquote>';
}

function pt_pullquote_l($atts, $content = null) {
    extract(shortcode_atts(array(
        "align" => '',
    ), $atts));

    return '<blockquote class="pullquote alignleft"><i class="fa fa-quote-left"></i>'. do_shortcode($content) .'</blockquote>';
}

/////////////////////////////////////////////////

function pt_blockquote($atts, $content = null) {
    return '<blockquote><i class="fa fa-quote-left"></i>'. do_shortcode($content) .'</blockquote>';
}

/////////////////////////////////////////////////

function pt_htext($atts, $content = null) {
    return '<span class="highlighted-text">'. do_shortcode($content) .'</span>';
}

/////////////////////////////////////////////////

function pt_dropcap($atts, $content = null) {
    return '<span class="dropcap">'. do_shortcode($content) .'</span>';
}



//==============================================//
// BUTTONS SHORTCODES
//==============================================//
function pt_button($atts, $content = null) {
    extract(shortcode_atts(array(
        "url" => 'http://',
        "color" => 'orange',
        "target" => '',
        "liquid" => ''
    ), $atts));

    if( $liquid == 'yes' ){
        $btn_liquid = ' liquid';
    } else {
        $btn_liquid = '';
    }

    if( $target != '' ){
        $btn_target = ' target="_blank"';
    } else {
        $btn_target = '';
    }

    return '<a href="'.$url.'" class="pt-btn '.$color.'-btn'.$btn_liquid.'"'.$btn_target.'>'.$content.'</a>';
}



//==============================================//
// DIVIDERS
//==============================================//
function pt_divider () {
    return '<div class="hor-divider"><hr/></div>';
}

///////////////////////////////////////////////////

function pt_divider_top () {
    return '<div class="hor-divider"><a href="#main-wrapper">Top</a><hr/><div class="clear"></div></div>';
}

///////////////////////////////////////////////////

function pt_hspace () {
    return '<div class="hor-space"><hr/></div>';
}



//==============================================//
// LISTS
//==============================================//
function pt_list($atts, $content = null) {
    extract(shortcode_atts(array(
        "type" => ''
    ), $atts));

    return '<ul class="pt-list '.$type.'">'. do_shortcode($content) .'</ul>';
}

///////////////////////////////////////////////////

function pt_list_item ($atts, $content = null) {
    extract(shortcode_atts(array(
        "type" => ''
    ), $atts));

    return '<li><i class="fa fa-'.$type.' fa-lg"></i>'. do_shortcode($content) .'</li>';
}



//==============================================//
// ACCORDIONS
//==============================================//
function pt_acc ($atts, $content = null) {
    return '<div class="accordion">'. do_shortcode($content) .'</div>';
}

///////////////////////////////////////////////////

function pt_panel ($atts, $content = null) {
    extract(shortcode_atts(array(
        "title" => ''
    ), $atts));

    return '<div class="accHead"><p>'.$title.'</p></div><div class="accBody">'. wpautop( do_shortcode( $content ) ) .'</div>';
}



//==============================================//
// TABS
//==============================================//
$pt_tabs_i = 0;
function pt_tabs( $atts, $content = null ) {
    global $pt_tabs_i;
    extract(shortcode_atts(array(), $atts));

    $output = '<div class="tabs">';
    $output .= '<ul class="tabset">';
    foreach ($atts as $tab) {
        $tabID = "tab-" . $pt_tabs_i++;
        $output .= '<li><a href="#' . $tabID . '" class="tab">' .$tab. '</a></li>';
    }
    $output .= '<li class="clear"></li></ul>';
    $output .= do_shortcode($content) .'</div>';

    return $output;
}

///////////////////////////////////////////////////

$pt_tabs_j = 0;
function pt_tab( $atts, $content = null ) {
    global $pt_tabs_j;
    extract(shortcode_atts(array(), $atts));

    $tabID = "tab-" . $pt_tabs_j++;
    $output = '<div id="' . $tabID . '" class="tabContent">' . wpautop( do_shortcode( $content ) ) .'</div>';

    return $output;
}



//==============================================//
// TESTIMONIALS
//==============================================//
function pt_testimonial ($atts, $content = null) {
    extract(shortcode_atts(array(
        "author" => ''
    ), $atts));

    return '<blockquote class="testimonial"><i class="fa fa-quote-left"></i>'. do_shortcode($content) .'<footer class="testimonial-author">' .$author. '</footer></blockquote>';
}



//==============================================//
// NOTIFICATION BOXES
//==============================================//
function pt_box ($atts, $content = null) {
    extract(shortcode_atts(array(
        "type" => ''
    ), $atts));

    return '<div class="pt-box '.$type.'-box">'. wpautop( do_shortcode( $content ) ) .'</div>';
}



//==============================================//
// SERVICE/FEATURE
//==============================================//
function pt_service($atts, $content = null) {  
    extract(shortcode_atts(array(  
        'icon' => '',
        'title' => '',
        'layout' => ''
    ), $atts));

    if($title != ''){
        $serviceTitle = '<h2>'.$title.'</h2>';
    } else {
        $serviceTitle = '';
    }

    return '<div class="pt-service service-'.$layout.' clearfix"><div class="pt-icon"><i class="fa fa-'.$icon.'"></i></div>'.$serviceTitle.''. do_shortcode($content) .'</div>';
}



//==============================================//
// PRICE LABEL
//==============================================//
function pt_price_label($atts, $content = null) {  
    extract(shortcode_atts(array(  
        'size' => '',
        'featured' => '',
        'title' => '',
        'price' => '',
        'suffix' => ''
    ), $atts));

    if( $suffix != '' ){
        $price_suffix = ' <span>'.$suffix.'</span>';
    } else {
        $price_suffix = '';
    }

    if( $featured == 'yes' ){
        $featuredClass = ' price-featured';
    } else {
        $featuredClass = '';
    }

    return '<div class="price-label '.$size.'-label'.$featuredClass.'"><div class="label-wrap"><div class="label-title">'.$title.'</div><div class="label-price">'.$price.$price_suffix.'</div><div class="label-content clearfix">'. do_shortcode($content) .'</div></div></div>';  
}



//==============================================//
// IMAGES
//==============================================//
function pt_img ($atts, $content = null) {
    extract(shortcode_atts(array(
        "path" => '',
        "width" => '',
        "height" => '',
        "frame" => '',
        "align" => '',
        "title" => '',
        "alt" => '',
        "link" => ''
    ), $atts));

    $imgLinkPath = premitheme_multisite_image_path($path);
    $src = $path;
    
    $image = premitheme_image( '', $src, array( $width, $height) );

    if( $frame == 'yes' ){
        $width = $image[1] - 8;
        $height = $image[2] - 8;
        $frameClass = ' frame';
    } else {
        $width = $image[1];
        $height = $image[2];
        $frameClass = '';
    }

    if( $link != '' ):
        if( $path == $link ):
            return '<a class="pt-img-link '.$align.'" title="'.$title.'" href="'.$imgLinkPath.'" rel="prettyPhoto"><img class="pt-img'.$frameClass.'" src="'.$image[0].'" width="'.$width.'" height="'.$height.'" alt="'.$alt.'"/></a>';
        else:
            return '<a class="pt-img-link '.$align.'" title="'.$title.'" href="'.$link.'"><img class="pt-img'.$frameClass.'" src="'.$image[0].'" width="'.$width.'" height="'.$height.'" alt="'.$alt.'"/></a>';
        endif;
    else:
        return '<img class="pt-img '.$align.$frameClass.'" src="'.$image[0].'" width="'.$width.'" height="'.$height.'" alt="'.$alt.'" title="'.$title.'"/>';
    endif;
}



//==============================================//
// POPUP LIGHTBOX
//==============================================//
function pt_popup($atts, $content = null) {
    extract(shortcode_atts(array(
        "id" => '',
        "text" => '',
        "color" => ''
    ), $atts));

    return '<a href="#" class="pt-btn '.$color.'-btn" data-reveal-id="'.$id.'" data-animation="fadeAndPop" data-animationspeed="400" data-closeonbackgroundclick="true" data-dismissmodalclass="close-reveal-modal">'.$text.'</a><div id="'.$id.'" class="reveal-modal">'. do_shortcode($content) .'<a class="close-reveal-modal">&#215;</a></div>';
}



//==============================================//
// IMAGE SLIDER
//==============================================//
function pt_slider($atts, $content = null) {     
    extract(shortcode_atts(array(
        "width" => ''
    ), $atts));

    return '<div class="entry-thumb flexslider flexslider-shortcode" style="max-width:'.$width.'px !important;"><ul class="slides">'. do_shortcode($content) .'</ul></div>';
}

function pt_slide($atts, $content = null) {
    extract(shortcode_atts(array(
        "path" => '',
        "width" => '',
        "height" => ''
    ), $atts));

    $imgLinkPath = premitheme_multisite_image_path($path);
    $image = premitheme_image( '', $path, array( $width, $height) );

    return '<li><a title="" href="'.$imgLinkPath.'" rel="prettyPhoto"><img src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" alt=""/></a></li>';
}



//==============================================//
// AUDIO
//==============================================//
function pt_audio($atts, $content = null) {
    extract(shortcode_atts(array(
        "mp3" => '',
        "oga" => '',
        "id"  => ''
    ), $atts));

    return '<script>
            jQuery(document).ready(function($){
                $("#jquery-jplayer-'.$id.'").jPlayer({
                    ready: function () {
                        $(this).jPlayer("setMedia", {
                            mp3: "'.$mp3.'",
                            oga: "'.$oga.'",
                        });
                    },
                    play: function() { // To avoid multiple jPlayers playing together.
                        $(this).jPlayer("pauseOthers");
                    },
                    swfPath: "'.PT_JS.'",
                    solution: "html, flash",
                    supplied: "mp3, oga",
                    wmode: "window",
                    cssSelectorAncestor: "#jp-gui-'.$id.'"
                });
            });
        </script>
          
        <div class="audio-shortcode">
            <div class="jp-audio-wrapper">
                <div class="jp-type-single">
                    <div id="jquery-jplayer-'.$id.'" class="jp-jplayer"></div>
                    <div id="jp-gui-'.$id.'" class="jp-gui">
                        <div class="jp-interface">
                            <div class="jp-interface-wrapper">
                                <div><a href="#" class="jp-play" tabindex="1"><i class="fa fa-play"></i></a></div>
                                <div><a href="#" class="jp-pause" tabindex="1"><i class="fa fa-pause"></i></a></div>
                                <div class="jp-time-wrapper">
                                    <div class="jp-time">
                                        <div class="jp-current-time"></div>
                                        <div class="jp-time-sep">&nbsp;/&nbsp;</div>
                                        <div class="jp-duration"></div>
                                    </div>
                                </div>
                                <div class="jp-progress">
                                    <div class="jp-seek-bar">
                                        <div class="jp-play-bar"></div>
                                    </div>
                                </div>
                                <div><a href="#" class="jp-mute" tabindex="1"><i class="fa fa-volume-up"></i></a></div>
                                <div><a href="#" class="jp-unmute" tabindex="1"><i class="fa fa-volume-off"></i></a></div>
                                <div class="jp-volume-bar">
                                    <div class="jp-volume-bar-value"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
}



//==============================================//
// VIDEO
//==============================================//
function pt_video($atts, $content = null) {  
    extract(shortcode_atts(array(
        "url" => '',
        "width" => '',
        "align" => 'alignnone'
    ), $atts));
    
    if(!$width){
        $style = 'remotely-hosted"';
    } else {
        $style = $align.'" style="max-width:'.$width.'px" data-align="'.$align.'"';
    }
    $embed_code = wp_oembed_get($url, array('width'=>$width));
    
    return '<div class="pt-video url-video entry-media '.$style.'>'.$embed_code.'</div><div class="clear"></div>';  
}  

//////////////////////

function pt_video_embed($atts, $content = null) {  
    $embed_code = htmlspecialchars_decode($content);

    return '<div class="pt-video entry-media remotely-hosted"><p>'.$embed_code.'</p></div>';  
}  



//==============================================//
// GRAPH
//==============================================//
function pt_graph($atts, $content = null) {     
    return '<div class="pt-graph"><ul>'. do_shortcode($content) .'</ul></div>';  
}  

function pt_graph_item($atts, $content = null) {  
    extract(shortcode_atts(array(
        "label" => '',
        "value" => ''
    ), $atts));

    return '<li><div style="width:'.$value.'"><span>'.$label.'</span></div></li>';  
}