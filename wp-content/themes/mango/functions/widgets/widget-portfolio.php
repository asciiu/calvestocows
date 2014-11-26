<?php

add_action( 'widgets_init', 'pt_portfolio_widget' );
function pt_portfolio_widget() {
    register_widget( 'Portfolio_Widget' );
}

class Portfolio_Widget extends WP_Widget {
    function Portfolio_Widget() {
        global $pt_themename;

        $widget_ops = array( 'classname' => 'widget-portfolio', 'description' => __('Show your recent work', 'premitheme') );
        $control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'portfolio-widget' ); //default width = 250
        $this->WP_Widget( 'portfolio-widget', $pt_themename.' - '.__('Recent Work (Portfolio)', 'premitheme'), $widget_ops, $control_ops );
    }


/*-------------------------------/
    UPDATE & SAVE SETTINGS
/-------------------------------*/
    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['category'] = strip_tags( $new_instance['category'] );
        $instance['orderby'] = strip_tags( $new_instance['orderby'] );
        $instance['order'] = strip_tags( $new_instance['order'] );
        $instance['open_in'] = strip_tags( $new_instance['open_in'] );
        $instance['count'] = strip_tags( $new_instance['count'] );

        return $instance;
    }


/*-------------------------------/
    RENDER WIDGET
/-------------------------------*/
    function widget($args, $instance) {
        extract( $args );

        $title = apply_filters('widget_title', $instance['title'] );
        $category = $instance['category'];
        $orderby = $instance['orderby'];
        $order = $instance['order'];
        $open_in = $instance['open_in'];
        $count = $instance['count'];

        echo $before_widget;
        if ( $title ) echo $before_title . $title . $after_title;

        ?>
            <div class="flexslider flexslider-folio-wid">
                <ul class="slides">
                    <?php
                    global $post;
                    $tmp_post = $post;

                    if($count == '') $count = '-1';

                    if($category != 'all'):
                        $args = array(
                            'posts_per_page' => $count,
                            'order'          => $order,
                            'orderby'        => $orderby,
                            'post_type' => 'portfolio',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'portfolio_cats',
                                    'field' => 'id',
                                    'terms' => array($category),
                                    'operator' => 'IN'
                                )
                            )
                        );
                    else:
                        $args = array(
                            'posts_per_page' => $count,
                            'order'          => $order,
                            'orderby'        => $orderby,
                            'post_type' => 'portfolio'
                        );
                    endif;

                    $myposts = get_posts($args);

                    foreach( $myposts as $post ):
                        setup_postdata($post);

                        $imgAtt = array( 'title' => trim(strip_tags( $post->post_title )) ); 

                        $folio_cats =  get_the_terms( get_the_ID(), 'portfolio_cats' );
                        $cat_name = '';
                        $cats_names = array();
                        if( !empty($folio_cats) ):
                            foreach( $folio_cats as $folio_cat ):
                                $cats_names[] = $folio_cat->name;
                            endforeach; 
                            $cat_name = join( ', ', $cats_names );
                        endif;
                    
                        $attachments = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
                        $thumbSrc = $attachments[0];
                    
                        if( $open_in == 'lightbox' ){
                            $link = $thumbSrc;
                        } else {
                            $link = get_permalink();
                        }
                        ?>
                            <li class="folio-wid-wrapper">
                                <a <?php if( $open_in == 'lightbox' ) echo 'rel="prettyPhoto[wid-folio-items]"';?> href="<?php echo $link; ?>" title="<?php the_title(); ?>">
                                    <div class="folio-wid-thumb">
                                        <?php if( has_post_thumbnail() ):
                                            $src = $thumbSrc;
                                            $image = premitheme_image( '', $src, premitheme_img_size('folio-wid-thumb'));
                                        ?>
                                            <img src="<?php echo $image[0]; ?>" alt="" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" title="<?php the_title_attribute(); ?>"/>
                                        <?php else: ?>
                                            <img src="<?php echo get_template_directory_uri();?>/images/no-image/392x270.jpg" alt="No Image"/>
                                        <?php endif;?>
                                    </div>
                                    
                                    <div class="folio-wid-overlay">
                                        <h6 title="<?php the_title_attribute(); ?>"><?php the_title(); ?></h6>
                                        <span><?php echo $cat_name; ?></span>
                                    </div>
                                </a>
                            </li>
                        <?php 
                    endforeach;
                    $post = $tmp_post;
                    ?>
                </ul>
            </div>
        <?php echo $after_widget;
    }
    
    
/*-------------------------------/
    WIDGET SETTINGS
/-------------------------------*/
    function form($instance) {
        $defaults = array( 'title' => 'Recent Work', 'category' => 'all','open_in' => 'page', 'count' => '5');
        $instance = wp_parse_args( (array) $instance, $defaults );
        
        $folioCats = get_categories('taxonomy=portfolio_cats');
        
        ?>
        
        <p>
            <label><?php _e('Title', 'premitheme');?>:
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
            </label>
        </p>
        
        <p>
            <label><?php _e('Portfolio Category', 'premitheme');?>:
            <select class="widefat" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>">
            <option value="all" <?php selected( 'all', $instance['category'] ); ?>><?php _e('Show all', 'premitheme');?></option>
            <?php foreach ( $folioCats as $folio_cat ): ?>
             <option value="<?php echo $folio_cat->cat_ID; ?>" <?php selected( $folio_cat->cat_ID, $instance['category'] ); ?>><?php echo $folio_cat->cat_name; ?></option>
          <?php endforeach; ?>
            </select>
            </label>
        </p>

        <p>
            <label><?php _e('Items Order By', 'premitheme');?>:
            <select class="widefat" id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>">
                <option value="date" <?php selected( 'date', $instance['orderby'] ); ?>><?php _e('Item\'s creation date', 'premitheme');?></option>
                <option value="menu_order" <?php selected( 'menu_order', $instance['orderby'] ); ?>><?php _e('Custom order', 'premitheme');?></option>
                <option value="rand" <?php selected( 'rand', $instance['orderby'] ); ?>><?php _e('Random', 'premitheme');?></option>
            </select>
            </label>
        </p>
        
        <p>
            <label><?php _e('Items Order', 'premitheme');?>:
            <select class="widefat" id="<?php echo $this->get_field_id( 'order' ); ?>" name="<?php echo $this->get_field_name( 'order' ); ?>">
                <option value="DESC" <?php selected( 'DESC', $instance['order'] ); ?>><?php _e('Descending', 'premitheme');?></option>
                <option value="ASC" <?php selected( 'ASC', $instance['order'] ); ?>><?php _e('Ascending', 'premitheme');?></option>
            </select>
            </label>
        </p>
        
        <p>
            <label><?php _e('Open in ...', 'premitheme');?>:
            <select class="widefat" id="<?php echo $this->get_field_id( 'open_in' ); ?>" name="<?php echo $this->get_field_name( 'open_in' ); ?>">
                <option value="page" <?php selected( 'page', $instance['open_in'] ); ?>><?php _e('Separate Page', 'premitheme');?></option>
                <option value="lightbox" <?php selected( 'lightbox', $instance['open_in'] ); ?>><?php _e('Lightbox', 'premitheme');?></option>
            </select>
            </label>
        </p>
        
        <p>
            <label><?php _e('No. of items (leave empty to show all)', 'premitheme');?>:
            <input id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $instance['count']; ?>" type="text" size="3"/>
            </label>
        </p>
        
        <?php       
    }
}
