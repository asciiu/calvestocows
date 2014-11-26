<?php

add_action( 'widgets_init', 'pt_social_widget' );

function pt_social_widget() {
    register_widget( 'Social_Widget' );
}


class Social_Widget extends WP_Widget {
    
    function Social_Widget() {
        global $pt_themename;
        
        $widget_ops = array( 'classname' => 'widget-social', 'description' => __('Add social links to the sidebar', 'premitheme') );
        $control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'social-widget' ); //default width = 250
        $this->WP_Widget( 'social-widget', $pt_themename.' - '.__('Social Links', 'premitheme'), $widget_ops, $control_ops );
    }


/*-------------------------------/
    UPDATE & SAVE SETTINGS
/-------------------------------*/
    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );

        return $instance;
    }


/*-------------------------------/
    RENDER WIDGET
/-------------------------------*/
    function widget($args, $instance) {
        extract( $args );

        $title = apply_filters('widget_title', $instance['title'] );

        echo $before_widget;
        
        if ( $title ) echo $before_title . $title . $after_title;

        ?>
            <ul class="social-wrapper">
                <?php echo premitheme_social_links("round"); ?>
                <li class="clear"></li>
            </ul>
        <?php

        echo $after_widget;
    }


/*-------------------------------/
    WIDGET SETTINGS
/-------------------------------*/
    function form($instance) {
        $defaults = array( 'title' => 'Social Links' );
        $instance = wp_parse_args( (array) $instance, $defaults );
        ?>

        <p><i><b><?php _e('Note:', 'premitheme');?></b> <?php _e('Set your social settings under (Appearance -> Theme Options -> Social Settings) and it will be used automatically in widget.', 'premitheme');?></i></p>

        <p>
            <label><?php _e('Title', 'premitheme');?>:
                <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
            </label>
        </p>

        <?php
    }
}
