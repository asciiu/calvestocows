<?php
$author = get_the_author();
$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
$authorAttr = sprintf( __('View all posts by %s', 'premitheme'), $author );
$mp3Path = get_post_meta($post->ID, 'audioformat_mpthree', TRUE);
$ogaPath = get_post_meta($post->ID, 'audioformat_oga', TRUE);
?>

<!-- ENTRY AUDIO
====================================== -->
<?php if ( $mp3Path && $ogaPath ): ?>

    <script>
        jQuery(document).ready(function($){
            $("#jquery-jplayer-<?php the_ID(); ?>").jPlayer({
                ready: function () {
                    $(this).jPlayer("setMedia", {
                        mp3: "<?php echo $mp3Path; ?>",
                        oga: "<?php echo $ogaPath; ?>",
                    });
                },
                play: function() { // To avoid multiple jPlayers playing together.
                    $(this).jPlayer("pauseOthers");
                },
                swfPath: "<?php echo PT_JS; ?>",
                solution: "html, flash",
                supplied: "mp3, oga",
                wmode: "window",
                cssSelectorAncestor: "#jp-gui-<?php the_ID(); ?>"
            });
        });
    </script>

    <div class="entry-media">
        <div class="jp-audio-wrapper">
            <div class="jp-type-single">
                <div id="jquery-jplayer-<?php the_ID(); ?>" class="jp-jplayer"></div>
                <div id="jp-gui-<?php the_ID(); ?>" class="jp-gui">
                    <div class="jp-interface">
                        <div class="jp-interface-wrapper">
                            <div><a href="#" class="jp-play" tabindex="1"><i class="fa fa-play"></i></a></div>
                            <div><a href="#" class="jp-pause" tabindex="1"><i class="fa fa-pause"></i></a></div>
                            <div class="jp-time-wrapper">
                                <div class="jp-time">
                                    <div class="jp-current-time"></div>
                                    <div class="jp-time-sep">&nbsp;/&nbsp;</div>
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
        </div><!-- .jp-audio-wrapper -->
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