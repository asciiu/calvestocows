<?php
/* ADD METABOXS
=====================*/

add_action( 'add_meta_boxes', 'premitheme_page_metabox' );
function premitheme_page_metabox() {
    add_meta_box( 'folio_page_settings', __('Portfolio Page Settings', 'premitheme'), 'premitheme_render_folio_page_metabox', 'page', 'normal' , 'high' );
    add_meta_box( 'faqs_page_settings', __('FAQs Page Settings', 'premitheme'), 'premitheme_render_faqs_page_metabox', 'page', 'normal' , 'high' );
    add_meta_box( 'home_video_settings', __('Home Video Settings', 'premitheme'), 'premitheme_render_home_video_metabox', 'page', 'normal' , 'high' );
    add_meta_box( 'home_slideshow_settings', __('Home Slideshow Settings', 'premitheme'), 'premitheme_render_home_slideshow_metabox', 'page', 'normal' , 'high' );
    add_meta_box( 'about_page_settings', __('About Page Settings', 'premitheme'), 'premitheme_render_about_page_metabox', 'page', 'normal' , 'high' );
    add_meta_box( 'contact_page_settings', __('Contact Page Settings', 'premitheme'), 'premitheme_render_contact_page_metabox', 'page', 'normal' , 'high' );
    add_meta_box( 'page_bg_settings', __('Custom Fullscreen Background', 'premitheme'), 'premitheme_render_page_bg_metabox', 'page', 'normal' , 'low' );
}


/* RENDER METABOXS
=====================*/

/* PORTFOLIO TEMPLATE METABOX */
/* 
Needed to declare two arrays here, one for showing metabox options ( $pt_folio_page_metabox_options )
and anothr one for saving them ( $pt_folio_page_metabox_save )
*/
$pt_folio_page_metabox_save = array(
    array(
        'id' => 'folio_cat',
        'type' => 'select'
    ),
    array(
        'id' => 'folio_main_layout',
        'type' => 'select'
    ),
    array(
        'id' => 'folio_thumbs_style',
        'type' => 'select'
    ),
    array(
        'id' => 'folio_thumbs_link',
        'type' => 'select'
    ),
    array(
        'id' => 'folio_orderby',
        'type' => 'select'
    ),
    array(
        'id' => 'folio_order',
        'type' => 'select'
    ),
    array(
        'id' => 'folio_filtering',
        'type' => 'select'
    )
);

