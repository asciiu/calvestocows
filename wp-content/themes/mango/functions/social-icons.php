<?php
function premitheme_social_links($style) {
    if($style == "round") {
        $style = '-r';
    } elseif($style == "circle"){
        $style = '-c';
    } else {
        $style = '';
    }

    $social_links = '';

    if( of_get_option('social_aim') )
        $social_links .= '<li class="aim social-link"><a href="aim:goim?screenname='.of_get_option('social_aim').'" title="AIM"><span class="icon-aim'.$style.'"></span></a></li>';
    if( of_get_option('social_behance') )
        $social_links .= '<li class="behance social-link"><a href="'.of_get_option('social_behance').'" title="Behance" target="_blank"><span class="icon-behance'.$style.'"></span></a></li>';
    if( of_get_option('social_delicious') )
        $social_links .= '<li class="delicious social-link"><a href="'.of_get_option('social_delicious').'" title="Delicious" target="_blank"><span class="icon-delicious'.$style.'"></span></a></li>';
    if( of_get_option('social_deviant') )
        $social_links .= '<li class="deviant social-link"><a href="'.of_get_option('social_deviant').'" title="DeviantArt" target="_blank"><span class="icon-deviantart'.$style.'"></span></a></li>';
    if( of_get_option('social_digg') )
        $social_links .= '<li class="digg social-link"><a href="'.of_get_option('social_digg').'" title="Digg" target="_blank"><span class="icon-digg'.$style.'"></span></a></li>';
    if( of_get_option('social_dribbble') )
        $social_links .= '<li class="dribbble social-link"><a href="'.of_get_option('social_dribbble').'" title="Dribbble" target="_blank"><span class="icon-dribbble'.$style.'"></span></a></li>';
    if( of_get_option('social_facebook') )
        $social_links .= '<li class="facebook social-link"><a href="'.of_get_option('social_facebook').'" title="Facebook" target="_blank"><span class="icon-facebook'.$style.'"></span></a></li>';
    if( of_get_option('social_flickr') )
        $social_links .= '<li class="flickr social-link"><a href="'.of_get_option('social_flickr').'" title="Flickr" target="_blank"><span class="icon-flickr'.$style.'"></span></a></li>';
    if( of_get_option('social_forrst') )
        $social_links .= '<li class="forrst social-link"><a href="'.of_get_option('social_forrst').'" title="Forrst" target="_blank"><span class="icon-forrst'.$style.'"></span></a></li>';
    if( of_get_option('social_github') )
        $social_links .= '<li class="github social-link"><a href="'.of_get_option('social_github').'" title="Github" target="_blank"><span class="icon-github'.$style.'"></span></a></li>';
    if( of_get_option('social_gplus') )
        $social_links .= '<li class="gplus social-link"><a href="'.of_get_option('social_gplus').'" title="Google+" target="_blank"><span class="icon-gplus'.$style.'"></span></a></li>';
    if( of_get_option('social_imdb') )
        $social_links .= '<li class="imdb social-link"><a href="'.of_get_option('social_imdb').'" title="IMDb" target="_blank"><span class="icon-imdb'.$style.'"></span></a></li>';
    if( of_get_option('social_instagram') )
        $social_links .= '<li class="instagram social-link"><a href="'.of_get_option('social_instagram').'" title="Instagram" target="_blank"><span class="icon-instagram'.$style.'"></span></a></li>';
    if( of_get_option('social_lastfm') )
        $social_links .= '<li class="lastfm social-link"><a href="'.of_get_option('social_lastfm').'" title="Last FM" target="_blank"><span class="icon-lastfm'.$style.'"></span></a></li>';
    if( of_get_option('social_linkedin') )
        $social_links .= '<li class="linkedin social-link"><a href="'.of_get_option('social_linkedin').'" title="LinkedIn" target="_blank"><span class="icon-linkedin'.$style.'"></span></a></li>';
    if( of_get_option('social_paypal') )
        $social_links .= '<li class="paypal social-link"><a href="'.of_get_option('social_paypal').'" title="Paypal" target="_blank"><span class="icon-paypal'.$style.'"></span></a></li>';
    if( of_get_option('social_pinterest') )
        $social_links .= '<li class="pinterest social-link"><a href="'.of_get_option('social_pinterest').'" title="Pinterest" target="_blank"><span class="icon-pinterest'.$style.'"></span></a></li>';
    if( of_get_option('social_reddit') )
        $social_links .= '<li class="reddit social-link"><a href="'.of_get_option('social_reddit').'" title="Reddit" target="_blank"><span class="icon-reddit'.$style.'"></span></a></li>';
    if( of_get_option('social_skype') )
        $social_links .= '<li class="skype social-link"><a href="skype:'.of_get_option('social_skype').'?chat" title="Skype"><span class="icon-skype'.$style.'"></span></a></li>';
    if( of_get_option('social_soundcloud') )
        $social_links .= '<li class="soundcloud social-link"><a href="'.of_get_option('social_soundcloud').'" title="SoundCloud" target="_blank"><span class="icon-soundcloud'.$style.'"></span></a></li>';
    if( of_get_option('social_spotify') )
        $social_links .= '<li class="spotify social-link"><a href="'.of_get_option('social_spotify').'" title="Spotify" target="_blank"><span class="icon-spotify'.$style.'"></span></a></li>';
    if( of_get_option('social_stumbleupon') )
        $social_links .= '<li class="stumbleupon social-link"><a href="'.of_get_option('social_stumbleupon').'" title="Stumbleupon" target="_blank"><span class="icon-stumbleupon'.$style.'"></span></a></li>';
    if( of_get_option('social_tumblr') )
        $social_links .= '<li class="tumblr social-link"><a href="'.of_get_option('social_tumblr').'" title="Tumblr" target="_blank"><span class="icon-tumblr'.$style.'"></span></a></li>';
    if( of_get_option('social_twitter') )
        $social_links .= '<li class="twitter social-link"><a href="'.of_get_option('social_twitter').'" title="Twitter" target="_blank"><span class="icon-twitter'.$style.'"></span></a></li>';
    if( of_get_option('social_vimeo') )
        $social_links .= '<li class="vimeo social-link"><a href="'.of_get_option('social_vimeo').'" title="Vimeo" target="_blank"><span class="icon-vimeo'.$style.'"></span></a></li>';
    if( of_get_option('social_wp') )
        $social_links .= '<li class="wp social-link"><a href="'.of_get_option('social_wp').'" title="WordPress.com" target="_blank"><span class="icon-wordpress'.$style.'"></span></a></li>';
    if( of_get_option('social_yahoo') )
        $social_links .= '<li class="yahoo social-link"><a href="ymsgr:sendim?'.of_get_option('social_yahoo').'" title="Yahoo!"><span class="icon-yahoo'.$style.'"></span></a></li>';
    if( of_get_option('social_youtube') )
        $social_links .= '<li class="youtube social-link"><a href="'.of_get_option('social_youtube').'" title="YouTube" target="_blank"><span class="icon-youtube'.$style.'"></span></a></li>';
    if( of_get_option('social_rss') )
        $social_links .= '<li class="rss social-link"><a href="'.of_get_option('social_rss').'" title="RSS" target="_blank"><span class="icon-rss'.$style.'"></span></a></li>';

    return $social_links;
}


