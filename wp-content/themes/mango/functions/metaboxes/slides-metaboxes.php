<?php
/* ADD METABOXS
=====================*/

add_action( 'add_meta_boxes', 'premitheme_slider_metabox' );
function premitheme_slider_metabox() {
    add_meta_box( 'nivo_slide_settings', __('Slide Settings', 'premitheme'), 'premitheme_render_slider_metabox', 'slides', 'normal' , 'high' );
}


/* RENDER METABOXS
=====================*/

/* SLIDER METABOX */
global $pt_sliderImgWidth;
$pt_slider_metabox_options = array(
    array(
        'id'    => 'slide_img',
        'label' => __('Slide Image URL', 'premitheme'),
        'desc'  => sprintf( __( 'Image MUSTN\'T be less than <strong>%s width</strong> with no height limitations, but all the slides in a specific slider set will share the same height.', 'premitheme' ), $pt_sliderImgWidth ),
        'std'   => '',
        'note'  => '',
        'first' => 'first',
        'type'  => 'upload'
    ),
    array(
        'id'     => 'slide_link',
        'label'  => __('Slide Link (optional)', 'premitheme'),
        'desc'   => __('Insert a link URL if you want the slide to be hyperliked to somewhere. Always use the full absolute URL including "http://".', 'premitheme'),
        'std'    => '',
        'note'   => '',
        'size'   => '',
        'suffix' => '',
        'first'  => '',
        'type'   => 'text'
    ),
    array(
        'id'    => 'slide_caption_one',
        'label' => __('Slide Caption - First Line (optional)', 'premitheme'),
        'desc'  => __('First line caption text for this slide.', 'premitheme'),
        'std'   => '',
        'note'  => '',
        'first' => '',
        'size'  => '',
        'type'  => 'textarea'
    ),
    array(
        'id'    => 'slide_caption_two',
        'label' => __('Slide Caption - Second Line (optional)', 'premitheme'),
        'desc'  => __('Second line caption text for this slide.', 'premitheme'),
        'std'   => '',
        'note'  => '',
        'first' => '',
        'size'  => '',
        'type'  => 'textarea'
    ),
    array(
        'id' => 'slide_caption_color',
        'label' => __('Caption Color', 'premitheme'),
        'desc' => '',
        'std' => '#ffffff',
        'note' => '',
        'size' => '',
        'first' => '',
        'type' => 'color'
    )
);

function premitheme_render_slider_metabox( $post ) {
    global $pt_slider_metabox_options;
    wp_nonce_field( 'nivo_meta_box_nonce', 'nivo-meta-box-nonce' );

    premitheme_meta_fields_output($pt_slider_metabox_options);
}


/* SAVE METABOXS
=====================*/

/* SLIDER METABOX */
add_action( 'save_post', 'premitheme_slider_metabox_save' );
function premitheme_slider_metabox_save( $post_id )  {
    global $pt_slider_metabox_options;
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['nivo-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['nivo-meta-box-nonce'], 'nivo_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_posts' ) ) return;  
    
    foreach ($pt_slider_metabox_options as $field) {
        if( $field['type'] == 'heading' || $field['type'] == 'sep' ){
            // DO NOTHING
        } elseif( $field['type'] == 'checkbox' ){
            if( isset( $_POST[ $field['id'] ] ) ){
                update_post_meta($post_id, $field['id'], '1');
            } else {
                update_post_meta($post_id, $field['id'], '0');
            }
        } elseif( $field['type'] == 'multi_upload' ){
            if (isset($_POST[ $field['id'] ])){
                $meta_array = $_POST[ $field['id'] ];
                update_post_meta($post_id, $field['id'], $meta_array);
            } else {
                delete_post_meta($post_id, $field['id']);
            }
        } else {
            if( isset( $_POST[ $field['id'] ] ) )
                update_post_meta($post_id, $field['id'], esc_attr( $_POST[ $field['id'] ] )); 
        }
    }
}

