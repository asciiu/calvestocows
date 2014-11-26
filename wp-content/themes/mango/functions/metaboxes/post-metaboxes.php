<?php
/* ADD METABOXS
=====================*/

add_action( 'add_meta_boxes', 'premitheme_post_metabox' );
function premitheme_post_metabox() {
    add_meta_box( 'link_format_settings', __('"Link" Format Settings', 'premitheme'), 'premitheme_render_linkformat_metabox', 'post', 'normal' , 'high' );
    add_meta_box( 'video_format_settings', __('"Video" Format Settings', 'premitheme'), 'premitheme_render_videoformat_metabox', 'post', 'normal' , 'high' );
    add_meta_box( 'audio_format_settings', __('"Audio" Format Settings', 'premitheme'), 'premitheme_render_audioformat_metabox', 'post', 'normal' , 'high' );
    add_meta_box( 'quote_format_settings', __('"Quote" Format Settings', 'premitheme'), 'premitheme_render_quoteformat_metabox', 'post', 'normal' , 'high' );
    add_meta_box( 'gallery_format_settings', __('"Gallery" Format Settings', 'premitheme'), 'premitheme_render_galleryformat_metabox', 'post', 'normal' , 'high' );
    add_meta_box( 'post_bg_settings', __('Custom Fullscreen Background', 'premitheme'), 'premitheme_render_post_bg_metabox', 'post', 'normal' , 'high' );
}


/* RENDER METABOXS
=====================*/

/* LINK POST FORMAT */
$pt_linkformat_metabox_options = array(
    array(
        'id' => 'linkformat_url',
        'label' => __('Link URL', 'premitheme'),
        'desc' => __('Insert the full absolute URL including "http://"', 'premitheme'),
        'std' => '',
        'note' => '',
        'size' => '',
        'suffix' => '',
        'first' => 'first',
        'type' => 'text'
    ),
);

function premitheme_render_linkformat_metabox( $post ) {
    global $pt_linkformat_metabox_options;
    wp_nonce_field( 'link_meta_box_nonce', 'link-meta-box-nonce' ); 
    
    premitheme_meta_fields_output($pt_linkformat_metabox_options);
}


/* VIDEO POST FORMAT */
global $pt_blogVidWidth;
$pt_videoformat_metabox_options = array(
    array(
        'label' => __('Project\'s Remotely-hosted Video', 'premitheme'),
        'first' => 'first',
        'type' => 'heading'
    ),
    array(
        'id' => 'videoformat_embed',
        'label' => __('Remotely-hosted Video Embed Code (Use this instead of the next field below for more controlled video embedding)', 'premitheme'),
        'desc' => sprintf( __( 'Enter the embed code of remotely-hosted video. You <strong>MUST</strong> set video width to <strong>%s</strong>. Overrides the next field. <strong>Tip:</strong> add <code>wmode="transparent"</code> attribute to the iframe of embed code to prevent z-index issue with YouTube videos.', 'premitheme' ), $pt_blogVidWidth ),
        'std' => '',
        'note' => '',
        'size' => '',
        'first' => 'first',
        'type' => 'textarea'
    ),
    array(
        'id' => 'videoformat_url',
        'label' => __('Remotely-hosted Video URL (For easy embed, if not using embed code above)', 'premitheme'),
        'desc' => __('Only remotely-hosted videos supported (i.e. youtube, vimeo &hellip; etc). For Vimeo videos, only videos which support HD mode works fine, otherwise the video will be displayed in smaller size. Always use the full URL including "http://".', 'premitheme').' <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">'.__('List of supported video hosts', 'premitheme').'</a>',
        'std' => '',
        'note' => '',
        'size' => '',
        'suffix' => '',
        'first' => '',
        'type' => 'text'
    ),
    array(
        'label' => __('Project\'s Self-hosted Video', 'premitheme'),
        'first' => '',
        'type' => 'heading'
    ),
    array(
        'id' => 'videoformat_mfourv',
        'label' => __('Self-hosted M4V Video File', 'premitheme'),
        'desc' => __('Required.', 'premitheme'),
        'std' => '',
        'note' => __('Note: Videos could be uploaded to media library, or hosted on external server.', 'premitheme'),
        'first' => 'first',
        'type' => 'upload'
    ),
    array(
        'id' => 'videoformat_ogv',
        'label' => __('Self-hosted OGV/OGG Video File', 'premitheme'),
        'desc' => __('Required, for better browser support.', 'premitheme'),
        'std' => '',
        'note' => '',
        'first' => '',
        'type' => 'upload'
    ),
    array(
        'id' => 'videoformat_poster',
        'label' => __('Self-hosted Video Poster Image', 'premitheme'),
        'desc' => __('Required, it\'s just an image to be shown before playing the video.', 'premitheme'),
        'std' => '',
        'note' => '',
        'first' => '',
        'type' => 'upload'
    ),
    array(
        'id' => 'videoformat_height',
        'label' => __('Self-hosted Video Height', 'premitheme'),
        'desc' => sprintf( __( 'Required, according to <strong>%s</strong> width. Could be decimal number.', 'premitheme' ), $pt_blogVidWidth ),
        'std' => '300',
        'note' => '',
        'size' => 'small',
        'suffix' => __('px', 'premitheme'),
        'first' => '',
        'type' => 'text'
    )
);

