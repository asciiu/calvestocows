<div id="sidebar" class="grid_3 columns padding-bottom clearfix"> 
    <?php
    /* CHILD PAGE NAVIGATION (FOR PAGE WITH CHILD PAGES)
    ======================================================*/
    if ( is_page() && of_get_option('childs_nav') ):
        if($post->post_parent)
            $children = wp_list_pages('title_li=&child_of='.$post->post_parent.'&echo=0');
        else
            $children = wp_list_pages('title_li=&child_of='.$post->ID.'&echo=0');

        if ($children):
    ?>
        <aside id="sub-page-nav" class="widget widget-subnav">
            <h3 class="widget-title">
                <?php $parent_title = get_the_title($post->post_parent); echo $parent_title; ?>
            </h3>
             
            <ul>
                <?php echo $children; ?>
            </ul>
        </aside>
    <?php endif;
    endif;

    /* DYNAMIC SIDEBAR STARTS HERE
    ======================================================*/
    if ( ! dynamic_sidebar( 'sidebar-3' ) ):
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