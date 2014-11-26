<?php
/* ADD METABOXS
=====================*/

add_action( 'add_meta_boxes', 'premitheme_portfolio_metabox' );
function premitheme_portfolio_metabox() {
    add_meta_box( 'portfolio_item_settengs', __('Portfolio Item Settings', 'premitheme'), 'premitheme_render_portfolio_metabox', 'portfolio', 'normal', 'high' );
    add_meta_box( 'portfolio_bg_settings', __('Custom Fullscreen Background', 'premitheme'), 'premitheme_render_portfolio_bg_metabox', 'portfolio', 'normal', 'high' );
}


/* RENDER METABOXS
=====================*/

/* PORTFOLIO ITEM METABOX */
global $pt_folioImgWidth;

$pages_array = array();  
$pages_array_obj = get_pages('sort_column=post_parent,menu_order');
$pages_array[''] = __('&mdash; Use the global setting in theme options panel &mdash;', 'premitheme');
foreach ($pages_array_obj as $page) {
    $pages_array[$page->ID] = $page->post_title;
}

$pt_portfolio_metabox_options = array(
    array(
        'label' => __('Project\'s General Settings', 'premitheme'),
        'first' => 'first',
        'type'  => 'heading'
    ),
    array(
        'id'      => 'folio_parent',
        'label'   => __('Item\'s Portfolio Parent Page', 'premitheme'),
        'desc'    => __('Use this to override the global "Portfolio Patent Page" setting in the theme options panel when needed. Useful when you\'re using multiple portfolio parent pages for different portfolio categories.', 'premitheme'),
        'std'     => '',
        'note'    => '',
        'size'    => '',
        'first'   => 'first',
        'type'    => 'select',
        'options' => $pages_array
    ),
    array(
        'id'      => 'folio_item_layout',
        'label'   => __('Item\'s Page Layout', 'premitheme'),
        'desc'    => __('Choose between 2 columns of full-width page layout.', 'premitheme'),
        'std'     => '',
        'note'    => '',
        'size'    => 'medium',
        'first'   => '',
        'type'    => 'select',
        'options' => array(
                '2col' => __('2 columns', 'premitheme'),
                'fullwidth' => __('Full-width', 'premitheme')
            )
    ),
    array(
        'id'      => 'folio_item_thumb',
        'label'   => __('Item\'s Thumbnail Lightbox Content', 'premitheme'),
        'desc'    => __('When using both preview images and video together, choose which to use in the item\'s thumbnail lightbox in the parent page (when using lightbox option in the parent portfolio page). The video option supports ONLY remotely-hosted videos.', 'premitheme'),
        'std'     => '',
        'note'    => '',
        'size'    => 'medium',
        'first'   => '',
        'type'    => 'select',
        'options' => array(
                'image' => __('Image', 'premitheme'),
                'video' => __('Video', 'premitheme')
            )
    ),
    array(
        'label' => __('Project\'s Completion Date', 'premitheme'),
        'first' => '',
        'type'  => 'heading'
    ),
    array(
        'id'     => 'folio_date',
        'label'  => __('Completion Date', 'premitheme'),
        'desc'   => __('e.g. "Sep 2011". Used for visual presentation only and has no effect on items\' order. You can leave it empty if you want.', 'premitheme'),
        'std'    => '',
        'note'   => '',
        'size'   => 'medium',
        'suffix' => '',
        'first'  => 'first',
        'type'   => 'text'
    ),
    array(
        'label' => __('Client Information', 'premitheme'),
        'first' => '',
        'type'  => 'heading'
    ),
    array(
        'id'     => 'folio_client_label',
        'label'  => __('Client Label', 'premitheme'),
        'desc'   => '',
        'std'    => __('Client', 'premitheme'),
        'note'   => '',
        'size'   => 'medium',
        'suffix' => '',
        'first'  => 'first',
        'type'   => 'text'
    ),
    array(
        'id'     => 'folio_client_name',
        'label'  => __('Client Name', 'premitheme'),
        'desc'   => '',
        'std'    => '',
        'note'   => '',
        'size'   => 'medium',
        'suffix' => '',
        'first'  => '',
        'type'   => 'text'
    ),
    array(
        'label' => __('Project\'s Skills Settings', 'premitheme'),
        'first' => '',
        'type'  => 'heading'
    ),
    array(
        'id'     => 'folio_skills_label',
        'label'  => __('Skills Label', 'premitheme'),
        'desc'   => '',
        'std'    => __('Skills', 'premitheme'),
        'note'   => '',
        'size'   => 'medium',
        'suffix' => '',
        'first'  => 'first',
        'type'   => 'text'
    ),
    array(
        'id'      => 'folio_skills_type',
        'label'   => __('Skills List Type', 'premitheme'),
        'desc'    => __('Show skills list as links or plain text.', 'premitheme'),
        'std'     => '',
        'note'    => '',
        'size'    => 'medium',
        'first'   => '',
        'type'    => 'select',
        'options' => array(
                'links' => __('Links', 'premitheme'),
                'text' => __('Plain text', 'premitheme')
            )
    ),
    array(
        'label' => __('Project\'s Live Button Settings', 'premitheme'),
        'first' => '',
        'type'  => 'heading'
    ),
    array(
        'id'     => 'folio_project_btn_text',
        'label'  => __('Project Button\'s Text', 'premitheme'),
        'desc'   => '',
        'std'    => __('Visit Website', 'premitheme'),
        'note'   => '',
        'size'   => 'medium',
        'suffix' => '',
        'first'  => 'first',
        'type'   => 'text'
    ),
    array(
        'id'     => 'folio_project_btn_url',
        'label'  => __('Project URL (if applicable)', 'premitheme'),
        'desc'   => '',
        'std'    => '',
        'note'   => '',
        'size'   => '',
        'suffix' => '',
        'first'  => '',
        'type'   => 'text'
    ),
    array(
        'label' => __('Project\'s Preview Image(s)', 'premitheme'),
        'first' => '',
        'type'  => 'heading'
    ),
    array(
        'id'    => 'folio_preview_imgs',
        'label' => __('Project\'s Preview Image(s)', 'premitheme'),
        'desc'  => sprintf( __( "All images <strong>MUST NOT</strong> be less than <strong>%s</strong>. There's no max/min height.", "premitheme" ), $pt_folioImgWidth ),
        'std'   => '',
        'note'  => __('IMPORTANT: Images must be uploaded to media library, external images are not allowed for security purposes.', 'premitheme'),
        'first' => 'first',
        'type'  => 'multi_upload'
    ),
    array(
        'id'      => 'folio_preview_imgs_type',
        'label'   => __('Preview Image(s) Type', 'premitheme'),
        'desc'    => __('Show preview image(s) as slider or list of images.', 'premitheme'),
        'std'     => '',
        'note'    => '',
        'size'    => 'medium',
        'first'   => '',
        'type'    => 'select',
        'options' => array(
                'slider' => __('Slider', 'premitheme'),
                'list' => __('Images list', 'premitheme')
            )
    ),
    array(
        'id'     => 'folio_preview_imgs_height',
        'label'  => __('Slider Height', 'premitheme'),
        'desc'   => __('<strong>Required</strong> when using preview images slider.', 'premitheme'),
        'std'    => '300',
        'note'   => '',
        'size'   => 'small',
        'suffix' => __('px', 'premitheme'),
        'first'  => '',
        'type'   => 'text'
    ),
    array(
        'id'      => 'folio_preview_imgs_nav',
        'label'   => __('Slider Pagination', 'premitheme'),
        'desc'    => __('Choose slider pagination type.', 'premitheme'),
        'std'     => '',
        'note'    => '',
        'size'    => 'medium',
        'first'   => '',
        'type'    => 'select',
        'options' => array(
                'normal' => __('Normal pagination', 'premitheme'),
                'thumbnails' => __('Thumbnails', 'premitheme')
            )
    ),
    array(
        'id'      => 'folio_preview_imgs_effect',
        'label'   => __('Slider Animation effect', 'premitheme'),
        'desc'    => __('Choose slider animation effect.', 'premitheme'),
        'std'     => '',
        'note'    => '',
        'size'    => 'medium',
        'first'   => '',
        'type'    => 'select',
        'options' => array(
                'slide' => __('Slide effect', 'premitheme'),
                'fade' => __('Fade effect', 'premitheme')
            )
    ),
    array(
        'label' => __('Project\'s Remotely-hosted Video', 'premitheme'),
        'first' => '',
        'type'  => 'heading'
    ),
    array(
        'id'    => 'folio_video_embed',
        'label' => __('Remotely-hosted Video Embed Code (Use this instead of the next field below for more controlled video embedding)', 'premitheme'),
        'desc'  => sprintf( __( 'Enter the embed code of remotely-hosted video. You <strong>MUST</strong> set video width to <strong>%s</strong>. Overrides the next field. <strong>Tip:</strong> add <code>wmode="transparent"</code> attribute to the iframe of embed code to prevent z-index issue with YouTube videos.', 'premitheme' ), $pt_folioImgWidth ),
        'std'   => '',
        'note'  => '',
        'size'  => '',
        'first' => 'first',
        'type'  => 'textarea'
    ),
    array(
        'id'     => 'folio_video_url',
        'label'  => __('Remotely-hosted Video URL (For easy embed, if not using embed code above)', 'premitheme'),
        'desc'   => __('Only remotely-hosted videos supported (i.e. youtube, vimeo &hellip; etc). For Vimeo videos, only videos which support HD mode works fine, otherwise the video will be displayed in smaller size. Always use the full URL including "http://".', 'premitheme').' <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">'.__('List of supported video hosts', 'premitheme').'</a>',
        'std'    => '',
        'note'   => '',
        'size'   => '',
        'suffix' => '',
        'first'  => '',
        'type'   => 'text'
    ),
    array(
        'label' => __('Project\'s Self-hosted Video', 'premitheme'),
        'first' => '',
        'type'  => 'heading'
    ),
    array(
        'id'    => 'folio_video_mfourv',
        'label' => __('Self-hosted M4V Video File', 'premitheme'),
        'desc'  => __('Required.', 'premitheme'),
        'std'   => '',
        'note'  => __('Note: Videos could be uploaded to media library, or hosted on external server.', 'premitheme'),
        'first' => 'first',
        'type'  => 'upload'
    ),
    array(
        'id'    => 'folio_video_ogv',
        'label' => __('Self-hosted OGV/OGG Video File', 'premitheme'),
        'desc'  => __('Required, for better browser support.', 'premitheme'),
        'std'   => '',
        'note'  => '',
        'first' => '',
        'type'  => 'upload'
    ),
    array(
        'id'    => 'folio_video_poster',
        'label' => __('Self-hosted Video Poster Image', 'premitheme'),
        'desc'  => __('Required, it\'s just an image to be shown before playing the video.', 'premitheme'),
        'std'   => '',
        'note'  => '',
        'first' => '',
        'type'  => 'upload'
    ),
    array(
        'id'     => 'folio_video_height',
        'label'  => __('Self-hosted Video Height', 'premitheme'),
        'desc'   => sprintf( __( 'Required, according to <strong>%s</strong>. Could be decimal number.', 'premitheme' ), $pt_folioImgWidth ),
        'std'    => '300',
        'note'   => '',
        'size'   => 'small',
        'suffix' => __('px', 'premitheme'),
        'first'  => '',
        'type'   => 'text'
    )
);

