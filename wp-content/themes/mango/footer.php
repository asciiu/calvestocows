<?php
$hasSections = '1';
$useFooter = '1';

$contentSections = premitheme_home_has_sections();
if(!$contentSections){
    $hasSections = '0';
}
if( is_page_template('home-corp.php') || is_page_template('home-video.php') || is_page_template('home-slideshow.php') ){
    $useFooter = get_post_meta($post->ID, "use_home_footer", true);
}
?>
        <?php if( $hasSections == '1' ): ?>
            <div id="footer-container" class="fullwidth-container">
                <?php if( $useFooter == '1' ):
                    get_sidebar('footer');
                endif; ?>

                <footer id="ending" class="container">
                    <!-- FOOTER MENU
                    ====================================== -->
                    <?php premitheme_navigation('footer'); ?>

                    <?php if( of_get_option('footer_note') ): ?>
                        <!-- COPYRIGHT NOTE
                        ====================================== -->
                        <div id="copyright">
                            <?php echo of_get_option('footer_note'); ?>
                        </div>
                    <?php endif; ?>
                </footer>
            </div>
        <?php endif;?>
    </div>

    <!-- BACK TO TOP BUTTON
    ====================================== -->
    <div id="to-top"><i class="fa fa-chevron-up"></i></div>

    <?php if( of_get_option("ie_warning") ): ?>
        <!-- OLD BROWSER WARNING MESSAGE
        ====================================== -->
        <div id="ie-warning">
            <span id="ie-close">&times;</span>
            <?php _e('Internet Explorer is missing updates required to view this site properly. <a href="http://ie.microsoft.com" target="_blank">Click here to update</a>. OR even better, try out other great browsers, <a href="http://chrome.google.com" target="_blank">Chrome</a> and <a href="http://firefox.com" target="_blank">Firefox</a> are top of the best.', 'premitheme'); ?>
        </div>
    <?php endif; ?>

    <!-- WP FOOTER
    ====================================== -->
    <?php wp_footer();?>
</body>
</html>