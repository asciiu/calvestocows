<?php
/* The template for displaying single portfolio items */

$folioParent = get_post_meta($post->ID, 'folio_parent', TRUE);
$folioLayout = get_post_meta($post->ID, 'folio_item_layout', TRUE);
$itemDate = get_post_meta($post->ID, 'folio_date', TRUE);
$clientLabel = get_post_meta($post->ID, 'folio_client_label', TRUE);
$clientName = get_post_meta($post->ID, 'folio_client_name', TRUE);
$skillsLabel = get_post_meta($post->ID, 'folio_skills_label', TRUE);
$skillsType = get_post_meta($post->ID, 'folio_skills_type', TRUE);
$liveLabel = get_post_meta($post->ID, 'folio_project_btn_text', TRUE);
$liveUrl = get_post_meta($post->ID, 'folio_project_btn_url', TRUE);
$prevImages = get_post_meta($post->ID, 'folio_preview_imgs', TRUE);
$prevHeight = get_post_meta($post->ID, 'folio_preview_imgs_height', TRUE);
$prevType = get_post_meta($post->ID, 'folio_preview_imgs_type', TRUE);
$prevNav = get_post_meta($post->ID, 'folio_preview_imgs_nav', TRUE);
$prevEffect = get_post_meta($post->ID, 'folio_preview_imgs_effect', TRUE);
$prevVidEmbed = get_post_meta($post->ID, 'folio_video_embed', TRUE);
$prevVidUrl = get_post_meta($post->ID, 'folio_video_url', TRUE);
$prevM4vPath = get_post_meta($post->ID, 'folio_video_mfourv', TRUE);
$prevOgvPath = get_post_meta($post->ID, 'folio_video_ogv', TRUE);
$videoPoster = get_post_meta($post->ID, 'folio_video_poster', TRUE);
$videoHeight = get_post_meta($post->ID, 'folio_video_height', TRUE);

if($folioLayout == 'fullwidth'){
    $prevClass = 'grid_12 alpha omega';
    $contentClass = 'grid_12 alpha omega';
    $prevWidth = '912';
} else {
    $prevClass = 'grid_8 omega';
    $contentClass = 'grid_4 alpha';
    $prevWidth = '600';
}

if($prevNav == 'thumbnails'){
    $prevNavOption = '"thumbnails"';
} else {
    $prevNavOption = true;
}

if($prevEffect == 'fade'){
    $prevEffectOption = '"fade"';
} else {
    $prevEffectOption = '"slide"';
}

$folio_cats =  get_the_terms( get_the_ID(), 'portfolio_cats' ); 
$cat_name = '';
$cats_names = array();
if( !empty($folio_cats) ):
    foreach( $folio_cats as $folio_cat ):
        $cats_names[] = $folio_cat->name;
    endforeach; 
    $cat_name = join( ', ', $cats_names );
endif;

$folio_skills =  get_the_terms( get_the_ID(), 'portfolio_skills' ); 
if ( $folio_skills && ! is_wp_error( $folio_skills ) ):
    $skills_names = array();
    foreach( $folio_skills as $folio_skill ):
        $skills_names[] = $folio_skill->name;
    endforeach; 
endif;

