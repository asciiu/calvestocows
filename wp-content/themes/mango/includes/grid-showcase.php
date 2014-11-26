<?php
/* The template for displaying grid showcase content section */

global $pt_section_i;
$postsCount = get_post_meta($post->ID, "grid_showcase_count", true);
$gridShowcaseLabel = get_post_meta($post->ID, "grid_showcase_label", true);
$gridShowcaseDesc = get_post_meta($post->ID, "grid_showcase_desc", true);
$gridShowcaseCat = get_post_meta($post->ID, "grid_showcase_cat", true);
$gridShowcaseOpen = get_post_meta($post->ID, "grid_showcase_open", true);
$gridShowcaseOrderby = get_post_meta($post->ID, "grid_showcase_orderby", true);
$gridShowcaseOrder = get_post_meta($post->ID, "grid_showcase_order", true);

if($postsCount[$pt_section_i] == '3'){
    $count = 12;
} else {
    $count = 8;
}

if ( $gridShowcaseCat[$pt_section_i] == 'all' ):
    $cats_args = array(
        'hide_empty'   => 1,
        'hierarchical' => 0,
        'taxonomy'     => 'portfolio_cats'
    );

    $args = array(
        'posts_per_page' => $count,
        'order'          => $gridShowcaseOrder[$pt_section_i],
        'orderby'        => $gridShowcaseOrderby[$pt_section_i],
        'post_type'      => 'portfolio'
    );
else:
    $cats_args = array(
        'child_of' => $gridShowcaseCat[$pt_section_i],
        'taxonomy' => 'portfolio_cats'
    );

    $args = array(
        'posts_per_page' => $count,
        'order'          => $gridShowcaseOrder[$pt_section_i],
        'orderby'        => $gridShowcaseOrderby[$pt_section_i],
        'post_type'      => 'portfolio',
        'tax_query'      => array(
            array(
                'taxonomy' => 'portfolio_cats',
                'field'    => 'id',
                'terms'    => array($gridShowcaseCat[$pt_section_i]),
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
        <div class="grid-showcase recent-section padding-bottom clearfix">
            <?php if( $gridShowcaseLabel[$pt_section_i] ): ?>
                <h3 class="home-section-heading"><span><?php echo $gridShowcaseLabel[$pt_section_i]; ?></span></h3>
            <?php endif; ?>

            <?php if( $gridShowcaseDesc[$pt_section_i] ): ?>
                <p class="recent-section-desc"><?php echo nl2br( $gridShowcaseDesc[$pt_section_i] ); ?></p>
            <?php endif; ?>

            <div class="grid-showcase-row">
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
                        if ( $gridShowcaseOpen[$pt_section_i] == 'lightbox'){ 
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
                        <li class="grid-showcase-col folio-item">
                            <a href="<?php echo $folio_link; ?>" title="<?php the_title_attribute(); ?>"<?php echo $folio_rel; ?>>
                                
                                <?php /* THUMBNAILS TEMPLATE
                                ============================================*/
                                get_template_part( 'includes/grid-showcase-thumbs' );
                                ?>

                                <div class="folio-overlay">
                                    <div class="folio-title">
                                        <h2><?php the_title(); ?></h2>
                                        <?php if( count($folio_cats) > 1 ){ echo '<h3>'.$cat_name.'</h3>'; } ?>
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