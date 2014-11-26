<?php
/* Twitter Relative Time FUnction
========================================*/

define("SECOND", 1);
define("MINUTE", 60 * SECOND);
define("HOUR", 60 * MINUTE);
define("DAY", 24 * HOUR);
define("MONTH", 30 * DAY);
define("YEAR", 12 * MONTH);

function premitheme_timeDiff($now, $time){
    if( !$now ) $now = time();

    if (!is_int($now)) {
        $now = strtotime($now);
    }
    if (!is_int($time)) {
        $time = strtotime($time);
    }

    $diff = $now - $time;

    if ($diff <= 10 && $diff >= 0){
        return __("Just now", "premitheme");
    }
    if ($diff < MINUTE && $diff >= 11){
        return __("Less than a minute", "premitheme");
    }
    if ($diff < 2 * MINUTE && $diff >= MINUTE){
        return __("About 1 minute ago", "premitheme");
    }
    if ($diff < 60 * MINUTE && $diff >= 2 * MINUTE){
        return __("About", "premitheme") . ' ' . round($diff / MINUTE) . ' ' . __("minutes ago", "premitheme");
    }
    if ($diff < 2 * HOUR && $diff >= 60 * MINUTE){
        return __("About 1 hour ago", "premitheme");
    }
    if ($diff < 24 * HOUR && $diff >= 2 * HOUR){
        return __("About", "premitheme") . ' ' . round($diff / HOUR) . ' ' . __("hours ago", "premitheme");
    }
    if ($diff < 2 * DAY && $diff >= 24 * HOUR){
        return __("About 1 day ago", "premitheme");
    }
    if ($diff < 30 * DAY && $diff >= 2 * DAY){
        return __("About", "premitheme") . ' ' . round($diff / DAY) . ' ' . __("days ago", "premitheme");
    }
    if ($diff < 37 * DAY && $diff >= 30 * DAY){
        return __("About 1 month ago", "premitheme");
    }
    if ($diff < 2 * MONTH && $diff >= 37 * DAY){
        return __("More than a month ago", "premitheme");
    }
    if ($diff < 12 * MONTH && $diff >= 2 * MONTH){
        return __("About", "premitheme") . ' ' . round($diff / MONTH) . ' ' . __("months ago", "premitheme");
    }
    if ($diff < 12 * MONTH && $diff >= 12 * MONTH){
        return __("About 1 year ago", "premitheme");
    }
    if ($diff <= 1.5 * YEAR && $diff >= 13 * MONTH){
        return __("More than a year ago", "premitheme");
    }
    if ($diff > 1.5 * YEAR){
        return __("About", "premitheme") . ' ' . round($diff / YEAR) . ' ' . __("years ago", "premitheme");
    }
}



/* Actual Twitter FUnction
========================================*/

