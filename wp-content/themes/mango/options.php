<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {
    global $pt_shortname;

    $optionsframework_settings = get_option('optionsframework');
    $optionsframework_settings['id'] = $pt_shortname;
    update_option('optionsframework', $optionsframework_settings);
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {
    global $pt_themename;

    // Pull all the categories into an array
    $options_categories = array();  
    $options_categories_obj = get_categories('hide_empty=0');
    $options_categories[''] = __('Select a category', 'premitheme');
    foreach ($options_categories_obj as $category) {
        $options_categories[$category->cat_ID] = $category->cat_name;
    }

    // Pull all the pages into an array
    $options_pages = array();  
    $options_pages_obj = get_pages('sort_column=post_parent,menu_order');
    $options_pages[''] = __('Select a page (None)', 'premitheme');
    foreach ($options_pages_obj as $page) {
        $options_pages[$page->ID] = $page->post_title;
    }

    // If using image radio buttons, define a directory path
    $imagepath =  get_stylesheet_directory_uri() . '/images/radio/';

    $options = array();

    // GENERAL SETTINGS
    //================================//

    $options[] = array( "name" => __("General Settings", "premitheme"),
                        "type" => "heading");

    $options[] = array( "name" => __("Use Retina Featured Images (WARNING: This may slow down your website on retina devices)", "premitheme"),
                        "desc" => __("Use retina featured images for posts, pages and portfolio items for selected places (too big images by default will not generate retina version for not slowing down the site too much). This doesn't affect the logo, favicon, apple touch device icon, social icons and other icons used in the theme, these will be delivered as retina versions when needed as they will not affect the loading speed dramatically and will make a big difference in terms of site look. Anyway retina images will be used ONLY when a device with retina display detected, BUT PUT IN YOUR MIND if you checked this checkbox that this may affect your site's loading speed dramatically on retina devices. I warned you, okay?", "premitheme"),
                        "id" => "use_retina",
                        "std" => "0",
                        "type" => "checkbox");

    $options[] = array( "name" => __("Page Loading Progress Animation", "premitheme"),
                        "desc" => __("Use page loading progress animation.", "premitheme"),
                        "id" => "use_loading_animation",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => __("Floating Navigation", "premitheme"),
                        "desc" => __("Use floating navigation when scrolling down.", "premitheme"),
                        "id" => "use_floating_navigation",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => __("Centered Content", "premitheme"),
                        "desc" => __("Use centered content layout instead of being align to left.", "premitheme"),
                        "id" => "center_content",
                        "std" => "",
                        "type" => "checkbox");

    $options[] = array( "name" => __("Global Sidebar Position", "premitheme"),
                        "desc" => __("Select left/right sidebar position.", "premitheme"),
                        "id" => "sidebar_position",
                        "std" => "right",
                        "type" => "images",
                        "options" => array(
                                'right' => $imagepath . 'right.png',
                                'left' => $imagepath . 'left.png',
                            )
                        );

    $options[] = array( "name" => __("Child Pages Navigation Widget", "premitheme"),
                        "desc" => __("Turn on/off child pages navigation widget when viewing page with child pages.", "premitheme"),
                        "id" => "childs_nav",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => __("Global Blog Posts Comments On/Off", "premitheme"),
                        "desc" => __("Turn on/off the comments for blog posts", "premitheme"),
                        "id" => "posts_comments",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => __("Global Pages Comments On/Off", "premitheme"),
                        "desc" => __("Turn on/off the comments for pages", "premitheme"),
                        "id" => "pages_comments",
                        "std" => "0",
                        "type" => "checkbox");

    $options[] = array( "name" => __("Global Portfolio Comments On/Off", "premitheme"),
                        "desc" => __("Turn on/off the comments for portfolio items", "premitheme"),
                        "id" => "folio_comments",
                        "std" => "0",
                        "type" => "checkbox");

    $options[] = array( "name" => __("Old IE Warning Message", "premitheme"),
                        "desc" => __("Turn on/off warning message for IE 8 or older versions,", "premitheme"),
                        "id" => "ie_warning",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => __("Enable Lightbox", "premitheme"),
                        "desc" => __("Enable lightbox for content images/galleries. This doesn't affect the lighbox feature of portfolio thumbnails, preview images and sliders", "premitheme"),
                        "id" => "use_lightbox",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => __("Footer Copyright Note", "premitheme"),
                        "desc" => __("Type your copy right note here. You can use some html tags like <code>&lt;a href=\"\"&gt;&lt;/a&gt;</code> and <code>&lt;span class=\"\"&gt;&lt;/span&gt;</code>", "premitheme"),
                        "id" => "footer_note",
                        "std" => '&copy; 2013, Premium WordPress theme by <a href="http://premitheme.com">premitheme</a>. Sold exclusively on <a href="http://themeforest.net/user/premitheme/portfolio?ref=premitheme">ThemeForest.net</a>',
                        "type" => "textarea");

    $options[] = array( "name" => __("Tracking Code", "premitheme"),
                        "desc" => __("Paste your Google Analytics code here INCLUDING <code>&lt;script&gt;</code> tag.", "premitheme"),
                        "id" => "tracking_code",
                        "std" => "",
                        "type" => "textarea");


    // BLOG SETTINGS
    //================================//

    $options[] = array( "name" => __("Blog Settings", "premitheme"),
                        "type" => "heading");

    $options[] = array( "name" => __("Blog Title", "premitheme"),
                        "desc" => __("Enter the title you desire to appear on single blog posts. usually the same name of your blog page you have created.", "premitheme"),
                        "id" => "blog_title",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => __("Show full blog posts content", "premitheme"),
                        "desc" => __("Check to show full content instead of excerpt for posts content in blog main page and archives.", "premitheme"),
                        "id" => "blog_content",
                        "std" => "0",
                        "type" => "checkbox");

    $options[] = array( "name" => __("Related Posts", "premitheme"),
                        "desc" => __("Turn on/off related posts in single post pages", "premitheme"),
                        "id" => "show_related",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => __("Related Posts Heading", "premitheme"),
                        "desc" => __('Defaults to "Related Posts" if left empty.', "premitheme"),
                        "id" => "related_heading",
                        "std" => __("Related Posts", "premitheme"),
                        "class" => "",
                        "type" => "text");


    // PORTFOLIO SETTINGS
    //================================//

    $options[] = array( "name" => __("Portfolio Settings", "premitheme"),
                        "type" => "heading");

    $options[] = array( "name" => __("General", "premitheme"),
                        "desc" => "",
                        "type" => "info");

    $options[] = array( "name" => __("Portfolio Parent Page", "premitheme"),
                        "desc" => __("Select the parent portfolio page. This is necessary for some background functionality", "premitheme"),
                        "id" => "folio_parent",
                        "type" => "select",
                        "options" => $options_pages);

    $options[] = array( "name" => __("Items per Page", "premitheme"),
                        "desc" => __("Enter the number of portfolio items to be show per page. Leave it empty to show all items and disable portfolio pagination", "premitheme"),
                        "id" => "folio_perpage",
                        "std" => "",
                        "class" => "mini",
                        "type" => "text");

    $options[] = array( "name" => __("Portfolio Item Permalinks Base", "premitheme"),
                        "desc" => __('Customize the slug for portfolio items permalinks. This is useful if your portfolio are something like music, products, books ...etc. e.g. "products", "music" ...etc without quotes, lowercase, no spaces, <strong>AND YOU MUSTN\'T</strong> set the same value for this slug and portfolio page\'s slug to avoid permalinks and pagination issues.', "premitheme"),
                        "id" => "folio_item_slug",
                        "std" => "portfolio-items",
                        "class" => "",
                        "type" => "text");

    $options[] = array( "name" => __("Portfolio Category Permalinks Base", "premitheme"),
                        "desc" => __('Customize the slug for portfolio category permalinks. This is useful if your portfolio are something like music, products, books ...etc. e.g. "products", "music" ...etc without quotes, lowercase and no spaces.', "premitheme"),
                        "id" => "folio_cat_slug",
                        "std" => "portfolio-categories",
                        "class" => "",
                        "type" => "text");

    $options[] = array( "name" => __("Portfolio Skill Permalinks Base", "premitheme"),
                        "desc" => __('Customize the slug for portfolio skill permalinks. This is useful if your portfolio are something like music, products, books ...etc. e.g. "products", "music" ...etc without quotes, lowercase and no spaces.', "premitheme"),
                        "id" => "folio_skill_slug",
                        "std" => "portfolio-skills",
                        "class" => "",
                        "type" => "text");

    $options[] = array( "name" => __("Filtering", "premitheme"),
                        "desc" => __("Turn on/off portfolio filtering feature", "premitheme"),
                        "id" => "filtering_on",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => __("Similar Items", "premitheme"),
                        "desc" => __("Turn on/off similar items in single portfolio pages", "premitheme"),
                        "id" => "show_similar",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => __("Similar Work Heading", "premitheme"),
                        "desc" => __('Defaults to "Similar Work" if left empty.', "premitheme"),
                        "id" => "similar_heading",
                        "std" => __("Similar Work", "premitheme"),
                        "class" => "",
                        "type" => "text");

    $options[] = array( "name" => __("Portfolio RSS Feeds", "premitheme"),
                        "desc" => __("Turn on/off portfolio items from showing up in the main RSS feeds", "premitheme"),
                        "id" => "folio_rss",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => __("Portfolio Page Global Settings (necessary for non-fancy filtering Option)", "premitheme"),
                        "desc" => "",
                        "type" => "info");

    $options[] = array( "name" => __("Portfolio Layout", "premitheme"),
                        "desc" => __("This option complement the similar option in portfolio page template, but this is necessary when using non-fancy filtering option, otherwise you may get different thumbnails styles when you're viewing single portfolio filter.", "premitheme"),
                        "id" => "global_folio_main_layout",
                        "std" => "1",
                        "type" => "select",
                        "class" => "",
                        "options" => array(
                                '3col' => __('3 Columns','premitheme'),
                                '2col' => __('2 Columns','premitheme'),
                                '2col-sidebar' => __('2 Columns + sidebar','premitheme'),
                                )
                        );

    $options[] = array( "name" => __("Thumbnails Style", "premitheme"),
                        "desc" => __("This option complement the similar option in portfolio page template, but this is necessary when using non-fancy filtering option, otherwise you may get different thumbnails styles when you're viewing single portfolio filter.", "premitheme"),
                        "id" => "global_folio_thumbs_style",
                        "std" => "1",
                        "type" => "select",
                        "class" => "",
                        "options" => array(
                                "grid" => __("Grid style", "premitheme"),
                                "masonry" => __("Masonry style", "premitheme")
                                )
                        );

    $options[] = array( "name" => __("Thumbnails' Link Type", "premitheme"),
                        "desc" => __("This option complement the similar option in portfolio page template, but this is necessary when using non-fancy filtering option, otherwise you may get different thumbnail link type when you're viewing single portfolio filter.", "premitheme"),
                        "id" => "global_folio_thumbs_link",
                        "std" => "1",
                        "type" => "select",
                        "class" => "",
                        "options" => array(
                                "link" => __("Open single portofolio item", "premitheme"),
                                "lightbox" => __("Open lightbox", "premitheme")
                                )
                        );

    $options[] = array( "name" => __("Items Order By", "premitheme"),
                        "desc" => __("This option complement the similar option in portfolio page template, but this is necessary when using non-fancy filtering option, otherwise you may get different items order when you're viewing single portfolio filter.", "premitheme"),
                        "id" => "global_folio_orderby",
                        "std" => "1",
                        "type" => "select",
                        "class" => "",
                        "options" => array(
                                'date' => __('Item\'s creation date','premitheme'),
                                'menu_order' => __('Custom order','premitheme'),
                                'title' => __('Title','premitheme'),
                                'rand' => __('Random','premitheme')
                                )
                        );

    $options[] = array( "name" => __("Items Order", "premitheme"),
                        "desc" => __("This option complement the similar option in portfolio page template, but this is necessary when using non-fancy filtering option, otherwise you may get different items order direction when you're viewing single portfolio filter.", "premitheme"),
                        "id" => "global_folio_order",
                        "std" => "1",
                        "type" => "select",
                        "class" => "",
                        "options" => array(
                                "DESC" => __("Descending", "premitheme"),
                                "ASC" => __("Ascending", "premitheme")
                                )
                        );


    // CONTACT SETTINGS
    //================================//

    $options[] = array( "name" => __("Social Settings", "premitheme"),
                        "type" => "heading");

    $options[] = array( "name" => __("AIM", "premitheme"),
                        "desc" => __("Enter your AIM username", "premitheme"),
                        "id" => "social_aim",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => __("Behance", "premitheme"),
                        "desc" => __("Enter your profile URL", "premitheme"),
                        "id" => "social_behance",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => __("Delicious", "premitheme"),
                        "desc" => __("Enter your profile URL", "premitheme"),
                        "id" => "social_delicious",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => __("DeviantArt", "premitheme"),
                        "desc" => __("Enter your profile URL", "premitheme"),
                        "id" => "social_deviant",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => __("Digg", "premitheme"),
                        "desc" => __("Enter your profile URL", "premitheme"),
                        "id" => "social_digg",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => __("Dribbble", "premitheme"),
                        "desc" => __("Enter your profile URL", "premitheme"),
                        "id" => "social_dribbble",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => __("Facebook", "premitheme"),
                        "desc" => __("Enter your profile URL", "premitheme"),
                        "id" => "social_facebook",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => __("Flickr", "premitheme"),
                        "desc" => __("Enter your profile URL", "premitheme"),
                        "id" => "social_flickr",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => __("Forrst", "premitheme"),
                        "desc" => __("Enter your profile URL", "premitheme"),
                        "id" => "social_forrst",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => __("Github", "premitheme"),
                        "desc" => __("Enter your profile URL", "premitheme"),
                        "id" => "social_github",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => __("Google +", "premitheme"),
                        "desc" => __("Enter your profile URL", "premitheme"),
                        "id" => "social_gplus",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => __("IMDb", "premitheme"),
                        "desc" => __("Enter your profile URL", "premitheme"),
                        "id" => "social_imdb",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => __("Instagram", "premitheme"),
                        "desc" => __("Enter your profile URL", "premitheme"),
                        "id" => "social_instagram",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => __("Last FM", "premitheme"),
                        "desc" => __("Enter your profile URL", "premitheme"),
                        "id" => "social_lastfm",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => __("LinkedIn", "premitheme"),
                        "desc" => __("Enter your profile URL", "premitheme"),
                        "id" => "social_linkedin",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => __("PayPal", "premitheme"),
                        "desc" => __("Enter your profile URL", "premitheme"),
                        "id" => "social_paypal",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => __("Pinterest", "premitheme"),
                        "desc" => __("Enter your profile URL", "premitheme"),
                        "id" => "social_pinterest",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => __("Reddit", "premitheme"),
                        "desc" => __("Enter your profile URL", "premitheme"),
                        "id" => "social_reddit",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => __("RSS", "premitheme"),
                        "desc" => __("Enter your FeedBurner URL (http://feeds.feedburner.com/YOUR_URL)or any other feeds URL", "premitheme"),
                        "id" => "social_rss",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => __("Skype", "premitheme"),
                        "desc" => __("Enter your Skype username", "premitheme"),
                        "id" => "social_skype",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => __("SoundCloud", "premitheme"),
                        "desc" => __("Enter your profile URL", "premitheme"),
                        "id" => "social_soundcloud",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => __("Spotify", "premitheme"),
                        "desc" => __("Enter your profile URL", "premitheme"),
                        "id" => "social_spotify",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => __("Stumbleupon", "premitheme"),
                        "desc" => __("Enter your profile URL", "premitheme"),
                        "id" => "social_stumbleupon",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => __("Tumblr", "premitheme"),
                        "desc" => __("Enter your profile URL", "premitheme"),
                        "id" => "social_tumblr",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => __("Twitter", "premitheme"),
                        "desc" => __("Enter your profile URL", "premitheme"),
                        "id" => "social_twitter",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => __("Vimeo", "premitheme"),
                        "desc" => __("Enter your profile URL", "premitheme"),
                        "id" => "social_vimeo",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => __("WordPress.com", "premitheme"),
                        "desc" => __("Enter your profile URL", "premitheme"),
                        "id" => "social_wp",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => __("Yahoo", "premitheme"),
                        "desc" => __("Enter your Yahoo username", "premitheme"),
                        "id" => "social_yahoo",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => __("YouTube", "premitheme"),
                        "desc" => __("Enter your profile URL", "premitheme"),
                        "id" => "social_youtube",
                        "std" => "",
                        "type" => "text");


    // SHARING SETTINGS
    //================================//

    $options[] = array( "name" => __("Sharing Settings", "premitheme"),
                        "type" => "heading");

    $options[] = array( "name" => __("Blog Sharing Buttons", "premitheme"),
                        "desc" => __("Turn on/off sharing buttons in single post pages", "premitheme"),
                        "id" => "sharing_on",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => __("Portfolio Sharing Buttons", "premitheme"),
                        "desc" => __("Turn on/off sharing buttons in single portfolio pages", "premitheme"),
                        "id" => "folio_sharing",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => __("Customize Sharing Buttons", "premitheme"),
                        "desc" => "",
                        "type" => "info");

    $options[] = array( "name" => __("Facebook Sharing Button", "premitheme"),
                        "desc" => __("Include Facebook in blogpost/portfolio item's single page sharing buttons", "premitheme"),
                        "id" => "sharing_facebook",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => __("Twitter Sharing Button", "premitheme"),
                        "desc" => __("Include Twitter in blogpost/portfolio item's single page sharing buttons", "premitheme"),
                        "id" => "sharing_twitter",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => __("Google+ Sharing Button", "premitheme"),
                        "desc" => __("Include Google+ in blogpost/portfolio item's single page sharing buttons", "premitheme"),
                        "id" => "sharing_gplus",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => __("Pinterest Sharing Button", "premitheme"),
                        "desc" => __("Include Pinterest in blogpost/portfolio item's single page sharing buttons", "premitheme"),
                        "id" => "sharing_pinterest",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => __("LinkedIn Sharing Button", "premitheme"),
                        "desc" => __("Include LinkedIn in blogpost/portfolio item's single page sharing buttons", "premitheme"),
                        "id" => "sharing_linkedin",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => __("Twitter Display Name", "premitheme"),
                        "desc" => __("Required to show Twitter sharing button", "premitheme"),
                        "id" => "twitter_name",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => __("LinkedIn Display Name", "premitheme"),
                        "desc" => __("Required to show LinkedIn sharing button", "premitheme"),
                        "id" => "linkedin_name",
                        "std" => "",
                        "type" => "text");


    // BRANDING SETTINGS
    //================================//

    $options[] = array( "name" => __("Branding Settings", "premitheme"),
                        "type" => "heading");

    $options[] = array( "name" => __("Logo Settings", "premitheme"),
                        "desc" => "",
                        "type" => "info");

    $options[] = array( "name" => __("Logo Image", "premitheme"),
                        "desc" => __("Upload/Select image to be used as site logo. PNG, JPG or GIF images are allowed", "premitheme"),
                        "id" => "site_logo",
                        "type" => "upload");

    $options[] = array( "name" => __("Retina Logo Image", "premitheme"),
                        "desc" => __("Upload/Select image to be used as retina version or your site logo. PNG, JPG or GIF images are allowed. It MUST be (width x 2) and (height x 2) of the normal logo size.", "premitheme"),
                        "id" => "site_logo_retina",
                        "type" => "upload");

    $options[] = array( "name" => __("Favicon", "premitheme"),
                        "desc" => __("Upload/Select (ico) image 16x16 px to be used as favicon", "premitheme"),
                        "id" => "favicon",
                        "type" => "upload");

    $options[] = array( "name" => __("Retina Favicon", "premitheme"),
                        "desc" => __("Upload/Select (ico) image 32x32 px to be used as retina version for favicon.", "premitheme"),
                        "id" => "favicon_retina",
                        "type" => "upload");

    $options[] = array( "name" => __("Apple Touch Devices Icon (57x57)", "premitheme"),
                        "desc" => __("Upload/Select (png) image to be used as webclip icon for apple iPhone non-retina devices. MUST be 57x57 px", "premitheme"),
                        "id" => "apple_icon",
                        "type" => "upload");

    $options[] = array( "name" => __("Apple Touch Devices Icon (72x72)", "premitheme"),
                        "desc" => __("Upload/Select (png) image to be used as webclip icon for apple iPad non-retina devices. MUST be 72x72 px", "premitheme"),
                        "id" => "apple_icon_72",
                        "type" => "upload");

    $options[] = array( "name" => __("Apple Touch Devices Icon (114x114)", "premitheme"),
                        "desc" => __("Upload/Select (png) image to be used as webclip icon for apple iPhone retina devices. MUST be 114x114 px", "premitheme"),
                        "id" => "apple_icon_114",
                        "type" => "upload");

    $options[] = array( "name" => __("Apple Touch Devices Icon (144x144)", "premitheme"),
                        "desc" => __("Upload/Select (png) image to be used as webclip icon for apple iPad retina devices. MUST be 144x144 px", "premitheme"),
                        "id" => "apple_icon_144",
                        "type" => "upload");

    $options[] = array( "name" => __("Custom Colors Settings", "premitheme"),
                        "desc" => "",
                        "type" => "info");

    $options[] = array( "name" => __("Starter Skin Color", "premitheme"),
                        "desc" => __("Select the light or dark skin color", "premitheme"),
                        "id" => "skin_color",
                        "std" => "light",
                        "type" => "select",
                        "class" => "mini",
                        "options" => array(
                            'light' => __("Light", "premitheme"),
                            'dark' => __("Dark", "premitheme"),
                            )
                        );

    $options[] = array( "name" => __("Custom Accent Color", "premitheme"),
                        "desc" => __("Select custom accent color", "premitheme"),
                        "id" => "cus_accent_color",
                        "std" => "",
                        "type" => "color");

    $options[] = array( "name" => __("Accent Color Foreground", "premitheme"),
                        "desc" => __("Select accent color foreground (color of elements/text on accent color).", "premitheme"),
                        "id" => "on_accent_color",
                        "std" => "",
                        "type" => "color");

    $options[] = array( "name" => __("Custom Logo Background Color", "premitheme"),
                        "desc" => __("Select custom logo background color to suite your logo instead of the accent color. Leave this empty to use the accent color as logo background color.", "premitheme"),
                        "id" => "logo_bg_color",
                        "std" => "",
                        "class" => "",
                        "type" => "color");

    $options[] = array( "name" => __("Global Background Settings", "premitheme"),
                        "desc" => "",
                        "type" => "info");

    $options[] = array( "name" => __("Global Background Image", "premitheme"),
                        "desc" => __("Select/upload custom background image. This will be use on all pages unless you set custom backgrouns for individual pages in its settings. Doesn't apply for home fullscreen video/slideshow page templates.", "premitheme"),
                        "id" => "bg_img",
                        "type" => "upload");

    $options[] = array( "name" => __("Global Background Color", "premitheme"),
                        "desc" => __("Select custom background color", "premitheme"),
                        "id" => "global_bg_color",
                        "std" => "",
                        "class" => "",
                        "type" => "color");

    $options[] = array( "name" => __("Global On-background Text Color", "premitheme"),
                        "desc" => __("Select custom color for text palced on background (main navigation links, page heading ...etc).", "premitheme"),
                        "id" => "global_on_bg_color",
                        "std" => "",
                        "type" => "color");

    $options[] = array( "name" => __("Fullscreen Background", "premitheme"),
                        "desc" => __("Turn on/off the fullscreen background option.", "premitheme"),
                        "id" => "use_full_bg",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => __("Background X position", "premitheme"),
                        "desc" => __("Enter \"left\", \"center\", \"right\" or value suffixed with \"px\" like \"200px\". All without quotes.", "premitheme"),
                        "id" => "bg_x_pos",
                        "class" => "mini hidden",
                        "type" => "text");

    $options[] = array( "name" => __("Background Y position", "premitheme"),
                        "desc" => __("Enter \"top\", \"center\", \"bottom\" or value suffixed with \"px\" like \"200px\". All without quotes.", "premitheme"),
                        "id" => "bg_y_pos",
                        "class" => "mini hidden",
                        "type" => "text");

    $options[] = array( "name" => __("Background Image Repeat", "premitheme"),
                        "desc" => __("Select background image repeat option.", "premitheme"),
                        "id" => "bg_repeat",
                        "std" => "0",
                        "type" => "select",
                        "class" => "mini hidden",
                        "options" => array(
                                "0" => __("Select...", "premitheme"),
                                "no-repeat" => __("No repeat", "premitheme"),
                                "repeat" => __("Repeat all (Tile)", "premitheme"),
                                "repeat-x" => __("Repeat Horizontally", "premitheme"),
                                "repeat-y" => __("Repeat Vertically", "premitheme")
                                )
                        );

    $options[] = array( "name" => __("Background Image Attachment", "premitheme"),
                        "desc" => __("Select background image attachment, fixed or scrollable.", "premitheme"),
                        "id" => "bg_att",
                        "std" => "0",
                        "type" => "select",
                        "class" => "mini hidden",
                        "options" => array(
                                "0" => __("Select...", "premitheme"),
                                "fixed" => __("Fixed", "premitheme"),
                                "scroll" => __("Scrollable", "premitheme")
                                )
                        );

    $options[] = array( "name" => __("Background Overlay", "premitheme"),
                        "desc" => __("Helps masking video quality degradation on big displays and looks stylish as well. Turn off if you don't like it.", "premitheme"),
                        "id" => "use_bg_overlay",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => __("Custom Font Settings", "premitheme"),
                        "desc" => "",
                        "type" => "info");

    $options[] = array( "name" => __("Custom @Font-Face Stylesheet", "premitheme"),
                        "desc" => __("Paste the entire <code>&lt;link&gt;</code> tag of Google web font's (or custom @font-face) stylesheet.", "premitheme"),
                        "id" => "cus_font_stylesheet",
                        "std" => "",
                        "type" => "textarea");

    $options[] = array( "name" => __("Custom @Font-Face CSS Font Family", "premitheme"),
                        "desc" => __("Paste the CSS rule for the font family. e.g. <code>font-family: 'Font Name';</code> ", "premitheme"),
                        "id" => "cus_font_family",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => __("Custom CSS Settings", "premitheme"),
                        "desc" => "",
                        "type" => "info");

    $options[] = array( "name" => __("Custom CSS", "premitheme"),
                        "desc" => __("Need to style specific elements? paste your custom css here", "premitheme"),
                        "id" => "custom_css",
                        "std" => "",
                        "type" => "textarea");

    return $options;
}