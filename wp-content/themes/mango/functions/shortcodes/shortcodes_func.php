<?php
// Creats shortcodes TinyMCE's editor button & plugin
add_action('init', 'premitheme_sc_button');
function premitheme_sc_button() {
    if ( current_user_can('edit_posts') && current_user_can('edit_pages') ){
        add_filter('mce_external_plugins', 'premitheme_add_tinymce_sc_plugin');
        add_filter('mce_buttons', 'premitheme_register_sc_button');
    }
} 

function premitheme_register_sc_button($buttons) {
    array_push($buttons, 'separator', 'pt_shortcodes' );
    return $buttons;
}

function premitheme_add_tinymce_sc_plugin($plugin_array) {
    $plugin_array['pt_shortcodes'] = PT_SHORTCODES . '/editor_plugin.js';
    return $plugin_array;
} 