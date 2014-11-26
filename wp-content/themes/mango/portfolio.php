<?php 
/* Template name: Portfolio page */

$folio_cat_option = get_post_meta($post->ID, 'folio_cat', TRUE);

if ( get_post_meta($post->ID, 'folio_main_layout', TRUE) != 'global' ) {
    $folio_main_layout_option = get_post_meta($post->ID, 'folio_main_layout', TRUE);
} else {
    $folio_main_layout_option = of_get_option('global_folio_main_layout');
}

if ( $folio_main_layout_option == '2col-sidebar' ){
    $col_class = 'folio-2col folio-sidebar';
    $grid_class = 'grid_9';
} elseif ( $folio_main_layout_option == '2col' ){
    $col_class = 'folio-2col';
    $grid_class = 'grid_12';
} else {
    $col_class = 'folio-3col';
    $grid_class = 'grid_12';
}

if ( get_post_meta($post->ID, 'folio_thumbs_style', TRUE) != 'global' ) {
    $pt_folio_thumbs_style_option = get_post_meta($post->ID, 'folio_thumbs_style', TRUE);
} else {
    $pt_folio_thumbs_style_option = of_get_option('global_folio_thumbs_style');
}

if ( get_post_meta($post->ID, 'folio_thumbs_link', TRUE) != 'global' ) {
    $folio_thumbs_link_option = get_post_meta($post->ID, 'folio_thumbs_link', TRUE);
} else {
    $folio_thumbs_link_option = of_get_option('global_folio_thumbs_link');
}

if ( get_post_meta($post->ID, 'folio_orderby', TRUE) != 'global' ) {
    $folio_orderby_option = get_post_meta($post->ID, 'folio_orderby', TRUE);
} else {
    $folio_orderby_option = of_get_option('global_folio_orderby');
}

if ( get_post_meta($post->ID, 'folio_order', TRUE) != 'global' ) {
    $folio_order_option = get_post_meta($post->ID, 'folio_order', TRUE);
} else {
    $folio_order_option = of_get_option('global_folio_order');
}

$folio_filtering_option = get_post_meta($post->ID, 'folio_filtering', TRUE);

if ( $folio_cat_option == 'all' ):
    $args = array(
        'hide_empty'   => 1,
        'hierarchical' => 0,
        'taxonomy'     => 'portfolio_cats'
    );
else:
    $args = array(
        'child_of'   => $folio_cat_option,
        'taxonomy'     => 'portfolio_cats'
    );
endif;
$folio_cats = get_categories($args);

if ( !empty($folio_cats) && $folio_cat_option != 'all' ):
    $filters_args = array(
            'title_li'     => '',
            'hierarchical' => 0,
            'child_of'     => $folio_cat_option,
            'taxonomy'     => 'portfolio_cats'
        );
else:
    $filters_args = array(
            'title_li'     => '',
            'hierarchical' => 0,
            'taxonomy'     => 'portfolio_cats'
        );
endif;

