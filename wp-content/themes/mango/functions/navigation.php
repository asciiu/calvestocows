<?php
function premitheme_navigation($location){
    if( $location == 'header' ){
        if (has_nav_menu('header')):
            // MAIN MENU
            wp_nav_menu( array(
                'container'      => '',
                'theme_location' => 'header',
                'menu_class'     => 'main-menu',
                'fallback_cb'    => 'false',
                'depth'          => 0
            ) );

            // RESPONSIVE DROPDOWN MENU
            wp_nav_menu( array(
                'container'      => '',
                'theme_location' => 'header',
                'walker'         => new Walker_Nav_Menu_Dropdown(),
                'menu_class'     => 'dropdown-menu',
                'fallback_cb'    => 'false',
                'depth'          => 0,
                'items_wrap'     => '<div id="dropdown-nav" class="fa fa-bars"><select>%3$s</select></div>',
            ) );
        endif;
    } elseif( $location == 'footer' ){
        if (has_nav_menu('footer')):
            // FOOTER MENU
            wp_nav_menu( array(
                'container'      => 'div',
                'container_id'    => 'footer-nav',
                'theme_location' => 'footer',
                'menu_class'     => 'footer-menu',
                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul><div class="clear"></div>',
                'fallback_cb'    => 'false',
                'depth'          => 1
            ) );
        endif;
    }
}