function premitheme_render_folio_page_metabox( $post ) {
    $folio_cats_array = array();
    $folio_cats_array_obj = get_categories('taxonomy=portfolio_cats');
    $folio_cats_array['all'] = __('Show All','premitheme');
    foreach ($folio_cats_array_obj as $folio_cat) {
        $folio_cats_array[$folio_cat->cat_ID] = $folio_cat->cat_name;
    }

    $pt_folio_page_metabox_options = array(
        array(
            'id' => 'folio_cat',
            'label' => __('Portfolio Category', 'premitheme'),
            'desc' => __('Select to show portfolio items in all portfolio categories or in a specific single portfolio category. If there\'s a category not in the list, that means you didn\'t assign any portfolio items to this category.', 'premitheme'),
            'std' => '',
            'note' => __('Some of the settings below could be set globally from the theme options panel under "Portfolio Settings" tab, and you can override the global settings here when needed. Setting the global settings is necessary when using the "non-jQuery" filtering to match the settings here.', 'premitheme'),
            'size' => '',
            'first' => 'first',
            'type' => 'select',
            'options' => $folio_cats_array
        ),
        array(
            'id' => 'folio_main_layout',
            'label' => __('Portfolio Layout', 'premitheme'),
            'desc' => __('Overrides the global option in the theme options panel.', 'premitheme'),
            'std' => '',
            'note' => '',
            'size' => '',
            'first' => '',
            'type' => 'select',
            'options' => array(
                    'global' => __('&mdash; Use the global setting in theme options panel &mdash;','premitheme'),
                    '3col' => __('3 Columns','premitheme'),
                    '2col' => __('2 Columns','premitheme'),
                    '2col-sidebar' => __('2 Columns + sidebar','premitheme'),
                )
        ),
        array(
            'id' => 'folio_thumbs_style',
            'label' => __('Thumbnails Style', 'premitheme'),
            'desc' => __('Overrides the global option in the theme options panel.', 'premitheme'),
            'std' => '',
            'note' => '',
            'size' => '',
            'first' => '',
            'type' => 'select',
            'options' => array(
                    'global' => __('&mdash; Use the global setting in theme options panel &mdash;','premitheme'),
                    'grid' => __('Grid layout','premitheme'),
                    'masonry' => __('Masonry Layout','premitheme')
                )
        ),
        array(
            'id' => 'folio_thumbs_link',
            'label' => __('Thumbnails\' Link Type', 'premitheme'),
            'desc' => __('Overrides the global option in the theme options panel.', 'premitheme'),
            'std' => '',
            'note' => '',
            'size' => '',
            'first' => '',
            'type' => 'select',
            'options' => array(
                    'global' => __('&mdash; Use the global setting in theme options panel &mdash;','premitheme'),
                    'link' => __('Open single portofolio item','premitheme'),
                    'lightbox' => __('Open lightbox','premitheme')
                )
        ),
        array(
            'id' => 'folio_orderby',
            'label' => __('Items Order By', 'premitheme'),
            'desc' => __('Overrides the global option in the theme options panel.', 'premitheme'),
            'std' => '',
            'note' => '',
            'size' => '',
            'first' => '',
            'type' => 'select',
            'options' => array(
                    'global' => __('&mdash; Use the global setting in theme options panel &mdash;','premitheme'),
                    'date' => __('Item\'s creation date','premitheme'),
                    'menu_order' => __('Custom order','premitheme'),
                    'title' => __('Title','premitheme'),
                    'rand' => __('Random','premitheme')
                )
        ),
        array(
            'id' => 'folio_order',
            'label' => __('Items Order', 'premitheme'),
            'desc' => __('Overrides the global option in the theme options panel.', 'premitheme'),
            'std' => '',
            'note' => '',
            'size' => '',
            'first' => '',
            'type' => 'select',
            'options' => array(
                    'global' => __('&mdash; Use the global setting in theme options panel &mdash;','premitheme'),
                    'DESC' => __('Descending','premitheme'),
                    'ASC' => __('Ascending','premitheme')
                )
        ),
        array(
            'id' => 'folio_filtering',
            'label' => __('Portfolio Filtering Type', 'premitheme'),
            'desc' => __('Choose between fancy animated filtering or normal filtering using portfolio taxonomies.', 'premitheme'),
            'std' => '',
            'note' => '',
            'size' => '',
            'first' => '',
            'type' => 'select',
            'options' => array(
                    'fancy' => __('Fancy animation (jQuery)','premitheme'),
                    'normal' => __('Normal Filtering (non-jQuery)','premitheme')
                )
        )
    );

    wp_nonce_field( 'folio_page_meta_box_nonce', 'folio-page-meta-box-nonce' );

    premitheme_meta_fields_output($pt_folio_page_metabox_options);
}

/* FAQS TEMPLATE METABOX */
$pt_faqs_page_metabox_sav = array(
        array(
            'id' => 'faqs_group',
            'type' => 'select'
        ),
        array(
            'id' => 'faqs_style',
            'type' => 'select'
        ),
        array(
            'id' => 'faqs_layout',
            'type' => 'select'
        ),
        array(
            'id' => 'faqs_orderby',
            'type' => 'select'
        ),
        array(
            'id' => 'faqs_order',
            'type' => 'select'
        )
    );

function premitheme_render_faqs_page_metabox( $post ) {
    $faq_groups_array = array();
    $faq_groups_array_obj = get_categories('taxonomy=faq_groups');
    $faq_groups_array['all'] = __('Show All','premitheme');
    foreach ($faq_groups_array_obj as $faq_group) {
        $faq_groups_array[$faq_group->cat_ID] = $faq_group->cat_name;
    }

    $pt_faqs_page_metabox_options = array(
        array(
            'id' => 'faqs_group',
            'label' => __('FAQs Group', 'premitheme'),
            'desc' => __('Select to show FAQs from all FAQ groups or in a specific single FAQ group. If there\'s a group not in the list, that means you didn\'t assign any FAQs to this group.', 'premitheme'),
            'std' => '',
            'note' => '',
            'size' => '',
            'first' => 'first',
            'type' => 'select',
            'options' => $faq_groups_array
        ),
        array(
            'id' => 'faqs_style',
            'label' => __('Normal or Accordion Style', 'premitheme'),
            'desc' => __('Choose between normal or accordion page style.', 'premitheme'),
            'std' => '',
            'note' => '',
            'size' => '',
            'first' => '',
            'type' => 'select',
            'options' => array(
                    'normal' => __('Normal style','premitheme'),
                    'accordion' => __('Accordion style','premitheme')
                )
        ),
        array(
            'id' => 'faqs_layout',
            'label' => __('Fullwidth or Sidebar Layout', 'premitheme'),
            'desc' => __('Choose between fullwidth or sidebar layout.', 'premitheme'),
            'std' => '',
            'note' => '',
            'size' => '',
            'first' => '',
            'type' => 'select',
            'options' => array(
                    'sidebar' => __('Sidebar layout','premitheme'),
                    'fullwidth' => __('Fullwidth layout','premitheme')
                )
        ),
        array(
            'id' => 'faqs_orderby',
            'label' => __('FAQs Order By', 'premitheme'),
            'desc' => '',
            'std' => '',
            'note' => '',
            'size' => '',
            'first' => '',
            'type' => 'select',
            'options' => array(
                    'date' => __('Item\'s creation date','premitheme'),
                    'menu_order' => __('Custom order','premitheme'),
                    'title' => __('Title','premitheme'),
                    'rand' => __('Random','premitheme')
                )
        ),
        array(
            'id' => 'faqs_order',
            'label' => __('FAQs Order', 'premitheme'),
            'desc' => '',
            'std' => '',
            'note' => '',
            'size' => '',
            'first' => '',
            'type' => 'select',
            'options' => array(
                    'DESC' => __('Descending','premitheme'),
                    'ASC' => __('Ascending','premitheme'),
                )
        )
    );

    wp_nonce_field( 'faqs_page_meta_box_nonce', 'faqs-page-meta-box-nonce' );
    
    premitheme_meta_fields_output($pt_faqs_page_metabox_options);
}


