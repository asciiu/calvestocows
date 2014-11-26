<?php
/* ADD METABOXS
=====================*/

add_action( 'add_meta_boxes', 'premitheme_content_builder_metabox' );
function premitheme_content_builder_metabox() {
    add_meta_box( 'content_builder_settings', __('Content Builder Settings', 'premitheme'), 'premitheme_render_content_builder_metabox', 'page', 'normal' , 'high' );
}


/* RENDER METABOXS
=====================*/

/* CONTENT BUILDER METABOX */
function premitheme_render_content_builder_metabox( $post ) {
    global $post, $pt_themeFullWidth;

    $post_vals = get_post_custom( $post->ID );
    $useFooter = isset( $post_vals['use_home_footer'] ) ? esc_attr( $post_vals['use_home_footer'][0] ) : '1';

    $section_selects = get_post_meta($post->ID, "section_select", true);

    $callout_messages = get_post_meta($post->ID, "callout_message", true);

    $slider_sets = get_post_meta($post->ID, "slider_set", true);
    $slider_heights = get_post_meta($post->ID, "slider_height", true);
    $slider_orderbys = get_post_meta($post->ID, "slider_orderby", true);
    $slider_orders = get_post_meta($post->ID, "slider_order", true);

    $video_banner_embeds = get_post_meta($post->ID, "video_banner_embed", true);
    $video_banner_urls = get_post_meta($post->ID, "video_banner_url", true);
    $video_banner_m4vs = get_post_meta($post->ID, "video_banner_mfourv", true);
    $video_banner_ogvs = get_post_meta($post->ID, "video_banner_ogv", true);
    $video_banner_posters = get_post_meta($post->ID, "video_banner_poster", true);
    $video_banner_heights = get_post_meta($post->ID, "video_banner_height", true);

    $fixed_img_urls = get_post_meta($post->ID, "fixed_img_url", true);
    $fixed_img_heights = get_post_meta($post->ID, "fixed_img_height", true);
    $fixed_img_links = get_post_meta($post->ID, "fixed_img_link", true);
    $fixed_img_titleAttrs = get_post_meta($post->ID, "fixed_img_titleAttr", true);

    $grid_showcase_counts = get_post_meta($post->ID, "grid_showcase_count", true);
    $grid_showcase_labels = get_post_meta($post->ID, "grid_showcase_label", true);
    $grid_showcase_descs = get_post_meta($post->ID, "grid_showcase_desc", true);
    $grid_showcase_cats = get_post_meta($post->ID, "grid_showcase_cat", true);
    $grid_showcase_opens = get_post_meta($post->ID, "grid_showcase_open", true);
    $grid_showcase_orderbys = get_post_meta($post->ID, "grid_showcase_orderby", true);
    $grid_showcase_orders = get_post_meta($post->ID, "grid_showcase_order", true);

    $recent_work_counts = get_post_meta($post->ID, "recent_work_count", true);
    $recent_work_labels = get_post_meta($post->ID, "recent_work_label", true);
    $recent_work_descs = get_post_meta($post->ID, "recent_work_desc", true);
    $recent_work_links = get_post_meta($post->ID, "recent_work_link", true);
    $recent_work_cats = get_post_meta($post->ID, "recent_work_cat", true);
    $recent_work_opens = get_post_meta($post->ID, "recent_work_open", true);
    $recent_work_orderbys = get_post_meta($post->ID, "recent_work_orderby", true);
    $recent_work_orders = get_post_meta($post->ID, "recent_work_order", true);

    $recent_posts_labels = get_post_meta($post->ID, "recent_posts_label", true);
    $recent_posts_descs = get_post_meta($post->ID, "recent_posts_desc", true);
    $recent_posts_links = get_post_meta($post->ID, "recent_posts_link", true);
    $recent_posts_cats = get_post_meta($post->ID, "recent_posts_cat", true);
    $recent_posts_orderbys = get_post_meta($post->ID, "recent_posts_orderby", true);
    $recent_posts_orders = get_post_meta($post->ID, "recent_posts_order", true);

    $clients_labels = get_post_meta($post->ID, "clients_label", true);
    $clients_descs = get_post_meta($post->ID, "clients_desc", true);
    $clients_orderbys = get_post_meta($post->ID, "clients_orderby", true);
    $clients_orders = get_post_meta($post->ID, "clients_order", true);

    $twitter_ids = get_post_meta($post->ID, "twitter_id", true);
    $twitter_cons_keys = get_post_meta($post->ID, "twitter_cons_key", true);
    $twitter_cons_secrets = get_post_meta($post->ID, "twitter_cons_secret", true);
    $twitter_acc_tokens = get_post_meta($post->ID, "twitter_acc_token", true);
    $twitter_acc_secrets = get_post_meta($post->ID, "twitter_acc_secret", true);

    $slider_cats = get_categories('taxonomy=slider_sets');
    $folio_cats = get_categories('taxonomy=portfolio_cats');
    $blog_cats = get_categories();

    wp_nonce_field( 'content_builder_meta_box_nonce', 'content-builder-meta-box-nonce' );
?>
    <div class="section heading-section first">
        <h4><?php _e('Footer Wingets', 'premitheme'); ?></h4>
    </div>

    <div class="section checkbox-section first">
        <input type="checkbox" name="use_home_footer" id="use_home_footer" <?php checked( $useFooter, '1' ); ?>/>
        <label for="use_home_footer"><?php _e('Show Footer Widgets Area', 'premitheme'); ?></label>
    </div>

    <div class="section heading-section">
        <h4><?php _e('Content Sections', 'premitheme'); ?></h4>
    </div>

    <div class="section first">
        <label for="section_select"><?php _e('Add, remove, edit or arrange content sections', 'premitheme') ?></label>
        <ul id="content-builder-repeatable" class="field_repeatable section-sortable">
            <?php if( $section_selects ){
                $i = 0;
                foreach( $section_selects as $key => $section_select){
                    $section = $section_select;

                    $calloutMessage = $callout_messages[$key];

                    $sliderSet = $slider_sets[$key];
                    $sliderHeight = $slider_heights[$key];
                    $sliderOrderby = $slider_orderbys[$key];
                    $sliderOrder = $slider_orders[$key];

                    $videoBannerEmbed = $video_banner_embeds[$key];
                    $videoBannerURL = $video_banner_urls[$key];
                    $videoBannerM4v = $video_banner_m4vs[$key];
                    $videoBannerOgv = $video_banner_ogvs[$key];
                    $videoBannerPoster = $video_banner_posters[$key];
                    $videoBannerHeight = $video_banner_heights[$key];

                    $fixedImgURL = $fixed_img_urls[$key];
                    $fixedImgHeight = $fixed_img_heights[$key];
                    $fixedImgLink = $fixed_img_links[$key];
                    $fixedImgTitleAttr = $fixed_img_titleAttrs[$key];

                    $gridShowcaseCount = $grid_showcase_counts[$key];
                    $gridShowcaseLabel = $grid_showcase_labels[$key];
                    $gridShowcaseDesc = $grid_showcase_descs[$key];
                    $gridShowcaseCat = $grid_showcase_cats[$key];
                    $gridShowcaseOpen = $grid_showcase_opens[$key];
                    $gridShowcaseOrderby = $grid_showcase_orderbys[$key];
                    $gridShowcaseOrder = $grid_showcase_orders[$key];

                    $recentWorkCount = $recent_work_counts[$key];
                    $recentWorkLabel = $recent_work_labels[$key];
                    $recentWorkDesc = $recent_work_descs[$key];
                    $recentWorkLink = $recent_work_links[$key];
                    $recentWorkCat = $recent_work_cats[$key];
                    $recentWorkOpen = $recent_work_opens[$key];
                    $recentWorkOrderby = $recent_work_orderbys[$key];
                    $recentWorkOrder = $recent_work_orders[$key];

                    $recentPostsLabel = $recent_posts_labels[$key];
                    $recentPostsDesc = $recent_posts_descs[$key];
                    $recentPostsLink = $recent_posts_links[$key];
                    $recentPostsCat = $recent_posts_cats[$key];
                    $recentPostsOrderby = $recent_posts_orderbys[$key];
                    $recentPostsOrder = $recent_posts_orders[$key];

                    $clientsLabel = $clients_labels[$key];
                    $clientsDesc = $clients_descs[$key];
                    $clientsOrderby = $clients_orderbys[$key];
                    $clientsOrder = $clients_orders[$key];

                    $twitterId = $twitter_ids[$key];
                    $twitterConsKey = $twitter_cons_keys[$key];
                    $twitterConsSecret = $twitter_cons_secrets[$key];
                    $twitterAccToken = $twitter_acc_tokens[$key];
                    $twitterAccSecret = $twitter_acc_secrets[$key];

                    $VidPosterPreview = '';
                    $FixedImgPreview = '';
                    if($videoBannerPoster){
                        $image_id = premitheme_get_attachment_id_by_src($videoBannerPoster);
                        $image = wp_get_attachment_image_src($image_id, 'medium');
                        $VidPosterPreview = '<img src="'.$image[0].'" class="upload-preview-img" alt="" style="display:none;" width="150px"/>';
                    }
                    if($fixedImgURL){
                        $image_id = premitheme_get_attachment_id_by_src($fixedImgURL);
                        $image = wp_get_attachment_image_src($image_id, 'medium');
                        $FixedImgPreview = '<img src="'.$image[0].'" class="upload-preview-img" alt="" style="display:none;" width="150px"/>';
                    }
            ?>
                <li class="postbox closed content-section-wrapper">
                    <a title="<?php _e('Remove', 'premitheme'); ?>" class="repeatable-remove button" href="#"><i class="fa fa-trash-o"></i></a>
                    <div title="<?php _e('Section Settings', 'premitheme'); ?>" class="handlediv button"><i class="fa fa-cog"></i></div>

                    <div class="content-section-header">
                        <span class="sort hndle button" title="<?php _e('Drag to arrange', 'premitheme'); ?>"><i class="fa fa-bars"></i></span>
                        <select class="section-select increment" name="section_select[<?php echo $i; ?>]" id="section_select">
                             <option <?php selected($section, '0'); ?> value="0"><?php _e('Please select &hellip;', 'premitheme'); ?></option>
                             <option <?php selected($section, 'callout-message'); ?> value="callout-message"><?php _e('Callout Message', 'premitheme'); ?></option>
                             <option <?php selected($section, 'flex-slider'); ?> value="flex-slider"><?php _e('Flex Slider', 'premitheme'); ?></option>
                             <option <?php selected($section, 'video-banner'); ?> value="video-banner"><?php _e('Video Banner', 'premitheme'); ?></option>
                             <option <?php selected($section, 'fixed-image'); ?> value="fixed-image"><?php _e('Fixed Image Banner', 'premitheme'); ?></option>
                             <option <?php selected($section, 'grid-showcase'); ?> value="grid-showcase"><?php _e('Portfolio Grid Showcase', 'premitheme'); ?></option>
                             <option <?php selected($section, 'recent-work-row'); ?> value="recent-work-row"><?php _e('Recent Work', 'premitheme'); ?></option>
                             <option <?php selected($section, 'recent-posts-row'); ?> value="recent-posts-row"><?php _e('Recent Posts', 'premitheme'); ?></option>
                             <option <?php selected($section, 'clients'); ?> value="clients"><?php _e('Clients', 'premitheme'); ?></option>
                             <option <?php selected($section, 'twitter'); ?> value="twitter"><?php _e('Last Twitter Feed', 'premitheme'); ?></option>
                             <option <?php selected($section, 'custom'); ?> value="custom"><?php _e('Custom Content', 'premitheme'); ?></option>
                        </select>
                    </div>

                    <div class="inside content-section-settings">
                        <!-- CALLOUT MESSGAE SECTION
                        ========================================== -->
                        <div id="callout-message-section" class="sub-section">
                            <label for="callout_message"><?php _e('Callout Message', 'premitheme'); ?></label><br/>
                            <textarea class="increment" id="callout_message" name="callout_message[<?php echo $i; ?>]" cols="50" rows="4"><?php echo $calloutMessage; ?></textarea>
                            <p><?php _e('Description text', 'premitheme'); ?></p>
                        </div>

                        <!-- FLEX SLIDER SECTION
                        ========================================== -->
                        <div id="flex-slider-section" class="sub-section">
                            <label for="slider_set"><?php _e('Slider Set', 'premitheme'); ?></label><br/>
                            <select class="medium increment" id="slider_set" name="slider_set[<?php echo $i; ?>]">
                                <option value="all" <?php selected('all', $sliderSet); ?>><?php _e('All Slides', 'premitheme'); ?></option>
                                <?php foreach ($slider_cats as $slider_cat): ?>
                                    <option value="<?php echo $slider_cat->cat_ID; ?>" <?php selected($slider_cat->cat_ID, $sliderSet); ?>><?php echo $slider_cat->cat_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <p><?php _e('Select slider set to display its slides.', 'premitheme'); ?></p>

                            <div class="sep"></div>

                            <label for="slider_height"><?php _e('Slider Height', 'premitheme'); ?></label><br/>
                            <input class="small increment" type="text" id="slider_height" name="slider_height[<?php echo $i; ?>]" value="<?php echo $sliderHeight; ?>">px
                            <p><?php _e('Required. Defaults to 300px if left empty', 'premitheme'); ?></p>

                            <div class="sep"></div>

                            <label for="slider_orderby"><?php _e('Slides Order By', 'premitheme'); ?></label><br/>
                            <select class="medium increment" id="slider_orderby" name="slider_orderby[<?php echo $i; ?>]">
                                <option value="date" <?php selected('date', $sliderOrder); ?>><?php _e('Creation date', 'premitheme'); ?></option>
                                <option value="menu_order" <?php selected('menu_order', $sliderOrder); ?>><?php _e('Custom order', 'premitheme'); ?></option>
                                <option value="rand" <?php selected('rand', $sliderOrder); ?>><?php _e('Random', 'premitheme'); ?></option>
                            </select>

                            <div class="sep"></div>

                            <label for="slider_order"><?php _e('Slides Order', 'premitheme'); ?></label><br/>
                            <select class="medium increment" id="slider_order" name="slider_order[<?php echo $i; ?>]">
                                <option value="DESC" <?php selected('DESC', $sliderOrder); ?>><?php _e('Descending', 'premitheme'); ?></option>
                                <option value="ASC" <?php selected('ASC', $sliderOrder); ?>><?php _e('Ascending', 'premitheme'); ?></option>
                            </select>
                        </div>

                        <!-- VIDEO BANNER SECTION
                        ========================================== -->
                        <div id="video-banner-section" class="sub-section">
                            <label for="video_banner_embed"><?php _e('Remotely Hosted Video Embed Code (Use instead of the next field below for more controlled video embedding).', 'premitheme'); ?></label><br/>
                            <textarea class="increment" id="video_banner_embed" name="video_banner_embed[<?php echo $i; ?>]" cols="50" rows="4"><?php echo $videoBannerEmbed; ?></textarea>
                            <p><?php printf( __('Enter the embed code of remotely-hosted video. Overrides the next field.Set the height according to %s width.', 'premitheme'), $pt_themeFullWidth); ?></p>

                            <div class="sep"></div>

                            <label for="video_banner_url"><?php _e('Remotely Hosted Video URL (For easy embed, if not using embed code above).', 'premitheme'); ?></label><br/>
                            <input class="increment" type="text" id="video_banner_url" name="video_banner_url[<?php echo $i; ?>]" value="<?php echo $videoBannerURL; ?>">
                            <p><?php _e('Enter just the URL of the video page (auto embed). Only remotely-hosted videos supported (i.e. youtube, vimeo &hellip; etc).', 'premitheme');?><a href="http://codex.wordpress.org/Embeds" target="_blank"><?php _e( 'List of supported video hosts', 'premitheme'); ?></a>. <?php _e('Always use the full absolute URL including "http://".', 'premitheme' ); ?></p>

                            <div class="sep"></div>

                            <ul>
                                <li>
                                    <label for="video_banner_mfourv"><?php _e('Self-hosted M4V Video File', 'premitheme'); ?></label><br/>
                                    <input class="increment" type="text" id="video_banner_mfourv" name="video_banner_mfourv[<?php echo $i; ?>]" placeholder="<?php _e('No file chosen', 'premitheme'); ?>" value="<?php echo $videoBannerM4v; ?>">
                                    <input type="button" name="upload_image_button" class="upload_img button" value="<?php _e('Upload', 'premitheme'); ?>"/>
                                    <a class="value-remove button" href="#"><?php _e('&times;', 'premitheme'); ?></a>
                                    <p><?php _e('MUST be provided.', 'premitheme'); ?></p>
                                </li>
                            </ul>

                            <div class="sep"></div>

                            <ul>
                                <li>
                                    <label for="video_banner_ogv"><?php _e('Self-hosted OGV/OGG Video File', 'premitheme'); ?></label><br/>
                                    <input class="increment" type="text" id="video_banner_ogv" name="video_banner_ogv[<?php echo $i; ?>]" placeholder="<?php _e('No file chosen', 'premitheme'); ?>" value="<?php echo $videoBannerOgv; ?>">
                                    <input type="button" name="upload_image_button" class="upload_img button" value="<?php _e('Upload', 'premitheme'); ?>"/>
                                    <a class="value-remove button" href="#"><?php _e('&times;', 'premitheme'); ?></a>
                                    <p><?php _e( 'MUST be provided, for better browser support.', 'premitheme' ); ?></p>
                                </li>
                            </ul>

                            <div class="sep"></div>

                            <ul>
                                <li>
                                    <label for="video_banner_poster"><?php _e('Self-hosted Video Poster Image', 'premitheme'); ?></label><br/>
                                    <input class="increment" type="text" id="video_banner_poster" name="video_banner_poster[<?php echo $i; ?>]" placeholder="<?php _e('No file chosen', 'premitheme'); ?>" value="<?php echo $videoBannerPoster; ?>">
                                    <input type="button" name="upload_image_button" class="upload_img button" value="<?php _e('Upload', 'premitheme'); ?>"/>
                                    <a class="value-remove button" href="#"><?php _e('&times;', 'premitheme'); ?></a>
                                    <?php echo $VidPosterPreview; ?>
                                    <p><?php _e( 'MUST be provided, to be shown before play.', 'premitheme' ); ?></p>
                                </li>
                            </ul>

                            <div class="sep"></div>

                            <label for="video_banner_height"><?php _e('Self-hosted Video Height', 'premitheme'); ?></label><br/>
                            <input type="text" id="video_banner_height" name="video_banner_height[<?php echo $i; ?>]" value="<?php echo $videoBannerHeight; ?>" class="small increment">px
                            <p><?php printf( __('MUST be provided, according to %s width. Could be decimal number.', 'premitheme'), $pt_themeFullWidth); ?></p>
                        </div>

                        <!-- FIXED IMAGE SECTION
                        ========================================== -->
                        <div id="fixed-image-section" class="sub-section">
                            <ul>
                                <li>
                                    <label for="fixed_img_url"><?php _e('Image URL', 'premitheme'); ?></label><br/>
                                    <input class="increment" type="text" id="fixed_img_url" name="fixed_img_url[<?php echo $i; ?>]" placeholder="<?php _e('No file chosen', 'premitheme'); ?>" value="<?php echo $fixedImgURL; ?>">
                                    <input type="button" name="upload_image_button" class="upload_img button" value="<?php _e('Upload', 'premitheme'); ?>"/>
                                    <a class="value-remove button" href="#"><?php _e('&times;', 'premitheme'); ?></a>
                                    <?php echo $FixedImgPreview; ?>
                                    <p><?php printf( __('Image shouldn\'t be less than <strong>%s width</strong> with no height limitations. Always use the full absolute URL including "http://"', 'premitheme'), $pt_themeFullWidth); ?></p>
                                </li>
                            </ul>

                            <div class="sep"></div>

                            <label for="fixed_img_height"><?php _e('Image Height', 'premitheme'); ?></label><br/>
                            <input class="small increment" type="text" id="fixed_img_height" name="fixed_img_height[<?php echo $i; ?>]" value="<?php echo $fixedImgHeight; ?>">px
                            <p><?php _e('Required. Defaults to 300px if left empty', 'premitheme'); ?></p>

                            <div class="sep"></div>

                            <label for="fixed_img_link"><?php _e('Image Link (optional)', 'premitheme'); ?></label><br/>
                            <input class="increment" type="text" id="fixed_img_link" name="fixed_img_link[<?php echo $i; ?>]" value="<?php echo $fixedImgLink; ?>">
                            <p><?php _e('Enter a link URL if you want the image to be hyperlinked to somewhere. Always use the full absolute URL including "http://"', 'premitheme'); ?></p>

                            <div class="sep"></div>

                            <label for="fixed_img_titleAttr"><?php _e('Image Title Attribute (optional)', 'premitheme'); ?></label><br/>
                            <input class="increment" type="text" id="fixed_img_titleAttr" name="fixed_img_titleAttr[<?php echo $i; ?>]" value="<?php echo $fixedImgTitleAttr; ?>">
                            <p><?php _e('Enter an optional title attribute text to be shown when hover over the image.', 'premitheme'); ?></p>
                        </div>

                        <!-- GRID SHOWCASE SECTION
                        ========================================== -->
                        <div id="grid-showcase-section" class="sub-section">
                            <label for="grid_showcase_label"><?php _e('Grid Showcase Heading (optional)', 'premitheme'); ?></label><br/>
                            <input class="increment" type="text" id="grid_showcase_label" name="grid_showcase_label[<?php echo $i; ?>]" value="<?php echo $gridShowcaseLabel; ?>">

                            <div class="sep"></div>

                            <label for="grid_showcase_desc"><?php _e('Grid Showcase Description (optional)', 'premitheme'); ?></label><br/>
                            <textarea class="increment" id="grid_showcase_desc" name="grid_showcase_desc[<?php echo $i; ?>]" cols="50" rows="4"><?php echo $gridShowcaseDesc; ?></textarea>

                            <div class="sep"></div>

                            <label for="grid_showcase_count"><?php _e('Number of Rows', 'premitheme'); ?></label><br/>
                            <select class="medium increment" id="grid_showcase_count" name="grid_showcase_count[<?php echo $i; ?>]">
                                <option value="2" <?php selected('2', $gridShowcaseCount); ?>><?php _e('Two rows' ,'premitheme');?></option>
                                <option value="3" <?php selected('3', $gridShowcaseCount); ?>><?php _e('Three rows' ,'premitheme');?></option>
                            </select>

                            <div class="sep"></div>

                            <label for="grid_showcase_cat"><?php _e('Portfolio Category', 'premitheme'); ?></label><br/>
                            <select class="medium increment" id="grid_showcase_cat" name="grid_showcase_cat[<?php echo $i; ?>]">
                                <option value="all" <?php selected('all', $gridShowcaseCat); ?>><?php _e('All', 'premitheme'); ?></option>
                                <?php foreach ($folio_cats as $folio_cat): ?>
                                    <option value="<?php echo $folio_cat->cat_ID; ?>" <?php selected($folio_cat->cat_ID, $gridShowcaseCat); ?>><?php echo $folio_cat->cat_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <p><?php _e( 'Select portfolio category to display its items', 'premitheme' ); ?></p>

                            <div class="sep"></div>

                            <label for="grid_showcase_open"><?php _e('Open in ...', 'premitheme'); ?></label><br/>
                            <select class="medium increment" id="grid_showcase_open" name="grid_showcase_open[<?php echo $i; ?>]">
                                <option value="page" <?php selected('page', $gridShowcaseOpen); ?>><?php _e('Separate Page' ,'premitheme');?></option>
                                <option value="lightbox" <?php selected('lightbox', $gridShowcaseOpen); ?>><?php _e('Lightbox' ,'premitheme');?></option>
                            </select>

                            <div class="sep"></div>

                            <label for="grid_showcase_orderby"><?php _e('Items Order By', 'premitheme'); ?></label><br/>
                            <select class="medium increment" id="grid_showcase_orderby" name="grid_showcase_orderby[<?php echo $i; ?>]">
                                <option value="date" <?php selected('date', $gridShowcaseOrderby); ?>><?php _e('Item\'s creation date' ,'premitheme');?></option>
                                <option value="menu_order" <?php selected('menu_order', $gridShowcaseOrderby); ?>><?php _e('Custom order' ,'premitheme');?></option>
                                <option value="title" <?php selected('title', $gridShowcaseOrderby); ?>><?php _e('Title' ,'premitheme');?></option>
                                <option value="rand" <?php selected('rand', $gridShowcaseOrderby); ?>><?php _e('Random' ,'premitheme');?></option>
                            </select>

                            <div class="sep"></div>

                            <label for="grid_showcase_order"><?php _e('Items Order', 'premitheme'); ?></label><br/>
                            <select class="medium increment" id="grid_showcase_order" name="grid_showcase_order[<?php echo $i; ?>]">
                                <option value="DESC" <?php selected('DESC', $gridShowcaseOrder); ?>><?php _e('Descending' ,'premitheme');?></option>
                                <option value="ASC" <?php selected('ASC', $gridShowcaseOrder); ?>><?php _e('Ascending' ,'premitheme');?></option>
                            </select>
                        </div>

                        <!-- RECENT WORK SECTION
                        ========================================== -->
                        <div id="recent-work-section" class="sub-section">
                            <label for="recent_work_label"><?php _e('Recent Work Label', 'premitheme'); ?></label><br/>
                            <input class="increment" type="text" id="recent_work_label" name="recent_work_label[<?php echo $i; ?>]" value="<?php echo $recentWorkLabel; ?>">
                            <p><?php _e( 'Defaults to "Recent Work" if left empty.', 'premitheme' ); ?></p>

                            <div class="sep"></div>

                            <label for="recent_work_desc"><?php _e('Recent Work Description (Optional)', 'premitheme'); ?></label><br/>
                            <textarea class="increment" id="recent_work_desc" name="recent_work_desc[<?php echo $i; ?>]" cols="50" rows="4"><?php echo $recentWorkDesc; ?></textarea>

                            <div class="sep"></div>

                            <label for="recent_work_link"><?php _e('"View all" button URL (Optional)', 'premitheme'); ?></label><br/>
                            <input class="increment" type="text" id="recent_work_link" name="recent_work_link[<?php echo $i; ?>]" value="<?php echo $recentWorkLink; ?>">

                            <div class="sep"></div>

                            <label for="recent_work_count"><?php _e('Number of Rows', 'premitheme'); ?></label><br/>
                            <select class="medium increment" id="recent_work_count" name="recent_work_count[<?php echo $i; ?>]">
                                <option value="1" <?php selected('1', $recentWorkCount); ?>><?php _e('One row' ,'premitheme');?></option>
                                <option value="2" <?php selected('2', $recentWorkCount); ?>><?php _e('Tow rows' ,'premitheme');?></option>
                                <option value="3" <?php selected('3', $recentWorkCount); ?>><?php _e('Three rows' ,'premitheme');?></option>
                            </select>

                            <div class="sep"></div>

                            <label for="recent_work_cat"><?php _e('Portfolio Category', 'premitheme'); ?></label><br/>
                            <select class="medium increment" id="recent_work_cat" name="recent_work_cat[<?php echo $i; ?>]">
                                <option value="all" <?php selected('all', $recentWorkCat); ?>><?php _e('All', 'premitheme'); ?></option>
                                <?php foreach ($folio_cats as $folio_cat): ?>
                                    <option value="<?php echo $folio_cat->cat_ID; ?>" <?php selected($folio_cat->cat_ID, $recentWorkCat); ?>><?php echo $folio_cat->cat_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <p><?php _e( 'Select portfolio category to display its items', 'premitheme' ); ?></p>

                            <div class="sep"></div>

                            <label for="recent_work_open"><?php _e('Open in ...', 'premitheme'); ?></label><br/>
                            <select class="medium increment" id="recent_work_open" name="recent_work_open[<?php echo $i; ?>]">
                                <option value="page" <?php selected('page', $recentWorkOpen); ?>><?php _e('Separate Page' ,'premitheme');?></option>
                                <option value="lightbox" <?php selected('lightbox', $recentWorkOpen); ?>><?php _e('Lightbox' ,'premitheme');?></option>
                            </select>

                            <div class="sep"></div>

                            <label for="recent_work_orderby"><?php _e('Items Order By', 'premitheme'); ?></label><br/>
                            <select class="medium increment" id="recent_work_orderby" name="recent_work_orderby[<?php echo $i; ?>]">
                                <option value="date" <?php selected('date', $recentWorkOrderby); ?>><?php _e('Item\'s creation date' ,'premitheme');?></option>
                                <option value="menu_order" <?php selected('menu_order', $recentWorkOrderby); ?>><?php _e('Custom order' ,'premitheme');?></option>
                                <option value="title" <?php selected('title', $recentWorkOrderby); ?>><?php _e('Title' ,'premitheme');?></option>
                                <option value="rand" <?php selected('rand', $recentWorkOrderby); ?>><?php _e('Random' ,'premitheme');?></option>
                            </select>

                            <div class="sep"></div>

                            <label for="recent_work_order"><?php _e('Items Order', 'premitheme'); ?></label><br/>
                            <select class="medium increment" id="recent_work_order" name="recent_work_order[<?php echo $i; ?>]">
                                <option value="DESC" <?php selected('DESC', $recentWorkOrder); ?>><?php _e('Descending' ,'premitheme');?></option>
                                <option value="ASC" <?php selected('ASC', $recentWorkOrder); ?>><?php _e('Ascending' ,'premitheme');?></option>
                            </select>
                        </div>

                        <!-- RECENT POSTS SECTION
                        ========================================== -->
                        <div id="recent-posts-section" class="sub-section">
                            <label for="recent_posts_label"><?php _e('Recent Posts Label', 'premitheme'); ?></label><br/>
                            <input class="increment" type="text" id="recent_posts_label" name="recent_posts_label[<?php echo $i; ?>]" value="<?php echo $recentPostsLabel; ?>">
                            <p><?php _e( 'Defaults to "Recent Posts" if left empty.', 'premitheme' ); ?></p>

                            <div class="sep"></div>

                            <label for="recent_posts_desc"><?php _e('Recent Posts Description (Optional)', 'premitheme'); ?></label><br/>
                            <textarea class="increment" id="recent_posts_desc" name="recent_posts_desc[<?php echo $i; ?>]" cols="50" rows="4"><?php echo $recentPostsDesc; ?></textarea>

                            <div class="sep"></div>

                            <label for="recent_posts_link"><?php _e('"View all" button URL (Optional)', 'premitheme'); ?></label><br/>
                            <input class="increment" type="text" id="recent_posts_link" name="recent_posts_link[<?php echo $i; ?>]" value="<?php echo $recentPostsLink; ?>">

                            <div class="sep"></div>

                            <label for="recent_posts_cat"><?php _e('Blog Category', 'premitheme'); ?></label><br/>
                            <select class="medium increment" id="recent_posts_cat" name="recent_posts_cat[<?php echo $i; ?>]">
                                <option value="all" <?php selected('all', $recentPostsCat); ?>><?php _e('All', 'premitheme'); ?></option>
                                <?php foreach ($blog_cats as $blog_cat): ?>
                                    <option value="<?php echo $blog_cat->cat_ID; ?>" <?php selected($blog_cat->cat_ID, $recentPostsCat); ?>><?php echo $blog_cat->cat_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <p><?php _e( 'Select blog category to display its posts', 'premitheme' ); ?></p>

                            <div class="sep"></div>

                            <label for="recent_posts_orderby"><?php _e('Posts Order By', 'premitheme'); ?></label><br/>
                            <select class="medium increment" id="recent_posts_orderby" name="recent_posts_orderby[<?php echo $i; ?>]">
                                <option value="date" <?php selected('date', $recentPostsOrderby); ?>><?php _e('Post\'s creation date' ,'premitheme');?></option>
                                <option value="title" <?php selected('title', $recentPostsOrderby); ?>><?php _e('Title' ,'premitheme');?></option>
                                <option value="rand" <?php selected('rand', $recentPostsOrderby); ?>><?php _e('Random' ,'premitheme');?></option>
                            </select>

                            <div class="sep"></div>

                            <label for="recent_posts_order"><?php _e('Posts Order', 'premitheme'); ?></label><br/>
                            <select class="medium increment" id="recent_posts_order" name="recent_posts_order[<?php echo $i; ?>]">
                                <option value="DESC" <?php selected('DESC', $recentPostsOrder); ?>><?php _e('Descending' ,'premitheme');?></option>
                                <option value="ASC" <?php selected('ASC', $recentPostsOrder); ?>><?php _e('Ascending' ,'premitheme');?></option>
                            </select>
                        </div>

                        <!-- CLIENTS SECTION
                        ========================================== -->
                        <div id="clients-section" class="sub-section">
                            <label for="clients_label"><?php _e('Clients Label', 'premitheme'); ?></label><br/>
                            <input class="increment" type="text" id="clients_label" name="clients_label[<?php echo $i; ?>]" value="<?php echo $clientsLabel; ?>">
                            <p><?php _e( 'Defaults to "Clients" if left empty.', 'premitheme' ); ?></p>

                            <div class="sep"></div>

                            <label for="clients_desc"><?php _e('Clients Description (Optional)', 'premitheme'); ?></label><br/>
                            <textarea class="increment" id="clients_desc" name="clients_desc[<?php echo $i; ?>]" cols="50" rows="4"><?php echo $clientsDesc; ?></textarea>

                            <div class="sep"></div>

                            <label for="clients_orderby"><?php _e('Clients Order By', 'premitheme'); ?></label><br/>
                            <select class="medium increment" id="clients_orderby" name="clients_orderby[<?php echo $i; ?>]">
                                <option value="date" <?php selected('date', $clientsOrderby); ?>><?php _e('Client\'s creation date' ,'premitheme');?></option>
                                <option value="title" <?php selected('title', $clientsOrderby); ?>><?php _e('Title' ,'premitheme');?></option>
                                <option value="rand" <?php selected('rand', $clientsOrderby); ?>><?php _e('Random' ,'premitheme');?></option>
                            </select>

                            <div class="sep"></div>

                            <label for="clients_order"><?php _e('Clients Order', 'premitheme'); ?></label><br/>
                            <select class="medium increment" id="clients_order" name="clients_order[<?php echo $i; ?>]">
                                <option value="DESC" <?php selected('DESC', $clientsOrder); ?>><?php _e('Descending' ,'premitheme');?></option>
                                <option value="ASC" <?php selected('ASC', $clientsOrder); ?>><?php _e('Ascending' ,'premitheme');?></option>
                            </select>
                        </div>

                        <!-- TWITTER SECTION
                        ========================================== -->
                        <div id="twitter-section" class="sub-section">
                            <p class="note"><?php _e('To get your Consumer Key, Consumer secret, Access token and Access token secret, you need to create a Twitter Application <a href="https://dev.twitter.com/apps" target="_blank">(here)</a>', 'premitheme'); ?></p>

                            <label for="twitter_id"><?php _e('Twitter ID', 'premitheme'); ?></label><br/>
                            <input class="increment" type="text" id="twitter_id" name="twitter_id[<?php echo $i; ?>]" value="<?php echo $twitterId; ?>">

                            <div class="sep"></div>

                            <label for="twitter_cons_key"><?php _e('Consumer Key', 'premitheme'); ?></label><br/>
                            <input class="increment" type="text" id="twitter_cons_key" name="twitter_cons_key[<?php echo $i; ?>]" value="<?php echo $twitterConsKey; ?>">

                            <div class="sep"></div>

                            <label for="twitter_cons_secret"><?php _e('Consumer Secret', 'premitheme'); ?></label><br/>
                            <input class="increment" type="text" id="twitter_cons_secret" name="twitter_cons_secret[<?php echo $i; ?>]" value="<?php echo $twitterConsSecret; ?>">

                            <div class="sep"></div>

                            <label for="twitter_acc_token"><?php _e('Access Token', 'premitheme'); ?></label><br/>
                            <input class="increment" type="text" id="twitter_acc_token" name="twitter_acc_token[<?php echo $i; ?>]" value="<?php echo $twitterAccToken; ?>">

                            <div class="sep"></div>

                            <label for="twitter_acc_secret"><?php _e('Access Token Secret', 'premitheme'); ?></label><br/>
                            <input class="increment" type="text" id="twitter_acc_secret" name="twitter_acc_secret[<?php echo $i; ?>]" value="<?php echo $twitterAccSecret; ?>">
                        </div>

                        <!-- CUSTOM CONTENT SECTION
                        ========================================== -->
                        <div id="custom-section" class="sub-section">
                            <p class="note"><?php _e('There are no settings for this content section, just add the content that you want in the main page editor above.', 'premitheme'); ?></p>
                        </div>
                    </div>
                </li>
            <?php $i++; }
            } else { ?>
                <li class="postbox closed content-section-wrapper">
                    <a title="<?php _e('Remove', 'premitheme'); ?>" class="repeatable-remove button" href="#"><i class="fa fa-trash-o"></i></a>
                    <div title="<?php _e('Section Settings', 'premitheme'); ?>" class="handlediv button"><i class="fa fa-cog"></i></div>

                    <div class="content-section-header">
                        <span class="sort hndle button" title="<?php _e('Drag to arrange', 'premitheme'); ?>"><i class="fa fa-bars"></i></span>
                        <select class="section-select increment" name="section_select[0]" id="section_select">
                            <option value="0"><?php _e('Please select &hellip;', 'premitheme'); ?></option>
                            <option value="callout-message"><?php _e('Callout Message', 'premitheme'); ?></option>
                            <option value="flex-slider"><?php _e('Flex Slider', 'premitheme'); ?></option>
                            <option value="video-banner"><?php _e('Video Banner', 'premitheme'); ?></option>
                            <option value="fixed-image"><?php _e('Fixed Image Banner', 'premitheme'); ?></option>
                            <option value="grid-showcase"><?php _e('Portfolio Grid Showcase', 'premitheme'); ?></option>
                            <option value="recent-work-row"><?php _e('Recent Work', 'premitheme'); ?></option>
                            <option value="recent-posts-row"><?php _e('Recent Posts', 'premitheme'); ?></option>
                            <option value="clients"><?php _e('Clients', 'premitheme'); ?></option>
                            <option value="twitter"><?php _e('Last Twitter Feed', 'premitheme'); ?></option>
                            <option value="custom"><?php _e('Custom Content', 'premitheme'); ?></option>
                        </select>
                    </div>

                    
                    <div class="inside content-section-settings">
                        <!-- CALLOUT MESSAGE SECTION
                        ========================================== -->
                        <div id="callout-message-section" class="sub-section">
                            <label for="callout_message"><?php _e('Callout Message', 'premitheme'); ?></label><br/>
                            <textarea class="increment" id="callout_message" name="callout_message[0]" cols="50" rows="4"></textarea>
                            <p><?php _e('Description text', 'premitheme'); ?></p>
                        </div>

                        <!-- FLEX SLIDER SECTION
                        ========================================== -->
                        <div id="flex-slider-section" class="sub-section">
                            <label for="slider_set"><?php _e('Slider Set', 'premitheme'); ?></label><br/>
                            <select class="medium increment" id="slider_set" name="slider_set[0]">
                                <option value="all"><?php _e('All Slides', 'premitheme'); ?></option>
                                <?php foreach ($slider_cats as $slider_cat): ?>
                                    <option value="<?php echo $slider_cat->cat_ID; ?>"><?php echo $slider_cat->cat_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <p><?php _e('Select slider set to display its slides.', 'premitheme'); ?></p>

                            <div class="sep"></div>

                            <label for="slider_height"><?php _e('Slider Height', 'premitheme'); ?></label><br/>
                            <input class="small increment" type="text" id="slider_height" name="slider_height[0]" value="">px
                            <p><?php _e('Required. Defaults to 300px if left empty', 'premitheme'); ?></p>

                            <div class="sep"></div>

                            <label for="slider_orderby"><?php _e('Slides Order By', 'premitheme'); ?></label><br/>
                            <select class="medium increment" id="slider_orderby" name="slider_orderby[0]">
                                <option value="date"><?php _e('Creation date', 'premitheme'); ?></option>
                                <option value="menu_order"><?php _e('Custom order', 'premitheme'); ?></option>
                                <option value="rand"><?php _e('Random', 'premitheme'); ?></option>
                            </select>

                            <div class="sep"></div>

                            <label for="slider_order"><?php _e('Slides Order', 'premitheme'); ?></label><br/>
                            <select class="medium increment" id="slider_order" name="slider_order[0]">
                                <option value="DESC"><?php _e('Descending', 'premitheme'); ?></option>
                                <option value="ASC"><?php _e('Ascending', 'premitheme'); ?></option>
                            </select>
                        </div>

                        <!-- VIDEO BANNER SECTION
                        ========================================== -->
                        <div id="video-banner-section" class="sub-section">
                            <label for="video_banner_embed"><?php _e('Remotely Hosted Video Embed Code (Use instead of the next field below for more controlled video embedding).', 'premitheme'); ?></label><br/>
                            <textarea class="increment" id="video_banner_embed" name="video_banner_embed[0]" cols="50" rows="4"></textarea>
                            <p><?php printf( __('Enter the embed code of remotely-hosted video. Overrides the next field.Set the height according to %s width.', 'premitheme'), $pt_themeFullWidth); ?></p>

                            <div class="sep"></div>

                            <label for="video_banner_url"><?php _e('Remotely Hosted Video URL (For easy embed, if not using embed code above).', 'premitheme'); ?></label><br/>
                            <input class="increment" type="text" id="video_banner_url" name="video_banner_url[0]" value="">
                            <p><?php _e('Enter just the URL of the video page (auto embed). Only remotely-hosted videos supported (i.e. youtube, vimeo &hellip; etc).', 'premitheme');?><a href="http://codex.wordpress.org/Embeds" target="_blank"><?php _e( 'List of supported video hosts', 'premitheme'); ?></a>. <?php _e('Always use the full absolute URL including "http://".', 'premitheme' ); ?></p>

                            <div class="sep"></div>

                            <ul>
                                <li>
                                    <label for="video_banner_mfourv"><?php _e('Self-hosted M4V Video File', 'premitheme'); ?></label><br/>
                                    <input class="increment" type="text" id="video_banner_mfourv" name="video_banner_mfourv[0]" value="">
                                    <input type="button" name="upload_image_button" class="upload_img button" value="<?php _e('Upload', 'premitheme'); ?>"/>
                                    <p><?php _e('MUST be provided.', 'premitheme'); ?></p>
                                </li>
                            </ul>

                            <div class="sep"></div>

                            <ul>
                                <li>
                                    <label for="video_banner_ogv"><?php _e('Self-hosted OGV/OGG Video File', 'premitheme'); ?></label><br/>
                                    <input class="increment" type="text" id="video_banner_ogv" name="video_banner_ogv[0]" value="">
                                    <input type="button" name="upload_image_button" class="upload_img button" value="<?php _e('Upload', 'premitheme'); ?>"/>
                                    <p><?php _e('MUST be provided, for better browser support.', 'premitheme'); ?></p>
                                </li>
                            </ul>
                            
                            <div class="sep"></div>
                            
                            <ul>
                                <li>
                                    <label for="video_banner_poster"><?php _e('Self-hosted Video Poster Image', 'premitheme'); ?></label><br/>
                                    <input class="increment" type="text" id="video_banner_poster" name="video_banner_poster[0]" value="">
                                    <input type="button" name="upload_image_button" class="upload_img button" value="<?php _e('Upload', 'premitheme'); ?>"/>
                                    <p><?php _e('MUST be provided, to be shown before play.', 'premitheme'); ?></p>
                                </li>
                            </ul>
                            
                            <div class="sep"></div>
                            
                            <label for="video_banner_height"><?php _e('Self-hosted Video Height', 'premitheme'); ?></label><br/>
                            <input type="text" id="video_banner_height" name="video_banner_height[0]" value="" class="small increment">px
                            <p><?php printf( __('MUST be provided, according to %s width. Could be decimal number.', 'premitheme'), $pt_themeFullWidth); ?></p>
                        </div>

                        <!-- FIXED IMAGE SECTION
                        ========================================== -->
                        <div id="fixed-image-section" class="sub-section">
                            <ul>
                                <li>
                                    <label for="fixed_img_url"><?php _e('Image URL', 'premitheme'); ?></label><br/>
                                    <input class="increment" type="text" id="fixed_img_url" name="fixed_img_url[0]" value="">
                                    <input type="button" name="upload_image_button" class="upload_img button" value="<?php _e('Upload', 'premitheme'); ?>"/>
                                    <p><?php printf( __('Image shouldn\'t be less than <strong>%s width</strong> with no height limitations. Always use the full absolute URL including "http://"', 'premitheme'), $pt_themeFullWidth); ?></p>
                                </li>
                            </ul>

                            <div class="sep"></div>

                            <label for="fixed_img_height"><?php _e('Image Height', 'premitheme'); ?></strong></label><br/>
                            <input class="small increment" type="text" id="fixed_img_height" name="fixed_img_height[0]" value="">px
                            <p><?php _e('Required. Defaults to 300px if left empty', 'premitheme'); ?></p>

                            <div class="sep"></div>

                            <label for="fixed_img_link"><?php _e('Image Link (optional)', 'premitheme'); ?></label><br/>
                            <input class="increment" type="text" id="fixed_img_link" name="fixed_img_link[0]" value="">
                            <p><?php _e('Enter a link URL if you want the image to be hyperlinked to somewhere. Always use the full absolute URL including "http://"', 'premitheme'); ?></p>

                            <div class="sep"></div>

                            <label for="fixed_img_titleAttr"><?php _e('Image Title Attribute (optional)', 'premitheme'); ?></label><br/>
                            <input class="increment" type="text" id="fixed_img_titleAttr" name="fixed_img_titleAttr[0]" value="">
                            <p><?php _e('Enter an optional title attribute text to be shown when hover over the image.', 'premitheme'); ?></p>
                        </div>

                        <!-- GRID SHOWCASE SECTION
                        ========================================== -->
                        <div id="grid-showcase-section" class="sub-section">
                            <label for="grid_showcase_label"><?php _e('Grid Showcase Heading (optional)', 'premitheme'); ?></label><br/>
                            <input class="increment" type="text" id="grid_showcase_label" name="grid_showcase_label[0]" value="">

                            <div class="sep"></div>

                            <label for="grid_showcase_desc"><?php _e('Grid Showcase Description (optional)', 'premitheme'); ?></label><br/>
                            <textarea class="increment" id="grid_showcase_desc" name="grid_showcase_desc[0]" cols="50" rows="4"></textarea>

                            <div class="sep"></div>

                            <label for="grid_showcase_count"><?php _e('Number of Rows', 'premitheme'); ?></label><br/>
                            <select class="medium increment" id="grid_showcase_count" name="grid_showcase_count[0]">
                                <option value="2"><?php _e('Two rows' ,'premitheme');?></option>
                                <option value="3"><?php _e('Three rows' ,'premitheme');?></option>
                            </select>

                            <div class="sep"></div>

                            <label for="grid_showcase_cat"><?php _e('Portfolio Category', 'premitheme'); ?></label><br/>
                            <select class="medium increment" id="grid_showcase_cat" name="grid_showcase_cat[0]">
                                <option value="all"><?php _e('All', 'premitheme'); ?></option>
                                <?php foreach ($folio_cats as $folio_cat): ?>
                                    <option value="<?php echo $folio_cat->cat_ID; ?>"><?php echo $folio_cat->cat_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <p><?php _e( 'Select portfolio category to display its items', 'premitheme' ); ?></p>

                            <div class="sep"></div>

                            <label for="grid_showcase_open"><?php _e('Open in ...', 'premitheme'); ?></label><br/>
                            <select class="medium increment" id="grid_showcase_open" name="grid_showcase_open[0]">
                                <option value="page"><?php _e('Separate Page' ,'premitheme');?></option>
                                <option value="lightbox"><?php _e('Lightbox' ,'premitheme');?></option>
                            </select>

                            <div class="sep"></div>

                            <label for="grid_showcase_orderby"><?php _e('Items Order By', 'premitheme'); ?></label><br/>
                            <select class="medium increment" id="grid_showcase_orderby" name="grid_showcase_orderby[0]">
                                <option value="date"><?php _e('Item\'s creation date' ,'premitheme');?></option>
                                <option value="menu_order"><?php _e('Custom order' ,'premitheme');?></option>
                                <option value="title"><?php _e('Title' ,'premitheme');?></option>
                                <option value="rand"><?php _e('Random' ,'premitheme');?></option>
                            </select>

                            <div class="sep"></div>

                            <label for="grid_showcase_order"><?php _e('Items Order', 'premitheme'); ?></label><br/>
                            <select class="medium increment" id="grid_showcase_order" name="grid_showcase_order[0]">
                                <option value="DESC"><?php _e('Descending' ,'premitheme');?></option>
                                <option value="ASC"><?php _e('Ascending' ,'premitheme');?></option>
                            </select>
                        </div>

                        <!-- RECENT WORK SECTION
                        ========================================== -->
                        <div id="recent-work-section" class="sub-section">
                            <label for="recent_work_label"><?php _e('Recent Work Label', 'premitheme'); ?></label><br/>
                            <input class="increment" type="text" id="recent_work_label" name="recent_work_label[0]" value="">
                            <p><?php _e( 'Defaults to "Recent Work" if left empty.', 'premitheme' ); ?></p>

                            <div class="sep"></div>

                            <label for="recent_work_desc"><?php _e('Recent Work Description (Optional)', 'premitheme'); ?></label><br/>
                            <textarea class="increment" id="recent_work_desc" name="recent_work_desc[0]" cols="50" rows="4"></textarea>

                            <div class="sep"></div>

                            <label for="recent_work_link"><?php _e('"View all" button URL (Optional)', 'premitheme'); ?></label><br/>
                            <input class="increment" type="text" id="recent_work_link" name="recent_work_link[0]" value="">

                            <div class="sep"></div>

                            <label for="recent_work_count"><?php _e('Number of Rows', 'premitheme'); ?></label><br/>
                            <select class="medium increment" id="recent_work_count" name="recent_work_count[0]">
                                <option value="1"><?php _e('One row' ,'premitheme');?></option>
                                <option value="2"><?php _e('Tow rows' ,'premitheme');?></option>
                                <option value="3"><?php _e('Three rows' ,'premitheme');?></option>
                            </select>

                            <div class="sep"></div>

                            <label for="recent_work_cat"><?php _e('Portfolio Category', 'premitheme'); ?></label><br/>
                            <select class="medium increment" id="recent_work_cat" name="recent_work_cat[0]">
                                <option value="all"><?php _e('All', 'premitheme'); ?></option>
                                <?php foreach ($folio_cats as $folio_cat): ?>
                                    <option value="<?php echo $folio_cat->cat_ID; ?>"><?php echo $folio_cat->cat_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <p><?php _e( 'Select portfolio category to display its items', 'premitheme' ); ?></p>

                            <div class="sep"></div>

                            <label for="recent_work_open"><?php _e('Open in ...', 'premitheme'); ?></label><br/>
                            <select class="medium increment" id="recent_work_open" name="recent_work_open[0]">
                                <option value="page"><?php _e('Separate Page' ,'premitheme');?></option>
                                <option value="lightbox"><?php _e('Lightbox' ,'premitheme');?></option>
                            </select>

                            <div class="sep"></div>

                            <label for="recent_work_orderby"><?php _e('Items Order By', 'premitheme'); ?></label><br/>
                            <select class="medium increment" id="recent_work_orderby" name="recent_work_orderby[0]">
                                <option value="date"><?php _e('Item\'s creation date' ,'premitheme');?></option>
                                <option value="menu_order"><?php _e('Custom order' ,'premitheme');?></option>
                                <option value="title"><?php _e('Title' ,'premitheme');?></option>
                                <option value="rand"><?php _e('Random' ,'premitheme');?></option>
                            </select>

                            <div class="sep"></div>

                            <label for="recent_work_order"><?php _e('Items Order', 'premitheme'); ?></label><br/>
                            <select class="medium increment" id="recent_work_order" name="recent_work_order[0]">
                                <option value="DESC"><?php _e('Descending' ,'premitheme');?></option>
                                <option value="ASC"><?php _e('Ascending' ,'premitheme');?></option>
                            </select>
                        </div>

                        <!-- RECENT POSTS SECTION
                        ========================================== -->
                        <div id="recent-posts-section" class="sub-section">
                            <label for="recent_posts_label"><?php _e('Recent Posts Label', 'premitheme'); ?></label><br/>
                            <input class="increment" type="text" id="recent_posts_label" name="recent_posts_label[0]" value="">
                            <p><?php _e( 'Defaults to "Recent Posts" if left empty.', 'premitheme' ); ?></p>

                            <div class="sep"></div>

                            <label for="recent_posts_desc"><?php _e('Recent Posts Description (Optional)', 'premitheme'); ?></label><br/>
                            <textarea class="increment" id="recent_posts_desc" name="recent_posts_desc[0]" cols="50" rows="4"></textarea>

                            <div class="sep"></div>

                            <label for="recent_posts_link"><?php _e('"View all" button URL (Optional)', 'premitheme'); ?></label><br/>
                            <input class="increment" type="text" id="recent_posts_link" name="recent_posts_link[0]" value="">

                            <div class="sep"></div>

                            <label for="recent_posts_cat"><?php _e('Blog Category', 'premitheme'); ?></label><br/>
                            <select class="medium increment" id="recent_posts_cat" name="recent_posts_cat[0]">
                                <option value="all"><?php _e('All', 'premitheme'); ?></option>
                                <?php foreach ($blog_cats as $blog_cat): ?>
                                    <option value="<?php echo $blog_cat->cat_ID; ?>"><?php echo $blog_cat->cat_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <p><?php _e( 'Select blog category to display its posts', 'premitheme' ); ?></p>

                            <div class="sep"></div>

                            <label for="recent_posts_orderby"><?php _e('Posts Order By', 'premitheme'); ?></label><br/>
                            <select class="medium increment" id="recent_posts_orderby" name="recent_posts_orderby[0]">
                                <option value="date"><?php _e('Post\'s creation date' ,'premitheme');?></option>
                                <option value="title"><?php _e('Title' ,'premitheme');?></option>
                                <option value="rand"><?php _e('Random' ,'premitheme');?></option>
                            </select>

                            <div class="sep"></div>

                            <label for="recent_posts_order"><?php _e('Posts Order', 'premitheme'); ?></label><br/>
                            <select class="medium increment" id="recent_posts_order" name="recent_posts_order[0]">
                                <option value="DESC"><?php _e('Descending' ,'premitheme');?></option>
                                <option value="ASC"><?php _e('Ascending' ,'premitheme');?></option>
                            </select>
                        </div>

                        <!-- CLIENTS SECTION
                        ========================================== -->
                        <div id="clients-section" class="sub-section">
                            <label for="clients_label"><?php _e('Clients Label', 'premitheme'); ?></label><br/>
                            <input class="increment" type="text" id="clients_label" name="clients_label[0]" value="">
                            <p><?php _e( 'Defaults to "Clients" if left empty.', 'premitheme' ); ?></p>

                            <div class="sep"></div>

                            <label for="clients_desc"><?php _e('Clients Description (Optional)', 'premitheme'); ?></label><br/>
                            <textarea class="increment" id="clients_desc" name="clients_desc[0]" cols="50" rows="4"></textarea>

                            <div class="sep"></div>

                            <label for="clients_orderby"><?php _e('Clients Order By', 'premitheme'); ?></label><br/>
                            <select class="medium increment" id="clients_orderby" name="clients_orderby[0]">
                                <option value="date"><?php _e('Client\'s creation date' ,'premitheme');?></option>
                                <option value="title"><?php _e('Title' ,'premitheme');?></option>
                                <option value="rand"><?php _e('Random' ,'premitheme');?></option>
                            </select>

                            <div class="sep"></div>

                            <label for="clients_order"><?php _e('Clients Order', 'premitheme'); ?></label><br/>
                            <select class="medium increment" id="clients_order" name="clients_order[0]">
                                <option value="DESC"><?php _e('Descending' ,'premitheme');?></option>
                                <option value="ASC"><?php _e('Ascending' ,'premitheme');?></option>
                            </select>
                        </div>

                        <!-- TWITTER SECTION
                        ========================================== -->
                        <div id="twitter-section" class="sub-section">
                            <p class="note"><?php _e('To get your Consumer Key, Consumer secret, Access token and Access token secret, you need to create a Twitter Application <a href="https://dev.twitter.com/apps" target="_blank">(here)</a>', 'premitheme'); ?></p>

                            <label for="twitter_id"><?php _e('Twitter ID', 'premitheme'); ?></label><br/>
                            <input class="increment" type="text" id="twitter_id" name="twitter_id[0]" value="">

                            <div class="sep"></div>

                            <label for="twitter_cons_key"><?php _e('Consumer Key', 'premitheme'); ?></label><br/>
                            <input class="increment" type="text" id="twitter_cons_key" name="twitter_cons_key[0]" value="">

                            <div class="sep"></div>

                            <label for="twitter_cons_secret"><?php _e('Consumer Secret', 'premitheme'); ?></label><br/>
                            <input class="increment" type="text" id="twitter_cons_secret" name="twitter_cons_secret[0]" value="">

                            <div class="sep"></div>

                            <label for="twitter_acc_token"><?php _e('Access Token', 'premitheme'); ?></label><br/>
                            <input class="increment" type="text" id="twitter_acc_token" name="twitter_acc_token[0]" value="">

                            <div class="sep"></div>

                            <label for="twitter_acc_secret"><?php _e('Access Token Secret', 'premitheme'); ?></label><br/>
                            <input class="increment" type="text" id="twitter_acc_secret" name="twitter_acc_secret[0]" value="">
                        </div>

                        <!-- CUSTOM CONTENT SECTION
                        ========================================== -->
                        <div id="custom-section" class="sub-section">
                            <p class="note"><?php _e('There are no settings for this content section, just add the content that you want in the main page editor above.', 'premitheme'); ?></p>
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
        <a class="repeatable-add button" href="#"><i class="fa fa-plus-circle"></i> <?php _e('Add Section', 'premitheme'); ?></a>
    </div>
<?php }


/* SAVE METABOXS
=====================*/

/* CONTENT BUILDER SAVE */
add_action( 'save_post', 'premitheme_save_content_builder_metabox' );
function premitheme_save_content_builder_metabox( $post_id ) {
    global $post_id;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if ( !isset($_POST['content-builder-meta-box-nonce']) || !wp_verify_nonce($_POST['content-builder-meta-box-nonce'], 'content_builder_meta_box_nonce') ) return; 
    if ( !current_user_can( 'edit_posts' ) ) return;

    if( isset( $_POST['use_home_footer'] ) ){
        update_post_meta($post_id, 'use_home_footer', '1');
    } else {
        update_post_meta($post_id, 'use_home_footer', '0');
    }



    if ( isset($_POST['section_select']) ){
        $section_selects = $_POST['section_select'];
        update_post_meta($post_id,'section_select',$section_selects);
    }else{
        delete_post_meta($post_id,'section_select');
    }



    if ( isset($_POST['callout_message']) ){
        $callout_messages = $_POST['callout_message'];
        update_post_meta($post_id,'callout_message',$callout_messages);
    }else{
        delete_post_meta($post_id,'callout_message');
    }



    if ( isset($_POST['slider_set']) ){
        $slider_sets = $_POST['slider_set'];
        update_post_meta($post_id,'slider_set',$slider_sets);
    }else{
        delete_post_meta($post_id,'slider_set');
    }

    if ( isset($_POST['slider_height']) ){
        $slider_heights = $_POST['slider_height'];
        update_post_meta($post_id,'slider_height',$slider_heights);
    }else{
        delete_post_meta($post_id,'slider_height');
    }

    if ( isset($_POST['slider_orderby']) ){
        $slider_orderbys = $_POST['slider_orderby'];
        update_post_meta($post_id,'slider_orderby',$slider_orderbys);
    }else{
        delete_post_meta($post_id,'slider_orderby');
    }

    if ( isset($_POST['slider_order']) ){
        $slider_orders = $_POST['slider_order'];
        update_post_meta($post_id,'slider_order',$slider_orders);
    }else{
        delete_post_meta($post_id,'slider_order');
    }



    if ( isset($_POST['video_banner_embed']) ){
        $video_banner_embeds = $_POST['video_banner_embed'];
        update_post_meta($post_id,'video_banner_embed',$video_banner_embeds);
    }else{
        delete_post_meta($post_id,'video_banner_embed');
    }

    if ( isset($_POST['video_banner_url']) ){
        $video_banner_urls = $_POST['video_banner_url'];
        update_post_meta($post_id,'video_banner_url',$video_banner_urls);
    }else{
        delete_post_meta($post_id,'video_banner_url');
    }

    if ( isset($_POST['video_banner_mfourv']) ){
        $video_banner_m4vs = $_POST['video_banner_mfourv'];
        update_post_meta($post_id,'video_banner_mfourv',$video_banner_m4vs);
    }else{
        delete_post_meta($post_id,'video_banner_mfourv');
    }

    if ( isset($_POST['video_banner_ogv']) ){
        $video_banner_ogvs = $_POST['video_banner_ogv'];
        update_post_meta($post_id,'video_banner_ogv',$video_banner_ogvs);
    }else{
        delete_post_meta($post_id,'video_banner_ogv');
    }

    if ( isset($_POST['video_banner_poster']) ){
        $video_banner_posters = $_POST['video_banner_poster'];
        update_post_meta($post_id,'video_banner_poster',$video_banner_posters);
    }else{
        delete_post_meta($post_id,'video_banner_poster');
    }

    if ( isset($_POST['video_banner_height']) ){
        $video_banner_heights = $_POST['video_banner_height'];
        update_post_meta($post_id,'video_banner_height',$video_banner_heights);
    }else{
        delete_post_meta($post_id,'video_banner_height');
    }

    if ( isset($_POST['video_banner_height']) ){
        $video_banner_heights = $_POST['video_banner_height'];
        update_post_meta($post_id,'video_banner_height',$video_banner_heights);
    }else{
        delete_post_meta($post_id,'video_banner_height');
    }



    if ( isset($_POST['fixed_img_url']) ){
        $fixed_img_urls = $_POST['fixed_img_url'];
        update_post_meta($post_id,'fixed_img_url',$fixed_img_urls);
    }else{
        delete_post_meta($post_id,'fixed_img_url');
    }

    if ( isset($_POST['fixed_img_height']) ){
        $fixed_img_heights = $_POST['fixed_img_height'];
        update_post_meta($post_id,'fixed_img_height',$fixed_img_heights);
    }else{
        delete_post_meta($post_id,'fixed_img_height');
    }

    if ( isset($_POST['fixed_img_link']) ){
        $fixed_img_links = $_POST['fixed_img_link'];
        update_post_meta($post_id,'fixed_img_link',$fixed_img_links);
    }else{
        delete_post_meta($post_id,'fixed_img_link');
    }

    if ( isset($_POST['fixed_img_titleAttr']) ){
        $fixed_img_titleAttrs = $_POST['fixed_img_titleAttr'];
        update_post_meta($post_id,'fixed_img_titleAttr',$fixed_img_titleAttrs);
    }else{
        delete_post_meta($post_id,'fixed_img_titleAttr');
    }



    if ( isset($_POST['grid_showcase_count']) ){
        $grid_showcase_counts = $_POST['grid_showcase_count'];
        update_post_meta($post_id,'grid_showcase_count',$grid_showcase_counts);
    }else{
        delete_post_meta($post_id,'grid_showcase_count');
    }

    if ( isset($_POST['grid_showcase_label']) ){
        $grid_showcase_labels = $_POST['grid_showcase_label'];
        update_post_meta($post_id,'grid_showcase_label',$grid_showcase_labels);
    }else{
        delete_post_meta($post_id,'grid_showcase_label');
    }

    if ( isset($_POST['grid_showcase_desc']) ){
        $grid_showcase_descs = $_POST['grid_showcase_desc'];
        update_post_meta($post_id,'grid_showcase_desc',$grid_showcase_descs);
    }else{
        delete_post_meta($post_id,'grid_showcase_desc');
    }

    if ( isset($_POST['grid_showcase_cat']) ){
        $grid_showcase_cats = $_POST['grid_showcase_cat'];
        update_post_meta($post_id,'grid_showcase_cat',$grid_showcase_cats);
    }else{
        delete_post_meta($post_id,'grid_showcase_cat');
    }

    if ( isset($_POST['grid_showcase_open']) ){
        $grid_showcase_opens = $_POST['grid_showcase_open'];
        update_post_meta($post_id,'grid_showcase_open',$grid_showcase_opens);
    }else{
        delete_post_meta($post_id,'grid_showcase_open');
    }

    if ( isset($_POST['grid_showcase_orderby']) ){
        $grid_showcase_orderbys = $_POST['grid_showcase_orderby'];
        update_post_meta($post_id,'grid_showcase_orderby',$grid_showcase_orderbys);
    }else{
        delete_post_meta($post_id,'grid_showcase_orderby');
    }

    if ( isset($_POST['grid_showcase_order']) ){
        $grid_showcase_orders = $_POST['grid_showcase_order'];
        update_post_meta($post_id,'grid_showcase_order',$grid_showcase_orders);
    }else{
        delete_post_meta($post_id,'grid_showcase_order');
    }



    if ( isset($_POST['recent_work_count']) ){
        $recent_work_counts = $_POST['recent_work_count'];
        update_post_meta($post_id,'recent_work_count',$recent_work_counts);
    }else{
        delete_post_meta($post_id,'recent_work_count');
    }

    if ( isset($_POST['recent_work_label']) ){
        $recent_work_labels = $_POST['recent_work_label'];
        update_post_meta($post_id,'recent_work_label',$recent_work_labels);
    }else{
        delete_post_meta($post_id,'recent_work_label');
    }

    if ( isset($_POST['recent_work_desc']) ){
        $recent_work_descs = $_POST['recent_work_desc'];
        update_post_meta($post_id,'recent_work_desc',$recent_work_descs);
    }else{
        delete_post_meta($post_id,'recent_work_desc');
    }

    if ( isset($_POST['recent_work_link']) ){
        $recent_work_links = $_POST['recent_work_link'];
        update_post_meta($post_id,'recent_work_link',$recent_work_links);
    }else{
        delete_post_meta($post_id,'recent_work_link');
    }

    if ( isset($_POST['recent_work_cat']) ){
        $recent_work_cats = $_POST['recent_work_cat'];
        update_post_meta($post_id,'recent_work_cat',$recent_work_cats);
    }else{
        delete_post_meta($post_id,'recent_work_cat');
    }

    if ( isset($_POST['recent_work_open']) ){
        $recent_work_opens = $_POST['recent_work_open'];
        update_post_meta($post_id,'recent_work_open',$recent_work_opens);
    }else{
        delete_post_meta($post_id,'recent_work_open');
    }

    if ( isset($_POST['recent_work_orderby']) ){
        $recent_work_orderbys = $_POST['recent_work_orderby'];
        update_post_meta($post_id,'recent_work_orderby',$recent_work_orderbys);
    }else{
        delete_post_meta($post_id,'recent_work_orderby');
    }

    if ( isset($_POST['recent_work_order']) ){
        $recent_work_orders = $_POST['recent_work_order'];
        update_post_meta($post_id,'recent_work_order',$recent_work_orders);
    }else{
        delete_post_meta($post_id,'recent_work_order');
    }



    if ( isset($_POST['recent_posts_label']) ){
        $recent_posts_labels = $_POST['recent_posts_label'];
        update_post_meta($post_id,'recent_posts_label',$recent_posts_labels);
    }else{
        delete_post_meta($post_id,'recent_posts_label');
    }

    if ( isset($_POST['recent_posts_desc']) ){
        $recent_posts_descs = $_POST['recent_posts_desc'];
        update_post_meta($post_id,'recent_posts_desc',$recent_posts_descs);
    }else{
        delete_post_meta($post_id,'recent_posts_desc');
    }

    if ( isset($_POST['recent_posts_link']) ){
        $recent_posts_links = $_POST['recent_posts_link'];
        update_post_meta($post_id,'recent_posts_link',$recent_posts_links);
    }else{
        delete_post_meta($post_id,'recent_posts_link');
    }

    if ( isset($_POST['recent_posts_cat']) ){
        $recent_posts_cats = $_POST['recent_posts_cat'];
        update_post_meta($post_id,'recent_posts_cat',$recent_posts_cats);
    }else{
        delete_post_meta($post_id,'recent_posts_cat');
    }

    if ( isset($_POST['recent_posts_orderby']) ){
        $recent_posts_orderbys = $_POST['recent_posts_orderby'];
        update_post_meta($post_id,'recent_posts_orderby',$recent_posts_orderbys);
    }else{
        delete_post_meta($post_id,'recent_posts_orderby');
    }

    if ( isset($_POST['recent_posts_order']) ){
        $recent_posts_orders = $_POST['recent_posts_order'];
        update_post_meta($post_id,'recent_posts_order',$recent_posts_orders);
    }else{
        delete_post_meta($post_id,'recent_posts_order');
    }



    if ( isset($_POST['clients_label']) ){
    $clients_labels = $_POST['clients_label'];
        update_post_meta($post_id,'clients_label',$clients_labels);
    }else{
        delete_post_meta($post_id,'clients_label');
    }

    if ( isset($_POST['clients_desc']) ){
    $clients_descs = $_POST['clients_desc'];
        update_post_meta($post_id,'clients_desc',$clients_descs);
    }else{
        delete_post_meta($post_id,'clients_desc');
    }

    if ( isset($_POST['clients_orderby']) ){
        $clients_orderbys = $_POST['clients_orderby'];
        update_post_meta($post_id,'clients_orderby',$clients_orderbys);
    }else{
        delete_post_meta($post_id,'clients_orderby');
    }

    if ( isset($_POST['clients_order']) ){
        $clients_orders = $_POST['clients_order'];
        update_post_meta($post_id,'clients_order',$clients_orders);
    }else{
        delete_post_meta($post_id,'clients_order');
    }



    if ( isset($_POST['twitter_id']) ){
    $twitter_ids = $_POST['twitter_id'];
        update_post_meta($post_id,'twitter_id',$twitter_ids);
    }else{
        delete_post_meta($post_id,'twitter_id');
    }

    if ( isset($_POST['twitter_cons_key']) ){
    $twitter_cons_key = $_POST['twitter_cons_key'];
        update_post_meta($post_id,'twitter_cons_key',$twitter_cons_key);
    }else{
        delete_post_meta($post_id,'twitter_cons_key');
    }

    if ( isset($_POST['twitter_cons_secret']) ){
    $twitter_cons_secrets = $_POST['twitter_cons_secret'];
        update_post_meta($post_id,'twitter_cons_secret',$twitter_cons_secrets);
    }else{
        delete_post_meta($post_id,'twitter_cons_secret');
    }

    if ( isset($_POST['twitter_acc_token']) ){
        $twitter_acc_tokens = $_POST['twitter_acc_token'];
        update_post_meta($post_id,'twitter_acc_token',$twitter_acc_tokens);
    }else{
        delete_post_meta($post_id,'twitter_acc_token');
    }

    if ( isset($_POST['twitter_acc_secret']) ){
        $twitter_acc_secrets = $_POST['twitter_acc_secret'];
        update_post_meta($post_id,'twitter_acc_secret',$twitter_acc_secrets);
    }else{
        delete_post_meta($post_id,'twitter_acc_secret');
    }
}