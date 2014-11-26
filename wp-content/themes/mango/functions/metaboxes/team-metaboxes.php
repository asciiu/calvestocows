<?php
/* ADD METABOXS
=====================*/

add_action( 'add_meta_boxes', 'premitheme_team_metabox' );
function premitheme_team_metabox() {
    add_meta_box( 'team_settings', __('Team Member Settings', 'premitheme'), 'premitheme_render_team_metabox', 'team', 'normal' , 'high' );
}


/* RENDER METABOXS
=====================*/

/* TEAM METABOX */
global $pt_memberImgWidth;
$pt_team_metabox_options = array(
    array(
        'label' => __('Team Member\'s General Info', 'premitheme'),
        'first' => 'first',
        'type'  => 'heading'
    ),
    array(
        'id'    => 'team_member_img',
        'label' => __('Personal Photo', 'premitheme'),
        'desc'  => sprintf( __( 'Minimum size required <strong>%s</strong>.', 'premitheme' ), $pt_memberImgWidth ),
        'std'   => '',
        'note'  => '',
        'first' => 'first',
        'type'  => 'upload'
    ),
    array(
        'id'     => 'team_member_role',
        'label'  => __('Role', 'premitheme'),
        'desc'   => __('e.g. Designer.', 'premitheme'),
        'std'    => '',
        'note'   => '',
        'size'   => '',
        'suffix' => '',
        'first'  => '',
        'type'   => 'text'
    ),
    array(
        'id'    => 'team_member_bio',
        'label' => __('Biography', 'premitheme'),
        'desc'  => __('Short member\'s biography.', 'premitheme'),
        'std'   => '',
        'note'  => '',
        'size'  => '',
        'first' => '',
        'type'  => 'textarea'
    ),
    array(
        'id'     => 'team_member_web',
        'label'  => __('Personal Website', 'premitheme'),
        'desc'   => __('Enter personal website URL if any.', 'premitheme'),
        'std'    => '',
        'note'   => '',
        'size'   => '',
        'suffix' => '',
        'first'  => '',
        'type'   => 'text'
    ),
    array(
        'label' => __('Team Member\'s Social Networks', 'premitheme'),
        'first' => 'first',
        'type'  => 'heading'
    ),
    array(
        'id'     => 'team_member_aim',
        'label'  => __('AIM', 'premitheme'),
        'desc'   => __('Enter member\'s AIM username.', 'premitheme'),
        'std'    => '',
        'note'   => '',
        'size'   => '',
        'suffix' => '',
        'first'  => 'first',
        'type'   => 'text'
    ),
    array(
        'id'     => 'team_member_behance',
        'label'  => __('Behance', 'premitheme'),
        'desc'   => __('Enter member\'s profile URL.', 'premitheme'),
        'std'    => '',
        'note'   => '',
        'size'   => '',
        'suffix' => '',
        'first'  => '',
        'type'   => 'text'
    ),
    array(
        'id'     => 'team_member_delicious',
        'label'  => __('Delicious', 'premitheme'),
        'desc'   => __('Enter member\'s profile URL.', 'premitheme'),
        'std'    => '',
        'note'   => '',
        'size'   => '',
        'suffix' => '',
        'first'  => 'first',
        'type'   => 'text'
    ),
    array(
        'id'     => 'team_member_deviant',
        'label'  => __('DeviantArt', 'premitheme'),
        'desc'   => __('Enter member\'s profile URL.', 'premitheme'),
        'std'    => '',
        'note'   => '',
        'size'   => '',
        'suffix' => '',
        'first'  => '',
        'type'   => 'text'
    ),
    array(
        'id'     => 'team_member_digg',
        'label'  => __('Digg', 'premitheme'),
        'desc'   => __('Enter member\'s profile URL.', 'premitheme'),
        'std'    => '',
        'note'   => '',
        'size'   => '',
        'suffix' => '',
        'first'  => '',
        'type'   => 'text'
    ),
    array(
        'id'     => 'team_member_dribbble',
        'label'  => __('Dribbble', 'premitheme'),
        'desc'   => __('Enter member\'s profile URL.', 'premitheme'),
        'std'    => '',
        'note'   => '',
        'size'   => '',
        'suffix' => '',
        'first'  => '',
        'type'   => 'text'
    ),
    array(
        'id'     => 'team_member_facebook',
        'label'  => __('Facebook', 'premitheme'),
        'desc'   => __('Enter member\'s profile URL.', 'premitheme'),
        'std'    => '',
        'note'   => '',
        'size'   => '',
        'suffix' => '',
        'first'  => '',
        'type'   => 'text'
    ),
    array(
        'id'     => 'team_member_flickr',
        'label'  => __('Flickr', 'premitheme'),
        'desc'   => __('Enter member\'s profile URL.', 'premitheme'),
        'std'    => '',
        'note'   => '',
        'size'   => '',
        'suffix' => '',
        'first'  => '',
        'type'   => 'text'
    ),
    array(
        'id'     => 'team_member_forrst',
        'label'  => __('Forrst', 'premitheme'),
        'desc'   => __('Enter member\'s profile URL.', 'premitheme'),
        'std'    => '',
        'note'   => '',
        'size'   => '',
        'suffix' => '',
        'first'  => '',
        'type'   => 'text'
    ),
    array(
        'id'     => 'team_member_github',
        'label'  => __('Github', 'premitheme'),
        'desc'   => __('Enter member\'s profile URL.', 'premitheme'),
        'std'    => '',
        'note'   => '',
        'size'   => '',
        'suffix' => '',
        'first'  => '',
        'type'   => 'text'
    ),
    array(
        'id'     => 'team_member_gplus',
        'label'  => __('Google +', 'premitheme'),
        'desc'   => __('Enter member\'s profile URL.', 'premitheme'),
        'std'    => '',
        'note'   => '',
        'size'   => '',
        'suffix' => '',
        'first'  => '',
        'type'   => 'text'
    ),
    array(
        'id'     => 'team_member_imdb',
        'label'  => __('IMDb', 'premitheme'),
        'desc'   => __('Enter member\'s profile URL.', 'premitheme'),
        'std'    => '',
        'note'   => '',
        'size'   => '',
        'suffix' => '',
        'first'  => '',
        'type'   => 'text'
    ),
    array(
        'id'     => 'team_member_instagram',
        'label'  => __('Instagram', 'premitheme'),
        'desc'   => __('Enter member\'s profile URL.', 'premitheme'),
        'std'    => '',
        'note'   => '',
        'size'   => '',
        'suffix' => '',
        'first'  => '',
        'type'   => 'text'
    ),
    array(
        'id'     => 'team_member_lastfm',
        'label'  => __('Last FM', 'premitheme'),
        'desc'   => __('Enter member\'s profile URL.', 'premitheme'),
        'std'    => '',
        'note'   => '',
        'size'   => '',
        'suffix' => '',
        'first'  => '',
        'type'   => 'text'
    ),
    array(
        'id'     => 'team_member_linkedin',
        'label'  => __('LinkedIn', 'premitheme'),
        'desc'   => __('Enter member\'s profile URL.', 'premitheme'),
        'std'    => '',
        'note'   => '',
        'size'   => '',
        'suffix' => '',
        'first'  => '',
        'type'   => 'text'
    ),
    array(
        'id'     => 'team_member_paypal',
        'label'  => __('PayPal', 'premitheme'),
        'desc'   => __('Enter member\'s profile URL.', 'premitheme'),
        'std'    => '',
        'note'   => '',
        'size'   => '',
        'suffix' => '',
        'first'  => '',
        'type'   => 'text'
    ),
    array(
        'id'     => 'team_member_pinterest',
        'label'  => __('Pinterest', 'premitheme'),
        'desc'   => __('Enter member\'s profile URL.', 'premitheme'),
        'std'    => '',
        'note'   => '',
        'size'   => '',
        'suffix' => '',
        'first'  => '',
        'type'   => 'text'
    ),
    array(
        'id'     => 'team_member_reddit',
        'label'  => __('Reddit', 'premitheme'),
        'desc'   => __('Enter member\'s profile URL.', 'premitheme'),
        'std'    => '',
        'note'   => '',
        'size'   => '',
        'suffix' => '',
        'first'  => '',
        'type'   => 'text'
    ),
    array(
        'id'     => 'team_member_rss',
        'label'  => __('RSS', 'premitheme'),
        'desc'   => __('Enter member\'s FeedBurner URL (http://feeds.feedburner.com/YOUR_URL)or any other feeds URL.', 'premitheme'),
        'std'    => '',
        'note'   => '',
        'size'   => '',
        'suffix' => '',
        'first'  => '',
        'type'   => 'text'
    ),
    array(
        'id'     => 'team_member_skype',
        'label'  => __('Skype', 'premitheme'),
        'desc'   => __('Enter member\'s Skype username.', 'premitheme'),
        'std'    => '',
        'note'   => '',
        'size'   => '',
        'suffix' => '',
        'first'  => '',
        'type'   => 'text'
    ),
    array(
        'id'     => 'team_member_soundcloud',
        'label'  => __('SoundCloud', 'premitheme'),
        'desc'   => __('Enter member\'s profile URL.', 'premitheme'),
        'std'    => '',
        'note'   => '',
        'size'   => '',
        'suffix' => '',
        'first'  => '',
        'type'   => 'text'
    ),
    array(
        'id'     => 'team_member_spotify',
        'label'  => __('Spotify', 'premitheme'),
        'desc'   => __('Enter member\'s profile URL.', 'premitheme'),
        'std'    => '',
        'note'   => '',
        'size'   => '',
        'suffix' => '',
        'first'  => '',
        'type'   => 'text'
    ),
    array(
        'id'     => 'team_member_stumbleupon',
        'label'  => __('Stumbleupon', 'premitheme'),
        'desc'   => __('Enter member\'s profile URL.', 'premitheme'),
        'std'    => '',
        'note'   => '',
        'size'   => '',
        'suffix' => '',
        'first'  => '',
        'type'   => 'text'
    ),
    array(
        'id'     => 'team_member_tumblr',
        'label'  => __('Tumblr', 'premitheme'),
        'desc'   => __('Enter member\'s profile URL.', 'premitheme'),
        'std'    => '',
        'note'   => '',
        'size'   => '',
        'suffix' => '',
        'first'  => '',
        'type'   => 'text'
    ),
    array(
        'id'     => 'team_member_twitter',
        'label'  => __('Twitter', 'premitheme'),
        'desc'   => __('Enter member\'s profile URL.', 'premitheme'),
        'std'    => '',
        'note'   => '',
        'size'   => '',
        'suffix' => '',
        'first'  => '',
        'type'   => 'text'
    ),
    array(
        'id'     => 'team_member_vimeo',
        'label'  => __('Vimeo', 'premitheme'),
        'desc'   => __('Enter member\'s profile URL.', 'premitheme'),
        'std'    => '',
        'note'   => '',
        'size'   => '',
        'suffix' => '',
        'first'  => '',
        'type'   => 'text'
    ),
    array(
        'id'     => 'team_member_wp',
        'label'  => __('WordPress.com', 'premitheme'),
        'desc'   => __('Enter member\'s profile URL.', 'premitheme'),
        'std'    => '',
        'note'   => '',
        'size'   => '',
        'suffix' => '',
        'first'  => '',
        'type'   => 'text'
    ),
    array(
        'id'     => 'team_member_yahoo',
        'label'  => __('Yahoo', 'premitheme'),
        'desc'   => __('Enter member\'s Yahoo username.', 'premitheme'),
        'std'    => '',
        'note'   => '',
        'size'   => '',
        'suffix' => '',
        'first'  => '',
        'type'   => 'text'
    ),
    array(
        'id'     => 'team_member_youtube',
        'label'  => __('YouTube', 'premitheme'),
        'desc'   => __('Enter member\'s profile URL.', 'premitheme'),
        'std'    => '',
        'note'   => '',
        'size'   => '',
        'suffix' => '',
        'first'  => '',
        'type'   => 'text'
    )
);

function premitheme_render_team_metabox( $post ) {
    global $pt_team_metabox_options;
    wp_nonce_field( 'team_meta_box_nonce', 'team-meta-box-nonce' ); 

    premitheme_meta_fields_output($pt_team_metabox_options);
}


/* SAVE METABOXS
=====================*/

/* TEAM METABOX */
add_action( 'save_post', 'premitheme_save_team_metabox' );
function premitheme_save_team_metabox( $post_id )  {  
    global $pt_team_metabox_options;
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['team-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['team-meta-box-nonce'], 'team_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_posts' ) ) return;  
    
    foreach ($pt_team_metabox_options as $field) {
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


