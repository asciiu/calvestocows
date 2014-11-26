<?php
/* The template for displaying last tweet content section */

global $pt_section_i;
$twitterId = get_post_meta($post->ID, "twitter_id", true);
$twitterConsKey = get_post_meta($post->ID, "twitter_cons_key", true);
$twitterConsSecret = get_post_meta($post->ID, "twitter_cons_secret", true);
$twitterAccToken = get_post_meta($post->ID, "twitter_acc_token", true);
$twitterAccSecret = get_post_meta($post->ID, "twitter_acc_secret", true);
$style = 'time_since';
$max_tweets = 1;

?>
    <!-- LAST TWEET
    ====================================== -->
    <div class="last-tweet padding-bottom clearfix">
        <div class="tweet-spacer"></div>
        <?php if ( $twitterId[$pt_section_i] && $twitterConsKey[$pt_section_i] && $twitterConsSecret[$pt_section_i] && $twitterAccToken[$pt_section_i] && $twitterAccSecret[$pt_section_i] ) {
            premitheme_twitter_image($twitterId[$pt_section_i], $twitterConsKey[$pt_section_i], $twitterConsSecret[$pt_section_i], $twitterAccToken[$pt_section_i], $twitterAccSecret[$pt_section_i]);
            premitheme_home_display_tweets( $style, $twitterId[$pt_section_i], $max_tweets, $twitterConsKey[$pt_section_i], $twitterConsSecret[$pt_section_i], $twitterAccToken[$pt_section_i], $twitterAccSecret[$pt_section_i]);
        } else { ?>
            <ul class="twitter-feeds-container">
                <li><?php _e('Sorry, Widget error.', 'premitheme'); ?></li>
            </ul>
        <?php } ?>
    </div>