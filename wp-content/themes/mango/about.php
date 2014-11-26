<?php 
/* Template name: About page */

$show_team = get_post_meta($post->ID, 'show_team', TRUE);
$team_label = get_post_meta($post->ID, 'team_label', TRUE);
$members_orderby = get_post_meta($post->ID, 'members_orderby', TRUE);
$members_order = get_post_meta($post->ID, 'members_order', TRUE);

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
                        <?php if( trim($post->post_content) != '' ): ?>
                            <!-- PAGE CONTENT
                            ====================================== -->
                            <div class="entry-content">
                                <?php the_content(); ?>
                                <?php wp_link_pages( array( 'before' => '<p><span><strong>' . __( 'Pages: ', 'premitheme' ) . '</strong></span>', 'after' => '</p>' ) ); ?>
                                <?php edit_post_link( __( 'Edit', 'premitheme'), '<div class="entry-meta edit-link">', '</div>' ); ?>
                            </div>
                        <?php endif; ?>

                        <?php if( $show_team == '1' ): ?>
                            <?php /* TEAM MEMBERS 
                            ====================================*/
                            $args = array(
                                    'nopaging'       => TRUE,
                                    'order'          => $members_order,
                                    'orderby'        => $members_orderby,
                                    'post_type'      => 'team'
                                );
                            $original_query = $wp_query;
                            $wp_query = null;
                            $wp_query = new WP_Query( $args );
                            if ($wp_query->have_posts()):
                            ?>
                                <div id="work-team">
                                    <?php if( $team_label ): ?>
                                        <h3 id="team-title" class="section-heading"><span><?php echo $team_label; ?></span></h3>
                                    <?php endif; ?>
                                    <ul class="clearfix">
                                        <?php while ($wp_query->have_posts()) : $wp_query->the_post();
                                            $altAttr = get_post_meta( get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true);
                                            $src = get_post_meta($post->ID, 'team_member_img', TRUE);
                                            $image = premitheme_image( '', $src, array(164, 164) );

                                            $memberRole = get_post_meta($post->ID, 'team_member_role', TRUE);

                                            $memberBio = get_post_meta($post->ID, 'team_member_bio', TRUE);
                                            $memberBio_decode = htmlspecialchars_decode($memberBio);
                                            $memberBio_final = do_shortcode($memberBio_decode);

                                            $memberSocial = premitheme_team_member_social_links($post->ID, "round");
                                        ?>
                                            <li <?php post_class('team-member-wrapper');?>>
                                                <div class="team-member-photo">
                                                    <?php if ( isset( $image[0] ) ): ?>
                                                        <img src="<?php echo $image[0]; ?>" alt="<?php echo $altAttr; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" title="<?php the_title_attribute(); ?>"/>
                                                    <?php else: ?>
                                                        <img src="<?php echo get_template_directory_uri();?>/images/no-image/185x185.jpg" alt="No Image"/>
                                                    <?php endif; ?>
                                                </div>

                                                <div class="team-member-info">
                                                    <h3 class="team-member-name"><?php the_title(); ?></h3>
                                                    <h4 class="team-member-role"><?php echo $memberRole; ?></h4>
                                                    <div class="team-member-bio">
                                                        <?php echo wpautop($memberBio_final); ?>
                                                    </div>

                                                    <ul class="team-member-links social-wrapper clearfix">
                                                        <?php if($memberSocial): ?>
                                                            <?php echo $memberSocial; ?>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                            </li>
                                        <?php endwhile; ?>
                                    </ul>
                                </div>
                            <?php
                            endif;
                            $wp_query = null;
                            $wp_query = $original_query;
                            wp_reset_postdata();
                            ?>
                        <?php endif; ?>
                    </article>

                    <?php endwhile; ?>

                    <?php /* COMMENTS
                    ======================================*/
                    if( of_get_option('pages_comments') )
                        comments_template( '', true );
                    ?>
                </div>
            </div><!-- #content -->
        </div>
<?php get_footer(); ?>