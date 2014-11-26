<div id="sidebar" class="grid_3 columns padding-bottom clearfix"> 
    <?php /* DYNAMIC SIDEBAR STARTS HERE
    ======================================================*/
    if ( ! dynamic_sidebar( 'sidebar-5' ) ):
    ?>
        <aside id="archives" class="widget widget-archive">
            <h3 class="widget-title"><span><?php _e( 'Archives', 'ultymighty' ); ?></span></h3>
            <ul>
                <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
            </ul>
        </aside>

        <aside id="meta" class="widget widget-links">
            <h3 class="widget-title"><span><?php _e( 'Meta', 'ultymighty' ); ?></span></h3>
            <ul>
                <?php wp_register(); ?>
                <li><?php wp_loginout(); ?></li>
                <?php wp_meta(); ?>
            </ul>
        </aside>
    <?php endif; // end sidebar widget area ?>
</div><!-- #sidebar -->