function premitheme_render_videoformat_metabox( $post ) {
    global $pt_videoformat_metabox_options;
    wp_nonce_field( 'video_meta_box_nonce', 'video-meta-box-nonce' ); 
    
    premitheme_meta_fields_output($pt_videoformat_metabox_options);
}


/* AUDIO POST FORMAT */
$pt_audioformat_metabox_options = array(
    array(
        'id' => 'audioformat_mpthree',
        'label' => __('Self-hosted MP3 Audio File', 'premitheme'),
        'desc' => __('Required.', 'premitheme'),
        'std' => '',
        'note' => '',
        'first' => 'first',
        'type' => 'upload'
    ),
    array(
        'id' => 'audioformat_oga',
        'label' => __('SSelf-hosted OGA/OGG Audio File', 'premitheme'),
        'desc' => __('Required, for better browser support.', 'premitheme'),
        'std' => '',
        'note' => '',
        'first' => '',
        'type' => 'upload'
    )
);

function premitheme_render_audioformat_metabox( $post ) {
    global $pt_audioformat_metabox_options;
    wp_nonce_field( 'audio_meta_box_nonce', 'audio-meta-box-nonce' ); 

    premitheme_meta_fields_output($pt_audioformat_metabox_options);
}


/* QUOTE POST FORMAT */
$pt_quoteformat_metabox_options = array(
    array(
        'id' => 'quoteformat_text',
        'label' => __('Quote Text', 'premitheme'),
        'desc' => __('Insert the quote text here.', 'premitheme'),
        'std' => '',
        'note' => '',
        'first' => 'first',
        'size' => '',
        'type' => 'textarea'
    ),
    array(
        'id' => 'quoteformat_author',
        'label' => __('Quote Author\'s Name', 'premitheme'),
        'desc' => __('Insert the quote author\'s name here.', 'premitheme'),
        'std' => '',
        'note' => '',
        'size' => '',
        'suffix' => '',
        'first' => '',
        'type' => 'text'
    )
);

function premitheme_render_quoteformat_metabox( $post ) {
    global $pt_quoteformat_metabox_options;
    wp_nonce_field( 'quote_meta_box_nonce', 'quote-meta-box-nonce' ); 

    premitheme_meta_fields_output($pt_quoteformat_metabox_options);
}


/* GALLERY POST FORMAT */
$pt_galleryformat_metabox_options = array(
    array(
        'id' => 'galleryformat_imgs',
        'label' => __('Gallery Slides', 'premitheme'),
        'desc' => sprintf( __( "All images <strong>MUST NOT</strong> be less than <strong>%s width</strong>. There's no max/min height.", "premitheme" ), $pt_blogVidWidth ),
        'std' => '',
        'note' => __('IMPORTANT: Images must be uploaded to media library, external images are not allowed for security purposes.', 'premitheme'),
        'first' => 'first',
        'type' => 'multi_upload'
    ),
    array(
        'id' => 'galleryformat_imgs_height',
        'label' => __('Gallery Slider Height', 'premitheme'),
        'desc' => __('Gallery slider height is a <strong>required</strong>.', 'premitheme'),
        'std' => '300',
        'note' => '',
        'size' => 'small',
        'suffix' => __('px', 'premitheme'),
        'first' => '',
        'type' => 'text'
    ),
    array(
        'id' => 'galleryformat_imgs_nav',
        'label' => __('Gallery Slider Pagination', 'premitheme'),
        'desc' => __('Slider pagination type.', 'premitheme'),
        'std' => '',
        'note' => '',
        'size' => '',
        'suffix' => '',
        'first' => '',
        'type'    => 'select',
        'options' => array(
                'normal' => __('Normal pagination', 'premitheme'),
                'thumbnails' => __('Thumbnails', 'premitheme')
            )
    ),
    array(
        'id' => 'galleryformat_imgs_effect',
        'label' => __('Gallery Slider Animation Effect', 'premitheme'),
        'desc' => __('Choose between "slide" or " fade" slider animation effect.', 'premitheme'),
        'std' => '',
        'note' => '',
        'size' => '',
        'suffix' => '',
        'first' => '',
        'type'    => 'select',
        'options' => array(
                'slide' => __('Slide effect', 'premitheme'),
                'fade' => __('Fade effect', 'premitheme')
            )
    )
);

