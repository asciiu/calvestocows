<?php
/* The template for displaying recent work content section */

global $pt_section_i;
$postsCount = get_post_meta($post->ID, "recent_work_count", true);
$recentWorkLabel = get_post_meta($post->ID, "recent_work_label", true);
$recentWorkDesc = get_post_meta($post->ID, "recent_work_desc", true);
$recentWorkLink = get_post_meta($post->ID, "recent_work_link", true);
$recentWorkCat = get_post_meta($post->ID, "recent_work_cat", true);
$recentWorkOpen = get_post_meta($post->ID, "recent_work_open", true);
$recentWorkOrderby = get_post_meta($post->ID, "recent_work_orderby", true);
$recentWorkOrder = get_post_meta($post->ID, "recent_work_order", true);

if ( !$recentWorkLabel[$pt_section_i] ) $recentWorkLabel[$pt_section_i] = __('Recent Work', 'premitheme');

if ($postsCount[$pt_section_i] == '3'){
    $count = 9;
} elseif ($postsCount[$pt_section_i] == '2'){
    $count = 6;
} else {
    $count = 3;
}

if ( $recentWorkCat[$pt_section_i] == 'all' ):
    $cats_args = array(
        'hide_empty'   => 1,
        'hierarchical' => 0,
        'taxonomy'     => 'portfolio_cats'
    );

    $args = array(
        'posts_per_page' => $count,
        'order'          => $recentWorkOrder[$pt_section_i],
        'orderby'        => $recentWorkOrderby[$pt_section_i],
        'post_type'      => 'portfolio'
    );
else:
    $cats_args = array(
        'child_of' => $recentWorkCat[$pt_section_i],
        'taxonomy' => 'portfolio_cats'
    );

    $args = array(
        'posts_per_page' => $count,
        'order'          => $recentWorkOrder[$pt_section_i],
        'orderby'        => $recentWorkOrderby[$pt_section_i],
        'post_type'      => 'portfolio',
        'tax_query'      => array(
            array(
                'taxonomy' => 'portfolio_cats',
                'field'    => 'id',
                'terms'    => array($recentWorkCat[$pt_section_i]),
                'operator' => 'IN'
            )
        )
    );
endif;

$folio_cats = get_categories($cats_args);

$original_query = $wp_query;
$wp_query = null;
$wp_query = new WP_Query( $args );
if ( $wp_query->have_posts() ):
    ?>
        <!-- RECENT WORK
        ====================================== -->
        <div class="recent-work recent-section padding-bottom clearfix">
            <h3 class="home-section-heading"><span><?php echo $recentWorkLabel[$pt_section_i]; ?></span></h3>

            <?php if( $recentWorkDesc[$pt_section_i] ): ?>
                <p class="recent-section-desc"><?php echo nl2br( $recentWorkDesc[$pt_section_i] ); ?></p>
            <?php endif; ?>

            <?php if( $recentWorkLink[$pt_section_i] ): ?>
                <a class="desc-link" href="<?php echo $recentWorkLink[$pt_section_i]; ?>"><?php _e('View all', 'premitheme'); ?></a>
            <?php endif; ?>

            <div class="recent-work-row column alpha omega">
                <ul class="clearfix">
                    <?php while ($wp_query->have_posts()) : $wp_query->the_post();
                        $attachement_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

                        $item_thumb = get_post_meta($post->ID, 'folio_item_thumb', TRUE);
                        $item_date = get_post_meta($post->ID, 'folio_date', TRUE);

                        $folio_item_cats =  get_the_terms( get_the_ID(), 'portfolio_cats' );
                        $cat_name = '';
                        $cats_names = array();

                        if ( !empty($folio_item_cats) ){
                            foreach ( $folio_item_cats as $folio_item_cat ){
                                $cats_names[] = $folio_item_cat->name;
                            } 
                            $cat_name = join( ', ', $cats_names );
                        }

                        $folio_rel = '';
                        if ( $recentWorkOpen[$pt_section_i] == 'lightbox'){ 
                            if ( $item_thumb == 'video' ){
                                $folio_link = get_post_meta($post->ID, 'folio_video_url', TRUE);
                            } else {
                                $folio_link = $attachement_img[0];
                            }
                            $folio_rel = ' rel="prettyPhoto[folio-items]"';
                        } else {
                            $folio_link = get_permalink();
                        }
                    ?>
                        <li class="col-3col folio-item">
                            <a href="<?php echo $folio_link; ?>" title="<?php the_title_attribute(); ?>"<?php echo $folio_rel; ?>>
                                
                                <?php /* THUMBNAILS TEMPLATE
                                ============================================*/
                                get_template_part( 'includes/folio-thumb-3col' );
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
            </div>
        </div> 
    <?php
endif;
$wp_query = null;
$wp_query = $original_query;
wp_reset_postdata();