<?php 
/* Template name: Home page - Fullsceen Slideshow */

$homeSlideshowImgs = get_post_meta($post->ID, "home_slideshow_imgs", true);
$homeSlideshowMessage = get_post_meta($post->ID, "home_slideshow_message", true);
$homeSlideshowSocial = get_post_meta($post->ID, "home_slideshow_social", true);
$contentSections = get_post_meta($post->ID, "section_select", true);
$sections = premitheme_home_has_sections();
$social = premitheme_social_links("circle");

$captionAnimation = '';
if( $sections ){
    $captionAnimation = '  data-0="opacity:1; margin-bottom:0px; -webkit-transform: scale(1); -moz-transform:scale(1); -ms-transform:scale(1); -o-transform:scale(1); transform:scale(1);" data--180-top="opacity:0; margin-bottom:-120px; -webkit-transform: scale(0.8); -moz-transform:scale(0.8); -ms-transform:scale(0.8); -o-transform:scale(0.8); transform:scale(0.8);"';
}

get_header(); ?>
        <?php while ( have_posts() ) : the_post(); ?>

        <div id="slideshow-screen" class="fullwidth-container">
            <div class="screen-inner container alpha omega"<?php echo $captionAnimation; ?>>
                <?php if($homeSlideshowMessage): ?>
                    <h1><?php echo nl2br($homeSlideshowMessage); ?></h1>
                <?php endif; ?>

                <?php if ( $homeSlideshowSocial == '1' && $social ): ?>
                    <div class="social-sep"></div>
                    <ul class="social-wrapper">
                        <?php echo $social; ?>
                        <li class="clear"></li>
                    </ul>
                <?php endif; ?>
            </div>

            <?php if( $sections ): ?>
                <div id="bouncing-arrow" data-0="opacity:1" data-50="opacity:0"><i class="fa fa-angle-down first"></i><i class="fa fa-angle-down second"></i><i class="fa fa-angle-down"></i></div>
            <?php endif; ?>
        </div>

        <?php if( $sections ): ?>
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
        <?php endif; ?>
        <?php endwhile; ?>

<?php get_footer(); ?>