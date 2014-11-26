<?php
/* REGISTER POST TYPE
===============================*/

add_action( 'init', 'premitheme_clients_post_type' );
add_filter( 'post_updated_messages', 'premitheme_clients_updated_messages' );

function premitheme_clients_post_type() {
    register_post_type( 'clients', array(
        'labels' => array(
            'name'               => __( 'Clients', 'premitheme' ),
            'singular_name'      => __( 'Client', 'premitheme' ),
            'add_new'            => __( 'Add New Client', 'premitheme' ),
            'add_new_item'       => __( 'Add New Client', 'premitheme' ),
            'edit'               => __( 'Edit', 'premitheme' ),
            'edit_item'          => __( 'Edit Client', 'premitheme' ),
            'new_item'           => __( 'New Client', 'premitheme' ),
            'view'               => __( 'View', 'premitheme' ),
            'view_item'          => __( 'View Client', 'premitheme' ),
            'search_items'       => __( 'Search Clients', 'premitheme' ),
            'not_found'          => __( 'No Clients Found', 'premitheme' ),
            'not_found_in_trash' => __( 'No Clients Found in Trash', 'premitheme' )
        ),
        'description'         => __( 'Create, delete and edit clients to be shown in home page template\'s clients section', 'premitheme' ),
        'public'              => true,
        'publicly_queryable'  => false,
        'show_in_nav_menus'   => false,
        'exclude_from_search' => true,
        //'menu_position'       => 20,
        'menu_icon'           => 'dashicons-businessman',
        'has_archive'         => false,
        'query_var'           => true,
        'supports'            => array( 'title', 'page-attributes' ),
        'rewrite'             => true
        )
    );
}

function premitheme_clients_updated_messages( $messages ) {
    global $post, $post_ID;
    $messages['team'] = array(
        0  => '', // Unused. Messages start at index 1.
        1  => sprintf( __('Team member updated. <a href="%s">View team member</a>', 'premitheme'), esc_url( get_permalink($post_ID) ) ),
        2  => __('Custom field updated.', 'premitheme'),
        3  => __('Custom field deleted.', 'premitheme'),
        4  => __('Team member updated.', 'premitheme'),
        5  => isset($_GET['revision']) ? sprintf( __('Team member restored to revision from %s', 'premitheme'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6  => sprintf( __('Team member published. <a href="%s">View team member</a>', 'premitheme'), esc_url( get_permalink($post_ID) ) ),
        7  => __('Team member saved.', 'premitheme'),
        8  => sprintf( __('Team member submitted. <a target="_blank" href="%s">Preview team member</a>', 'premitheme'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9  => sprintf( __('Team member scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview team member</a>', 'premitheme'), date_i18n( __( 'M j, Y @ G:i', 'premitheme' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
        10 => sprintf( __('Team member draft updated. <a target="_blank" href="%s">Preview team member</a>', 'premitheme'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) )
    );
    return $messages;
}


/* CUSTOM COLUMNS
===============================*/

add_filter("manage_edit-clients_columns", "premitheme_clients_edit_columns");
add_action("manage_posts_custom_column", "premitheme_clients_columns_display", 10, 2);
   
function premitheme_clients_edit_columns($team_columns){
    $team_columns = array(
        "cb"             => "<input type=\"checkbox\" />",
        "title"          => __('Client', 'premitheme'),
        "client_thumbnail" => __('Thumbnail', 'premitheme'),
        "author"         => __('Author', 'premitheme'),
        "date"           => __('Date', 'premitheme'),
    );
    return $team_columns;
}

function premitheme_clients_columns_display($team_columns, $post_id){
    switch ($team_columns){
        case "client_thumbnail":
            $thumb_src = get_post_meta($post_id, 'client_img', TRUE);
            $thumb = premitheme_image( '', $thumb_src, premitheme_img_size("100x100") );

            if ( $thumb[0] ) {
                echo '<img src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'"/>';
            } else {
                echo __('None', 'premitheme');
            }
        break;
    }
}


/* CHANGE TITLE FIELD PLACEHOLDER TEXT
=======================================*/

add_filter( 'enter_title_here', 'premitheme_clients_title_text' );
function premitheme_clients_title_text( $title ){
    $screen = get_current_screen();
    if ( 'clients' == $screen->post_type ){
        $title = __("Enter client's name here", "premitheme");
    }
    return $title;
}