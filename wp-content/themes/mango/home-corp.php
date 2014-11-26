<?php 
/* Template name: Home page - Corporate */

$contentSections = get_post_meta($post->ID, "section_select", true);

get_header(); ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <div id="content-container" class="fullwidth-container">
                <div id="content" class="container padding-top">
                    <div id="main" class="grid_12 columns">
                        <article id="post-<?php the_ID();?>" <?php post_class('entry-wrapper clearfix');?>>
                            <?php /* CONTENT SCTIONS
                            =======================================================*/
                            $pt_section_i = 0;
                            foreach( $contentSections as $section ):
                                if( $section == 'callout-message' ){
                                    get_template_part( 'includes/callout-message' );
                                } elseif( $section == 'flex-slider' ){
                                    get_template_part( 'includes/flex-slider' );
                                } elseif( $section == 'video-banner' ){
                                    get_template_part( 'includes/video-banner' );
                                } elseif( $section == 'fixed-image' ){
                                    get_template_part( 'includes/fixed-image' );
                                } elseif( $section == 'recent-work-row' ){
                                    get_template_part( 'includes/recent-work' );
                                } elseif( $section == 'recent-posts-row' ){
                                    get_template_part( 'includes/recent-posts' );
                                } elseif( $section == 'clients' ){
                                    get_template_part( 'includes/clients' );
                                } elseif( $section == 'twitter' ){
                                    get_template_part( 'includes/twitter-feed' );
                                } elseif( $section == 'grid-showcase' ){
                                    get_template_part( 'includes/grid-showcase' );
                                } elseif( $section == 'custom' ){
                                ?>
                                    <?php if(trim($post->post_content) != '' ): ?>
                                        <!-- PAGE CONTENT
                                        ====================================== -->
                                        <div class="entry-content padding-top padding-bottom clearfix">
                                            <?php the_content(); ?>
                                            <?php wp_link_pages( array( 'before' => '<p><span>' . __( 'Pages:', 'premitheme' ) . '</span>', 'after' => '</p>' ) ); ?>
                                        </div>
                                    <?php endif; ?>
                                <?php } 
                                $pt_section_i++;
                            endforeach;
                            ?>
                        </article>
                    </div>
                </div><!-- #content -->
            </div>
        <?php endwhile; ?>

<?php get_footer(); ?>