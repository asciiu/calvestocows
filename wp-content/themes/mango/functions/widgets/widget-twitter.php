<?php

add_action( 'widgets_init', 'pt_twitter_widget' );

function pt_twitter_widget() {
    register_widget( 'Twitter_Widget' );
}


class Twitter_Widget extends WP_Widget {
    
    function Twitter_Widget() {
        global $pt_themename;
        
        $widget_ops = array( 'classname' => 'widget-twitter', 'description' => __('Add Twitter feeds to the sidebar', 'premitheme') );
        $control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'twitter-widget' ); //default width = 250
        $this->WP_Widget( 'twitter-widget', $pt_themename.' - '.__('Twitter Feeds', 'premitheme'), $widget_ops, $control_ops );
    }


/*-------------------------------/
    UPDATE & SAVE SETTINGS
/-------------------------------*/
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['twitter_id'] = strip_tags( $new_instance['twitter_id'] );
        $instance['cons_key'] = strip_tags( $new_instance['cons_key'] );
        $instance['cons_secret'] = strip_tags( $new_instance['cons_secret'] );
        $instance['user_token'] = strip_tags( $new_instance['user_token'] );
        $instance['user_secret'] = strip_tags( $new_instance['user_secret'] );
        $instance['max_tweets'] = strip_tags( $new_instance['max_tweets'] );
        $instance['style'] = strip_tags( $new_instance['style'] );
        
        return $instance;
    }
    
    
/*-------------------------------/
    RENDER WIDGET
/-------------------------------*/
    function widget($args, $instance) {
        extract( $args );

        $title = apply_filters('widget_title', $instance['title'] );
        $twitter_id = $instance['twitter_id'];
        $cons_key = $instance['cons_key'];
        $cons_secret = $instance['cons_secret'];
        $user_token = $instance['user_token'];
        $user_secret = $instance['user_secret'];
        $max_tweets = $instance['max_tweets'];
        $style = $instance['style'];
        
        echo $before_widget;
        
        if ( $title ) echo $before_title . $title . $after_title;
        
        if ( $twitter_id && $cons_key && $cons_secret && $user_token && $user_secret ) {
            premitheme_display_tweets( $style, $twitter_id, $max_tweets, $cons_key, $cons_secret, $user_token, $user_secret);
        } else { ?>
            <ul class="twitter-feeds-container">
                <li>Sorry, Widget error.</li>
            </ul>
        <?php }

        echo $after_widget;
    }
    
    
/*-------------------------------/
    WIDGET SETTINGS
/-------------------------------*/
    function form($instance) {
        $defaults = array(
                'title'       => 'Twitter',
                'twitter_id'  => '',
                'max_tweets'  => 5,
                'style'       => 'time_since',
                'cons_key'    => '',
                'cons_secret' => '',
                'user_token'  => '',
                'user_secret' => ''
            );
        $instance = wp_parse_args( (array) $instance, $defaults );
        ?>
        
        <p><i><b><?php _e('Note:', 'premitheme');?></b> <?php _e('To get your Consumer Key, Consumer secret, Access token and Access token secret, you need to create a Twitter Application <a href="https://dev.twitter.com/apps" target="_blank">here</a>', 'premitheme');?></i></p>

        <p>
            <label><?php _e('Title', 'premitheme');?>:
                <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
            </label>
        </p>
        
        <p>
            <label><?php _e('Twitter ID (Required)', 'premitheme');?>:
                <input id="<?php echo $this->get_field_id( 'twitter_id' ); ?>" name="<?php echo $this->get_field_name( 'twitter_id' ); ?>" value="<?php echo $instance['twitter_id']; ?>" class="widefat" type="text" />
            </label>
        </p>

        <p>
            <label><?php _e('Consumer key (Required)', 'premitheme');?>:
                <input id="<?php echo $this->get_field_id( 'cons_key' ); ?>" name="<?php echo $this->get_field_name( 'cons_key' ); ?>" value="<?php echo $instance['cons_key']; ?>" class="widefat" type="text" />
            </label>
        </p>

        <p>
            <label><?php _e('Consumer secret (Required)', 'premitheme');?>:
                <input id="<?php echo $this->get_field_id( 'cons_secret' ); ?>" name="<?php echo $this->get_field_name( 'cons_secret' ); ?>" value="<?php echo $instance['cons_secret']; ?>" class="widefat" type="text" />
            </label>
        </p>

        <p>
            <label><?php _e('Access token (Required)', 'premitheme');?>:
                <input id="<?php echo $this->get_field_id( 'user_token' ); ?>" name="<?php echo $this->get_field_name( 'user_token' ); ?>" value="<?php echo $instance['user_token']; ?>" class="widefat" type="text" />
            </label>
        </p>

        <p>
            <label><?php _e('Access token secret (Required)', 'premitheme');?>:
                <input id="<?php echo $this->get_field_id( 'user_secret' ); ?>" name="<?php echo $this->get_field_name( 'user_secret' ); ?>" value="<?php echo $instance['user_secret']; ?>" class="widefat" type="text" />
            </label>
        </p>
        
        <p>
            <label><?php _e('No. of tweets', 'premitheme');?>:
                <input id="<?php echo $this->get_field_id( 'max_tweets' ); ?>" name="<?php echo $this->get_field_name( 'max_tweets' ); ?>" value="<?php echo $instance['max_tweets']; ?>" type="text" size="3" />
            </label>
        </p>

        <p>
            <label><?php _e('Date style', 'premitheme');?>:
                <select class="widefat" id="<?php echo $this->get_field_id( 'style' ); ?>" name="<?php echo $this->get_field_name( 'style' ); ?>">
                    <option value="time_since" <?php selected($instance['style'], 'time_since'); ?>>Relative (ex. 3 minutes ago)</option>
                    <option value="ddmmyy" <?php selected($instance['style'], 'ddmmyy'); ?>>Normal (ex. 06 Nov 2012)</option>
                </select>
            </label>
        </p>
        
        <?php       
    }
}
