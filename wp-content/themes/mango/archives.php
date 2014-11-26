<?php 
/* Template name: Archives page */
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
                
                <div id="main" class="grid_9 columns padding-bottom">
                    <article id="post-<?php the_ID();?>" <?php post_class('entry-wrapper clearfix');?>>
                        <?php if( trim($post->post_content) != '' ): ?>
                            <!-- PAGE CONTENT
                            ====================================== -->
                            <div class="entry-content">
                                <?php the_content(); ?>
                                <?php wp_link_pages( array( 'before' => '<p><span><strong>' . __( 'Pages: ', 'premitheme' ) . '</strong></span>', 'after' => '</p>' ) ); ?>
                                <?php edit_post_link( __( 'Edit', 'premitheme'), '<div class="entry-meta edit-link">', '</div>' ); ?>
                            </div>
                        <?php endif; ?>

                        <div class="archives-section last-posts clearfix">
                            <h3><?php _e('Latest posts on the blog', 'premitheme');?></h3>
                            <ol>
                                <?php wp_get_archives( 'type=postbypost&limit=30' ); ?>
                            </ol>
                        </div>

                        <div class="archives-section by-category clearfix">
                            <h3><?php _e('Categories', 'premitheme');?></h3>
                            <ul>
                                <?php wp_list_categories( 'title_li=&show_count=1' ); ?>
                            </ul>
                        </div>

                        <div class="archives-section by-month clearfix">
                            <h3><?php _e('Monthly Archives', 'premitheme');?></h3>
                            <ul>
                                <?php wp_get_archives( 'type=monthly&limit=12&show_post_count=1' ); ?>
                            </ul>
                        </div>

                        <div class="archives-section by-author clearfix">
                            <h3><?php _e('Authors', 'premitheme');?></h3>
                            <ul>
                                <?php wp_list_authors( 'optioncount=1' ); ?>
                            </ul>
                        </div>

                        <div class="archives-section by-tag clearfix">
                            <h3><?php _e('Tags', 'premitheme');?></h3>
                            <?php wp_tag_cloud(); ?>
                        </div>
                    </article>

                    <?php endwhile; ?>
                </div>

                <?php get_sidebar(); ?>
            </div><!-- #content -->
        </div>
<?php get_footer(); ?>