get_header(); ?>
        <?php while ( have_posts() ) : the_post(); ?>
        <!-- BLOG POST TITLE
        ====================================== -->
        <div id="page-title" class="container alpha omega">
            <h1><?php the_title(); ?></h1>
        </div><!-- #page-title -->

        <div id="content-container" class="fullwidth-container">
            <div id="content" class="container padding-top">
                <!-- FOLIO NAVIGATION
                ====================================== -->
                <div class="folio-navigation container alpha omega">
                    <div class="folio-nav-next" title="<?php _e('Next project', 'premitheme'); ?>">
                        <?php next_post_link( '%link', '<i class="fa fa-chevron-left"></i>' ); ?>
                    </div>

                    <?php if( of_get_option('folio_parent') != '' && (!$folioParent || $folioParent == 'global')): ?>
                        <div class="folio-nav-all" title="<?php _e('View all projects', 'premitheme'); ?>">
                            <a href="<?php echo get_permalink( of_get_option('folio_parent') ); ?>"><i class="fa fa-th"></i></a>
                        </div>
                    <?php elseif( $folioParent && $folioParent != 'global'): ?>
                        <div class="folio-nav-all" title="<?php _e('View all projects', 'premitheme'); ?>">
                            <a href="<?php echo get_permalink( $folioParent ); ?>"><i class="fa fa-th"></i></a>
                        </div>
                    <?php endif; ?>

                    <div class="folio-nav-previous" title="<?php _e('Previous project', 'premitheme'); ?>">
                        <?php previous_post_link( '%link', '<i class="fa fa-chevron-right"></i>' ); ?>
                    </div>
                </div><!-- .folio-navigation -->

                <div id="main" class="grid_12 columns padding-bottom">
                    <article id="post-<?php the_ID();?>" <?php post_class('entry-wrapper clearfix');?>>
                        <div class="<?php echo $prevClass; ?> columns folio-previews">
                            <!-- FOLIO PREVIEWS
                            ====================================== -->
                            <?php if( $prevVidEmbed ) :
                                $embed_code = htmlspecialchars_decode($prevVidEmbed);
                            ?>
                                <div class="entry-media remotely-hosted"><?php echo stripslashes( $embed_code ); ?></div>
                            <?php elseif( $prevVidUrl ):
                                $embed_code = wp_oembed_get($prevVidUrl, array('width'=>$prevWidth));
                            ?>
                                <div class="entry-media remotely-hosted"><?php echo $embed_code; ?></div>
                            <?php elseif ( $prevOgvPath && $prevM4vPath && $videoPoster && $videoHeight ): ?>
                                <script>
                                    jQuery(document).ready(function($){
                                        if(window.opera){
                                            var jSolution = "flash, html";
                                        } else {
                                            var jSolution = "html, flash";
                                        }
                                        
                                        $("#jquery-jplayer-<?php the_ID(); ?>").jPlayer({
                                            ready: function () {
                                                $(this).jPlayer("setMedia", {
                                                    m4v: "<?php echo $prevM4vPath; ?>",
                                                    ogv: "<?php echo $prevOgvPath; ?>",
                                                    poster: "<?php echo $videoPoster; ?>"
                                                });
                                            },
                                            swfPath: "<?php echo PT_JS; ?>",
                                            solution: jSolution,
                                            supplied: "ogv, m4v",
                                            cssSelectorAncestor: "#jp-gui-<?php the_ID(); ?>",
                                            wmode: "transparent",
                                            size: {
                                                width: "100%",
                                                height: "<?php echo $videoHeight; ?>px",
                                                cssClass: "jp-video"
                                            },
                                            errorAlerts: true,
                                            warningAlerts: true
                                        })
                                        .on($.jPlayer.event.play, function() { // Bind an event handler to the instance's play event.
                                            $(this).jPlayer("pauseOthers"); // pause all players except this one.
                                        });
                                    });
                                </script>

                                <div class="entry-media">
                                    <div class="jp-video-wrapper">
                                        <div class="jp-type-single">
                                            <div id="jquery-jplayer-<?php the_ID(); ?>" class="jp-jplayer" data-orig-width="<?php echo $prevWidth; ?>" data-orig-height="<?php echo $videoHeight; ?>"></div>
                                            <div id="jp-gui-<?php the_ID(); ?>" class="jp-gui">
                                                <div class="jp-video-play">
                                                    <a href="javascript:;" class="jp-video-play-icon" tabindex="1">Play</a>
                                                </div>
                                                <div class="jp-interface">
                                                    <div class="jp-interface-wrapper">
                                                        <div><a href="#" class="jp-play" tabindex="1"><i class="fa fa-play"></i></a></div>
                                                        <div><a href="#" class="jp-pause" tabindex="1"><i class="fa fa-pause"></i></a></div>
                                                        <div class="jp-time-wrapper">
                                                            <div class="jp-time">
                                                                <div class="jp-current-time"></div>
                                                                <div class="jp-time-sep">/</div>
                                                                <div class="jp-duration"></div>
                                                            </div>
                                                        </div>
                                                        <div class="jp-progress">
                                                            <div class="jp-seek-bar">
                                                                <div class="jp-play-bar"></div>
                                                            </div>
                                                        </div>
                                                        <div><a href="#" class="jp-mute" tabindex="1"><i class="fa fa-volume-up"></i></a></div>
                                                        <div><a href="#" class="jp-unmute" tabindex="1"><i class="fa fa-volume-off"></i></a></div>
                                                        <div class="jp-volume-bar">
                                                            <div class="jp-volume-bar-value"></div>
                                                        </div>
                                                    </div>
                                                </div><!-- .jp-interface -->
                                            </div><!-- .jp-gui -->
                                        </div><!-- .jp-type-single -->
                                    </div><!-- .jp-video-wrapper -->
                                </div><!-- .entry-media -->
                            <?php endif; ?>

                            <?php if( $prevImages ): ?>
                                <?php if( count($prevImages) == 1 || $prevType == 'list' ): ?>
                                    <?php foreach ($prevImages as $imgPath): ?>
                                        <?php if ($imgPath != ''):
                                            $imgLink = premitheme_multisite_image_path($imgPath);
                                            $image = premitheme_image('', $imgPath, array($prevWidth, ''));
                                        ?>
                                            <div class="entry-thumb image-list">
                                                <?php if ( isset($image[0]) ): ?>
                                                    <a href="<?php echo $imgLink; ?>" rel="prettyPhoto[folio-previews]" title="<?php the_title_attribute(); ?>">
                                                        <img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" alt=""/>
                                                    </a>
                                                <?php else: ?>
                                                    <img src="<?php echo get_template_directory_uri();?>/images/no-image/600x300.jpg" alt="No Image"/>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php elseif ( $prevType == 'slider' && $prevHeight ): ?>
                                    <script>
                                        jQuery(window).load(function() {
                                            jQuery('.flexslider-<?php the_ID(); ?>').flexslider({
                                                animation: <?php echo $prevEffectOption; ?>,
                                                easing: "easeInOutExpo",
                                                smoothHeight: false,
                                                slideshow: true,
                                                slideshowSpeed: 3500,
                                                animationSpeed: 700,
                                                pauseOnAction: true,
                                                pauseOnHover: true,
                                                useCSS: false,
                                                controlNav: <?php echo $prevNavOption; ?>,
                                                directionNav: false,
                                                keyboard: false,
                                                start: function() { jQuery('.flexslider-<?php the_ID(); ?>').removeAttr("style"); }
                                            });
                                        });
                                    </script>

                                    <div class="entry-thumb flexslider folio-flexslider flexslider-<?php the_ID(); ?>" style="height: <?php echo $prevHeight; ?>px;">
                                        <ul class="slides">
                                            <?php foreach ($prevImages as $imgPath): ?>
                                                <?php if ($imgPath != ''):
                                                    $imgLink = premitheme_multisite_image_path($imgPath);
                                                    $image = premitheme_image('', $imgPath, array($prevWidth, $prevHeight));
                                                ?>
                                                    <?php if ( isset($image[0]) ): ?>
                                                        <li data-thumb="<?php echo $image[0]; ?>">
                                                            <a href="<?php echo $imgLink; ?>" rel="prettyPhoto[group-<?php the_ID(); ?>]" title="<?php the_title_attribute(); ?>">
                                                                <img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" alt=""/>
                                                            </a>
                                                        </li>
                                                    <?php else: ?>
                                                        <li data-thumb="<?php echo get_template_directory_uri();?>/images/no-image/600x300.jpg">
                                                            <img src="<?php echo get_template_directory_uri();?>/images/no-image/600x300.jpg" alt="No Image"/>
                                                        </li>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                        <div class="<?php echo $contentClass; ?> columns folio-content">
                            <div class="folio-description">
                                <div class="entry-content">
                                    <?php the_content(); ?>
                                    <?php wp_link_pages( array( 'before' => '<p><span><strong>' . __( 'Pages: ', 'premitheme' ) . '</strong></span>', 'after' => '</p>' ) ); ?>
                                    <?php edit_post_link( __( 'Edit', 'premitheme'), '<div class="entry-meta edit-link">', '</div>' ); ?>
                                </div>
                            </div>

                            <div class="folio-sidebar">
                                <div class="folio-meta">
                                    <?php if( $liveUrl ): ?>
                                        <!-- FOLIO LIVE LINK
                                        ====================================== -->
                                        <a class="live-btn" href="<?php echo $liveUrl; ?>" target="_blank"><?php echo $liveLabel; ?> <i class="fa fa-arrow-right"></i></a>
                                    <?php endif; ?>

                                    <?php if( $itemDate ): ?>
                                        <div class="folio-date"><?php echo $itemDate; ?></div>
                                    <?php endif; ?>

                                    <?php if( $clientName ): ?>
                                        <div class="folio-client">
                                            <span></span>
                                            <h6><?php echo $clientLabel; ?></h6>
                                            <ul>
                                                <li><?php echo $clientName; ?></li>
                                            </ul>
                                        </div>
                                    <?php endif; ?>

                                    <?php if( !empty($skills_names) ): ?>
                                        <div class="folio-skills">
                                            <span></span>
                                            <h6><?php echo $skillsLabel; ?></h6>
                                            <ul>
                                                <?php if( $skillsType == 'text' ): ?>
                                                    <?php foreach( $skills_names as $skill_name ):?>
                                                        <li><?php echo $skill_name; ?></li>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <?php echo get_the_term_list( $post->ID, 'portfolio_skills', '<li>', '</li><li>', '</li>' ); ?>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <?php if( of_get_option('folio_sharing') ): ?>
                                    <!-- HORIZONTAL SHARING LINKS
                                    ====================================== -->
                                    <div id="sharing-btns-hor">
                                        <?php get_template_part('includes/sharing-btns'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="clear"></div>

                        <?php endwhile; ?>

                        <?php /* SIMILAR WORK
                        ======================================*/
                        if( of_get_option('show_similar') )
                            get_template_part('includes/similar-work');
                        ?>

                        <?php /* COMMENTS
                        ======================================*/
                        if( of_get_option('folio_comments') && ( comments_open() || have_comments() ) )
                            comments_template( '', true );
                        ?>
                    </article>
                </div>
            </div><!-- #content -->
        </div>
<?php get_footer(); ?>