/* HOME VIDEO TEMPLATE METABOX */
$pt_home_video_metabox_options = array(
    array(
        'label' => __('Video Background Settings', 'premitheme'),
        'first' => 'first',
        'type'  => 'heading'
    ),
    array(
        'id' => 'home_video_url',
        'label' => __('Background YouTube Video URL', 'premitheme'),
        'desc' => __('Just YouTube is Supported. Always use the full URL including "http://"', 'premitheme'),
        'std' => '',
        'note' => '',
        'size' => '',
        'suffix' => '',
        'first' => 'first',
        'type' => 'text'
    ),
    array(
        'id' => 'home_video_ratio',
        'label' => __('Video Ratio', 'premitheme'),
        'desc' => '',
        'std' => '16/9',
        'note' => '',
        'size' => 'medium',
        'first' => '',
        'type' => 'select',
        'options' => array(
                '16/9' => __('16/9','premitheme'),
                '4/3' => __('4/3','premitheme')
            )
    ),
    array(
        'id' => 'home_video_quality',
        'label' => __('Video Quality', 'premitheme'),
        'desc' => '',
        'std' => 'default',
        'note' => '',
        'size' => 'medium',
        'first' => '',
        'type' => 'select',
        'options' => array(
                'default' => __('Default','premitheme'),
                'small' => __('Low','premitheme'),
                'hd720' => __('HD (720p)','premitheme')
            )
    ),
    array(
        'id' => 'home_video_mute',
        'label' => __('Mute Video Sound', 'premitheme'),
        'desc' => '',
        'std' => '0',
        'note' => '',
        'size' => '',
        'first' => '',
        'type' => 'checkbox',
    ),
    array(
        'id' => 'home_video_bg_color',
        'label' => __('Video Background Color (While Loading)', 'premitheme'),
        'desc' => '',
        'std' => '#000000',
        'note' => '',
        'size' => '',
        'first' => '',
        'type' => 'color'
    ),
    array(
        'id' => 'home_video_overlay',
        'label' => __('Use Video Overlay Texture', 'premitheme'),
        'desc' => __("Helps masking video quality degradation on big displays and looks stylish as well. Turn off if you don't like it.", 'premitheme'),
        'std' => '1',
        'note' => '',
        'size' => '',
        'first' => '',
        'type' => 'checkbox',
    ),
    array(
        'id' => 'home_video_fallback',
        'label' => __('Fallback Image (For Mobile Devices)', 'premitheme'),
        'desc' => __('Specify an image to be used as fallback for Mobile Devices.', 'premitheme'),
        'std' => '',
        'note' => '',
        'first' => '',
        'type' => 'upload'
    ),
    array(
        'label' => __('Video Foreground Settings', 'premitheme'),
        'first' => '',
        'type'  => 'heading'
    ),
    array(
        'id' => 'home_video_message',
        'label' => __('Video Foreground Caption', 'premitheme'),
        'desc' => __("Enter caption text for video foreground.", "premitheme"),
        'std' => '',
        'note' => '',
        'first' => 'first',
        'type' => 'textarea'
    ),
    array(
        'id' => 'home_video_social',
        'label' => __('Show Social Links', 'premitheme'),
        'desc' => '',
        'std' => '1',
        'note' => '',
        'size' => '',
        'first' => '',
        'type' => 'checkbox',
    ),
    array(
        'id' => 'home_video_text_color',
        'label' => __('Caption Text and Social Icons Color', 'premitheme'),
        'desc' => '',
        'std' => '#000000',
        'note' => '',
        'size' => '',
        'suffix' => '',
        'first' => '',
        'type' => 'color'
    ),
    array(
        'id' => 'home_video_text_shadow',
        'label' => __('Use Caption Text and Social Icons Shadow', 'premitheme'),
        'desc' => '',
        'std' => '1',
        'note' => '',
        'size' => '',
        'first' => '',
        'type' => 'checkbox',
    )
);

