<?php
/* The template for displaying video banner content section */

global $pt_section_i;
$videoEmbed =  get_post_meta($post->ID, 'video_banner_embed', TRUE);
$videoURL =  get_post_meta($post->ID, 'video_banner_url', TRUE);
$videoM4vPath =  get_post_meta($post->ID, 'video_banner_mfourv', TRUE);
$videoOgvPath =  get_post_meta($post->ID, 'video_banner_ogv', TRUE);
$videoPoster =  get_post_meta($post->ID, 'video_banner_poster', TRUE);
$videoHeight =  get_post_meta($post->ID, 'video_banner_height', TRUE);

if ( $videoEmbed[$pt_section_i] ): 
    $embedDecode = htmlspecialchars_decode($videoEmbed[$pt_section_i]);
    ?>
        <!-- VIDEO BANNER
        ====================================== -->
        <div class="video-banner entry-media remotely-hosted">
            <?php echo stripslashes( $embedDecode ); ?>
        </div>
    <?php
elseif ( $videoURL[$pt_section_i] ):
    $embed_code = wp_oembed_get($videoURL[$pt_section_i], array('width'=>960));
    ?>
        <!-- VIDEO BANNER
        ====================================== -->
        <div class="video-banner entry-media remotely-hosted">
            <?php echo $embed_code; ?>
        </div>
    <?php
elseif ( $videoM4vPath[$pt_section_i] && $videoOgvPath[$pt_section_i] && $videoPoster[$pt_section_i] && $videoHeight[$pt_section_i] ):
    ?>
        <!-- VIDEO BANNER
        ====================================== -->
        <div class="video-banner entry-media">
            <div class="jp-video-wrapper">
                <div class="jp-type-single">
                    <div id="jquery-jplayer-<?php the_ID(); ?>-<?php echo $pt_section_i; ?>" class="jp-jplayer" data-orig-width="960" data-orig-height="<?php echo $videoHeight[$pt_section_i]; ?>"></div>
                    <div id="jp-gui-<?php the_ID(); ?>-<?php echo $pt_section_i; ?>" class="jp-gui">
                        <div class="jp-video-play">
                            <a href="javascript:;" class="jp-video-play-icon" tabindex="1">Play</a>
                        </div>
                        <div class="jp-interface">
                            <div class="interface-inner-wrapper">
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

        <script>
            jQuery(document).ready(function($){
                if(window.opera){
                    var jSolution = "flash, html";
                } else {
                    var jSolution = "html, flash";
                }
                
                $("#jquery-jplayer-<?php the_ID(); ?>-<?php echo $pt_section_i; ?>").jPlayer({
                    ready: function () {
                        $(this).jPlayer("setMedia", {
                            m4v: "<?php echo $videoM4vPath[$pt_section_i]; ?>",
                            ogv: "<?php echo $videoOgvPath[$pt_section_i]; ?>",
                            poster: "<?php echo $videoPoster[$pt_section_i]; ?>"
                        });
                    },
                    play: function() { // To avoid multiple jPlayers playing together.
                        $(this).jPlayer("pauseOthers");
                    },
                    size: {
                        width: "100%",
                        height: "<?php echo $videoHeight[$pt_section_i]; ?>px",
                        cssClass: "jp-video"
                    },
                    swfPath: "<?php echo PT_JS; ?>",
                    solution: jSolution,
                    supplied: "m4v, ogv, all",
                    wmode: "transparent",
                    cssSelectorAncestor: "#jp-gui-<?php the_ID(); ?>-<?php echo $pt_section_i; ?>",
                });
            });
        </script>
    <?php

endif;