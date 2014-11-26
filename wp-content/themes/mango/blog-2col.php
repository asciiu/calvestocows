<?php 
/* Template name: Blog page - 2 columns */
get_header(); ?>
        <?php while ( have_posts() ) : the_post(); // MAIN PAGE QUERY START ?>

        <div id="page-title" class="container alpha omega">
            <h1><?php the_title(); ?></h1>
        </div><!-- #page-title -->

        <div id="content-container" class="fullwidth-container">
            <div id="content" class="container padding-top">
                <div id="main" class="grid_9 columns padding-bottom">
                    <ul class="clearfix">
                        <?php /* BLOG QUERY START
                        ============================*/
                        if ( get_query_var('paged') ) {
                            $paged = get_query_var('paged');
                        } else if ( get_query_var('page') ) {
                            $paged = get_query_var('page');
                        } else {
                            $paged = 1;
                        }

                        $args = array(
                            'paged' => $paged,
                            'posts_per_page' => get_option('posts_per_page'),
                            'post_type' => 'post'
                        );

                        $pt_origWidth = 327;
                        $pt_ratio = 0.545;

                        $original_query = $wp_query;
                        $wp_query = null;
                        $wp_query = new WP_Query( $args );

                        /* IF THERE'S ANY POSTS, SHOW THEM ...
                        ============================================*/
                        if ($wp_query->have_posts()):
                            while ($wp_query->have_posts()): $wp_query->the_post();
                        ?>
                            <li <?php post_class('entry-wrapper clearfix');?>>
                                <article id="post-<?php the_ID();?>">
                                    <div class="post-meta">
                                        <div class="entry-date" title="<?php echo get_the_time(); ?>"><span><?php echo get_the_date('d'); ?></span> <?php echo get_the_date('M'); ?></div>

                                        <?php if ( is_sticky() ):?>
                                            <div class="sticky-label"><?php _e('Featured', 'premitheme'); ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="post-content">
                                        <?php /* POST FORMATS
                                        ======================================================*/
                                        get_template_part( 'includes/content', get_post_format() ); ?>

                                        <?php if( !is_home() ): ?>
                                            <!-- ENTRY META
                                            ====================================== -->
                                            <div class="entry-meta lower">
                                                <div class="posted-in"><?php printf( __('Posted in %s','premitheme' ), get_the_category_list(', ') );?></div>
                                                <?php echo get_the_tag_list( '<div class="tagged">' . __('Tagged ','premitheme' ), ', ', '</div>' ); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </article>
                            </li>
                            <?php endwhile; ?>
                        </ul>

                        <?php /* PAGINATION
                        ============================================*/
                        premitheme_pagination();

                        /* ... OTHERWISE, SHOW THIS MESSAGE INSTEAD
                        ============================================*/
                        else: ?>

                        <article id="post-0" class="entry-wrapper">
                            <h2 class="entry-title"><?php _e('Nothing found', 'premitheme'); ?></h2>
                            <div class="entry-content">
                                <p><?php _e('Sorry, no posts were found.', 'premitheme'); ?></p>
                            </div>
                            <?php get_search_form(); ?>
                        </article>

                        <?php /* BLOG QUERY END & RESET QUERY
                        ============================================*/
                        endif; // have_posts()
                        $wp_query = null;
                        $wp_query = $original_query;
                        wp_reset_postdata();
                        ?>
                    <?php endwhile; // MAIN PAGE QUERY END ?>
                </div>

                <?php get_sidebar(); ?>
            </div><!-- #content -->
        </div>
<?php get_footer(); ?>