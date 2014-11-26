<?php

add_action( 'widgets_init', 'pt_contact_widget' );

function pt_contact_widget() {
    register_widget( 'Contact_Widget' );
}


class Contact_Widget extends WP_Widget {
    
    function Contact_Widget() {
        global $pt_themename;
        
        $widget_ops = array( 'classname' => 'widget-contact', 'description' => __('Add contact information to the sidebar', 'premitheme') );
        $control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'contact-widget' ); //default width = 250
        $this->WP_Widget( 'contact-widget', $pt_themename.' - '.__('Contact Info', 'premitheme'), $widget_ops, $control_ops );
    }


/*-------------------------------/
    UPDATE & SAVE SETTINGS
/-------------------------------*/
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['contact_address'] = htmlspecialchars_decode( $new_instance['contact_address'] );
        $instance['contact_phone'] = htmlspecialchars_decode( $new_instance['contact_phone'] );

        return $instance;
    }
    
    
/*-------------------------------/
    RENDER WIDGET
/-------------------------------*/
    function widget($args, $instance) {
        extract( $args );

        $title = apply_filters('widget_title', $instance['title'] );
        $contact_address = nl2br($instance['contact_address']);
        $contact_phone = nl2br($instance['contact_phone']);

        echo $before_widget;

        if ( $title ) echo $before_title . $title . $after_title;

        ?>
            <ul>
                <?php
                if ($contact_address)
                    echo '<li class="widget-address"><p>'.$contact_address.'</p></li>';

                if ($contact_phone)
                    echo '<li class="widget-phone"><p>'.$contact_phone.'</p></li>';
                ?>
            </ul>
        <?php

        echo $after_widget;
    }


/*-------------------------------/
    WIDGET SETTINGS
/-------------------------------*/
    function form($instance) {
        $defaults = array( 'title' => 'Contact Info', 'contact_address' => '', 'contact_phone' => '');
        $instance = wp_parse_args( (array) $instance, $defaults );
        ?>

        <p>
            <label><?php _e('Title', 'premitheme');?>:
                <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
            </label>
        </p>

        <p>
            <label><?php _e('Contact Address(es)', 'premitheme');?>:
                <textarea id="<?php echo $this->get_field_id( 'contact_address' ); ?>" name="<?php echo $this->get_field_name( 'contact_address' ); ?>" class="widefat" rows="4" cols="20"><?php echo $instance['contact_address']; ?></textarea>
            </label>
        </p>

        <p>
            <label><?php _e('Contact Phone(s)/Fax(s)', 'premitheme');?>:
                <textarea id="<?php echo $this->get_field_id( 'contact_phone' ); ?>" name="<?php echo $this->get_field_name( 'contact_phone' ); ?>" class="widefat" rows="4" cols="20"><?php echo $instance['contact_phone']; ?></textarea>
            </label>
        </p>

        <?php
    }
}
