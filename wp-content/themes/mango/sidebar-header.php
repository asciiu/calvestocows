<?php
// Check if any of the areas have widgets
if (   ! is_active_sidebar( 'sidebar-6'  )
    && ! is_active_sidebar( 'sidebar-7' )
    && ! is_active_sidebar( 'sidebar-8'  )
    && ! is_active_sidebar( 'sidebar-9'  )
)
return;

// If we get this far, we have widgets. Let's do this.
?>
<div id="header-widgets" class="fullwidth-container">
    <div class="container">
        <?php if ( is_active_sidebar( 'sidebar-6' ) ) : ?>
            <div id="header-first" <?php premitheme_header_sidebar_class(); ?>>
                <?php dynamic_sidebar( 'sidebar-6' ); ?>
            </div><!-- #header-first -->
        <?php endif; ?>
        
        <?php if ( is_active_sidebar( 'sidebar-7' ) ) : ?>
            <div id="header-second" <?php premitheme_header_sidebar_class(); ?>>
                <?php dynamic_sidebar( 'sidebar-7' ); ?>
            </div><!-- #header-second -->
        <?php endif; ?>
        
        <?php if ( is_active_sidebar( 'sidebar-8' ) ) : ?>
            <div id="header-third" <?php premitheme_header_sidebar_class(); ?>>
                <?php dynamic_sidebar( 'sidebar-8' ); ?>
            </div><!-- #header-third -->
        <?php endif; ?>
        
        <?php if ( is_active_sidebar( 'sidebar-9' ) ) : ?>
            <div id="header-fourth" <?php premitheme_header_sidebar_class(); ?>>
                <?php dynamic_sidebar( 'sidebar-9' ); ?>
            </div><!-- #header-fourth -->
        <?php endif; ?>
    </div>
</div><!-- #header-widgets -->