get_header(); ?>
        <?php while ( have_posts() ) : the_post(); ?>

        <div id="page-title" class="container alpha omega">
            <h1><?php the_title(); ?></h1>
        </div><!-- #page-title -->

        <div id="content-container" class="fullwidth-container">
            <div id="content" class="container padding-top">
                <?php if ( has_post_thumbnail()): ?>
                    <div class="container alpha omega page-thumb">
                        <?php
                        $altAttr = get_post_meta( get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true);
                        $image = premitheme_image( $post->ID, '', premitheme_img_size('page-standard'));
                        ?>
                        <img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" title="<?php the_title_attribute(); ?>" alt="<?php echo $altAttr; ?>"/>
                    </div>
                <?php endif; ?>

                <!-- FOLIO FILTERING LINKS
                ====================================== -->
                <?php if( of_get_option('filtering_on') && !empty( $folio_cats ) ): ?>
                    <ul id="filtering-links" class="container alpha omega">
                        <li>
                            <?php if ( $folio_filtering_option == 'fancy' ): ?>
                                <a class="all" href="#" title="<?php _e('Select category', 'premitheme'); ?>"><i class="fa fa-bars"></i> <?php _e('All', 'premitheme');?></a>
                                <ul>
                                    <li data-filter="*" class="filter current-cat">
                                        <a href="#" title="<?php _e('Show All', 'premitheme'); ?>"><?php _e('All', 'premitheme');?></a>
                                    </li>
                                    <?php foreach( $folio_cats as $folio_cat ): ?>
                                        <li data-filter=".<?php echo $folio_cat->slug ?>" class="filter">
                                            <a href="#" title="<?php printf( __('Show %s Only', 'premitheme'), $folio_cat->cat_name ); ?>"><?php echo $folio_cat->cat_name; ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <div class="all" title="<?php _e('Select category', 'premitheme'); ?>"><i class="fa fa-bars"></i> <?php _e('All', 'premitheme');?></div>
                                <ul>
                                    <li class="filter current-cat">
                                        <a href="<?php the_permalink(); ?>" title="<?php _e('Show All', 'premitheme'); ?>"><?php _e('All', 'premitheme');?></a>
                                    </li>
                                    <?php wp_list_categories($filters_args); ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    </ul>
                <?php endif; ?>
                
                <div id="main" class="<?php echo $grid_class; ?> columns padding-bottom">
                    <article id="post-<?php the_ID();?>" <?php post_class('entry-wrapper clearfix');?>>
                        <?php if( trim($post->post_content) != '' ): ?>
                            <!-- PAGE CONTENT
                            ====================================== -->
                            <div class="entry-content">
                                <?php the_content(); ?>
                                <?php wp_link_pages( array( 'before' => '<p><span><strong>' . __( 'Pages: ', 'premitheme' ) . '</strong></span>', 'after' => '</p>' ) ); ?>
                                <?php edit_post_link( __( 'Edit', 'premitheme'), '<div class="entry-meta edit-link">', '</div>' ); ?>
                            </div>
                        <?php endif; ?>

                        <!-- ACTUAL FOLIO ITEMS
                        ====================================== -->
                        <ul id="folio-items" class="<?php echo $col_class; ?> clearfix">
                            <?php
                            if( of_get_option('folio_perpage') ):
                                $items_per_page = of_get_option('folio_perpage');
                            else:
                                $items_per_page = '-1';
                            endif;

                            if ( get_query_var('paged') ) {
                                $paged = get_query_var('paged');
                            } else if ( get_query_var('page') ) {
                                $paged = get_query_var('page');
                            } else {
                                $paged = 1;
                            }

                            if ( $folio_cat_option == 'all' ):
                                $args = array(
                                        'paged'          => $paged,
                                        'posts_per_page' => $items_per_page,
                                        'order'          => $folio_order_option,
                                        'orderby'        => $folio_orderby_option,
                                        'post_type'      => 'portfolio'
                                    );
                            else:
                                $args = array(
                                        'paged'          => $paged,
                                        'posts_per_page' => $items_per_page,
                                        'order'          => $folio_order_option,
                                        'orderby'        => $folio_orderby_option,
                                        'post_type'      => 'portfolio',
                                        'tax_query'      => array(
                                            array(
                                                'taxonomy' => 'portfolio_cats',
                                                'field'    => 'id',
                                                'terms'    => array($folio_cat_option),
                                                'operator' => 'IN'
                                            )
                                        )
                                    );
                            endif;

                            // FOLIO QUERY START
                            $original_query = $wp_query;
                            $wp_query = null;
                            $wp_query = new WP_Query( $args );
                            while ($wp_query->have_posts()) : $wp_query->the_post();
                                $src = '';
                                $thumbnail_id = get_post_meta( $id, '_thumbnail_id', true );
                                list($src) = wp_get_attachment_image_src( $thumbnail_id, 'full' );

                                $item_thumb = get_post_meta($post->ID, 'folio_item_thumb', TRUE);
                                $item_date = get_post_meta($post->ID, 'folio_date', TRUE);

                                $folio_item_cats =  get_the_terms( get_the_ID(), 'portfolio_cats' );
                                $cat_name = '';
                                $cat_class = '';
                                $cats_names = array();
                                $cats_slugs = array();

                                if ( !empty($folio_item_cats) ){
                                    foreach ( $folio_item_cats as $folio_item_cat ){
                                        $cats_names[] = $folio_item_cat->name;
                                        $cats_slugs[] = $folio_item_cat->slug;
                                    } 
                                    $cat_name = join( ', ', $cats_names );
                                    $cat_class = join( ' ', $cats_slugs ).' ';
                                }

                                $folio_rel = '';
                                if ( $folio_thumbs_link_option == 'lightbox'){ 
                                    if ( $item_thumb == 'video' ){
                                        $folio_link = get_post_meta($post->ID, 'folio_video_url', TRUE);
                                    } else {
                                        $folio_link = $src;
                                    }
                                    $folio_rel = ' rel="prettyPhoto[folio-items]"';
                                } else {
                                    $folio_link = get_permalink();
                                }
                            ?>
                                <li class="<?php echo $cat_class; ?> all folio-item">
                                    <a href="<?php echo $folio_link; ?>" title="<?php the_title_attribute(); ?>"<?php echo $folio_rel; ?>>
                                        
                                        <?php /* THUMBNAILS TEMPLATE
                                        ============================================*/
                                        if ( $folio_main_layout_option == '2col-sidebar' ){
                                            get_template_part( 'includes/folio-thumb-2col-sidebar' );
                                        } elseif ( $folio_main_layout_option == '2col' ){
                                            get_template_part( 'includes/folio-thumb-2col' );
                                        } else {
                                            get_template_part( 'includes/folio-thumb-3col' );
                                        }
                                        ?>

                                        <div class="folio-overlay">
                                            <div class="folio-title">
                                                <h2><?php the_title(); ?></h2>
                                                <?php if( count($folio_cats) > 1 ){ echo '<h3>'.$cat_name.'</h3>'; } ?>
                                            </div>

                                            <div class="more-hover">
                                                <?php if( $item_date ){ echo '<h4>'.$item_date.'</h4>'; } ?>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            <?php endwhile; ?>
                        </ul>

                        <?php /* PAGINATION
                        ============================================*/
                        premitheme_pagination();

                        // FOLIO QUERY END & RESET QUERY
                        $wp_query = null;
                        $wp_query = $original_query;
                        wp_reset_postdata();?>
                    </article>

                    <?php endwhile; ?>
                </div>

                <?php /* GET THE SIDEBAR FROM "sidebar-portfolio.php" or "sidebar.php"
                ======================================================================*/
                if ( $folio_main_layout_option == '2col-sidebar' )
                    if ( is_active_sidebar( 'sidebar-4' ) )
                        get_sidebar('portfolio');
                    else
                        get_sidebar();
                ?>
            </div><!-- #content -->
        </div>
<?php get_footer(); ?>