function premitheme_render_galleryformat_metabox( $post ) {
    global $pt_galleryformat_metabox_options;
    wp_nonce_field( 'gallery_meta_box_nonce', 'gallery-meta-box-nonce' );

    premitheme_meta_fields_output($pt_galleryformat_metabox_options);
}


/* BG IMAGE METABOX */
$pt_post_bg_metabox_options = array(
    array(
        'id' => 'singular_bg_img',
        'label' => __('Custom Fullscreen Background Image', 'premitheme'),
        'desc' => __('Specify an image to be used as fullscreen background for this blog post.', 'premitheme'),
        'std' => '',
        'note' => __('These settings override the global background settings in the theme options panel under "Branding Settings" tab for this page only.', 'premitheme'),
        'first' => 'first',
        'type' => 'upload'
    ),
    array(
        'id' => 'singular_bg_color',
        'label' => __('Custom Background Color', 'premitheme'),
        'desc' => '',
        'std' => '',
        'note' => '',
        'first' => '',
        'type' => 'color'
    ),
    array(
        'id' => 'singular_on_bg_color',
        'label' => __('Custom On-background Text Color', 'premitheme'),
        'desc' => '',
        'std' => '',
        'note' => '',
        'first' => '',
        'type' => 'color'
    ),
    array(
        'id' => 'singular_bg_overlay',
        'label' => __('Use Background Overlay Texture', 'premitheme'),
        'desc' => __("Helps masking image quality degradation on big displays and looks stylish as well. Turn off if you don't like it.", 'premitheme'),
        'std' => '1',
        'note' => '',
        'first' => '',
        'type' => 'checkbox'
    )
);

function premitheme_render_post_bg_metabox( $post ) {
    global $pt_post_bg_metabox_options;
    wp_nonce_field( 'post_bg_meta_box_nonce', 'post-bg-meta-box-nonce' );

    premitheme_meta_fields_output($pt_post_bg_metabox_options);
}



/* SAVE METABOXS
=====================*/

/* LINK POST FORMAT */
add_action( 'save_post', 'premitheme_save_linkformat_metabox' );
function premitheme_save_linkformat_metabox( $post_id )  {
    global $pt_linkformat_metabox_options;
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['link-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['link-meta-box-nonce'], 'link_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_posts' ) ) return;  
    
    foreach ($pt_linkformat_metabox_options as $field) {
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


/* VIDEO POST FORMAT */
add_action( 'save_post', 'premitheme_save_videoformat_metabox' );
function premitheme_save_videoformat_metabox( $post_id )  {
    global $pt_videoformat_metabox_options;
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['video-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['video-meta-box-nonce'], 'video_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_posts' ) ) return;  
    
    foreach ($pt_videoformat_metabox_options as $field) {
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


/* AUDIO POST FORMAT */
add_action( 'save_post', 'premitheme_save_audioformat_metabox' );
function premitheme_save_audioformat_metabox( $post_id )  {
    global $pt_audioformat_metabox_options;
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['audio-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['audio-meta-box-nonce'], 'audio_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_posts' ) ) return;  
    
    foreach ($pt_audioformat_metabox_options as $field) {
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


/* QUOTE POST FORMAT */
add_action( 'save_post', 'premitheme_save_quoteformat_metabox' );
function premitheme_save_quoteformat_metabox( $post_id )  {
    global $pt_quoteformat_metabox_options;
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['quote-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['quote-meta-box-nonce'], 'quote_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_posts' ) ) return;  
    
    foreach ($pt_quoteformat_metabox_options as $field) {
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


/* GALLERY POST FORMAT */
add_action( 'save_post', 'premitheme_save_galleryformat_metabox' );
function premitheme_save_galleryformat_metabox( $post_id )  {
    global $pt_galleryformat_metabox_options;
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['gallery-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['gallery-meta-box-nonce'], 'gallery_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_posts' ) ) return;  
    
    foreach ($pt_galleryformat_metabox_options as $field) {
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


/* BG IMAGE SAVE */
add_action( 'save_post', 'premitheme_save_post_bg_metabox' );
function premitheme_save_post_bg_metabox( $post_id )  {
    global $pt_post_bg_metabox_options;
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['post-bg-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['post-bg-meta-box-nonce'], 'post_bg_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_posts' ) ) return;  
    
    foreach ($pt_post_bg_metabox_options as $field) {
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