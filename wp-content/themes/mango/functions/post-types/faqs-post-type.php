<?php
/* REGISTER POST TYPE
===============================*/

add_action( 'init', 'premitheme_faqs_post_type' );
add_filter( 'post_updated_messages', 'premitheme_faqs_updated_messages' );

function premitheme_faqs_post_type() {
    register_post_type( 'faqs', array(
        'labels' => array(
            'name'               => __( 'FAQs', 'premitheme' ),
            'singular_name'      => __( 'FAQ', 'premitheme' ),
            'add_new'            => __( 'Add New FAQ', 'premitheme' ),
            'add_new_item'       => __( 'Add New FAQ', 'premitheme' ),
            'edit'               => __( 'Edit', 'premitheme' ),
            'edit_item'          => __( 'Edit FAQ', 'premitheme' ),
            'new_item'           => __( 'New FAQ', 'premitheme' ),
            'view'               => __( 'View', 'premitheme' ),
            'view_item'          => __( 'View FAQ', 'premitheme' ),
            'search_items'       => __( 'Search FAQs', 'premitheme' ),
            'not_found'          => __( 'No FAQs Found', 'premitheme' ),
            'not_found_in_trash' => __( 'No FAQs Found in Trash', 'premitheme' ),
    
        ),
        'description'         => __( 'Create, delete and edit FAQs to be shown in "FAQs" page template', 'premitheme' ),
        'public'              => true,
        'publicly_queryable'  => false,
        'show_in_nav_menus'   => false,
        'exclude_from_search' => true,
        //'menu_position'       => 20,
        'menu_icon'           => 'dashicons-editor-help',
        'has_archive'         => false,
        'query_var'           => true,
        'supports'            => array( 'title', 'page-attributes' ),
        'rewrite'             => true
        )
    );
}

function premitheme_faqs_updated_messages( $messages ) {
    global $post, $post_ID;
    $messages['faqs'] = array(
        0  => '', // Unused. Messages start at index 1.
        1  => sprintf( __('FAQ updated. <a href="%s">View FAQ</a>', 'premitheme'), esc_url( get_permalink($post_ID) ) ),
        2  => __('Custom field updated.', 'premitheme'),
        3  => __('Custom field deleted.', 'premitheme'),
        4  => __('FAQ updated.', 'premitheme'),
        5  => isset($_GET['revision']) ? sprintf( __('FAQ restored to revision from %s', 'premitheme'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6  => sprintf( __('FAQ published. <a href="%s">View FAQ</a>', 'premitheme'), esc_url( get_permalink($post_ID) ) ),
        7  => __('FAQ saved.', 'premitheme'),
        8  => sprintf( __('FAQ submitted. <a target="_blank" href="%s">Preview FAQ</a>', 'premitheme'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9  => sprintf( __('FAQ scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview FAQ</a>', 'premitheme'), date_i18n( __( 'M j, Y @ G:i', 'premitheme' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
        10 => sprintf( __('FAQ draft updated. <a target="_blank" href="%s">Preview FAQ</a>', 'premitheme'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) )
    );
    return $messages;
}


/* REGISTER TAXONOMIES
===============================*/

add_action( 'init', 'premitheme_faqs_taxonomies' );
function premitheme_faqs_taxonomies() {
    register_taxonomy( 'faq_groups', 'faqs', array(
            'labels' => array(
                'name'                       => __( 'FAQ Groups', 'premitheme' ),
                'singular_name'              => __( 'FAQ Group', 'premitheme' ),
                'search_items'               => __( 'Search FAQ Groups', 'premitheme' ),
                'popular_items'              => __( 'Popular FAQ Groups', 'premitheme' ),
                'all_items'                  => __( 'All FAQ Groups', 'premitheme' ),
                'edit_item'                  => __( 'Edit FAQ Group', 'premitheme' ),
                'view_item'                  => __( 'View FAQ Group', 'premitheme' ),
                'update_item'                => __( 'Update FAQ Group', 'premitheme' ),
                'add_new_item'               => __( 'Add New FAQ Group', 'premitheme' ),
                'new_item_name'              => __( 'New FAQ Group Name', 'premitheme' ),
                'separate_items_with_commas' => __( 'Separate FAQ Groups With Commas', 'premitheme' ),
                'add_or_remove_items'        => __( 'Add or Remove FAQ Groups', 'premitheme' ),
                'choose_from_most_used'      => __( 'Choose From Most Used FAQ Groups', 'premitheme' ),
                'parent_item'                => __( 'Parent FAQ Groups', 'premitheme' ),
                'not_found'                  => __( 'No FAQ Groups found.', 'premitheme' )
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

add_filter("manage_edit-faqs_columns", "premitheme_faqs_edit_columns");
add_action("manage_posts_custom_column",  "premitheme_faqs_columns_display", 10, 2);
   
function premitheme_faqs_edit_columns($faqs_columns){
    $faqs_columns = array(
        "cb"         => "<input type=\"checkbox\" />",
        "title"      => __('Question', 'premitheme'),
        "answer"     => __('Answer', 'premitheme'),
        "faq-groups" => __('FAQ Groups', 'premitheme'),
        "author"     => __('Author', 'premitheme'),
        "date"       => __('Date', 'premitheme'),
    );
    return $faqs_columns;
}

function premitheme_faqs_columns_display($faqs_columns, $post_id){
    switch ($faqs_columns){
        case "answer":
            $answer = get_post_meta($post_id, 'faqanswer', TRUE);

            if ($answer){
                $truncate_answer = premitheme_truncate_text($answer, 40, $ellipsis = TRUE);
                echo '<p>'.$truncate_answer.'</p>';
            } else {
                echo __('-- No answer specified --', 'premitheme');
            }
        break;

        case "faq-groups":
            if ($cat_list = get_the_term_list( $post_id, 'faq_groups', '', ', ', '' ) ) {
                echo $cat_list;
            } else {
                echo __('None', 'premitheme');
            }
        break;
    }
}


/* CUSTOM FILTERING
===============================*/

add_action( 'restrict_manage_posts', 'premitheme_faqs_filter_display' );
add_filter( 'parse_query','premitheme_faqs_perform_filtering' );

function premitheme_faqs_filter_display() {
    global $typenow;
    if ( $typenow == 'faqs' ) {
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

function premitheme_faqs_perform_filtering( $query ) {
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


/* CHANGE TITLE FIELD PLACEHOLDER TEXT
=======================================*/

add_filter( 'enter_title_here', 'premitheme_faqs_title_text' );
function premitheme_faqs_title_text( $title ){
    $screen = get_current_screen();
    if ( 'faqs' == $screen->post_type ){
        $title = __("Enter FAQ question here", "premitheme");
    }
    return $title;
}