function premitheme_display_tweets($style = '', $twitter_id, $max_tweets=5, $cons_key, $cons_secret, $user_token, $user_secret) {
    $tmhOAuth = new tmhOAuth(array(
        'consumer_key' => $cons_key,
        'consumer_secret' => $cons_secret,
        'user_token' => $user_token,
        'user_secret' => $user_secret
    ));
    
    $code = $tmhOAuth->request('GET', $tmhOAuth->url('1.1/statuses/user_timeline'), array(
        'screen_name' => $twitter_id,
        'count' => $max_tweets,
        'include_rts' => true,
        'include_entities' => true
    ));

    $twitter = '';

    /*Retrieves the file from cache*/
    $tweets  = get_transient( 'pt-tweets-'.$twitter_id );
    
    if ($tweets === false) { //if there is no cached file
        $t = json_decode($tmhOAuth->response['response'], true);
        set_transient('pt-tweets-'.$twitter_id, $t, 60 * 30);//set the file to be cached at 30 minute intervals, this can be changed
        $set_tweets = true; //setting this to true will enable you to parse and display the feed immediately
    }
    if (isset($set_tweets)) { //parse the feed just once as it will be cached from now on
        $tweets = json_decode($tmhOAuth->response['response'], true);
    }
    
    /*Start of displaying the tweets as a list format*/
    $twitter .= '<ul class="twitter-feeds-container"><li class="twitter-bg"></li>';
    if (!empty($tweets)) {
        foreach ($tweets as $tweet) {
            $pubDate        = $tweet['created_at'];
            $tweet          = $tweet['text'];
            $today          = time();
            $time           = substr($pubDate, 11, 5);
            $day            = substr($pubDate, 0, 3);
            $date           = substr($pubDate, 7, 4);
            $month          = substr($pubDate, 4, 3);
            $year           = substr($pubDate, 25, 5);
            $english_suffix = date('jS', strtotime(preg_replace('/\s+/', ' ', $pubDate)));
            $full_month     = date('F', strtotime($pubDate));
            
            
            #pre-defined tags
            $default   = $full_month . $date . $year;
            $full_date = $day . $date . $month . $year;
            $ddmmyy    = $date . $month . $year;
            $mmyy      = $month . $year;
            $mmddyy    = $month . $date . $year;
            $ddmm      = $date . $month;
            
            #Time difference
            $timeDiff = premitheme_timeDiff($today, $pubDate);
            
            # Turn URLs into links
            $tweet = preg_replace('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\./-]*(\?\S+)?)?)?)@', '<a target="blank" title="$1" href="$1">$1</a>', $tweet);
            
            #Turn hashtags into links
            $tweet = preg_replace('/#([0-9a-zA-Z_-]+)/', "<a target='blank' title='$1' href=\"http://twitter.com/search?q=%23$1\">#$1</a>", $tweet);
            
            #Turn @replies into links
            $tweet = preg_replace("/@([0-9a-zA-Z_-]+)/", "<a target='blank' title='$1' href=\"http://twitter.com/$1\">@$1</a>", $tweet);
            
            $twitter .= '<li class="twitter-feed"><i class="fa fa-quote-left"></i> ' . $tweet . ' <i class="fa fa-quote-right"></i><span>';
            switch ($style) {
                case 'eng_suff': {
                    $twitter .= $english_suffix . '&nbsp;' . $full_month;
                }
                    break;
                case 'time_since'; {
                    $twitter .= $timeDiff;
                }
                    break;
                case 'ddmmyy'; {
                    $twitter .= $ddmmyy;
                }
                    break;
                case 'ddmm'; {
                    $twitter .= $ddmm;
                }
                    break;
                case 'full_date'; {
                    $twitter .= $full_date;
                }
                    break;
                default: {
                    $twitter .= $default;
                }
                    break;
            } //end switch statement
            $twitter .= '</span></li>'; //end of List
            
            
        } //end of foreach
    } else {
        $twitter.= '<li>'. __('No tweets', 'premitheme') .'</li>';
    } //end if statement
    $twitter .= '</ul>'; //end of Unordered list (Notice it's after the foreach loop!)
    $twitter .= '<a class="follow-link" href="http://twitter.com/'.$twitter_id.'" target="_blank"><i class="fa fa-twitter"></i> '.__('Follow', 'premitheme').' @'.$twitter_id.'</a>';
    echo $twitter;
}

// FUNCTION FOR VIEWING TWITTER PROFILE IMAGE
function premitheme_twitter_image($twitter_id, $cons_key, $cons_secret, $user_token, $user_secret) {
    $tmhOAuth = new tmhOAuth(array(
        'consumer_key' => $cons_key,
        'consumer_secret' => $cons_secret,
        'user_token' => $user_token,
        'user_secret' => $user_secret
    ));
    
    $code = $tmhOAuth->request('GET', $tmhOAuth->url('1.1/users/show'), array(
        'screen_name' => $twitter_id,
    ));

    $final_img_url = '';

    /*Retrieves the file from cache*/
    $img_url  = get_transient( 'pt-twitter-img-'.$twitter_id );

    if ($img_url === false) { //if there is no cached file
        $t = json_decode($tmhOAuth->response['response'], true);
        set_transient('pt-twitter-img-'.$twitter_id, $t, 60 * 30);//set the file to be cached at 30 minute intervals, this can be changed
        $set_img_url = true; //setting this to true will enable you to parse and display the feed immediately
    }
    if (isset($set_img_url)) { //parse the feed just once as it will be cached from now on
        $img_url = json_decode($tmhOAuth->response['response'], true);
    }

    // GET BIGGER IMAGE SIZE THAN THE DEFAULT
    if( isset( $img_url['profile_image_url'] ) ){
        $url = $img_url['profile_image_url'];
        $final_img_url = str_replace("_normal", "_bigger", $url);
    }

    echo '<a class="tweet-avatar-link" href="http://twitter.com/'.$twitter_id.'" title="'.__('Follow @','premitheme'), $twitter_id.'" target="_blank"><img class="tweet-avatar" src="'.$final_img_url.'" alt="'.$twitter_id, __(' profile image', 'premitheme').'"></a>';
}

