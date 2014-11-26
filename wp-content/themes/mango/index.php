<?php get_header(); ?>
        <?php if ( is_search() ) : ?>
            <!-- SEARCH TITLE
            ==================== -->
            <div id="page-title" class="container alpha omega">
                <h1><?php printf( __( 'Search Results for: %s', 'premitheme' ), get_search_query() ); ?></h1>
            </div><!-- #page-title -->
        
        <?php elseif ( is_author() ) : the_post(); ?>
            <!-- AUTHOR TITLE
            ==================== -->
            <div id="page-title" class="container alpha omega">
                <h1>
                    <?php if ( of_get_option('blog_title') ) echo of_get_option('blog_title').': ';
                    printf( __( 'Author: %s', 'premitheme' ), get_the_author() );
                    ?>
                </h1>
            </div><!-- #page-title -->
            <?php rewind_posts(); ?>
        
        <?php elseif ( is_category() ) : ?>
            <!-- CATEGORY TITLE
            ==================== -->
            <div id="page-title" class="container alpha omega">
                <h1>
                    <?php if ( of_get_option('blog_title') ) echo of_get_option('blog_title').': ';
                    _e( 'Category: ', 'premitheme' ). single_cat_title();
                    ?>
                </h1>
            </div><!-- #page-title -->
        
        <?php elseif ( is_tag() ) : ?>
            <!-- TAG TITLE
            ==================== -->
            <div id="page-title" class="container alpha omega">
                <h1>
                    <?php if ( of_get_option('blog_title') ) echo of_get_option('blog_title').': ';
                    _e( 'Tag: ', 'premitheme' ). single_tag_title();
                    ?>
                </h1>
            </div><!-- #page-title -->
        
        <?php elseif ( is_archive() ) : ?>
            <!-- ARCHIVE TITLE
            ==================== -->
            <div id="page-title" class="container alpha omega">
                <h1>
                    <?php if ( of_get_option('blog_title') ) echo of_get_option('blog_title').': ';
                        if ( is_day() ):
                            printf( __( 'Daily Archives: %s', 'premitheme' ), get_the_date() );
                        elseif ( is_month() ):
                            printf( __( 'Monthly Archives: %s', 'premitheme' ), get_the_date( 'F, Y' ) );
                        elseif ( is_year() ):
                            printf( __( 'Yearly Archives: %s', 'premitheme' ), get_the_date( 'Y' ) );
                        else:
                            _e( 'Archives: ', 'premitheme' );
                        endif;
                    ?>
                </h1>
            </div><!-- #page-title -->
        <?php elseif( is_home() && of_get_option('blog_title') ): ?>
            <!-- BLOG TITLE
            ==================== -->
            <div id="page-title" class="container alpha omega">
                <h1><?php echo of_get_option('blog_title'); ?></h1>
            </div><!-- #page-title -->
        <?php endif; ?>

        <div id="content-container" class="fullwidth-container">
            <div id="content" class="container padding-top">
                <div id="main" class="grid_9 columns padding-bottom">
                    <?php /* IF THERE'S ANY POSTS, SHOW THEM ...
                    ============================================*/
                    if ( have_posts() ):
                        while ( have_posts() ) : the_post();
                    ?>
                    
                            <article id="post-<?php the_ID();?>" <?php post_class('entry-wrapper clearfix');?>>
                                <div class="post-meta">
                                    <div class="entry-date" title="<?php echo get_the_time(); ?>"><span><?php echo get_the_date('d'); ?></span> <?php echo get_the_date('M'); ?></div>

                                    <?php if ( is_sticky() ):?>
                                        <div class="sticky-label"><?php _e('Featured', 'premitheme'); ?></div>
                                    <?php endif; ?>
                                </div>

                                <div class="post-content">
                                    <?php /* POST FORMATS
                                    ======================================================*/
                                    $pt_origWidth = 600;
                                    $pt_ratio = 1;
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

                        <?php endwhile;

                        /* PAGINATION
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

                    <?php endif; ?>
                </div>
                
                <?php get_sidebar(); ?>
            </div><!-- #content -->
        </div>
<?php get_footer(); ?>