function premitheme_render_home_video_metabox( $post ) {
    global $pt_home_video_metabox_options;
    wp_nonce_field( 'home_video_meta_box_nonce', 'home-video-meta-box-nonce' );
    
    premitheme_meta_fields_output($pt_home_video_metabox_options);
}


/* HOME SLIDESHOW TEMPLATE METABOX */
$pt_home_slideshow_metabox_options = array(
    array(
        'label' => __('Slideshow Background Settings', 'premitheme'),
        'first' => 'first',
        'type'  => 'heading'
    ),
    array(
        'id' => 'home_slideshow_imgs',
        'label' => __('Slideshow Images', 'premitheme'),
        'desc' => __("Recommended image size is 1024px width and 768px height. There's no max/min height.", 'premitheme'),
        'std' => '',
        'note' => 'IMPORTANT: Images must be uploaded to media library, external images are not allowed for security purposes.',
        'first' => 'first',
        'type' => 'multi_upload'
    ),
    array(
        'id' => 'home_slideshow_delay',
        'label' => __('Delay Between Slides (in milliseconds)', 'premitheme'),
        'desc' => '',
        'std' => 5000,
        'note' => '',
        'size' => 'small',
        'suffix' => 'ms',
        'first' => '',
        'type' => 'text'
    ),
    array(
        'id' => 'home_slideshow_bg_color',
        'label' => __('Slideshow Background Color (Before Loading)', 'premitheme'),
        'desc' => '',
        'std' => '#000000',
        'note' => '',
        'size' => '',
        'first' => '',
        'type' => 'color'
    ),
    array(
        'id' => 'home_slideshow_overlay',
        'label' => __('Use Slideshow Overlay Texture', 'premitheme'),
        'desc' => __("Helps masking image quality degradation on big displays and looks stylish as well. Turn off if you don't like it.", 'premitheme'),
        'std' => '1',
        'note' => '',
        'size' => '',
        'first' => '',
        'type' => 'checkbox',
    ),
    array(
        'label' => __('Slideshow Foreground Settings', 'premitheme'),
        'first' => '',
        'type'  => 'heading'
    ),
    array(
        'id' => 'home_slideshow_message',
        'label' => __('Slideshow Foreground Caption', 'premitheme'),
        'desc' => __("Enter caption text for slideshow foreground.", "premitheme"),
        'std' => '',
        'note' => '',
        'first' => 'first',
        'type' => 'textarea'
    ),
    array(
        'id' => 'home_slideshow_social',
        'label' => __('Show Social Links', 'premitheme'),
        'desc' => '',
        'std' => '1',
        'note' => '',
        'size' => '',
        'first' => '',
        'type' => 'checkbox',
    ),
    array(
        'id' => 'home_slideshow_text_color',
        'label' => __('Caption Text and Social Icons Color', 'premitheme'),
        'desc' => '',
        'std' => '#000000',
        'note' => '',
        'size' => '',
        'suffix' => '',
        'first' => '',
        'type' => 'color'
    ),
    array(
        'id' => 'home_slideshow_text_shadow',
        'label' => __('Use Caption Text and Social Icons Shadow', 'premitheme'),
        'desc' => '',
        'std' => '1',
        'note' => '',
        'size' => '',
        'first' => '',
        'type' => 'checkbox',
    )
);

function premitheme_render_home_slideshow_metabox( $post ) {
    global $pt_home_slideshow_metabox_options;
    wp_nonce_field( 'home_slideshow_meta_box_nonce', 'home-slideshow-meta-box-nonce' );
    
    premitheme_meta_fields_output($pt_home_slideshow_metabox_options);
}