// TWITTER FUNCTION FOR HOME LATEST TWITTER FEED
function premitheme_home_display_tweets($style = '', $twitter_id, $max_tweets=5, $cons_key, $cons_secret, $user_token, $user_secret) {
    $tmhOAuth = new tmhOAuth(array(
        'consumer_key' => $cons_key,
        'consumer_secret' => $cons_secret,
        'user_token' => $user_token,
        'user_secret' => $user_secret
    ));
    
    $code = $tmhOAuth->request('GET', $tmhOAuth->url('1.1/statuses/user_timeline'), array(
        'screen_name' => $twitter_id,
        'count' => $max_tweets,
        'include_rts' => true,
        'include_entities' => true
    ));

    $twitter = '';
    
    /*Retrieves the file from cache*/
    $tweets  = get_transient( 'pt-home-tweets-'.$twitter_id );
    
    if ($tweets === false) { //if there is no cached file
        $t = json_decode($tmhOAuth->response['response'], true);
        set_transient('pt-home-tweets-'.$twitter_id, $t, 60 * 30);//set the file to be cached at 30 minute intervals, this can be changed
        $set_tweets = true; //setting this to true will enable you to parse and display the feed immediately
    }
    if (isset($set_tweets)) { //parse the feed just once as it will be cached from now on
        $tweets = json_decode($tmhOAuth->response['response'], true);
    }
    
    /*Start of displaying the tweets*/
    if (!empty($tweets)) {
        foreach ($tweets as $tweet) {
            $pubDate        = $tweet['created_at'];
            $tweet          = $tweet['text'];
            $today          = time();
            $time           = substr($pubDate, 11, 5);
            $day            = substr($pubDate, 0, 3);
            $date           = substr($pubDate, 7, 4);
            $month          = substr($pubDate, 4, 3);
            $year           = substr($pubDate, 25, 5);
            $english_suffix = date('jS', strtotime(preg_replace('/\s+/', ' ', $pubDate)));
            $full_month     = date('F', strtotime($pubDate));
            
            
            #pre-defined tags
            $default   = $full_month . $date . $year;
            $full_date = $day . $date . $month . $year;
            $ddmmyy    = $date . $month . $year;
            $mmyy      = $month . $year;
            $mmddyy    = $month . $date . $year;
            $ddmm      = $date . $month;
            
            #Time difference
            $timeDiff = premitheme_timeDiff($today, $pubDate);
            
            # Turn URLs into links
            $tweet = preg_replace('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\./-]*(\?\S+)?)?)?)@', '<a target="blank" title="$1" href="$1">$1</a>', $tweet);
            
            #Turn hashtags into links
            $tweet = preg_replace('/#([0-9a-zA-Z_-]+)/', "<a target='blank' title='$1' href=\"http://twitter.com/search?q=%23$1\">#$1</a>", $tweet);
            
            #Turn @replies into links
            $tweet = preg_replace("/@([0-9a-zA-Z_-]+)/", "<a target='blank' title='$1' href=\"http://twitter.com/$1\">@$1</a>", $tweet);
            
            $twitter .= '<div class="tweet-container">' . $tweet . '<span class="tweet-date"><i class="fa fa-twitter"></i> ';
            switch ($style) {
                case 'eng_suff': {
                    $twitter .= $english_suffix . '&nbsp;' . $full_month;
                }
                    break;
                case 'time_since'; {
                    $twitter .= $timeDiff;
                }
                    break;
                case 'ddmmyy'; {
                    $twitter .= $ddmmyy;
                }
                    break;
                case 'ddmm'; {
                    $twitter .= $ddmm;
                }
                    break;
                case 'full_date'; {
                    $twitter .= $full_date;
                }
                    break;
                default: {
                    $twitter .= $default;
                }
                    break;
            } //end switch statement
            $twitter .= "</span></div>";
            
            
        } //end of foreach
    } else {
        $twitter.= '<div>'. __('No tweets', 'premitheme') .'</div>';
    } //end if statement
    echo $twitter;
}
