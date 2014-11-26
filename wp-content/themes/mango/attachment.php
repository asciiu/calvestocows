<?php get_header(); ?>
        <?php while ( have_posts() ) : the_post(); ?>
        <!-- BLOG POST TITLE
        ====================================== -->
        <div id="page-title" class="container alpha omega">
                <h1><?php _e('Attachment: ', 'premitheme') . the_title(); ?></h1>
        </div><!-- #page-title -->

        <div id="content-container" class="fullwidth-container">
            <div id="content" class="container padding-top">
                <div id="main" class="grid_9 columns padding-bottom">
                    <article id="post-<?php the_ID();?>" <?php post_class('entry-wrapper clearfix');?>>
                        <div class="post-meta">
                            <div class="entry-date" title="<?php echo get_the_time(); ?>"><span><?php echo get_the_date('d'); ?></span> <?php echo get_the_date('M'); ?></div>
                            <?php if( of_get_option('sharing_on') ): ?>
                                <!-- VERTICAL SHARING LINKS
                                ====================================== -->
                                <div id="sharing-btns-ver">
                                    <?php get_template_part('includes/sharing-btns'); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="post-content">
                            <?php
                            $altAttr = get_post_meta( get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true);
                            $thumbnail_id = get_post_meta( $post->ID, '_thumbnail_id', true );
                            list($link) = wp_get_attachment_image_src( $thumbnail_id, 'full' );
                            $image = premitheme_image( $post->ID, '', array(600, '') );
                            ?>

                            <a href="<?php echo $link; ?>" title="<?php the_title_attribute(); ?>">
                                <img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" title="<?php the_title_attribute(); ?>" alt="<?php echo $altAttr; ?>"/>
                            </a>

                            <?php if( of_get_option('sharing_on') ): ?>
                                <!-- HORIZONTAL SHARING LINKS
                                ====================================== -->
                                <div id="sharing-btns-hor">
                                    <?php get_template_part('includes/sharing-btns'); ?>
                                </div>
                            <?php endif; ?>

                            <?php endwhile; ?>
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