/* ABOUT TEMPLATE METABOX */
$pt_about_page_metabox_options = array(
    array(
        'id' => 'show_team',
        'label' => __('Show Team Section', 'premitheme'),
        'desc' => '',
        'std' => '1',
        'note' => '',
        'size' => '',
        'first' => 'first',
        'type' => 'checkbox',
    ),
    array(
        'id' => 'team_label',
        'label' => __('Team Section Label', 'premitheme'),
        'desc' => '',
        'std' => __('Meet the team', 'premitheme'),
        'note' => '',
        'size' => '',
        'suffix' => '',
        'first' => '',
        'type' => 'text'
    ),
    array(
        'id' => 'members_orderby',
        'label' => __('Members Order By', 'premitheme'),
        'desc' => '',
        'std' => '',
        'note' => '',
        'size' => '',
        'first' => '',
        'type' => 'select',
        'options' => array(
                'date' => __('Member\'s creation date','premitheme'),
                'menu_order' => __('Custom order','premitheme'),
                'title' => __('Name','premitheme'),
                'rand' => __('Random','premitheme')
            )
    ),
    array(
        'id' => 'members_order',
        'label' => __('Members Order', 'premitheme'),
        'desc' => '',
        'std' => '',
        'note' => '',
        'size' => '',
        'first' => '',
        'type' => 'select',
        'options' => array(
                'DESC' => __('Descending','premitheme'),
                'ASC' => __('Ascending','premitheme'),
            )
    )
);

function premitheme_render_about_page_metabox( $post ) {
    global $pt_about_page_metabox_options;
    wp_nonce_field( 'about_page_meta_box_nonce', 'about-page-meta-box-nonce' );
    
    premitheme_meta_fields_output($pt_about_page_metabox_options);
}


/* CONTACT TEMPLATE METABOX */
global $pt_themename;
$pt_contact_page_metabox_options = array(
    array(
        'label' => __('Contact Information', 'premitheme'),
        'first' => 'first',
        'type'  => 'heading'
    ),
    array(
        'id' => 'contact_address',
        'label' => __('Contact Address(es)', 'premitheme'),
        'desc' => __("Enter your contact address(es).", "premitheme"),
        'std' => '',
        'note' => '',
        'first' => 'first',
        'type' => 'textarea'
    ),
    array(
        'id' => 'contact_phone',
        'label' => __('Phone Number(s)', 'premitheme'),
        'desc' => __("Enter your phone number(s).", "premitheme"),
        'std' => '',
        'note' => '',
        'first' => '',
        'type' => 'textarea'
    ),
    array(
        'id' => 'contact_fax',
        'label' => __('Fax Number(s)', 'premitheme'),
        'desc' => __("Enter your fax number(s).", 'premitheme'),
        'std' => '',
        'note' => '',
        'first' => '',
        'type' => 'textarea'
    ),
    array(
        'label' => __('Contact Form Settings', 'premitheme'),
        'first' => '',
        'type'  => 'heading'
    ),
    array(
        'id' => 'use_contact_form',
        'label' => __('Use Built-in Contact Form', 'premitheme'),
        'desc' => __("Turn on/off the entire contact form. You may want to do this if you're using third-party contact form plugin for example.", 'premitheme'),
        'std' => '1',
        'note' => '',
        'first' => 'first',
        'type' => 'checkbox'
    ),
    array(
        'id' => 'contact_email',
        'label' => __('Contact Form Email Address (Never to be published)', 'premitheme'),
        'desc' => __("Enter your email address that you want the contact form to send emails to. Leave it empty to use the admin email address instead.", 'premitheme'),
        'std' => '',
        'note' => '',
        'size' => '',
        'suffix' => '',
        'first' => '',
        'type' => 'text'
    ),
    array(
        'id' => 'contact_subject',
        'label' => __('Contact Form Subject', 'premitheme'),
        'desc' => __("Enter short subject for the received emails.", 'premitheme'),
        'std' => $pt_themename,
        'note' => '',
        'size' => '',
        'suffix' => '',
        'first' => '',
        'type' => 'text'
    ),
    array(
        'id' => 'use_security',
        'label' => __('Use Simple Form Security Question', 'premitheme'),
        'desc' => __("Turn on/off the simple form security question.", 'premitheme'),
        'std' => '1',
        'note' => '',
        'first' => '',
        'type' => 'checkbox'
    ),
    array(
        'id' => 'security_question',
        'label' => __('Contact Form Security Question (e.g. math calculation)', 'premitheme'),
        'desc' => __("Enter a math calculation (or whatever you want) to validate that the sender is human to prevent robot spam.", 'premitheme'),
        'std' => 'What is 2+3?',
        'note' => '',
        'size' => '',
        'suffix' => '',
        'first' => '',
        'type' => 'text'
    ),
    array(
        'id' => 'security_answer',
        'label' => __('Contact Form Security Answer (e.g. the result)', 'premitheme'),
        'desc' => __("Enter the result for the calculation above (or the answer for any kind of question). Note that the sender should use the exact answer (case sensitive).", 'premitheme'),
        'std' => '5',
        'note' => '',
        'size' => '',
        'suffix' => '',
        'first' => '',
        'type' => 'text'
    ),
    array(
        'label' => __('Google Map Settings', 'premitheme'),
        'first' => '',
        'type'  => 'heading'
    ),
    array(
        'id' => 'google_lat',
        'label' => __('Map Latitude', 'premitheme'),
        'desc' => __('Convert address to Lat/Long <a href="http://www.latlong.net/convert-address-to-lat-long.html" target="_blank">here</a>.', 'premitheme'),
        'std' => '',
        'note' => '',
        'size' => 'medium',
        'suffix' => '',
        'first' => 'first',
        'type' => 'text'
    ),
    array(
        'id' => 'google_lng',
        'label' => __('Map Longitude', 'premitheme'),
        'desc' => __('Convert address to Lat/Long <a href="http://www.latlong.net/convert-address-to-lat-long.html" target="_blank">here</a>.', 'premitheme'),
        'std' => '',
        'note' => '',
        'size' => 'medium',
        'suffix' => '',
        'first' => '',
        'type' => 'text'
    ),
    array(
        'id' => 'google_map_balloon',
        'label' => __('Map balloon text', 'premitheme'),
        'desc' => __("Enter any text you want to view in location marker's balloon.", "premitheme"),
        'std' => '',
        'note' => '',
        'first' => '',
        'type' => 'textarea'
    ),
    array(
        'id' => 'map_type',
        'label' => __('Map Type', 'premitheme'),
        'desc' => __("Select the type of view for the map (Map, Terrain ..etc).", "premitheme"),
        'std' => 'ROADMAP',
        'note' => '',
        'size' => 'medium',
        'first' => '',
        'type' => 'select',
        'options' => array(
                "ROADMAP" => __("Roadmap", "premitheme"),
                "SATELLITE" => __("Satellite", "premitheme"),
                "TERRAIN" => __("Terrain", "premitheme"),
                "HYBRID" => __("Hybrid", "premitheme")
            )
    ),
    array(
        'id' => 'map_zoom',
        'label' => __('Map Zoom Factor', 'premitheme'),
        'desc' => __('Increase/decrease google map zoom.', 'premitheme'),
        'std' => '14',
        'note' => '',
        'size' => 'medium',
        'suffix' => '',
        'first' => '',
        'type' => 'text'
    )
);

