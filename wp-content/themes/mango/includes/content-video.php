<?php
global $pt_origWidth, $pt_ratio;
$author = get_the_author();
$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
$authorAttr = sprintf( __('View all posts by %s', 'premitheme'), $author );
$videoEmbed = get_post_meta($post->ID, 'videoformat_embed', TRUE);
$videoURL = get_post_meta($post->ID, 'videoformat_url', TRUE);
$m4vPath = get_post_meta($post->ID, 'videoformat_mfourv', TRUE);
$ogvPath = get_post_meta($post->ID, 'videoformat_ogv', TRUE);
$videoPoster = get_post_meta($post->ID, 'videoformat_poster', TRUE);
$videoHeight = get_post_meta($post->ID, 'videoformat_height', TRUE);

$finalHeight = round($videoHeight * $pt_ratio);
?>

<!-- ENTRY VIDEO
====================================== -->
<?php if ( $videoEmbed ): ?>
    <?php $embedDecode = htmlspecialchars_decode($videoEmbed); ?>
    <div class="entry-media remotely-hosted">
        <?php echo stripslashes( $embedDecode ); ?>
    </div>
<?php elseif ( $videoURL ):?>
    <?php $embed_code = wp_oembed_get($videoURL, array('width'=>327)); ?>
    <div class="entry-media remotely-hosted">
        <?php echo $embed_code; ?>
    </div>
<?php elseif ( $ogvPath && $m4vPath && $videoHeight && $videoPoster ): ?>
    
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
                        m4v: "<?php echo $m4vPath; ?>",
                        ogv: "<?php echo $ogvPath; ?>",
                        poster: "<?php echo $videoPoster; ?>"
                    });
                },
                play: function() { // To avoid multiple jPlayers playing together.
                    $(this).jPlayer("pauseOthers");
                },
                size: {
                    width: "100%",
                    height: "<?php echo $finalHeight; ?>px",
                    cssClass: "jp-video"
                },
                swfPath: "<?php echo PT_JS; ?>",
                solution: jSolution,
                supplied: "m4v, ogv",
                wmode: "transparent",
                cssSelectorAncestor: "#jp-gui-<?php the_ID(); ?>"
            });
        });
    </script>

    <div class="entry-media">
        <div class="jp-video-wrapper">
            <div class="jp-type-single">
                <div id="jquery-jplayer-<?php the_ID(); ?>" class="jp-jplayer" data-orig-width="<?php echo $pt_origWidth; ?>" data-orig-height="<?php echo $finalHeight; ?>"></div>
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

<?php if( !is_single() ): ?>
    <!-- ENTRY TITLE
    ====================================== -->
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
<?php endif; ?>

<!-- ENTRY META
====================================== -->
<div class="entry-meta upper clearfix">
    <div class="entry-author"><?php printf( __('By %s', 'premitheme'), '<a href="'.$author_url.'" title="'.esc_attr($authorAttr).'">'.$author.'</a>' );?></div>

    <?php if( of_get_option('posts_comments') && comments_open() ): ?>
        <div class="entry-comments"><i class="fa fa-comment"></i> <?php comments_popup_link( __( 'Comment', 'premitheme' ), __( '1', 'premitheme' ), __('%', 'premitheme'), 'comments-link' ); ?></div>
    <?php endif; ?>
</div>

<!-- ENTRY CONTENT
====================================== -->
<div class="entry-content">
    <?php if( is_single() || of_get_option('blog_content') ): ?>
        <?php the_content(); ?>
    <?php else: ?>
        <?php the_excerpt(); ?>
    <?php endif; ?>

    <?php if( is_single() ): ?>
        <?php wp_link_pages( array( 'before' => '<p><span><strong>' . __( 'Pages: ', 'premitheme' ) . '</strong></span>', 'after' => '</p>' ) ); ?>
        <?php edit_post_link( __( 'Edit', 'premitheme'), '<div class="entry-meta edit-link">', '</div>' ); ?>
    <?php endif; ?>
</div>