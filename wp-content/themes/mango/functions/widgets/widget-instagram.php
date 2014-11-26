<?php

add_action( 'widgets_init', 'pt_instagram_widget' );

function pt_instagram_widget() {
    register_widget( 'Instagram_Widget' );
}


class Instagram_Widget extends WP_Widget {
    
    function Instagram_Widget() {
        global $pt_themename;
        
        $widget_ops = array( 'classname' => 'widget-instagram', 'description' => __('Add Instagram user\'s recent images to the sidebar', 'premitheme') );
        $control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'instagram-widget' ); //default width = 250
        $this->WP_Widget( 'instagram-widget', $pt_themename.' - '.__('Instagram Images', 'premitheme'), $widget_ops, $control_ops );
    }


/*-------------------------------/
    UPDATE & SAVE SETTINGS
/-------------------------------*/
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['client_id'] = strip_tags( $new_instance['client_id'] );
        $instance['user_id'] = strip_tags( $new_instance['user_id'] );
        $instance['max_feeds'] = strip_tags( $new_instance['max_feeds'] );
        
        return $instance;
    }
    
    
/*-------------------------------/
    RENDER WIDGET
/-------------------------------*/
    function widget($args, $instance) {
        extract( $args );

        $title = apply_filters('widget_title', $instance['title'] );
        $client_id = $instance['client_id'];
        $user_id = $instance['user_id'];
        $max_feeds = $instance['max_feeds'];

        echo $before_widget;

        if ( $title ) echo $before_title . $title . $after_title;

        if($client_id && $user_id) {
            $output = '';
            $instagram = pt_instagram_feed("https://api.instagram.com/v1/users/".$user_id."/media/recent/?client_id=".$client_id."&count=".$max_feeds);
            $instagram = json_decode($instagram);
            if( isset($instagram->data) ) {
                $output .= '<div class="instagram-wrapper">';
                foreach ($instagram->data as $post) {
                    $output .= '<div class="instagram-thumb">';
                    $output .= '<a href='.$post->link.' target="_blank">';
                    $output .= '<img src='.$post->images->thumbnail->url.'>';
                    $output .= '</a>';
                    $output .= '</div>';
                }
                $output .= '</div>';
                echo $output;
            } else {
                echo "<p><strong>".__('Error: ', 'premitheme').$instagram->meta->error_message."</strong></p>";
            }
        } else {
            echo "<p><strong>".__('Error: No or wrong user/client ID supplied', 'premitheme')."</strong></p>";
        }

        echo $after_widget;
    }


/*-------------------------------/
    WIDGET SETTINGS
/-------------------------------*/
    function form($instance) {
        $defaults = array( 'title' => 'Instagram', 'user_id' => '', 'max_feeds' => '9' );
        $instance = wp_parse_args( (array) $instance, $defaults );
        ?>

        <p><i><b><?php _e('Note:', 'premitheme');?></b> <?php _e('To get your Client ID, you need to create an Instagram Client <a href="http://instagram.com/developer/clients/manage/" target="_blank">here</a>. Account must be public. Private accounts will not work, obviously.', 'premitheme');?></i></p>

        <p>
            <label><?php _e('Title', 'premitheme');?>:
                <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
            </label>
        </p>

        <p>
            <label><?php _e('Client ID', 'premitheme');?>: <i style="font-size:11px;"><?php _e('Get yours from', 'premitheme');?> <a href="http://instagram.com/developer/clients/manage/" target="_blank"><?php _e('HERE', 'premitheme');?></a></i>
                <input id="<?php echo $this->get_field_id( 'client_id' ); ?>" name="<?php echo $this->get_field_name( 'client_id' ); ?>" value="<?php echo $instance['client_id']; ?>" class="widefat" type="text" />
            </label>
        </p>

        <p>
            <label><?php _e('User ID', 'premitheme');?>: <i style="font-size:11px;"><?php _e('Get yours from', 'premitheme');?> <a href="http://jelled.com/instagram/lookup-user-id" target="_blank"><?php _e('HERE', 'premitheme');?></a></i>
                <input id="<?php echo $this->get_field_id( 'user_id' ); ?>" name="<?php echo $this->get_field_name( 'user_id' ); ?>" value="<?php echo $instance['user_id']; ?>" class="widefat" type="text" />
            </label>
        </p>

        <p>
            <label><?php _e('No. of photos', 'premitheme');?>:
                <select class="widefat" id="<?php echo $this->get_field_id( 'max_feeds' ); ?>" name="<?php echo $this->get_field_name( 'max_feeds' ); ?>">
                    <option value="0" style="font-weight:bold;font-style:italic;"><?php _e('Select Option...', 'premitheme');?></option>
                    <option value="3" <?php selected($instance['max_feeds'], '3'); ?>>3</option>
                    <option value="6" <?php selected($instance['max_feeds'], '6'); ?>>6</option>
                    <option value="9" <?php selected($instance['max_feeds'], '9'); ?>>9</option>
                </select>
            </label>
        </p>

        <?php
    }
}