function premitheme_render_contact_page_metabox( $post ) {
    global $pt_contact_page_metabox_options;
    wp_nonce_field( 'contact_page_meta_box_nonce', 'contact-page-meta-box-nonce' );
    
    premitheme_meta_fields_output($pt_contact_page_metabox_options);
}


/* BG IMAGE METABOX */
$pt_page_bg_metabox_options = array(
    array(
        'id' => 'singular_bg_img',
        'label' => __('Custom Fullscreen Background Image', 'premitheme'),
        'desc' => __('Specify an image to be used as fullscreen background for this page.', 'premitheme'),
        'std' => '',
        'note' => __('These settings override the global background settings in the theme options panel under "Branding Settings" tab for this page only.', 'premitheme'),
        'first' => 'first',
        'type' => 'upload'
    ),
    array(
        'id' => 'singular_bg_color',
        'label' => __('Custom Background Color', 'premitheme'),
        'desc' => '',
        'std' => '',
        'note' => '',
        'first' => '',
        'type' => 'color'
    ),
    array(
        'id' => 'singular_on_bg_color',
        'label' => __('Custom On-background Text Color', 'premitheme'),
        'desc' => '',
        'std' => '',
        'note' => '',
        'first' => '',
        'type' => 'color'
    ),
    array(
        'id' => 'singular_bg_overlay',
        'label' => __('Use Background Overlay Texture', 'premitheme'),
        'desc' => __("Helps masking image quality degradation on big displays and looks stylish as well. Turn off if you don't like it.", 'premitheme'),
        'std' => '1',
        'note' => '',
        'first' => '',
        'type' => 'checkbox'
    )
);

function premitheme_render_page_bg_metabox( $post ) {
    global $pt_page_bg_metabox_options;
    wp_nonce_field( 'page_bg_meta_box_nonce', 'page-bg-meta-box-nonce' );
    
    premitheme_meta_fields_output($pt_page_bg_metabox_options);
}



