<?php
/* REGISTER POST TYPE
===============================*/

add_action( 'init', 'premitheme_slides_post_type' );
add_filter( 'post_updated_messages', 'premitheme_slides_updated_messages' );

function premitheme_slides_post_type() {
    register_post_type( 'slides', array(
        'labels' => array(
            'name'               => __( 'Slides', 'premitheme' ),
            'singular_name'      => __( 'Slide', 'premitheme' ),
            'add_new'            => __( 'Add New slide', 'premitheme' ),
            'add_new_item'       => __( 'Add New Slide', 'premitheme' ),
            'edit'               => __( 'Edit', 'premitheme' ),
            'edit_item'          => __( 'Edit Slide', 'premitheme' ),
            'new_item'           => __( 'New Slide', 'premitheme' ),
            'view'               => __( 'View Slide', 'premitheme' ),
            'view_item'          => __( 'View Slide', 'premitheme' ),
            'search_items'       => __( 'Search Slides', 'premitheme' ),
            'not_found'          => __( 'No Slides Found', 'premitheme' ),
            'not_found_in_trash' => __( 'No Slides Found in Trash', 'premitheme' ),
        ),
        'description'         => __( 'Create, delete and edit slides for the home page slider', 'premitheme' ),
        'public'              => true,
        'publicly_queryable'  => false,
        'show_in_nav_menus'   => false,
        'exclude_from_search' => true,
        //'menu_position'       => 20,
        'menu_icon'           => 'dashicons-format-gallery',
        'has_archive'         => false,
        'query_var'           => true,
        'supports'            => array( 'title', 'page-attributes' ),
        'rewrite'             => true
        )
    );
}

function premitheme_slides_updated_messages( $messages ) {
    global $post, $post_ID;
    $messages['slides'] = array(
        0  => '', // Unused. Messages start at index 1.
        1  => sprintf( __('Slide updated. <a href="%s">View slide</a>', 'premitheme'), esc_url( get_permalink($post_ID) ) ),
        2  => __('Custom field updated.', 'premitheme'),
        3  => __('Custom field deleted.', 'premitheme'),
        4  => __('Slide updated.', 'premitheme'),
        5  => isset($_GET['revision']) ? sprintf( __('Slide restored to revision from %s', 'premitheme'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6  => sprintf( __('Slide published. <a href="%s">View slide</a>', 'premitheme'), esc_url( get_permalink($post_ID) ) ),
        7  => __('Slide saved.', 'premitheme'),
        8  => sprintf( __('Slide submitted. <a target="_blank" href="%s">Preview slide</a>', 'premitheme'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9  => sprintf( __('Slide scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview slide</a>', 'premitheme'), date_i18n( __( 'M j, Y @ G:i', 'premitheme' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
        10 => sprintf( __('Slide draft updated. <a target="_blank" href="%s">Preview slide</a>', 'premitheme'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) )
    );
    return $messages;
}


/* REGISTER TAXONOMIES
===============================*/

add_action( 'init', 'premitheme_slides_taxonomies' );
function premitheme_slides_taxonomies() {
    register_taxonomy( 'slider_sets', 'slides', array(
            'labels' => array(
                'name'                       => __( 'Sets', 'premitheme' ),
                'singular_name'              => __( 'Slider Set', 'premitheme' ),
                'search_items'               => __( 'Search Slider Sets', 'premitheme' ),
                'popular_items'              => __( 'Popular Slider Sets', 'premitheme' ),
                'all_items'                  => __( 'All Slider Sets', 'premitheme' ),
                'edit_item'                  => __( 'Edit Slider Set', 'premitheme' ),
                'view_item'                  => __( 'View Slider Set', 'premitheme' ),
                'update_item'                => __( 'Update Slider Set', 'premitheme' ),
                'add_new_item'               => __( 'Add New Set', 'premitheme' ),
                'new_item_name'              => __( 'New Slider Set Name', 'premitheme' ),
                'separate_items_with_commas' => __( 'Separate Slider Sets With Commas', 'premitheme' ),
                'add_or_remove_items'        => __( 'Add or Remove Slider Sets', 'premitheme' ),
                'choose_from_most_used'      => __( 'Choose From Most Used Slider Sets', 'premitheme' ),
                'parent_item'                => __( 'Parent Slider Set', 'premitheme' )
            ),
            'public'            => true,
            'hierarchical'      => true,
            'query_var'         => true,
            'show_in_nav_menus' => false,
            'show_tagcloud'     => false,
            'rewrite'           => true
        )  
    );
}


/* CUSTOM COLUMNS
===============================*/

add_filter("manage_edit-slides_columns", "premitheme_slides_edit_columns");
add_action("manage_posts_custom_column",  "premitheme_slides_columns_display", 10, 2);
   
function premitheme_slides_edit_columns($slides_columns){
    $slides_columns = array(
        "cb"               => "<input type=\"checkbox\" />",
        "title"            => __('Title', 'premitheme'),
        "slides_thumbnail" => __('Thumbnail', 'premitheme'),
        "slider-sets"      => __('Slider Sets', 'premitheme'),
        "author"           => __('Author', 'premitheme'),
        "date"             => __('Date', 'premitheme'),
    );
    return $slides_columns;
}

function premitheme_slides_columns_display($slides_columns, $post_id){
    switch ($slides_columns){
        case "slides_thumbnail":
            $thumb_src = get_post_meta($post_id, 'slide_img', TRUE);
            $thumb = premitheme_image( '', $thumb_src, premitheme_img_size("100x100") );

            if ( $thumb[0] ) {
                echo '<img src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'"/>';
            } else {
                echo __('None', 'premitheme');
            }
        break;

        case "slider-sets":
            if ($cat_list = get_the_term_list( $post_id, 'slider_sets', '', ', ', '' ) ) {
                echo $cat_list;
            } else {
                echo __('None', 'premitheme');
            }
        break;
    }
}


/* CUSTOM FILTERING
===============================*/

add_action( 'restrict_manage_posts', 'premitheme_slides_filter_display' );
add_filter( 'parse_query','premitheme_slides_perform_filtering' );

function premitheme_slides_filter_display() {
    global $typenow;
    if ( $typenow == 'slides' ) {
        $filters = get_object_taxonomies( $typenow );

        foreach($filters as $filter){
            $terms = get_terms($filter);
            if ( !empty($terms) ){
                $taxonomy = get_taxonomy( $filter );
                wp_dropdown_categories( array(
                        'show_option_all' => sprintf( __('Show All %s', 'premitheme'), $taxonomy->label),
                        'taxonomy'        => $filter,
                        'name'            => $taxonomy->name,
                        'orderby'         => 'name',
                        'selected'        => ( isset( $_GET[$filter] ) ? $_GET[$filter] : '' ),
                        'hierarchical'    => $taxonomy->hierarchical,
                        'show_count'      => false,
                        'hide_empty'      => true,
                    )
                );
            }
        }
    }
}

function premitheme_slides_perform_filtering( $query ) {
    global $pagenow, $typenow;

    if ( $pagenow == 'edit.php' ) {
        $filters = get_object_taxonomies( $typenow );
        foreach ( $filters as $filter ) {
            $var = &$query->query_vars[$filter];
            if ( isset( $var ) && $var != 0 ) {
                $term = get_term_by( 'id', $var, $filter );
                $var = $term->slug;
            }
        }
    }
}