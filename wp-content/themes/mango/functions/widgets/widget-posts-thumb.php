<?php

add_action( 'widgets_init', 'pt_posts_thumb_widget' );

function pt_posts_thumb_widget() {
    register_widget( 'Posts_Widget' );
}


class Posts_Widget extends WP_Widget {
    
    function Posts_Widget() {
        global $pt_themename;
        
        $widget_ops = array( 'classname' => 'widget-posts-thumbs', 'description' => __('Recent/Most commented posts with thumbnails', 'premitheme') );
        $control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'posts-widget' ); //default width = 250
        $this->WP_Widget( 'posts-widget', $pt_themename.' - '.__('Posts with Thumbnails', 'premitheme'), $widget_ops, $control_ops );
    }


/*-------------------------------/
    UPDATE & SAVE SETTINGS
/-------------------------------*/
    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['type'] = strip_tags( $new_instance['type'] );
        $instance['count'] = strip_tags( $new_instance['count'] );

        return $instance;
    }


/*-------------------------------/
    RENDER WIDGET
/-------------------------------*/
    function widget($args, $instance) {
        extract( $args );

        $title = apply_filters('widget_title', $instance['title'] );
        $type = $instance['type'];
        $count = $instance['count'];
        
        echo $before_widget;
        if ( $title ) echo $before_title . $title . $after_title;
        ?>
            <ul>
                <?php
                global $post;
                $tmp_post = $post;
                
                if( $type == 'recent' ):
                    $myposts = get_posts('numberposts='.$count.'&order=DESC&orderby=post_date');
                elseif( $type == 'popular' ):   
                    $myposts = get_posts('numberposts='.$count.'&order=DESC&orderby=comment_count');
                endif;
                
                foreach( $myposts as $post ) : setup_postdata($post);
                ?>
                    <li>
                        <a href="<?php the_permalink();?>" class="clearfix">
                            <?php if( get_post_format() == 'status' ): ?>
                                <div class="wid-thumb"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 50); ?></div>
                            <?php elseif( has_post_thumbnail() ):
                                $image = premitheme_image( $post->ID, '', premitheme_img_size('post-wid-thumb'));
                            ?>
                                <div class="wid-thumb"><img src="<?php echo $image[0]; ?>" alt="" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" title="<?php the_title_attribute(); ?>"/></div>
                            <?php else: ?>
                                <div class="wid-thumb"><img src="<?php echo get_template_directory_uri();?>/images/no-image/50x50.jpg" alt="No Image"/></div>
                            <?php endif; ?>

                            <h2 title="<?php the_title_attribute(); ?>"><?php echo premitheme_truncate_text( get_the_title(), 5, true); ?></h2>

                            <?php if ( comments_open() ): ?>
                                <div class="wid-post-meta"><?php echo get_the_date('d M');?> / <?php comments_number( __('0 comments', 'premitheme'), __('1 comment', 'premitheme'), __('% comments', 'premitheme') ); ?></div>
                            <?php else: ?>
                                <div class="wid-post-meta"><?php echo get_the_date('d M');?> / <?php _e('comments off', 'premitheme');?></div>
                            <?php endif; ?>
                        </a>
                    </li>
                <?php 
                endforeach;
                $post = $tmp_post; ?>
            </ul>
        <?php echo $after_widget;
    }
    
    
/*-------------------------------/
    WIDGET SETTINGS
/-------------------------------*/
    function form($instance) {
        $defaults = array( 'title' => '', 'type' => 'recent', 'count' => '3');
        $instance = wp_parse_args( (array) $instance, $defaults );
        ?>

        <p>
            <label><?php _e('Title', 'premitheme');?>:
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
            </label>
        </p>

        <p>
            <label><?php _e('Posts to show', 'premitheme');?>:
            <select class="widefat" id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>">
            <option value="recent" <?php selected($instance['type'], 'recent'); ?>><?php _e('Recent posts', 'premitheme');?></option>
            <option value="popular" <?php selected($instance['type'], 'popular'); ?>><?php _e('Most commented posts', 'premitheme');?></option>
            </select>
            </label>
        </p>

        <p>
            <label><?php _e('No. of posts', 'premitheme');?>:
            <input id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $instance['count']; ?>" type="text" size="3"/>
            </label>
        </p>

        <?php
    }
}
