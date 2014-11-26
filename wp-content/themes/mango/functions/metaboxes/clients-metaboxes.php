<?php
/* ADD METABOXS
=====================*/

add_action( 'add_meta_boxes', 'premitheme_clients_metabox' );
function premitheme_clients_metabox() {
    add_meta_box( 'faqs_settings', __('Client Settings', 'premitheme'), 'premitheme_render_clients_metabox', 'clients', 'normal' , 'high' );
}


/* RENDER METABOXS
=====================*/

/* FAQs METABOX */
$pt_clients_metabox_options = array(
    array(
        'id'    => 'client_img',
        'label' => __('Client Logo/Image', 'premitheme'),
        'desc'  => '',
        'std'   => '',
        'note'  => sprintf( __('Minimum image width required is <strong>%s</strong> with no height limitations, BUT make sure to use equal-height client images for clean look. Preferably use PNG images with transparent background for better look. Always use the full absolute URL including "http://"', 'premitheme'), $pt_clientImgWidth),
        'first' => 'first',
        'size' => '',
        'suffix' => '',
        'type'  => 'upload'
    ),
    array(
        'id'    => 'client_img_title',
        'label' => __('Client Logo/Image Title Attribute (optional)', 'premitheme'),
        'desc'  => '',
        'std'   => '',
        'note'  => '',
        'first' => '',
        'size' => '',
        'suffix' => '',
        'type'  => 'text'
    ),
    array(
        'id'    => 'client_img_link',
        'label' => __('Client Logo/Image Link (optional)', 'premitheme'),
        'desc'  => '',
        'std'   => '',
        'note'  => '',
        'first' => '',
        'size' => '',
        'suffix' => '',
        'type'  => 'text'
    )
);

function premitheme_render_clients_metabox( $post ) {
    global $pt_clients_metabox_options;
    wp_nonce_field( 'clients_meta_box_nonce', 'clients-meta-box-nonce' ); 

    premitheme_meta_fields_output($pt_clients_metabox_options);
}


/* SAVE METABOXS
=====================*/

/* FAQs METABOX */
add_action( 'save_post', 'premitheme_save_clients_metabox' );
function premitheme_save_clients_metabox( $post_id )  {  
    global $pt_clients_metabox_options;
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['clients-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['clients-meta-box-nonce'], 'clients_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_posts' ) ) return;  
    
    foreach ($pt_clients_metabox_options as $field) {
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