/* SAVE METABOXS
=====================*/
/* PORTFOLIO TEMPLATE SAVE */
add_action( 'save_post', 'premitheme_save_folio_page_metabox' );
function premitheme_save_folio_page_metabox( $post_id )  {
    global $pt_folio_page_metabox_save;
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['folio-page-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['folio-page-meta-box-nonce'], 'folio_page_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_posts' ) ) return;  
    
    foreach ($pt_folio_page_metabox_save as $field) {
        if( $field['type'] == 'heading' || $field['type'] == 'sep' ){
            // DO NOTHING
        } elseif( $field['type'] == 'checkbox' ){
            if( isset( $_POST[ $field['id'] ] ) ){
                update_post_meta($post_id, $field['id'], '1');
            } else {
                update_post_meta($post_id, $field['id'], '0');
            }
        } elseif( $field['type'] == 'multi_upload' ){
            if (isset($_POST[ $field['id'] ])){
                $meta_array = $_POST[ $field['id'] ];
                update_post_meta($post_id, $field['id'], $meta_array);
            } else {
                delete_post_meta($post_id, $field['id']);
            }
        } else {
            if( isset( $_POST[ $field['id'] ] ) )
                update_post_meta($post_id, $field['id'], esc_attr( $_POST[ $field['id'] ] )); 
        }
    }
}


/* FAQs TEMPLATE SAVE */
add_action( 'save_post', 'premitheme_save_faqs_page_metabox' );
function premitheme_save_faqs_page_metabox( $post_id )  {
    global $pt_faqs_page_metabox_sav;
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['faqs-page-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['faqs-page-meta-box-nonce'], 'faqs_page_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_posts' ) ) return;  
    
    foreach ($pt_faqs_page_metabox_sav as $field) {
        if( $field['type'] == 'heading' || $field['type'] == 'sep' ){
            // DO NOTHING
        } elseif( $field['type'] == 'checkbox' ){
            if( isset( $_POST[ $field['id'] ] ) ){
                update_post_meta($post_id, $field['id'], '1');
            } else {
                update_post_meta($post_id, $field['id'], '0');
            }
        } elseif( $field['type'] == 'multi_upload' ){
            if (isset($_POST[ $field['id'] ])){
                $meta_array = $_POST[ $field['id'] ];
                update_post_meta($post_id, $field['id'], $meta_array);
            } else {
                delete_post_meta($post_id, $field['id']);
            }
        } else {
            if( isset( $_POST[ $field['id'] ] ) )
                update_post_meta($post_id, $field['id'], esc_attr( $_POST[ $field['id'] ] )); 
        }
    }
}


/* HOME VIDEO TEMPLATE SAVE */
add_action( 'save_post', 'premitheme_save_home_video_metabox' );
function premitheme_save_home_video_metabox( $post_id )  {
    global $pt_home_video_metabox_options;
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['home-video-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['home-video-meta-box-nonce'], 'home_video_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_posts' ) ) return;  
    
    foreach ($pt_home_video_metabox_options as $field) {
        if( $field['type'] == 'heading' || $field['type'] == 'sep' ){
            // DO NOTHING
        } elseif( $field['type'] == 'checkbox' ){
            if( isset( $_POST[ $field['id'] ] ) ){
                update_post_meta($post_id, $field['id'], '1');
            } else {
                update_post_meta($post_id, $field['id'], '0');
            }
        } elseif( $field['type'] == 'multi_upload' ){
            if (isset($_POST[ $field['id'] ])){
                $meta_array = $_POST[ $field['id'] ];
                update_post_meta($post_id, $field['id'], $meta_array);
            } else {
                delete_post_meta($post_id, $field['id']);
            }
        } else {
            if( isset( $_POST[ $field['id'] ] ) )
                update_post_meta($post_id, $field['id'], esc_attr( $_POST[ $field['id'] ] )); 
        }
    }
}


/* HOME SLIDESHOW TEMPLATE SAVE */
add_action( 'save_post', 'premitheme_save_home_slideshow_metabox' );
function premitheme_save_home_slideshow_metabox( $post_id )  {
    global $pt_home_slideshow_metabox_options;
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['home-slideshow-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['home-slideshow-meta-box-nonce'], 'home_slideshow_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_posts' ) ) return;  
    
    foreach ($pt_home_slideshow_metabox_options as $field) {
        if( $field['type'] == 'heading' || $field['type'] == 'sep' ){
            // DO NOTHING
        } elseif( $field['type'] == 'checkbox' ){
            if( isset( $_POST[ $field['id'] ] ) ){
                update_post_meta($post_id, $field['id'], '1');
            } else {
                update_post_meta($post_id, $field['id'], '0');
            }
        } elseif( $field['type'] == 'multi_upload' ){
            if (isset($_POST[ $field['id'] ])){
                $meta_array = $_POST[ $field['id'] ];
                update_post_meta($post_id, $field['id'], $meta_array);
            } else {
                delete_post_meta($post_id, $field['id']);
            }
        } else {
            if( isset( $_POST[ $field['id'] ] ) )
                update_post_meta($post_id, $field['id'], esc_attr( $_POST[ $field['id'] ] )); 
        }
    }
}


/* ABOUT TEMPLATE SAVE */
add_action( 'save_post', 'premitheme_save_about_page_metabox' );
function premitheme_save_about_page_metabox( $post_id )  {
    global $pt_about_page_metabox_options;
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['about-page-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['about-page-meta-box-nonce'], 'about_page_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_posts' ) ) return;  
    
    foreach ($pt_about_page_metabox_options as $field) {
        if( $field['type'] == 'heading' || $field['type'] == 'sep' ){
            // DO NOTHING
        } elseif( $field['type'] == 'checkbox' ){
            if( isset( $_POST[ $field['id'] ] ) ){
                update_post_meta($post_id, $field['id'], '1');
            } else {
                update_post_meta($post_id, $field['id'], '0');
            }
        } elseif( $field['type'] == 'multi_upload' ){
            if (isset($_POST[ $field['id'] ])){
                $meta_array = $_POST[ $field['id'] ];
                update_post_meta($post_id, $field['id'], $meta_array);
            } else {
                delete_post_meta($post_id, $field['id']);
            }
        } else {
            if( isset( $_POST[ $field['id'] ] ) )
                update_post_meta($post_id, $field['id'], esc_attr( $_POST[ $field['id'] ] )); 
        }
    }
}


/* CONTACT TEMPLATE SAVE */
add_action( 'save_post', 'premitheme_save_contact_page_metabox' );
function premitheme_save_contact_page_metabox( $post_id )  {
    global $pt_contact_page_metabox_options;
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['contact-page-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['contact-page-meta-box-nonce'], 'contact_page_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_posts' ) ) return;  
    
    foreach ($pt_contact_page_metabox_options as $field) {
        if( $field['type'] == 'heading' || $field['type'] == 'sep' ){
            // DO NOTHING
        } elseif( $field['type'] == 'checkbox' ){
            if( isset( $_POST[ $field['id'] ] ) ){
                update_post_meta($post_id, $field['id'], '1');
            } else {
                update_post_meta($post_id, $field['id'], '0');
            }
        } elseif( $field['type'] == 'multi_upload' ){
            if (isset($_POST[ $field['id'] ])){
                $meta_array = $_POST[ $field['id'] ];
                update_post_meta($post_id, $field['id'], $meta_array);
            } else {
                delete_post_meta($post_id, $field['id']);
            }
        } else {
            if( isset( $_POST[ $field['id'] ] ) )
                update_post_meta($post_id, $field['id'], esc_attr( $_POST[ $field['id'] ] )); 
        }
    }
}


/* BG IMAGE SAVE */
add_action( 'save_post', 'premitheme_save_page_bg_metabox' );
function premitheme_save_page_bg_metabox( $post_id )  {
    global $pt_page_bg_metabox_options;
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['page-bg-meta-box-nonce'] ) || !wp_verify_nonce( $_POST['page-bg-meta-box-nonce'], 'page_bg_meta_box_nonce' ) ) return; 
    if( !current_user_can( 'edit_posts' ) ) return;  
    
    foreach ($pt_page_bg_metabox_options as $field) {
        if( $field['type'] == 'heading' || $field['type'] == 'sep' ){
            // DO NOTHING
        } elseif( $field['type'] == 'checkbox' ){
            if( isset( $_POST[ $field['id'] ] ) ){
                update_post_meta($post_id, $field['id'], '1');
            } else {
                update_post_meta($post_id, $field['id'], '0');
            }
        } elseif( $field['type'] == 'multi_upload' ){
            if (isset($_POST[ $field['id'] ])){
                $meta_array = $_POST[ $field['id'] ];
                update_post_meta($post_id, $field['id'], $meta_array);
            } else {
                delete_post_meta($post_id, $field['id']);
            }
        } else {
            if( isset( $_POST[ $field['id'] ] ) )
                update_post_meta($post_id, $field['id'], esc_attr( $_POST[ $field['id'] ] )); 
        }
    }
}

