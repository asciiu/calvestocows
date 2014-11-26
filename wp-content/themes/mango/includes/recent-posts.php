<?php
/* The template for displaying recent posts content section */

global $pt_section_i;
$recentPostsLabel = get_post_meta($post->ID, "recent_posts_label", true);
$recentPostsDesc = get_post_meta($post->ID, "recent_posts_desc", true);
$recentPostsLink = get_post_meta($post->ID, "recent_posts_link", true);
$recentPostsCat = get_post_meta($post->ID, "recent_posts_cat", true);
$recentPostsOrderby = get_post_meta($post->ID, "recent_posts_orderby", true);
$recentPostsOrder = get_post_meta($post->ID, "recent_posts_order", true);

if( !$recentPostsLabel[$pt_section_i] ) $recentPostsLabel[$pt_section_i] = __('Recent Posts', 'premitheme');

if( $recentPostsCat[$pt_section_i] == 'all' ):
    $args = array(
        'posts_per_page' => 9,
        'order'          => $recentPostsOrder[$pt_section_i],
        'orderby'        => $recentPostsOrderby[$pt_section_i],
        'ignore_sticky_posts' => 1,
        'tax_query'           => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'post_format',
                'field'    => 'slug',
                'terms'    => 'post-format-status',
                'operator' => 'NOT IN'
            ),
            array(
                'taxonomy' => 'post_format',
                'field'    => 'slug',
                'terms'    => 'post-format-aside',
                'operator' => 'NOT IN'
            )
        )
    );
else:
    $args = array(
        'posts_per_page' => 3,
        'order'          => $recentPostsOrder[$pt_section_i],
        'orderby'        => $recentPostsOrderby[$pt_section_i],
        'cat' => $recentPostsCat[$pt_section_i],
        'ignore_sticky_posts' => 1,
        'tax_query'           => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'post_format',
                'field'    => 'slug',
                'terms'    => 'post-format-status',
                'operator' => 'NOT IN'
            ),
            array(
                'taxonomy' => 'post_format',
                'field'    => 'slug',
                'terms'    => 'post-format-aside',
                'operator' => 'NOT IN'
            )
        )
    );
endif;

$original_query = $wp_query;
$wp_query = null;
$wp_query = new WP_Query( $args );
if ( $wp_query->have_posts() ):
    ?>
        <!-- RECENT POSTS
        ====================================== -->
        <div class="recent-posts recent-section padding-bottom clearfix">
            <h3 class="home-section-heading"><span><?php echo $recentPostsLabel[$pt_section_i]; ?></span></h3>

            <?php if( $recentPostsDesc[$pt_section_i] ): ?>
                <p class="recent-section-desc"><?php echo nl2br( $recentPostsDesc[$pt_section_i] ); ?></p>
            <?php endif; ?>

            <?php if( $recentPostsLink[$pt_section_i] ): ?>
                <a class="desc-link" href="<?php echo $recentPostsLink[$pt_section_i]; ?>"><?php _e('View all', 'premitheme'); ?></a>
            <?php endif; ?>

            <div class="recent-posts-row column alpha omega">
                <ul>
                    <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                        <li class="recent-post-wrapper">
                            <div class="recent-post">
                                <div class="recent-post-meta clearfix">
                                    <div class="entry-date" title="<?php echo get_the_time(); ?>"><span><?php echo get_the_date('d'); ?></span> <?php echo get_the_date('M'); ?></div>
                                    <?php if( of_get_option('posts_comments') && comments_open() ): ?>
                                        <div class="recent-entry-comments"><i class="fa fa-comment"></i> <?php comments_popup_link( __( '0', 'premitheme' ), __( '1', 'premitheme' ), __('%', 'premitheme'), 'comments-link' ); ?></div>
                                    <?php endif; ?>
                                </div>

                                <a class="blog-thumb" href="<?php the_permalink(); ?>"  title="<?php the_title_attribute(); ?>">
                                    <?php if ( has_post_thumbnail() ):
                                        $altAttr = get_post_meta( get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true);
                                        $image = premitheme_image( $post->ID, '', premitheme_img_size('recent-posts'));
                                    ?>
                                        <img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" title="<?php the_title_attribute(); ?>" alt="<?php echo $altAttr; ?>"/>
                                    <?php else: ?>
                                        <img src="<?php echo get_template_directory_uri();?>/images/no-image/392x164.jpg" alt="No Image"/>
                                    <?php endif; ?>
                                </a>

                                <div class="recent-post-content padding-bottom">
                                    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <?php the_excerpt(); ?>
                                </div>
                            </div>
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