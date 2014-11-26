<?php
/* CONTENT WIDTH
===============================================================*/
if ( ! isset( $content_width ) )
    $content_width = 600;


/* DEFINE PATHS
===============================================================*/
define('PT_FUNCTIONS', get_template_directory_uri() . '/functions');
define('PT_FRAMEWORK', get_template_directory() . '/functions');
define('PT_SHORTCODES', PT_FUNCTIONS . '/shortcodes');
define('PT_PLUGINS', PT_FRAMEWORK . '/plugins');
define('PT_JS', get_template_directory_uri() . '/js');
define('PT_CSS', get_stylesheet_directory_uri() . '/css');
define('PT_INDEX', get_stylesheet_directory_uri());
define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/functions/theme-options/' );


/* THEME VARIABLES
===============================================================*/
$pt_themename = "Mango";
$pt_shortname = "mango";
$pt_folioImgWidth = __('600px width for 2 columns layout or 912px width for fullwidth layout', 'premitheme');
$pt_blogVidWidth = __('600px', 'premitheme');
$pt_sliderImgWidth = __('960px', 'premitheme');
$pt_themeFullWidth = __('960px', 'premitheme');
$pt_memberImgWidth = __('296x200 px', 'premitheme');
$pt_clientImgWidth = __('232px', 'premitheme');


/* THEME SETUP
===============================================================*/
require_once(PT_FRAMEWORK . '/theme-setup.php');


/* IMAGE RESIZING FUNCTION
===============================================================*/
if( !function_exists('aq_resize') ){
    require_once(PT_FRAMEWORK . '/aq_resizer.php');
}


/* TWITTER FUNCTION
===============================================================*/
if( !class_exists('tmhOAuth') ){
    require_once(PT_FRAMEWORK . '/twitter-function/tmhOAuth.php');
}
require_once(PT_FRAMEWORK . '/twitter-function/twitter-function.php');


/* INSTAGRAM FUNCTION
===============================================================*/
require_once(PT_FRAMEWORK . '/instagram-function.php');


/* THEME OPTIONS PANEL
===============================================================*/
require_once (PT_FRAMEWORK . '/theme-options/options-framework.php');
require_once (PT_FRAMEWORK . '/theme-options/mod.php');


/* RETINA CHECK
===============================================================*/
$pt_retina = false;
if ( isset( $_COOKIE['pt_retina'] ) && $_COOKIE['pt_retina'] >= 2 ) {
    $pt_retina = true;
}

if( $pt_retina && of_get_option('use_retina') ){
    function premitheme_retina_width($width) {
        return $width * 2;
    }

    function premitheme_retina_height($height) {
        return $height * 2;
    }
    add_filter('pt_resize_width', 'premitheme_retina_width' );
    add_filter('pt_resize_height', 'premitheme_retina_height' );
}


/* WOOCOMMERCE
===============================================================*/
if (class_exists('WooCommerce')) {
    
}


/* SHORTCODES
===============================================================*/
require_once(PT_FRAMEWORK . '/shortcodes/shortcodes_func.php');
require_once(PT_FRAMEWORK . '/shortcodes/shortcodes.php');


/* WIDGETS
===============================================================*/
require_once(PT_FRAMEWORK . '/widgets/widget-video.php');
require_once(PT_FRAMEWORK . '/widgets/widget-twitter.php');
require_once(PT_FRAMEWORK . '/widgets/widget-instagram.php');
require_once(PT_FRAMEWORK . '/widgets/widget-flickr.php');
require_once(PT_FRAMEWORK . '/widgets/widget-posts-thumb.php');
require_once(PT_FRAMEWORK . '/widgets/widget-portfolio.php');
require_once(PT_FRAMEWORK . '/widgets/widget-contact.php');
require_once(PT_FRAMEWORK . '/widgets/widget-social.php');


/* CUSTOM POST TYPES
===============================================================*/
require_once(PT_FRAMEWORK . '/post-types/portfolio-post-type.php');
require_once(PT_FRAMEWORK . '/post-types/slides-post-type.php');
require_once(PT_FRAMEWORK . '/post-types/team-post-type.php');
require_once(PT_FRAMEWORK . '/post-types/clients-post-type.php');
require_once(PT_FRAMEWORK . '/post-types/faqs-post-type.php');


/* CUSTOM METABOXES
===============================================================*/
require_once(PT_FRAMEWORK . '/metaboxes/metaboxes-interface.php');
require_once(PT_FRAMEWORK . '/metaboxes/post-metaboxes.php');
require_once(PT_FRAMEWORK . '/metaboxes/slides-metaboxes.php');
require_once(PT_FRAMEWORK . '/metaboxes/portfolio-metaboxes.php');
require_once(PT_FRAMEWORK . '/metaboxes/team-metaboxes.php');
require_once(PT_FRAMEWORK . '/metaboxes/page-metaboxes.php');
require_once(PT_FRAMEWORK . '/metaboxes/content-builder-metaboxes.php');
require_once(PT_FRAMEWORK . '/metaboxes/faqs-metaboxes.php');
require_once(PT_FRAMEWORK . '/metaboxes/clients-metaboxes.php');


/* SIDEBARS
===============================================================*/
require_once(PT_FRAMEWORK . '/sidebars.php');


/* INLINE STYLES & SCRIPTS
===============================================================*/
require_once(PT_FRAMEWORK . '/inline-styles.php');
require_once(PT_FRAMEWORK . '/inline-scripts.php');


/* TITLE FORMATTING
===============================================================*/
require_once(PT_FRAMEWORK . '/site-title.php');


/* SITE LOGO
===============================================================*/
require_once(PT_FRAMEWORK . '/site-logo.php');


/* NAVIGATION
===============================================================*/
require_once(PT_FRAMEWORK . '/navigation.php');


/* COMMENTS TEMPLATE
===============================================================*/
require_once(PT_FRAMEWORK . '/comments-template.php');


/* PAGINATION
===============================================================*/
require_once(PT_FRAMEWORK . '/pagination.php');


/* MENU FUNCTIONS
===============================================================*/
require_once(PT_FRAMEWORK . '/menu-functions.php');


/* HELPER FUNCTIONS
===============================================================*/
require_once(PT_FRAMEWORK . '/helper-functions.php');


/* SOCIAL LINKS
===============================================================*/
require_once(PT_FRAMEWORK . '/social-icons.php');


/* FRONT-END STYLES & SCRIPTS
===============================================================*/
require_once(PT_FRAMEWORK . '/enqueue-scripts.php');


/* ADMIN STYLES & SCRIPTS 
===============================================================*/
require_once(PT_FRAMEWORK . '/admin-scripts.php');


/* CUSTOM IMAGE SIZES
===============================================================*/
require_once(PT_FRAMEWORK . '/image-sizes.php');


/* ADDITIONAL BODY CLASSES
/===============================================================*/
require_once(PT_FRAMEWORK . '/body-classes.php');
