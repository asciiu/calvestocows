<?php
/* REGISTER POST TYPE
===============================*/

add_action( 'init', 'premitheme_portfolio_post_type' );
add_filter( 'post_updated_messages', 'premitheme_portfolio_updated_messages' );

function premitheme_portfolio_post_type() {
    $folioItemSlug = of_get_option('folio_item_slug');

    register_post_type( 'portfolio', array(
        'labels' => array(
            'name'               => __( 'Portfolio Items', 'premitheme' ),
            'singular_name'      => __( 'Portfolio Item', 'premitheme' ),
            'add_new'            => __( 'Add New Item', 'premitheme' ),
            'add_new_item'       => __( 'Add New Portfolio Item', 'premitheme' ),
            'edit'               => __( 'Edit', 'premitheme' ),
            'edit_item'          => __( 'Edit Portfolio Item', 'premitheme' ),
            'new_item'           => __( 'New Portfolio Item', 'premitheme' ),
            'view'               => __( 'View Portfolio Item', 'premitheme' ),
            'view_item'          => __( 'View Portfolio Item', 'premitheme' ),
            'search_items'       => __( 'Search Portfolio Items', 'premitheme' ),
            'not_found'          => __( 'No Portfolio Items Found', 'premitheme' ),
            'not_found_in_trash' => __( 'No Portfolio Items Found in Trash', 'premitheme' ),
        ),
        'description'         => __( 'You can put your portfolio items here. They can be design work, photography, projects or any kind of content you want to showcase', 'premitheme' ),
        'public'              => true,
        'publicly_queryable'  => true,
        'show_in_nav_menus'   => true,
        'exclude_from_search' => false,
        //'menu_position'       => 20,
        'menu_icon'           => 'dashicons-portfolio',
        'has_archive'         => true,
        'query_var'           => $folioItemSlug,
        'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'comments' ),
        'rewrite'             => array( 'slug' => $folioItemSlug, 'with_front' => false )
        )
    );
}

