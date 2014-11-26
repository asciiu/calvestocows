<?php get_header(); ?>
        <?php while ( have_posts() ) : the_post(); ?>
        <!-- BLOG POST TITLE
        ====================================== -->
        <div id="page-title" class="container alpha omega">
            <?php if( get_post_format() == 'aside' ): ?>
                <h1 class="visually-hidden"><?php _e('Aside: ', 'premitheme') . the_title(); ?></h1>
            <?php elseif( get_post_format() == 'status' ): ?>
                <h1 class="visually-hidden"><?php _e('Status: ', 'premitheme') . the_title(); ?></h1>
            <?php elseif( get_post_format() == 'link' ): ?>
                <h1 class="visually-hidden"><?php _e('Link: ', 'premitheme') . the_title(); ?></h1>
            <?php elseif( get_post_format() == 'quote' ): ?>
                <h1 class="visually-hidden"><?php _e('Quote: ', 'premitheme') . the_title(); ?></h1>
            <?php elseif( get_post_format() == 'gallery' ): ?>
                <h1><?php _e('Gallery: ', 'premitheme') . the_title(); ?></h1>
            <?php elseif( get_post_format() == 'video' ): ?>
                <h1><?php _e('Video: ', 'premitheme') . the_title(); ?></h1>
            <?php elseif( get_post_format() == 'audio' ): ?>
                <h1><?php _e('Audio: ', 'premitheme') . the_title(); ?></h1>
            <?php else: ?>
                <h1><?php the_title(); ?></h1>
            <?php endif; ?>
        </div><!-- #page-title -->

        <div id="content-container" class="fullwidth-container">
            <div id="content" class="container padding-top">
                <div id="main" class="grid_9 columns padding-bottom">
                    <article id="post-<?php the_ID();?>" <?php post_class('entry-wrapper clearfix');?>>
                        <div class="post-meta">
                            <div class="entry-date" title="<?php echo get_the_time(); ?>"><span><?php echo get_the_date('d'); ?></span> <?php echo get_the_date('M'); ?></div>

                            <?php if ( is_sticky() ):?>
                                <div class="sticky-label"><?php _e('Featured', 'premitheme'); ?></div>
                            <?php endif; ?>

                            <?php if( of_get_option('sharing_on') ): ?>
                                <!-- VERTICAL SHARING LINKS
                                ====================================== -->
                                <div id="sharing-btns-ver">
                                    <?php get_template_part('includes/sharing-btns'); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="post-content">
                            <?php /* POST FORMATS
                            ======================================================*/
                            $pt_origWidth = 600;
                            $pt_ratio = 1;
                            get_template_part( 'includes/content', get_post_format() ); ?>

                            <?php if( of_get_option('sharing_on') ): ?>
                                <!-- HORIZONTAL SHARING LINKS
                                ====================================== -->
                                <div id="sharing-btns-hor">
                                    <?php get_template_part('includes/sharing-btns'); ?>
                                </div>
                            <?php endif; ?>

                            <!-- ENTRY META
                            ====================================== -->
                            <div class="entry-meta lower">
                                <div class="posted-in"><?php printf( __('Posted in %s','premitheme' ), get_the_category_list(', ') );?></div>
                                <?php echo get_the_tag_list( '<div class="tagged">' . __('Tagged ','premitheme' ), ', ', '</div>' ); ?>
                            </div>

                            <?php /* ABOUT AUTHOR SECTION
                            ======================================================*/
                            if ( get_the_author_meta( 'description' ) ) :
                                $author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
                            ?>
                                <!-- ABOUT AUTHOR
                                ====================================== -->
                                <div id="author-info" claa="clearfix">
                                    <div class="author-avatar">
                                        <?php echo get_avatar( get_the_author_meta( 'user_email' ), 80); ?>
                                    </div><!-- .author-avatar -->

                                    <div class="author-content">
                                        <h3><span><?php _e('Written by', 'premitheme'); ?></span> <a title="<?php printf( __( 'All posts by %s', 'premitheme' ), get_the_author() ); ?>" href="<?php echo $author_url; ?>"><?php echo get_the_author(); ?></a></h3>

                                        <div class="author-description">
                                            <p><?php the_author_meta( 'description' ); ?></p>
                                        </div><!-- .author-description  -->
                                    </div>
                                </div><!-- .author-info -->
                            <?php endif; ?>

                            <!-- POSTS NAVIGATION
                            ====================================== -->
                            <div id="post-navigation" class="clearfix">
                                <div class="nav-previous"><?php previous_post_link( '%link', __( 'Previous post <i class="fa fa-arrow-right"></i>', 'premitheme' ) ); ?></div>
                                <div class="nav-next"><?php next_post_link( '%link', __( '<i class="fa fa-arrow-left"></i> Next post', 'premitheme' ) ); ?></div>
                            </div>

                            <?php endwhile; ?>

                            <?php /* RELATE POSTS
                            ======================================*/
                            if( of_get_option('show_related') )
                                get_template_part('includes/related-posts');
                            ?>

                            <?php /* COMMENTS
                            ======================================*/
                            if( of_get_option('posts_comments') && ( comments_open() || have_comments() ) )
                                comments_template( '', true );
                            ?>
                        </div>
                    </article>
                </div>
                
                <?php /* GET THE SIDEBAR FROM "sidebar-single.php" or "sidebar.php"
                ======================================================================*/
                if ( is_active_sidebar( 'sidebar-2' ) )
                    get_sidebar('single');
                else
                    get_sidebar();
                ?>
            </div><!-- #content -->
        </div>
<?php get_footer(); ?>