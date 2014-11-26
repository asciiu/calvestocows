<?php 
/* Template name: Full-width page */
get_header(); ?>
        <?php while ( have_posts() ) : the_post(); ?>

        <div id="page-title" class="container alpha omega">
            <h1><?php the_title(); ?></h1>
        </div><!-- #page-title -->

        <div id="content-container" class="fullwidth-container">
            <div id="content" class="container padding-top">
                <?php if ( has_post_thumbnail()): ?>
                    <div class="container alpha omega page-thumb">
                        <?php
                        $altAttr = get_post_meta( get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true);
                        $image = premitheme_image( $post->ID, '', premitheme_img_size('page-standard'));
                        ?>
                        <img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" title="<?php the_title_attribute(); ?>" alt="<?php echo $altAttr; ?>"/>
                    </div>
                <?php endif; ?>
                
                <div id="main" class="grid_12 columns padding-bottom">
                    <article id="post-<?php the_ID();?>" <?php post_class('entry-wrapper clearfix');?>>
                        <div class="entry-content">
                            <?php the_content(); ?>
                            <?php wp_link_pages( array( 'before' => '<p><span><strong>' . __( 'Pages: ', 'premitheme' ) . '</strong></span>', 'after' => '</p>' ) ); ?>
                            <?php edit_post_link( __( 'Edit', 'premitheme'), '<div class="entry-meta edit-link">', '</div>' ); ?>
                        </div>
                    </article>

                    <?php endwhile; ?>

                    <?php /* COMMENTS
                    ======================================*/
                    if( of_get_option('pages_comments') && ( comments_open() || have_comments() ) )
                        comments_template( '', true );
                    ?>
                </div>
            </div><!-- #content -->
        </div>
<?php get_footer(); ?>