function premitheme_portfolio_updated_messages( $messages ) {
    global $post, $post_ID;
    $messages['portfolio'] = array(
        0  => '', // Unused. Messages start at index 1.
        1  => sprintf( __('Portfolio item updated. <a href="%s">View portfolio item</a>', 'premitheme'), esc_url( get_permalink($post_ID) ) ),
        2  => __('Custom field updated.', 'premitheme'),
        3  => __('Custom field deleted.', 'premitheme'),
        4  => __('Portfolio item updated.', 'premitheme'),
        5  => isset($_GET['revision']) ? sprintf( __('Portfolio item restored to revision from %s', 'premitheme'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6  => sprintf( __('Portfolio item published. <a href="%s">View portfolio item</a>', 'premitheme'), esc_url( get_permalink($post_ID) ) ),
        7  => __('Portfolio item saved.', 'premitheme'),
        8  => sprintf( __('Portfolio item submitted. <a target="_blank" href="%s">Preview portfolio item</a>', 'premitheme'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9  => sprintf( __('Portfolio item scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview portfolio item</a>', 'premitheme'), date_i18n( __( 'M j, Y @ G:i', 'premitheme' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
        10 => sprintf( __('Portfolio item draft updated. <a target="_blank" href="%s">Preview portfolio item</a>', 'premitheme'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) )
    );
    return $messages;
}


/* REGISTER TAXONOMIES
===============================*/

add_action( 'init', 'premitheme_portfolio_taxonomies' );

function premitheme_portfolio_taxonomies() {
    $folioCatSlug = of_get_option('folio_cat_slug');
    $folioSkillSlug = of_get_option('folio_skill_slug');

    // PORTFOLIO CATEGORIES
    register_taxonomy( 'portfolio_cats', 'portfolio', array(
            'labels' => array(
                'name'                       => __( 'Portfolio Categories', 'premitheme' ),
                'singular_name'              => __( 'Portfolio Category', 'premitheme' ),
                'search_items'               => __( 'Search Portfolio Categories', 'premitheme' ),
                'popular_items'              => __( 'Popular Portfolio Categories', 'premitheme' ),
                'all_items'                  => __( 'All Portfolio Categories', 'premitheme' ),
                'edit_item'                  => __( 'Edit Portfolio Category', 'premitheme' ),
                'view_item'                  => __( 'View Portfolio Category', 'premitheme' ),
                'update_item'                => __( 'Update Portfolio Category', 'premitheme' ),
                'add_new_item'               => __( 'Add New Portfolio Category', 'premitheme' ),
                'new_item_name'              => __( 'New Portfolio Category Name', 'premitheme' ),
                'separate_items_with_commas' => __( 'Separate Portfolio Categories With Commas', 'premitheme' ),
                'add_or_remove_items'        => __( 'Add or Remove Portfolio Categories', 'premitheme' ),
                'choose_from_most_used'      => __( 'Choose From Most Used Portfolio Categories', 'premitheme' ),
                'parent_item'                => __( 'Parent Portfolio Category', 'premitheme' ),
                'not_found'                  => __( 'No Portfolio Categories found.', 'premitheme' )
            ),
            'public'            => true,
            'hierarchical'      => true,
            'query_var'         => $folioCatSlug,
            'show_in_nav_menus' => true,
            'show_tagcloud'     => true,
            'rewrite'           => array( 'slug' => $folioCatSlug, 'with_front' => false )
        )  
    );
    
    // PORTFOLIO SKILLS
    register_taxonomy( 'portfolio_skills', 'portfolio', array(
            'labels' => array(
                'name'                       => __( 'Skills', 'premitheme' ),
                'singular_name'              => __( 'Skill', 'premitheme' ),
                'search_items'               => __( 'Search Skills', 'premitheme' ),
                'popular_items'              => __( 'Popular Skills', 'premitheme' ),
                'all_items'                  => __( 'All Skills', 'premitheme' ),
                'edit_item'                  => __( 'Edit Skill', 'premitheme' ),
                'view_item'                  => __( 'View Skill', 'premitheme' ),
                'update_item'                => __( 'Update Skill', 'premitheme' ),
                'add_new_item'               => __( 'Add New Skill', 'premitheme' ),
                'new_item_name'              => __( 'New Skill Name', 'premitheme' ),
                'separate_items_with_commas' => __( 'Separate Skills With Commas', 'premitheme' ),
                'add_or_remove_items'        => __( 'Add or Remove Skills', 'premitheme' ),
                'choose_from_most_used'      => __( 'Choose From Most Used Skills', 'premitheme' ),
                'not_found'                  => __( 'No Skills found.', 'premitheme' )
            ),
            'public'            => true,
            'hierarchical'      => false,
            'query_var'         => $folioSkillSlug,
            'show_in_nav_menus' => true,
            'show_tagcloud'     => true,
            'rewrite'           => array( 'slug' => $folioSkillSlug, 'with_front' => false )
        )  
    );
}


/* CUSTOM COLUMNS
===============================*/

add_filter("manage_edit-portfolio_columns", "premitheme_portfolio_edit_columns");
add_action("manage_posts_custom_column",  "premitheme_portfolio_columns_display", 10, 2);
 
function premitheme_portfolio_edit_columns($portfolio_columns){
    $portfolio_columns = array(
        "cb"              => "<input type=\"checkbox\" />",
        "title"           => __('Title', 'premitheme'),
        "folio_thumbnail" => __('Thumbnail', 'premitheme'),
        "portfolio-cats"  => __('Portfolio Categories', 'premitheme'),
        "portfolio_skills"  => __('Skills', 'premitheme'),
        "author"          => __('Author', 'premitheme'),
        "comments"        => '<span class="vers"><div title="Comments" class="comment-grey-bubble"></div></span>',
        "date"            => __('Date', 'premitheme'),
    );
    return $portfolio_columns;
}
 
function premitheme_portfolio_columns_display($portfolio_columns, $post_id){
    switch ($portfolio_columns){
        case "folio_thumbnail":
            $thumb = premitheme_image( $post_id, '', premitheme_img_size("100x100") );

            if ( $thumb[0] ) {
                echo '<img src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'"/>';
            } else {
                echo __('None', 'premitheme');
            }
        break;
        
        case "portfolio-cats":
            if ($cat_list = get_the_term_list( $post_id, 'portfolio_cats', '', ', ', '' ) ) {
                echo $cat_list;
            } else {
                echo __('None', 'premitheme');
            }
        break;

        case "portfolio_skills":
            if ($skills_list = get_the_term_list( $post_id, 'portfolio_skills', '', ', ', '' ) ) {
                echo $skills_list;
            } else {
                echo __('None', 'premitheme');
            }
        break;
    }
}


/* CUSTOM FILTERING
===============================*/

add_action( 'restrict_manage_posts', 'premitheme_portfolio_filter_display' );
add_filter( 'parse_query','premitheme_portfolio_perform_filtering' );

function premitheme_portfolio_filter_display() {
    global $typenow;
    if ( $typenow == 'portfolio' ) {
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

function premitheme_portfolio_perform_filtering( $query ) {
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

add_filter( 'enter_title_here', 'premitheme_folio_title_text' );
function premitheme_folio_title_text( $title ){
    $screen = get_current_screen();
    if ( 'portfolio' == $screen->post_type ) {
        $title = __("Enter portfolio items's name here", "premitheme");
    }
    return $title;
}