<?php

$folio_main_layout_option = of_get_option('global_folio_main_layout');

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

$folio_thumbs_style_option = of_get_option('global_folio_thumbs_style');
$folio_thumbs_link_option = of_get_option('global_folio_thumbs_link');

if ( of_get_option('folio_parent') != '' ){
    $folio_parent = get_the_title( of_get_option('folio_parent') ).': ';
} else {
    $folio_parent = '';
}

$current_cat = $wp_query->queried_object->term_id;
$parent_cat = $wp_query->queried_object->parent;
$children_cats = get_term_children( $wp_query->queried_object->term_id, 'portfolio_cats' );

get_header(); ?>
        <div id="page-title" class="container alpha omega">
            <?php if ( $parent_cat != ('0' || '') ): $termData = get_term_by('id', $parent_cat, 'portfolio_cats'); ?>
                <h1><?php echo $termData->name; ?>: <?php single_term_title(); ?></h1>
            <?php else: ?>
                <h1><?php echo $folio_parent; ?><?php single_term_title(); ?></h1>
            <?php endif; ?>
        </div><!-- #page-title -->

        <div id="content-container" class="fullwidth-container">
            <div id="content" class="container padding-top">
                <!-- FOLIO FILTERING LINKS
                ====================================== -->
                <?php if( of_get_option('filtering_on') && get_taxonomy( 'portfolio_cats' ) ): ?>
                    <ul id="filtering-links" class="container alpha omega">
                        <li>
                            <div class="all" title="<?php _e('Select category', 'premitheme'); ?>"><i class="fa fa-bars"></i> <?php single_term_title(); ?></div>
                            <ul>
                                <?php if ( $parent_cat != ('0' || '')  ):
                                    $termData = get_term_by('id', $parent_cat, 'portfolio_cats');
                                    $termLink = get_term_link($termData->slug, 'portfolio_cats');
                                ?>
                                    <li class="filter">
                                        <a href="<?php echo $termLink; ?>"><?php _e('All in ', 'premitheme');?><?php echo $termData->name; ?></a>
                                    </li>
                                <?php elseif ( !empty( $children_cats ) ):
                                    $termData = get_term_by('id', $current_cat, 'portfolio_cats');
                                    $termLink = get_term_link($termData->slug, 'portfolio_cats');
                                ?>
                                    <li class="filter">
                                        <a href="<?php echo $termLink; ?>"><?php _e('All in ', 'premitheme');?><?php echo $termData->name; ?></a>
                                    </li>
                                <?php elseif ( of_get_option('folio_parent') != '' ): ?>
                                    <li class="filter">
                                        <a href="<?php echo get_permalink( of_get_option('folio_parent') ); ?>"><?php _e('All', 'premitheme');?></a>
                                    </li>
                                <?php endif;

                                if ( $parent_cat != ('0' || '')  ):
                                    $args_filters = array(
                                            'title_li'     => '',
                                            'hierarchical' => 0,
                                            'child_of'     => $parent_cat,
                                            'taxonomy'     => 'portfolio_cats'
                                        );
                                elseif ( !empty( $children_cats ) ):
                                    $args_filters = array(
                                            'title_li'     => '',
                                            'hierarchical' => 0,
                                            'child_of'     => $wp_query->queried_object->term_id,
                                            'taxonomy'     => 'portfolio_cats'
                                        );
                                else: 
                                    $args_filters = array(
                                            'title_li'     => '',
                                            'hierarchical' => 0,
                                            'taxonomy'     => 'portfolio_cats'
                                        );
                                endif;

                                wp_list_categories($args_filters); ?>
                            </ul>
                        </li>
                    </ul>
                <?php endif; ?>
                
                <div id="main" class="<?php echo $grid_class; ?> columns padding-bottom">
                    <article id="post-<?php the_ID();?>" <?php post_class('entry-wrapper clearfix');?>>
                        <!-- ACTUAL FOLIO ITEMS
                        ====================================== -->
                        <?php if ( have_posts() ): ?>
                            <ul id="folio-items" class="<?php echo $col_class; ?> clearfix">
                                <?php while ( have_posts() ): the_post();
                                    $src = '';
                                    $thumbnail_id = get_post_meta( $id, '_thumbnail_id', true );
                                    $src = wp_get_attachment_image_src( $thumbnail_id, 'full' );

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
                                                    <?php if( count($children_cats) > 1 ){ echo '<h3>'.$cat_name.'</h3>'; } ?>
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

                        else: ?>

                            <h2 class="entry-title"><?php _e('Nothing found', 'premitheme'); ?></h2>
                            <div class="entry-content">
                                <p><?php _e('Sorry, no posts were found.', 'premitheme'); ?></p>
                            </div>
                            <?php get_search_form(); ?>

                        <?php endif; // have_posts() ?>
                    </article>
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