function premitheme_render_portfolio_metabox( $post ) {
    global $pt_portfolio_metabox_options, $pt_folioImgWidth;
    wp_nonce_field( 'folio_meta_box_nonce', 'folio-meta-box-nonce' );
    
    premitheme_meta_fields_output($pt_portfolio_metabox_options);
}


/* BG IMAGE METABOX */
$pt_folio_bg_metabox_options = array(
    array(
        'id'    => 'singular_bg_img',
        'label' => __('Custom Fullscreen Background Image', 'premitheme'),
        'desc'  => __('Specify an image to be used as fullscreen background for this portfolio item.', 'premitheme'),
        'std'   => '',
        'note' => __('These settings override the global background settings in the theme options panel under "Branding Settings" tab for this page only.', 'premitheme'),
        'first' => 'first',
        'type'  => 'upload'
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

function premitheme_render_portfolio_bg_metabox( $post ) {
    global $pt_folio_bg_metabox_options;
    wp_nonce_field( 'portfolio_bg_meta_box_nonce', 'portfolio-bg-meta-box-nonce' );

    premitheme_meta_fields_output($pt_folio_bg_metabox_options);
}


/* SAVE METABOXS
=====================*/

/* PORTFOLIO ITEM METABOX */
add_action( 'save_post', 'premitheme_save_portfolio_metabox' );
function premitheme_save_portfolio_metabox( $post_id )  {
    global $pt_portfolio_metabox_options;
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['folio-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['folio-meta-box-nonce'], 'folio_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_posts' ) ) return;  
    
    foreach ($pt_portfolio_metabox_options as $field) {
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
add_action( 'save_post', 'premitheme_save_portfolio_bg_metabox' );
function premitheme_save_portfolio_bg_metabox( $post_id )  {  
    global $pt_folio_bg_metabox_options;
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['portfolio-bg-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['portfolio-bg-meta-box-nonce'], 'portfolio_bg_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_posts' ) ) return;  
    
    foreach ($pt_folio_bg_metabox_options as $field) {
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