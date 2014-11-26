<?php
// Check if any of the areas have widgets
if (   ! is_active_sidebar( 'sidebar-10' )
    && ! is_active_sidebar( 'sidebar-11' )
    && ! is_active_sidebar( 'sidebar-12' )
    && ! is_active_sidebar( 'sidebar-13' )
)
return;

// If we get this far, we have widgets. Let's do this.
?>
<div id="footer-widgets" class="container padding-top">
    <?php if ( is_active_sidebar( 'sidebar-10' ) ) : ?>
        <div id="footer-first" <?php premitheme_footer_sidebar_class(); ?>>
            <?php dynamic_sidebar( 'sidebar-10' ); ?>
        </div><!-- #footer-first -->
    <?php endif; ?>
    
    <?php if ( is_active_sidebar( 'sidebar-11' ) ) : ?>
        <div id="footer-second" <?php premitheme_footer_sidebar_class(); ?>>
            <?php dynamic_sidebar( 'sidebar-11' ); ?>
        </div><!-- #footer-second -->
    <?php endif; ?>
    
    <?php if ( is_active_sidebar( 'sidebar-12' ) ) : ?>
        <div id="footer-third" <?php premitheme_footer_sidebar_class(); ?>>
            <?php dynamic_sidebar( 'sidebar-12' ); ?>
        </div><!-- #footer-third -->
    <?php endif; ?>
    
    <?php if ( is_active_sidebar( 'sidebar-13' ) ) : ?>
        <div id="footer-fourth" <?php premitheme_footer_sidebar_class(); ?>>
            <?php dynamic_sidebar( 'sidebar-13' ); ?>
        </div><!-- #footer-fourth -->
    <?php endif; ?>
</div><!-- #footer-widgets -->