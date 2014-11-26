<?php
add_action('admin_enqueue_scripts', 'premitheme_admin_styles');
add_action('admin_enqueue_scripts', 'premitheme_admin_scripts');

function premitheme_admin_styles($hook) {
    if( $hook == 'post.php' || $hook == 'post-new.php' ){
        wp_register_style('metaboxes', PT_FUNCTIONS.'/css/metaboxes_styles.css');
        wp_register_style('awesome', get_template_directory_uri() . '/css/font-awesome.css' );

        wp_enqueue_style('wp-color-picker');
        wp_enqueue_style('metaboxes');
        wp_enqueue_style( 'awesome' );
    }
}

function premitheme_admin_scripts($hook) {
    if( $hook == 'post.php' || $hook == 'post-new.php' ){
        wp_register_script('my-upload', PT_FUNCTIONS.'/js/my_upload.js', array('jquery'));
        wp_register_script('metaboxes', PT_FUNCTIONS.'/js/metaboxes_scripts.js', array('jquery'));

        wp_localize_script( 'my-upload', 'pt_trans_media', array(
                'title'     => __( 'Upload or Choose Your File', 'premitheme' ),
                'button'    => __( 'Use This File', 'premitheme' )
            )
        );

        if( !did_action('wp_enqueue_media') ){
            wp_enqueue_media();
        }

        wp_enqueue_script('my-upload');
        wp_enqueue_script('wp-color-picker');
        wp_enqueue_script('metaboxes');
    }
}