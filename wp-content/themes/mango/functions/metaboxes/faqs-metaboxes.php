<?php
/* ADD METABOXS
=====================*/

add_action( 'add_meta_boxes', 'premitheme_faqs_metabox' );
function premitheme_faqs_metabox() {
    add_meta_box( 'faqs_settings', __('FAQ Settings', 'premitheme'), 'premitheme_render_faqs_metabox', 'faqs', 'normal' , 'high' );
}


/* RENDER METABOXS
=====================*/

/* FAQs METABOX */
$pt_faqs_metabox_options = array(
    array(
        'id'    => 'faqanswer',
        'label' => __('FAQ Answer', 'premitheme'),
        'desc'  => __('Enter FAQ answer here.', 'premitheme'),
        'std'   => '',
        'note'  => '',
        'first' => 'first',
        'type'  => 'editor'
    )
);

function premitheme_render_faqs_metabox( $post ) {
    global $pt_faqs_metabox_options;
    wp_nonce_field( 'faqs_meta_box_nonce', 'faqs-meta-box-nonce' ); 

    premitheme_meta_fields_output($pt_faqs_metabox_options);
}


/* SAVE METABOXS
=====================*/

/* FAQs METABOX */
add_action( 'save_post', 'premitheme_save_faqs_metabox' );
function premitheme_save_faqs_metabox( $post_id )  {  
    global $pt_faqs_metabox_options;
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['faqs-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['faqs-meta-box-nonce'], 'faqs_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_posts' ) ) return;  
    
    foreach ($pt_faqs_metabox_options as $field) {
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


