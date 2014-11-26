<?php
// CUSTOM STYLES AND SCRIPTS
add_action('admin_enqueue_scripts', 'premitheme_optionsframework_styles', 20);
add_action('admin_enqueue_scripts', 'premitheme_optionsframework_scripts', 20);

function premitheme_optionsframework_styles($hook) {
    if( $hook != 'appearance_page_options-framework' )
        return;

    wp_enqueue_style( 'awesome', get_template_directory_uri() . '/css/font-awesome.css' );
    wp_enqueue_style( 'options-mod-css', OPTIONS_FRAMEWORK_DIRECTORY.'mod.css' );
}

function premitheme_optionsframework_scripts( $hook ) {
    if( $hook != 'appearance_page_options-framework' )
        return;

    wp_enqueue_script( 'options-mod-js', OPTIONS_FRAMEWORK_DIRECTORY . 'mod.js', array( 'jquery' ) );
}


// CUSTOM TEXTAREA SANITIZATION
add_action('admin_init','premitheme_of_textarea_santiziation', 100);

function premitheme_of_textarea_santiziation() {
    remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
    add_filter( 'of_sanitize_textarea', 'premitheme_of_sanitize_textarea_custom' );
}

function premitheme_of_sanitize_textarea_custom($input) {
    $output = stripslashes( $input );
    return $output;
}