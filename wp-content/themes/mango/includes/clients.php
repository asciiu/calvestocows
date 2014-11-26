<?php
/* The template for displaying clients content section */

global $pt_section_i;
$clientsLabel =  get_post_meta($post->ID, 'clients_label', TRUE);
$clientsDesc =  get_post_meta($post->ID, 'clients_desc', TRUE);
$clientsOrderby =  get_post_meta($post->ID, 'clients_orderby', TRUE);
$clientsOrder =  get_post_meta($post->ID, 'clients_order', TRUE);

$clientsCount = wp_count_posts('clients');
$count = $clientsCount->publish;
if($count > 5){
    $col_class = 6;
} else {
    $col_class = $count;
}

if( !$clientsLabel[$pt_section_i] ) $clientsLabel[$pt_section_i] = __('Clients', 'premitheme');

$args = array(
    'posts_per_page' => -1,
    'order' => $clientsOrder[$pt_section_i],
    'orderby' => $clientsOrderby[$pt_section_i],
    'post_type' => 'clients'
);

$original_query = $wp_query;
$wp_query = null;
$wp_query = new WP_Query( $args );
if ( $wp_query->have_posts() ):
    ?>
        <!-- CLIENTS
        ====================================== -->
        <div class="clients-section padding-bottom clearfix">
            <h3 class="home-section-heading"><span><?php echo $clientsLabel[$pt_section_i]; ?></span></h3>

            <?php if( $clientsDesc[$pt_section_i] ): ?>
                <p class="recent-section-desc"><?php echo nl2br( $clientsDesc[$pt_section_i] ); ?></p>
            <?php endif; ?>

            <ul class="clients-list col-<?php echo $col_class; ?>col clearfix">
                <?php while ($wp_query->have_posts()) : $wp_query->the_post();
                    $src = get_post_meta($post->ID, 'client_img', TRUE);
                    $imgID = premitheme_get_attachment_id_by_src($src);
                    $altAttr = get_post_meta( $imgID, '_wp_attachment_image_alt', true);
                    $clientImgTitle = get_post_meta($post->ID, 'client_img_title', TRUE);
                    $clientLink = get_post_meta($post->ID, 'client_img_link', TRUE);
                    $image = premitheme_image( '', $src, premitheme_img_size('client-thumb'));
                ?>
                    <li class="client-entry">
                        <div class="client-thumb">
                            <?php if( $clientLink ): ?><a href="<?php echo $clientLink; ?>" target="_blank"><?php endif; ?>
                                <img src="<?php echo $image[0]; ?>" alt="<?php echo $altAttr; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" title="<?php echo $clientImgTitle; ?>"/>
                            <?php if( $clientLink ): ?></a><?php endif; ?>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
    <?php
endif;
$wp_query = null;
$wp_query = $original_query;
wp_reset_postdata();