function premitheme_team_member_social_links($post_id, $style) {
    if($style == "round") {
        $style = '-r';
    } elseif($style == "circle"){
        $style = '-c';
    } else {
        $style = '';
    }

    $social_links = '';

    if( get_post_meta($post_id, 'team_member_web', TRUE) )
        $social_links .= '<li class="website social-link"><a href="'.get_post_meta($post_id, 'team_member_web', TRUE).'" title="'.__('Personal website','premitheme').'" target="_blank"><span class="icon-earth'.$style.'"></span></a></li>';
    if( get_post_meta($post_id, 'team_member_aim', TRUE) )
        $social_links .= '<li class="aim social-link"><a href="aim:goim?screenname='.get_post_meta($post_id, 'team_member_aim', TRUE).'" title="AIM"><span class="icon-aim'.$style.'"></span></a></li>';
    if( get_post_meta($post_id, 'team_member_behance', TRUE) )
        $social_links .= '<li class="behance social-link"><a href="'.get_post_meta($post_id, 'team_member_behance', TRUE).'" title="Behance" target="_blank"><span class="icon-behance'.$style.'"></span></a></li>';
    if( get_post_meta($post_id, 'team_member_delicious', TRUE) )
        $social_links .= '<li class="delicious social-link"><a href="'.get_post_meta($post_id, 'team_member_delicious', TRUE).'" title="Delicious" target="_blank"><span class="icon-delicious'.$style.'"></span></a></li>';
    if( get_post_meta($post_id, 'team_member_deviant', TRUE) )
        $social_links .= '<li class="deviant social-link"><a href="'.get_post_meta($post_id, 'team_member_deviant', TRUE).'" title="DeviantArt" target="_blank"><span class="icon-deviantart'.$style.'"></span></a></li>';
    if( get_post_meta($post_id, 'team_member_digg', TRUE) )
        $social_links .= '<li class="digg social-link"><a href="'.get_post_meta($post_id, 'team_member_digg', TRUE).'" title="Digg" target="_blank"><span class="icon-digg'.$style.'"></span></a></li>';
    if( get_post_meta($post_id, 'team_member_dribbble', TRUE) )
        $social_links .= '<li class="dribbble social-link"><a href="'.get_post_meta($post_id, 'team_member_dribbble', TRUE).'" title="Dribbble" target="_blank"><span class="icon-dribbble'.$style.'"></span></a></li>';
    if( get_post_meta($post_id, 'team_member_facebook', TRUE) )
        $social_links .= '<li class="facebook social-link"><a href="'.get_post_meta($post_id, 'team_member_facebook', TRUE).'" title="Facebook" target="_blank"><span class="icon-facebook'.$style.'"></span></a></li>';
    if( get_post_meta($post_id, 'team_member_flickr', TRUE) )
        $social_links .= '<li class="flickr social-link"><a href="'.get_post_meta($post_id, 'team_member_flickr', TRUE).'" title="Flickr" target="_blank"><span class="icon-flickr'.$style.'"></span></a></li>';
    if( get_post_meta($post_id, 'team_member_forrst', TRUE) )
        $social_links .= '<li class="forrst social-link"><a href="'.get_post_meta($post_id, 'team_member_forrst', TRUE).'" title="Forrst" target="_blank"><span class="icon-forrst'.$style.'"></span></a></li>';
    if( get_post_meta($post_id, 'team_member_github', TRUE) )
        $social_links .= '<li class="github social-link"><a href="'.get_post_meta($post_id, 'team_member_github', TRUE).'" title="Github" target="_blank"><span class="icon-github'.$style.'"></span></a></li>';
    if( get_post_meta($post_id, 'team_member_gplus', TRUE) )
        $social_links .= '<li class="gplus social-link"><a href="'.get_post_meta($post_id, 'team_member_gplus', TRUE).'" title="Google+" target="_blank"><span class="icon-gplus'.$style.'"></span></a></li>';
    if( get_post_meta($post_id, 'team_member_imdb', TRUE) )
        $social_links .= '<li class="imdb social-link"><a href="'.get_post_meta($post_id, 'team_member_imdb', TRUE).'" title="IMDb" target="_blank"><span class="icon-imdb'.$style.'"></span></a></li>';
    if( get_post_meta($post_id, 'team_member_instagram', TRUE) )
        $social_links .= '<li class="instagram social-link"><a href="'.get_post_meta($post_id, 'team_member_instagram', TRUE).'" title="Instagram" target="_blank"><span class="icon-instagram'.$style.'"></span></a></li>';
    if( get_post_meta($post_id, 'team_member_lastfm', TRUE) )
        $social_links .= '<li class="lastfm social-link"><a href="'.get_post_meta($post_id, 'team_member_lastfm', TRUE).'" title="Last FM" target="_blank"><span class="icon-lastfm'.$style.'"></span></a></li>';
    if( get_post_meta($post_id, 'team_member_linkedin', TRUE) )
        $social_links .= '<li class="linkedin social-link"><a href="'.get_post_meta($post_id, 'team_member_linkedin', TRUE).'" title="LinkedIn" target="_blank"><span class="icon-linkedin'.$style.'"></span></a></li>';
    if( get_post_meta($post_id, 'team_member_paypal', TRUE) )
        $social_links .= '<li class="paypal social-link"><a href="'.get_post_meta($post_id, 'team_member_paypal', TRUE).'" title="Paypal" target="_blank"><span class="icon-paypal'.$style.'"></span></a></li>';
    if( get_post_meta($post_id, 'team_member_pinterest', TRUE) )
        $social_links .= '<li class="pinterest social-link"><a href="'.get_post_meta($post_id, 'team_member_pinterest', TRUE).'" title="Pinterest" target="_blank"><span class="icon-pinterest'.$style.'"></span></a></li>';
    if( get_post_meta($post_id, 'team_member_reddit', TRUE) )
        $social_links .= '<li class="reddit social-link"><a href="'.get_post_meta($post_id, 'team_member_reddit', TRUE).'" title="Reddit" target="_blank"><span class="icon-reddit'.$style.'"></span></a></li>';
    if( get_post_meta($post_id, 'team_member_skype', TRUE) )
        $social_links .= '<li class="skype social-link"><a href="skype:'.get_post_meta($post_id, 'team_member_skype', TRUE).'?chat" title="Skype"><span class="icon-skype'.$style.'"></span></a></li>';
    if( get_post_meta($post_id, 'team_member_soundcloud', TRUE) )
        $social_links .= '<li class="soundcloud social-link"><a href="'.get_post_meta($post_id, 'team_member_soundcloud', TRUE).'" title="SoundCloud" target="_blank"><span class="icon-soundcloud'.$style.'"></span></a></li>';
    if( get_post_meta($post_id, 'team_member_spotify', TRUE) )
        $social_links .= '<li class="spotify social-link"><a href="'.get_post_meta($post_id, 'team_member_spotify', TRUE).'" title="Spotify" target="_blank"><span class="icon-spotify'.$style.'"></span></a></li>';
    if( get_post_meta($post_id, 'team_member_stumbleupon', TRUE) )
        $social_links .= '<li class="stumbleupon social-link"><a href="'.get_post_meta($post_id, 'team_member_stumbleupon', TRUE).'" title="Stumbleupon" target="_blank"><span class="icon-stumbleupon'.$style.'"></span></a></li>';
    if( get_post_meta($post_id, 'team_member_tumblr', TRUE) )
        $social_links .= '<li class="tumblr social-link"><a href="'.get_post_meta($post_id, 'team_member_tumblr', TRUE).'" title="Tumblr" target="_blank"><span class="icon-tumblr'.$style.'"></span></a></li>';
    if( get_post_meta($post_id, 'team_member_twitter', TRUE) )
        $social_links .= '<li class="twitter social-link"><a href="'.get_post_meta($post_id, 'team_member_twitter', TRUE).'" title="Twitter" target="_blank"><span class="icon-twitter'.$style.'"></span></a></li>';
    if( get_post_meta($post_id, 'team_member_vimeo', TRUE) )
        $social_links .= '<li class="vimeo social-link"><a href="'.get_post_meta($post_id, 'team_member_vimeo', TRUE).'" title="Vimeo" target="_blank"><span class="icon-vimeo'.$style.'"></span></a></li>';
    if( get_post_meta($post_id, 'team_member_wp', TRUE) )
        $social_links .= '<li class="wp social-link"><a href="'.get_post_meta($post_id, 'team_member_wp', TRUE).'" title="WordPress.com" target="_blank"><span class="icon-wordpress'.$style.'"></span></a></li>';
    if( get_post_meta($post_id, 'team_member_yahoo', TRUE) )
        $social_links .= '<li class="yahoo social-link"><a href="ymsgr:sendim?'.get_post_meta($post_id, 'team_member_yahoo', TRUE).'" title="Yahoo!"><span class="icon-yahoo'.$style.'"></span></a></li>';
    if( get_post_meta($post_id, 'team_member_youtube', TRUE) )
        $social_links .= '<li class="youtube social-link"><a href="'.get_post_meta($post_id, 'team_member_youtube', TRUE).'" title="YouTube" target="_blank"><span class="icon-youtube'.$style.'"></span></a></li>';
    if( get_post_meta($post_id, 'team_member_rss', TRUE) )
        $social_links .= '<li class="rss social-link"><a href="'.get_post_meta($post_id, 'team_member_rss', TRUE).'" title="RSS" target="_blank"><span class="icon-rss'.$style.'"></span></a></li>';

    return $social_links;
}