<?php
/* The template for displaying callout message content section */

global $pt_section_i;
$calloutMessage = get_post_meta($post->ID, "callout_message", true);

if ( $calloutMessage[$pt_section_i] ): 
    $message = nl2br( $calloutMessage[$pt_section_i] ); 
    $message = htmlspecialchars_decode( $message ); 
    $message = do_shortcode( $message );
    ?>
        <!-- CALLOUT MESSAGE
        ====================================== -->
        <div class="callout-message">
            <h2><?php echo $message; ?></h2>
        </div>
    <?php
endif;