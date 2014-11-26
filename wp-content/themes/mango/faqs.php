<?php 
/* Template name: FAQs page */

$pt_faqs_group = get_post_meta($post->ID, 'faqs_group', TRUE);
$faqs_style = get_post_meta($post->ID, 'faqs_style', TRUE);
$faqs_layout = get_post_meta($post->ID, 'faqs_layout', TRUE);
$pt_faqs_orderby = get_post_meta($post->ID, 'faqs_orderby', TRUE);
$pt_faqs_order = get_post_meta($post->ID, 'faqs_order', TRUE);

if ( $faqs_layout == 'sidebar' ){
    $grid_class = 'grid_9';
} else {
    $grid_class = 'grid_12';
}

if ( $pt_faqs_group == 'all' ):
    $args = array(
        'hide_empty'   => 1,
        'hierarchical' => 0,
        'taxonomy'     => 'faq_groups'
    );
    $pt_faq_groups = get_categories($args);
else:
    $pt_faq_groups = get_categories('taxonomy=faq_groups&child_of='.$pt_faqs_group);
endif;

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
                
                <div id="main" class="<?php echo $grid_class; ?> columns padding-bottom">
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

                        <!-- ACTUAL FAQs
                        ====================================== -->
                        <?php
                        if (  $faqs_style == 'accordion' ){
                            get_template_part( 'includes/faqs-accordion' );
                        } else {
                            get_template_part( 'includes/faqs-normal' );
                        }
                        ?>
                    </article>

                    <?php endwhile; ?>
                </div>

                <?php /* GET THE SIDEBAR FROM "sidebar-portfolio.php" or "sidebar.php"
                ======================================================================*/
                if ( $faqs_layout == 'sidebar' )
                    if ( is_active_sidebar( 'sidebar-5' ) )
                        get_sidebar('faqs');
                    else
                        get_sidebar();
                ?>
            </div><!-- #content -->
        </div>
<?php get_footer(); ?>