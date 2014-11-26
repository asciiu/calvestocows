<?php
$cats = get_the_terms( $post->ID, 'portfolio_cats' ); 
if ($cats):  
    $cat_ids = array();
    foreach($cats as $individual_cat)
        $cat_ids[] = $individual_cat->term_id;

    $args=array(  
        'post__not_in'        => array($post->ID),
        'showposts'           => 4,
        'order'               => 'DESC',
        'orderby'             => 'date',
        'ignore_sticky_posts' => 1,
        'tax_query'           => array(
            array(
                'taxonomy' => 'portfolio_cats',
                'field'    => 'id',
                'terms'    => $cat_ids,
                'operator' => 'IN'
            )
        )
    );

    $original_query = $wp_query;
    $wp_query = null;
    $wp_query = new WP_Query( $args );
    if ( $wp_query->have_posts() ):
    ?>
        <!-- SIMILAR WORK
        ====================================== -->
        <div id="related-posts" class="clearfix">
            <h3 class="section-heading"><span><?php if ( of_get_option('similar_heading') ){ echo of_get_option('similar_heading'); } else { _e('Similar Work', 'premitheme'); } ?></span></h3>
            <ul class="clearfix">
                <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                    <li class="related-entry">
                        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                            <div class="related-thumb">
                                <?php if ( has_post_thumbnail()):
                                    $image = premitheme_image( $post->ID, '', premitheme_img_size('related-standard'));
                                    $altAttr = get_post_meta( get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true);
                                ?>
                                    <img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" title="<?php the_title_attribute(); ?>" alt="<?php echo $altAttr; ?>"/>
                                <?php else: ?>
                                    <img src="<?php echo get_template_directory_uri();?>/images/no-image/380x200.jpg" alt="No Image"/>
                                <?php endif; ?>
                            </div><!-- .related-thumb -->
                            <h6 class="related-title"><?php the_title(); ?></h6>
                        </a>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
    <?php endif;
    $wp_query = null;
    $wp_query = $original_query;
    wp_reset_postdata();
endif;